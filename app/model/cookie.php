<?php

declare(strict_types=1);
/**
 * クッキーを扱うクラス
 * 
 * @param string $cookieString クッキーに保存されている文字列
 */
class Cookie
{
    private $string;

    public function __construct(string $cookieString)
    {
        if (isset($cookieString) === false) {
            $message = "Cookieが入っていません";
            echo $message . PHP_EOL;
            die();
        }
        $this->string = $this->escape($cookieString);
    }

    // HTML用エスケープ
    public function escape(string $string): string
    {
        return htmlspecialchars((string)$string, ENT_QUOTES);
    }

    public function getString()
    {
        return $this->string;
    }
}
