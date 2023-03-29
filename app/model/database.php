<?php

declare(strict_types=1);
/**
 * データベースのクラス
 * @return PDO
 */
class Database
{
    public function connect(): PDO
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
        return $dbh;
    }
}
