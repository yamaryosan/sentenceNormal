<?php

declare(strict_types=1);
require_once("./app/model/classDatabaseDeleter.php");
$knowledgeTableName = "sentence_table";
$filenameTableName = "filename_table";

$databaseDeleter = new DatabaseDeleter($knowledgeTableName, $filenameTableName);
$databaseDeleter->delete();
$databaseDeleter->message();

?>

<html>

<body>
    <a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">前の画面に戻る</a>
</body>

</html>