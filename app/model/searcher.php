<?php

declare(strict_types=1);
require_once("./app/model/database.php");
/**
 * 検索を行うクラス
 * @param SearchWords $searchWords
 * 
 */
class Searcher
{
    private $searchWords;
    public function __construct(SearchWords $searchWords)
    {
        $this->searchWords = $searchWords;
    }
    function search(): array
    {
        $database = new Database();
        $dbh = $database->connect();
        // 検索語でヒットする知識ユニットだけをDBから取得
        $tableName = "sentence_table";
        // 検索のためのSQLクエリを生成
        $statement = $this->createSearchSQLStatement($dbh, $tableName, $this->searchWords);
        $statement->execute();
        $searchResultArray = $statement->fetchAll();
        return $searchResultArray;
    }

    // 検索方法に対応したSQL文のステートメントを生成
    public function createSearchSQLStatement(PDO $dbh, string $tableName, SearchWords $searchWords): PDOStatement
    {
        // クエリの前半の部分
        $SQLFirstPart = "SELECT * FROM $tableName WHERE ";
        // クエリの後半の部分
        $SQLLatterPart = "";
        $count = 1;
        foreach ($searchWords->getWords() as $word) {
            $SQLLatterPart .= "sentences LIKE :word$count OR ";
            $count++;
        }
        // 一番最後の OR だけ不要なので取り除く
        $SQLLatterPart = rtrim($SQLLatterPart, " OR ");
        $SQLQuery = $SQLFirstPart . $SQLLatterPart;
        $statement = $dbh->prepare($SQLQuery);
        // プレースホルダーを置換
        $count = 1;
        foreach ($searchWords->getWords() as $word) {
            $statement->bindValue(":word$count", "%" . $word . "%");
            $count++;
        }
        return $statement;
    }
}
