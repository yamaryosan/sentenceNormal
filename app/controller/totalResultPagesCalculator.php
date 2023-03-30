<?php

/**
 * 全結果表示に必要なページ枚数を計算するクラス
 * 
 * @param array $searchResult 検索結果
 * 
 */
class PageCalculator
{
    private array $searchResult;

    public function __construct(array $searchResult)
    {
        $this->searchResult = $searchResult;
    }

    public function calculate(int $displayCount)
    {
        $resultKnowledgeUnitNumber = count($this->searchResult);
        return (int)(ceil($resultKnowledgeUnitNumber / $displayCount));
    }
}
