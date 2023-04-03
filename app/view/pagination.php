<?php

declare(strict_types=1);
require_once("./app/controller/totalResultPagesCalculator.php");

$totalPages = (new TotalResultPagesCalculator($searchResult, $displayCount))->get();

?>

<div class="pagination_container">
    <?php if ($totalPages >= 2) : ?>
        <?php if ($currentPage !== 1) : ?>
            <a href=<?php echo "result?search_words=$searchWordString&検索開始=送信&page=1&display_count=$displayCount" ?>>&lt;&lt;</a>
        <?php endif ?>
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <?php if ($i === $currentPage) : ?>
                <a><?php echo $i ?></a>
            <?php else : ?>
                <a href=<?php echo "result?search_words=$searchWordString&検索開始=送信&page=$i&display_count=$displayCount" ?>><?php echo $i ?></a>
            <?php endif ?>
        <?php endfor ?>
        <?php if ($currentPage !== $totalPages) : ?>
            <a href=<?php echo "result?search_words=$searchWordString&検索開始=送信&page=$totalPages&display_count=$displayCount" ?>>&gt;&gt;</a>
        <?php endif ?>
    <?php endif ?>
</div>