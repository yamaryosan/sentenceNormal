<?php

declare(strict_types=1);

/**
 * 現在のページ数を取得するクラス
 * @param int $currentPageByGetMethod リクエストパラメータから取得した、現在のページ数
 */
class CurrentPageCountGetter
{
    private $currentPage;

    public function __construct(int $currentPageByGetMethod)
    {
        if (isset($currentPageByGetMethod)) {
            $this->currentPage = $currentPageByGetMethod;
        } else {
            $this->currentPage = 1;
        }
    }
    public function get(): int
    {
        return $this->currentPage;
    }
}
