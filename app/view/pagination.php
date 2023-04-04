<?php

declare(strict_types=1);
require_once("./app/controller/totalResultPagesCalculator.php");

$totalPages = (new TotalResultPagesCalculator($searchResult, $displayCount))->get();
$pageLinkRange = 3;

?>

<div class="pagination_container">
    <?php if ($totalPages >= 2) : ?>
        <?php if ($currentPage !== 1) : ?>
            <a class="to_first_page" href='<?php echo "result?search_words=$searchWordString&検索開始=送信&page=1&display_count=$displayCount" ?>'>&lt;&lt;</a>
        <?php endif ?>
        <div class="page_number_container">
            <?php for ($i = max(1, $currentPage - $pageLinkRange); $i <= min($totalPages, $currentPage + $pageLinkRange); $i++) : ?>
                <?php if ($i === $currentPage) : ?>
                    <a class="this_page_number"><?php echo $i ?></a>
                <?php else : ?>
                    <a class="other_page_number" href='<?php echo "result?search_words=$searchWordString&検索開始=送信&page=$i&display_count=$displayCount" ?>'><?php echo $i ?></a>
                <?php endif ?>
            <?php endfor ?>
        </div>
        <?php if ($currentPage !== $totalPages) : ?>
            <a class="to_last_page" href='<?php echo "result?search_words=$searchWordString&検索開始=送信&page=$totalPages&display_count=$displayCount" ?>'>&gt;&gt;</a>
        <?php endif ?>
    <?php endif ?>
</div>