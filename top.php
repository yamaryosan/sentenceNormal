<?php

declare(strict_types=1);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>プログラミング備忘録</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style_common.css">
    <link rel="stylesheet" href="./css/style_top.css">
    <link rel="stylesheet" href="./css/style_side_column.css">
    <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
</head>

<body>

    <div class="wrapper">
        <header>
            <a href="top">プログラミング備忘録</a>
            <a href="top" class="mini_message">東京砂漠に生きる週末SE。<br>ここに備忘録を記します。</a>
        </header>
        <main>
            <div class="main_column">
                <?php require_once("./topContent.php") ?>
            </div>
            <div class="side_column">
                <?php require("sideColumn.php") ?>
            </div>
        </main>
        <footer>
            <p>© programmingnokemono <?php echo date("Y") ?></p>
        </footer>
    </div>
    <?php if (empty($_POST["search_word"])) : ?>
        <script>
            alert(<?php echo "検索語を入力してください"; ?>)
        </script>
    <?php endif ?>
</body>

</html>