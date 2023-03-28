<?php

declare(strict_types=1);
require_once("./app/model/cookie.php");
require_once("./app/classSearchHistoryGetter.php");
header("Cache-Control: no-cache, must-revalidate");

// クッキーを取得
if (isset($_COOKIE["search_word_cookie"])) {
    $cookie = new Cookie($_COOKIE["search_word_cookie"]);
    $previousSearchWord = $cookie->getString();
} else {
    $previousSearchWord = "";
}

// 履歴取得
$historyShowNumber = 10;
$searchHistoryGetter = new SearchHistoryGetter($historyShowNumber);
$result = $searchHistoryGetter->get();

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
        <h1>
            <a href=<?php echo "top.php" ?>>プログラミング備忘録</a>
        </h1>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <?php require_once("./app/view/searchInputForm.php"); ?>
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