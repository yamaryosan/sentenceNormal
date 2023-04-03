<?php

declare(strict_types=1);
require_once("./app/model/cookie.php");
require_once("./app/model/previousInputString.php");
require_once("./app/model/searchHistory.php");
header("Cache-Control: no-cache, must-revalidate");

// 以前入力されていた文字列を取得
$previousInputString = (new PreviousInputString("search_word_cookie"))->getString();

// 履歴取得
$historyCount = 10;
$searchHistory = (new SearchHistory($historyCount))->get();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>プログラミング備忘録</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style_common.css">
    <link rel="stylesheet" href="./css/style_top.css">
    <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
</head>

<body>
    <header>
        <!-- 何も書かない -->
    </header>
    <main>
        <div class="container">
            <div class="row">
                <!-- 検索フォーム -->
                <?php require_once("./app/view/searchInputForm.php"); ?>
                <!-- 検索履歴 -->
                <?php require_once("./app/view/searchHistoryView.php"); ?>
            </div>
        </div>
    </main>
    <?php if (empty($_POST["search_word"])) : ?>
        <script>
            alert(<?php echo "検索語を入力してください"; ?>)
        </script>
    <?php endif ?>
</body>

</html>