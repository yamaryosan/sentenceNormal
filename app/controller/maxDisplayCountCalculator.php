<?php

declare(strict_types=1);

/**
 * 検索結果の最大表示数を計算するクラス
 * @var int $searchResultCount 検索結果の数
 * @var int $offset 検索結果のオフセット値(何番目の検索結果から表示するか)
 * @var int $displayCount ページに一度に表示する検索結果の数
 * @var int $maxDisplayCountThisPage 一度に表示する検索結果の実際の数
 */

class MaxDisplayCountCalculator
{
    private int $searchResultCount, $offset, $displayCount, $maxDisplayCountThisPage;
    function __construct(int $searchResultCount, int $offset, int $displayCount)
    {
        if ($searchResultCount < 0 || $offset < 0 || $displayCount < 0) {
            throw new Exception("引数に負の数が入力されました。");
        }
        $this->searchResultCount = $searchResultCount;
        $this->offset = $offset;
        $this->displayCount = $displayCount;
        $this->maxDisplayCountThisPage = self::calculate($searchResultCount, $offset, $displayCount);
    }
    function calculate()
    {
        if ($this->searchResultCount - $this->offset < $this->displayCount) {
            $maxDisplayCountThisPage = $this->searchResultCount - $this->offset;
        } else {
            $maxDisplayCountThisPage = $this->displayCount;
        }
        return $maxDisplayCountThisPage;
    }
    function get()
    {
        return $this->maxDisplayCountThisPage;
    }
}
