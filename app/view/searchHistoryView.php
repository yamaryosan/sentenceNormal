<?php

declare(strict_types=1);

?>
<div class="mt-3 search_history_container">
    <p>検索履歴(押すと検索します)</p>
    <?php foreach ($searchHistory as $history) : ?>
        <div class="mx-auto">
            <a class="search_history_string" href=<?php echo "search.php?search_words=$history" ?>><?php echo $history ?></a>
        </div>
    <?php endforeach ?>
</div>