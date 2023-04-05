<?php

declare(strict_types=1);

require_once("./app/model/searchWords.php");
require_once("./app/model/searcher.php");
require_once("./app/model/searchHistorySaver.php");
require_once("./app/model/cookieSetter.php");
require_once("./app/model/searchHistorySaver.php");
require_once("./app/view/searchRetryView.php");
require_once("./app/controller/maxDisplayCountCalculator.php");
require_once("./app/controller/displayCountGetter.php");
require_once("./app/controller/offsetCalculator.php");
require_once("./app/controller/currentPageCountGetter.php");
require_once("./app/classStringHighlighter.php");

// キャッシュを使わせない(クッキーを利用するため)
header("Cache-Control: no-cache, must-revalidate");

$searchWordString = $_GET["search_words"];
$searchWords = new SearchWords($searchWordString);
$searchWordByComma = $searchWords->getStringByComma();
# $searchTarget = $_GET["search_target"];

// 文字列が空の場合、やり直させる
retrySearchIfEmpty($searchWords);

// 検索
$searchResult = (new Searcher($searchWords))->search();
# $searchResult = $searcher->search($searchTarget);

// 検索結果が一件もない場合、やり直させる
retrySearchIfNoResult($searchResult);

// ヒット数が多い場合、やり直させる
retrySearchIfTooManyResults($searchResult);

// 検索履歴を保存
$referrer = $_SERVER["HTTP_REFERER"];
(new searchHistorySaver($searchWords))->SaveSearchHistoryIfTopPage($referrer);

// 検索ページに戻ったときに備え、クッキーを保存
(new CookieSetter("search_words", $searchWordByComma))->set($referrer);

// 一度に表示する検索結果の数
$displayCount = (new DisplayCountGetter((int)$_GET["display_count"]))->get();

// ページネーションのために現在のページ数を取得
$currentPage = (new CurrentPageCountGetter((int)$_GET["page"]))->get();

// 検索結果のオフセットを計算
$offset = (new OffsetCalculator($currentPage, $displayCount))->get();

// 一度に表示する検索結果の数を計算
$maxDisplayCountThisPage = (new MaxDisplayCountCalculator(count($searchResult), $offset, $displayCount))->get();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>プレビュー</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/result/common.css">
    <link rel="stylesheet" media="screen and (max-width: 767px)" href="css/result/mobile.css">
    <link rel="stylesheet" media="screen and (min-width: 768px)" href="css/result/desktop.css">
    <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
</head>

<body>
    <header>
        <!-- 何も書かない -->
    </header>
    <main>
        <div class="container">
            <!-- ヒット数を表示 -->
            <?php require("./app/view/hitCount.php") ?>
            <!-- 表示数 -->
            <?php require("./app/view/displayCountDecisionView.php") ?>
            <!-- ページネーション -->
            <?php require("./app/view/pagination.php") ?>
            <!-- 結果 -->
            <?php require("./app/view/resultView.php") ?>
            <!-- ページネーション -->
            <?php require("./app/view/pagination.php") ?>
        </div>
        <!-- 検索画面に戻る位置固定のボタン -->
        <div class="search_btn_container">
            <a href="top" class="search_btn">
                <img src="./images/searchBtnIcon.png">
            </a>
        </div>
        <!-- 画面最上部に戻るボタン -->
        <div class="top_btn_container">
            <a href="#" class="top_btn">
                <img src="./images/toTopIcon.png">
            </a>
        </div>
    </main>
    <script type="module" src="./js/previewPageMoveController.js"></script>
    <script src="./js/topButtonScroll.js"></script>
</body>

</html>