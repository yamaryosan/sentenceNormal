<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once "./app/model/searchWords.php";

class SearchWordsTest extends TestCase
{
    public function testConstructorAndGetWords()
    {
        $searchWords = new SearchWords("apple,banana,grape");
        $this->assertEquals(["apple", "banana", "grape"], $searchWords->getWords());
    }

    public function testSpecialCharacters()
    {
        $searchWords = new SearchWords("<,>,.,");
        $this->assertEquals(["<", ">", "."], $searchWords->getWords());
    }

    public function testExtremelyShortAndLongWords()
    {
        $searchWords = new SearchWords("a,abcdefghijklmnopqrstuvwxyz");
        $this->assertEquals(["a", "abcdefghijklmnopqrstuvwxyz"], $searchWords->getWords());
    }

    public function testNormalize()
    {
        $searchWords = new SearchWords("ＡＢＣ、ｄｅｆ");
        $this->assertEquals(["ABC", "def"], $searchWords->getWords());
    }

    public function testGetStringByComma()
    {
        $searchWords = new SearchWords("apple,banana,grape");
        $this->assertEquals("apple,banana,grape", $searchWords->getStringByComma());
    }

    public function testFormat()
    {
        $searchWords = new SearchWords("  apple , banana , grape  ");
        $this->assertEquals(["apple", "banana", "grape"], $searchWords->getWords());

        $searchWords = new SearchWords("apple,,banana,,grape");
        $this->assertEquals(["apple", "banana", "grape"], $searchWords->getWords());
    }
}
