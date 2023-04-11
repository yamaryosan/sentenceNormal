<?php

declare(strict_types=1);
require_once("database.php");

/**
 * テキストデータをデータベースに保存するクラス
 * @param string $filePath テキストファイルのパス
 */

class DataSaver
{
    private $filePath;
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }
    public function save()
    {
        // 文字列をファイルから取得
        $string = file_get_contents($this->filePath);
        // 改行コードを統一
        $string = str_replace(array("\r\n", "\r"), "\n", $string);
        // 分離
        $sentencesArray = preg_split("/\n{2,}/", $string);
        // テーブル作成
        $db = new Database();
        $dbh = $db->connect();
        $tableName = "sentence_table";
        $query = "CREATE TABLE IF NOT EXISTS $tableName (id int NOT NULL AUTO_INCREMENT, sentences text NOT NULL, PRIMARY KEY(id))";
        $statement = $dbh->prepare($query);
        $statement->execute();
        // テーブルに保存
        foreach ($sentencesArray as $sentences) {
            $query = "INSERT INTO $tableName (sentences) VALUES (:sentences)";
            $statement = $dbh->prepare($query);
            $statement->bindParam(":sentences", $sentences);
            $statement->execute();
        }
    }
}
