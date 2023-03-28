<?php

declare(strict_types=1);
require_once("./app/model/cookie.php");
/**
 * クッキーから、以前入力されていた文字列をゲットするクラス
 * @param string $inputString 入力されていた文字列
 * 
 */
class previousInputString
{
    private string $inputString;
    public function __construct(string $cookieName)
    {
        if (isset($cookieName) === false) {
            $message = "Cookieの名前が入っていません";
            echo $message . PHP_EOL;
            die();
        }

        if (isset($_COOKIE[$cookieName])) {
            $cookie = new Cookie($_COOKIE[$cookieName]);
            $this->inputString = $cookie->getString();
        } else {
            $this->inputString = "";
        }
    }
    public function getString()
    {
        return $this->inputString;
    }
}
