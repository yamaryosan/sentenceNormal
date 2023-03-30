<?php

/**
 * オフセット値(何番目の検索結果から表示するか)を計算するクラス
 * @param int $currentPage 現在のページ
 * @param int $displayCount 一度に表示する検索結果の数
 * @var int $offset オフセット値
 */
class OffsetCalculator
{
    private int $currentPage, $displayCount, $offset;
    function __construct(int $currentPage, int $displayCount)
    {
        $this->currentPage = $currentPage;
        $this->displayCount = $displayCount;
        $this->offset = self::calculate();
    }
    function calculate()
    {
        return ($this->currentPage - 1) * $this->displayCount;
    }
    function get(): int
    {
        return $this->offset;
    }
}
