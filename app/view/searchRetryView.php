<?php

require_once("./app/model/SearchWords.php");

// 検索語が空の場合やり直しさせる
function retrySearchIfEmpty(SearchWords $searchWords): void
{
    if (empty($searchWords->getWords())) {
        echo "<script>
        alert('検索語を入力してください。');
        history.back();
    </script>";
        exit;
    }
}

// 検索語が多すぎる場合やり直しさせる
function retrySearchIfTooManyResults(array $searchResult): void
{
    $requestRetryHitNumber = 400;
    if (count($searchResult) > $requestRetryHitNumber) {
        echo "<script>
        alert('検索結果が多すぎます。検索語を減らしてください。');
        history.back();
    </script>";
        exit;
    }
}
