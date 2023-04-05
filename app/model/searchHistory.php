<?php

declare(strict_types=1);
require_once("./app/model/database.php");

/**
 * 検索履歴を取得するクラス
 * @param int $number 一度における表示数
 */

class SearchHistory
{
    private int $number;
    public function __construct(int $number)
    {
        $this->number = $number;
    }
    public function get(): array
    {
        $dbh = (new Database())->connect();
        $tableName = "input_history_table";
        $statement = $dbh->prepare("CREATE TABLE IF NOT EXISTS $tableName (id INT NOT NULL AUTO_INCREMENT, search_words TEXT NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id))");
        $statement->execute();
        $statement = $dbh->prepare("SELECT DISTINCT(search_words) FROM (SELECT * FROM $tableName ORDER BY created_at DESC LIMIT $this->number) AS sub_query");
        $statement->execute();
        $result = $statement->fetchAll();
        $resultHistoryArray = array();
        foreach ($result as $resultUnit) {
            $resultHistoryArray[] = $resultUnit["search_words"];
        }
        return $resultHistoryArray;
    }
}
