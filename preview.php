<?php

declare(strict_types=1);

require_once("./app/classSearchWords.php");
require_once("./app/classSearcher.php");
require_once("./app/classCookieSetter.php");
require_once("./app/classPageNumberCulculator.php");
require_once("./app/classSearchHistorySaver.php");
require_once("./app/classStringHighlighter.php");

// キャッシュを使わせない(クッキーを利用するため)
header("Cache-Control: no-cache, must-revalidate");

$searchWordString = $_GET["search_word"];
$searchWords = new SearchWords($searchWordString);
$searchWordByComma = $searchWords->getStringByComma();
$searchTarget = $_GET["search_target"];

// 検索語が空の場合やり直しさせる
if (empty($searchWords->getWords())) {
    echo "<script>alert('検索語を入力してください。'); history.back();</script>";
    exit;
}

// 検索履歴を保存
// 遷移元が検索ページのときのみ履歴を保存
$referrer = $_SERVER["HTTP_REFERER"];
if (is_integer(strpos($referrer, "searchPage.php")) === true) {
    $searchHistorySaver = new SearchHistorySaver($searchWords);
    $searchHistorySaver->save();
} else {
    // 何もしない
}

// 検索ページに戻ったときに備え、クッキーを保存
$referrer = $_SERVER["HTTP_REFERER"];
if (is_integer(strpos($referrer, "searchPage.php")) === true) {
    $cookieSetter = new CookieSetter("search_word_cookie", $searchWordByComma);
    $cookieSetter->setCookie();
} else {
    // 何もしない
}

// 検索
$searcher = new Searcher($searchWords);
$searchResult = $searcher->search($searchTarget);

// ヒット数があまりに多い場合、やり直させる
$requestRetryHitNumber = 400;
if (count($searchResult) > $requestRetryHitNumber) {
    $alertJSFilePath = "./js/alertMessage.js";
    $jsCode = "<script src='$alertJSFilePath'></script>;";
    echo $jsCode;
}

// 一度に表示する検索結果の数
$displayNumber = 0;
if (isset($_GET["display_number"]) === true) {
    $displayNumber = (int)$_GET["display_number"];
} else {
    $displayNumber = 25;
}

// ページ数を計算
$pageNumberCulculator = new PageNumberCulculator($searchResult);
$totalPages = $pageNumberCulculator->calculate($displayNumber);
$maxDisplayNumberThisPage = 0;

// ページネーション
if (isset($_GET["page"])) {
    $currentPage = (int)($_GET["page"]);
} else {
    $currentPage = 1;
}

$offset = ($currentPage - 1) * $displayNumber;

$searchResultCurrentCount = count($searchResult) - $offset;
if ($searchResultCurrentCount < $displayNumber) {
    $maxDisplayNumberThisPage = $searchResultCurrentCount;
} else {
    $maxDisplayNumberThisPage = $displayNumber;
}
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
        <div class="hit_number_text_container">
            <?php require("./app/functionSearchResultAbstract.php") ?>
        </div>
        <!-- 表示数 -->
        <div class="display_number_container">
            <?php require("./app/functionDisplayNumberForm.php") ?>
        </div>
        <!-- ページネーション -->
        <div class="pagination_container">
            <?php require("./app/functionPagination.php") ?>
        </div>
        <!-- 結果 -->
        <div class="results_container">
            <?php require("./app/functionSearchResult.php") ?>
        </div>
        <!-- ページネーション -->
        <div class="pagination_container">
            <?php require("./app/functionPagination.php") ?>
        </div>
        <div class="page_lower_back_btn_container">
            <a href="searchPage.php" class="page_lower_back_btn">戻る</a>
        </div>
        <div class="back_btn_container">
            <a href="searchPage.php" class="back_btn">
                <img src="./images/backBtnIcon.png">
            </a>
        </div>
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