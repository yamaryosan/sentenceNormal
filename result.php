<?php

declare(strict_types=1);

require_once("./app/model/searchWords.php");
require_once("./app/model/searcher.php");
require_once("./app/model/searchHistorySaver.php");
require_once("./app/model/cookieSetter.php");
require_once("./app/model/searchHistorySaver.php");
require_once("./app/view/searchRetryView.php");
require_once("./app/controller/PageCalculator.php");
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

// 文字列が空の場合、検索のやり直しを促す
retrySearchIfEmpty($searchWords);

// 検索履歴を保存
$referrer = $_SERVER["HTTP_REFERER"];
(new searchHistorySaver($searchWords))->SaveSearchHistoryIfTopPage($referrer);

// 検索ページに戻ったときに備え、クッキーを保存
(new CookieSetter("search_words", $searchWordByComma))->set($referrer);

// 検索
$searchResult = (new Searcher($searchWords))->search();
# $searchResult = $searcher->search($searchTarget);

// ヒット数が多い場合、やり直させる
retrySearchIfTooManyResults($searchResult);

// 一度に表示する検索結果の数
$displayCount = (new DisplayCountGetter((int)$_GET["display_count"]))->get();

// ページネーションのために現在のページ数を取得
$currentPage = (new CurrentPageCountGetter((int)$_GET["page"]))->get();

// 検索結果のオフセットを計算
$offset = ($currentPage - 1) * $displayCount;

// 一度に表示する検索結果の数を計算
$maxDisplayCountThisPage = (new MaxDisplayCountCalculator(count($searchResult), $offset, $displayCount))->get();
echo $maxDisplayCountThisPage;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>プレビュー</title>
    <link rel="stylesheet" href="./css/style_preview.css">
</head>

<body>
    <div class="main_container">
        <!-- ヒット数 -->
        <div class="hit_count_text_container">
            <?php require("./app/view/hitCount.php") ?>
        </div>
        <!-- 表示数 -->
        <div class="display_number_container">
            <?php require("./app/functionDisplayNumberForm.php") ?>
        </div>
        <!-- ページネーション -->
        <div class="pagination_container">
            <?php require("./app/view/pagination.php") ?>
        </div>
        <!-- 結果 -->
        <div class="results_container">
            <?php require("./app/functionSearchResult.php") ?>
        </div>
        <!-- ページネーション -->
        <div class="pagination_container">
            <?php require("./app/view/pagination.php") ?>
        </div>
        <!-- ページ最下部の戻るボタン -->
        <div class="page_lower_back_btn_container">
            <a href="top" class="page_lower_back_btn">戻る</a>
        </div>
        <!-- ページ右下部のトップへ戻るボタン -->
        <div class="back_btn_container">
            <a href="top" class="back_btn">
                <img src="./images/backBtnIcon.png">
            </a>
        </div>
        <!-- ページ右下部の画面トップへ戻るボタン(後で書き換えよう) -->
        <div class="to_top_btn_container">
            <a href="#" class="to_top_btn">
                <img src="./images/toTopIcon.png">
            </a>
        </div>
    </div>
    <script type="module" src="./js/previewPageMoveController.js"></script>
    <script src="./js/toTopButtonScroll.js"></script>
</body>

</html>