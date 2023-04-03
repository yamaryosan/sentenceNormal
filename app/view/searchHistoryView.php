<?php

declare(strict_types=1);

?>
<div class="mt-3 search_history_container">
    <p>検索履歴(押すと検索します)</p>
    <?php foreach ($searchHistory as $history) : ?>
        <div class="mx-auto">
            <a class="search_history_string" href=<?php echo "result?search_words=$history&search_target=both&page=1&display_count=25" ?>><?php echo $history ?></a>
        </div>
    <?php endforeach ?>
</div>