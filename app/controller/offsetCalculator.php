<?php

/**
 * オフセット値(何番目の検索結果から表示するか)を計算するクラス
 * @param int $currentPage 現在のページ
 */
class OffsetCalculator
{
    private int $currentPage;
    function __construct(int $currentPage)
    {
        $this->currentPage = $currentPage;
    }
    function calculate(int $displayCount)
    {
        return ($this->currentPage - 1) * $displayCount;
    }
}
