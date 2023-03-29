<?php

declare(strict_types=1);
/**
 * クッキーをセットするクラス
 * @param string $name クッキーの名前
 * @param string $searchResult 検索結果
 * 
 */
class CookieSetter
{
    private string $name, $searchResult;
    public function __construct(string $name, string $searchResult)
    {
        $this->name = $name;
        $this->searchResult = $searchResult;
    }
    public function set(string $referrer): void
    {
        if (is_integer(strpos($referrer, "top")) === true) {
            setcookie($this->name, $this->searchResult, time() + 3600);
        } else {
            // 何もしない
        }
    }
}
