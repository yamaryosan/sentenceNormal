<?php

/**
 * 全結果表示に必要なページ枚数を計算するクラス
 * 
 * @param array $searchResult 検索結果
 * @param int $displayCount 一度に表示する検索結果の数
 * @var int $totalPages 全結果表示に必要なページ枚数
 * 
 */
class TotalResultPagesCalculator
{
    private array $searchResult;
    private int $displayCount;
    private int $totalPages;

    public function __construct(array $searchResult, int $displayCount)
    {
        if ($displayCount < 0) {
            throw new Exception("一度に表示する検索結果の数は0以上である必要があります。");
        }
        $this->searchResult = $searchResult;
        $this->displayCount = $displayCount;
        $this->totalPages = self::calculate();
    }

    public function calculate(): int
    {
        // 検索結果が0件の場合は1ページとする
        if ($this->displayCount === 0) {
            return 1;
        }
        $resultKnowledgeUnitNumber = count($this->searchResult);
        return (int)(ceil($resultKnowledgeUnitNumber / $this->displayCount));
    }

    public function get(): int
    {
        return $this->totalPages;
    }
}
