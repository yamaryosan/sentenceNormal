<?php

declare(strict_types=1);

?>

<?php foreach ($searchHistory as $history) : ?>
    <div class="col-12">
        <a href=<?php echo "search.php?search_words=$history" ?>><?php echo $history ?></a>
    </div>
<?php endforeach ?>