<?php

declare(strict_types=1);
require_once("./app/controller/totalResultPagesCalculator.php");

$totalPages = (new TotalResultPagesCalculator($searchResult, $displayCount))->get();
$pageLinkRange = 2;
$skipPagesStep = 3;

?>

<div class="pagination_container">
    <?php if ($totalPages >= 2) : ?>
        <?php if ($currentPage !== 1) : ?>
            <!-- 最後のページへ -->
            <a class="to_last_page symbol" href='<?php echo "result?search_words=$searchWordString&検索開始=送信&page=1&display_count=$displayCount" ?>'>&lt;&lt;</a>
            <!-- 複数ページぶん進む -->
            <?php $skipPagesToLower = max($currentPage - $skipPagesStep, 1) ?>
            <a class="to_greater symbol" href=<?php echo "result?search_words=$searchWordString&検索開始=送信&page=$skipPagesToLower&display_count=$displayCount" ?>>&lt;</a>
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
            <!-- 複数ページぶん戻る -->
            <?php $skipPagesToUpper = min($currentPage + $skipPagesStep, $totalPages) ?>
            <a class="to_lesser symbol" href=<?php echo "result?search_words=$searchWordString&検索開始=送信&page=$skipPagesToUpper&display_count=$displayCount" ?>>&gt;</a>
            <!-- 最初のページへ -->
            <a class="to_first_page symbol" href='<?php echo "result?search_words=$searchWordString&検索開始=送信&page=$totalPages&display_count=$displayCount" ?>'>&gt;&gt;</a>
        <?php endif ?>
    <?php endif ?>
</div>