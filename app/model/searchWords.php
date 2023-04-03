<?php

declare(strict_types=1);
/**
 * 検索語群のクラス
 * 
 * @param string $postWords 検索語群の文字列
 * @var array $words 検索語群の配列
 */
class SearchWords
{
    private array $words;

    public function __construct(string $postWords)
    {
        $normalizedString = $this->normalize($postWords);
        $SearchWordsArray = $this->splitByComma($normalizedString);
        $this->words = $this->format($SearchWordsArray);
    }

    public function getWords()
    {
        return $this->words;
    }

    public function getStringByComma(): string
    {
        $string = "";
        foreach ($this->words as $word) {
            $string .= $word . ",";
        }
        // 最後のコンマは除いて返す
        return rtrim($string, ",");
    }

    // 表記ゆれ解消
    public function normalize(string $string): string
    {    // 読点(、)をコンマ(,)に変更
        $stringWithComma = str_replace("、", ",", $string);
        // 全角英数字を半角に、半角カタカナを全角に
        return mb_convert_kana($stringWithComma, "asK", "UTF-8");
    }

    // コンマで区切る
    public function splitByComma(string $string): array
    {
        $wordsArray = explode(",", $string);
        return $wordsArray;
    }

    // 検索語群の様式を整える
    function format(array $wordsArray): array
    {
        foreach ($wordsArray as $key => $value) {
            // スペースを削除
            $wordsArray[$key] = trim($value);
            // 文字数がゼロの要素を削除
            if (strlen($wordsArray[$key]) === 0) {
                unset($wordsArray[$key]);
            }
        }
        return $wordsArray;
    }
}
