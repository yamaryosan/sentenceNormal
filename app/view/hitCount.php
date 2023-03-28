<p>検索結果</p>
<?php if (count($searchResult) === 0) : ?>
    <?php echo "一件もヒットしませんでした。" ?>
<?php else : ?>
    <?php echo count($searchResult) . "件ヒットしました。" ?>
<?php endif ?>