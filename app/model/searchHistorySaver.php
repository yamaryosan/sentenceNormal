<?php

declare(strict_types=1);
require_once("./app/model/database.php");
require_once("./app/model/searchWords.php");

/**
 * 検索履歴を保存するクラス
 * @param SearchWords $searchWords
 */
class SearchHistorySaver
{
    private SearchWords $searchWords;

    public function __construct(SearchWords $searchWords)
    {
        $this->searchWords = $searchWords;
    }

    public function SaveSearchHistoryIfTopPage(string $referrer)
    {
        // 遷移元が検索ページのときのみ履歴を保存
        if (is_integer(strpos($referrer, "top")) === true) {
            self::save();
        } else {
            // 何もしない
        }
    }
    public function save()
    {
        $dbh = (new Database())->connect();
        // テーブルがなければ、作成
        $tableName = "input_history_table";
        $searchWordsString = $this->searchWords->getStringByComma();
        $statement = $dbh->prepare("CREATE TABLE IF NOT EXISTS $tableName (id INT NOT NULL AUTO_INCREMENT, search_words TEXT NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id));");
        $statement->execute();

        // データを保存
        $statement = $dbh->prepare("INSERT INTO $tableName(search_words) VALUES(:searchWordsString);");
        $statement->bindParam(":searchWordsString", $searchWordsString);
        $statement->execute();
    }
}
