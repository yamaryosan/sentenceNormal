<?php

/**
 * データベースを削除するクラス
 * @param string $knowledgeTableName 知識ユニットテーブル名
 * @param string $filenameTableName ファイルテーブル名
 */
class DatabaseDeleter
{
    private string $knowledgeTableName;
    private string $filenameTableName;

    public function __construct(string $knowledgeTableName, string $filenameTableName)
    {
        $this->knowledgeTableName = $knowledgeTableName;
        $this->filenameTableName = $filenameTableName;
    }
    public function delete()
    {
        $config = require("./config/config.php");

        $host = $config["database"]["host"];
        $db = $config["database"]["database"];
        $user = $config["database"]["username"];
        $pass = $config["database"]["password"];
        try {
            $dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        } catch (PDOException $ex) {
            // アクセスできなかったときの処理
            echo "アクセスできません : " . $ex->getMessage() . PHP_EOL;
            // 切断
            unset($dbh);
            die();
        }
        $statement = $dbh->prepare("DROP TABLE IF EXISTS $this->knowledgeTableName, $this->filenameTableName");
        $statement->execute();
    }
    public function message()
    {
        $messageString = "削除が完了しました。";
        echo $messageString;
    }
}
