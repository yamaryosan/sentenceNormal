<?php

declare(strict_types=1);

/**
 * ドキュメントファイルのクラス
 * 
 * @param string $filename ファイル名
 * @param string $extension 拡張子
 * @param string $tempName 一時保存ファイル名
 * @param int $size サイズ
 * @param string $errorCode エラーコード
 */

class DocumentFile
{
    private $name, $extension, $tempName, $size, $errorCode;
    public function __construct(string $filename, string $tempName, int $size, int $errorCode)
    {
        $this->name = explode(".", $filename)[0];
        $this->extension = explode(".", $filename)[1];
        $this->tempName = $tempName;
        $this->size = $size;
        $this->errorCode = $errorCode;
    }
    // ファイルがすでにアップロードされているか確認する
    public function isPreviouslyUploadedCheck()
    {
        $config = require("../config/config.php");

        $host = $config["database"]["host"];
        $db = $config["database"]["database"];
        $user = $config["database"]["username"];
        $pass = $config["database"]["password"];
        try {
            $dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        } catch (PDOException $ex) {
            echo "アクセスできません : " . $ex->getMessage() . PHP_EOL;
            unset($dbh);
            die();
        }

        // テーブルがなければ、DBに作成
        $table_name = "filename_table";
        $statement = $dbh->prepare("CREATE TABLE IF NOT EXISTS $table_name(filename TEXT);");
        $statement->execute();

        // ファイル名を検索
        $statement = $dbh->prepare("SELECT * from $table_name WHERE filename = '$this->name'");
        $statement->execute();
        $result_array = $statement->fetchAll();

        // 同名のファイルがあるかどうか確認
        if (count($result_array) >= 1) {
            $message = "すでに以前アップロードされたことのあるファイルです。";
            echo $message . PHP_EOL;
            die();
        } else {
            return "";
        }
    }
    // 拡張子チェック
    public function extensionCheck()
    {
        if (in_array($this->extension, ["docx"]) === false) {
            $message = "ファイルのタイプが間違っています。 : " . $this->extension;
            echo $message . PHP_EOL;
            die();
        }
    }
    // エラーチェック
    public function errorCheck()
    {
        if ($this->errorCode === 1) {
            $message = "アップロードファイルにエラーがあります。エラーコード : " . $this->errorCode;
            echo $message . PHP_EOL;
            die();
        }
    }
    // サイズチェック
    public function sizeCheck()
    {
        $two_mega_byte = 8 * (10 ** 7);
        if ($this->size > $two_mega_byte) {
            $message = "ファイルサイズが大きすぎます。ファイルサイズは2MB以下である必要があります。";
            echo $message . PHP_EOL;
            die();
        }
    }
    // アップロードされたファイル名をDBに保存
    public function uploadHistory()
    {
        $config = require("config.php");

        $host = $config["database"]["host"];
        $db = $config["database"]["database"];
        $user = $config["database"]["username"];
        $pass = $config["database"]["password"];
        try {
            $dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        } catch (PDOException $ex) {
            echo "アクセスできません : " . $ex->getMessage() . PHP_EOL;
            unset($dbh);
            die();
        }

        // テーブルがなければ、DBに作成
        $table_name = "filename_table";
        $statement = $dbh->prepare("CREATE TABLE IF NOT EXISTS $table_name(filename TEXT);");
        $statement->execute();

        //ファイル名をDBに追加
        $statement = $dbh->prepare("INSERT INTO $table_name(filename) VALUE(:filename);");
        $statement->bindParam(":filename", $this->name);
        $statement->execute();
    }
    // ファイル移動
    public function move()
    {
        // 一意なIDを付与した新しい名前でアップロード
        $newName = uniqid("", true) . ".docx";
        $currentDirectory = "./";
        $uploadDirectory = "uploads";
        $fileDestination = $currentDirectory . $uploadDirectory . "/" . $newName;
        if (move_uploaded_file($this->tempName, $fileDestination)) {
            $message = "ドキュメントファイル アップロード成功";
            echo $message;
        } else {
            $message = "ドキュメントファイル アップロード失敗";
            echo $message;
            die();
        }
        return $fileDestination;
    }
}
