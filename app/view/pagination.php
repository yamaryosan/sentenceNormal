<?php

declare(strict_types=1);
require_once("./app/controller/totalResultPagesCalculator.php");

$totalPages = (new TotalResultPagesCalculator($searchResult, $displayCount))->get();

?>

<div class="pagination_container">
    <?php if ($totalPages >= 2) : ?>
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <?php if ($i === $currentPage) : ?>
                <a class="this_page_number"><?php echo $i ?></a>
            <?php else : ?>
                <a class="other_page_number" href='<?php echo "result?search_words=$searchWordString&検索開始=送信&page=$i&display_count=$displayCount" ?>'><?php echo $i ?></a>
            <?php endif ?>
        <?php endfor ?>
    <?php endif ?>
</div>