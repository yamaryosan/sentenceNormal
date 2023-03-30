<?php

declare(strict_types=1);

/**
 * 検索結果の表示数を取得するクラス
 * @param int $displayCountByGetMethod リクエストパラメータから取得した表示数
 * @var int $displayCount 表示数
 */

class DisplayCountGetter
{
    private int $displayCount;
    function __construct(int $displayCountByGetMethod)
    {
        if (isset($displayCountByGetMethod) === true) {
            $this->displayCount = (int)$_GET["display_count"];
        } else {
            $this->displayCount = 25;
        }
    }
    function get()
    {
        return $this->displayCount;
    }
}
