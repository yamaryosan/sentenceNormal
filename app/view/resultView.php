<div class="results_container">
    <?php for ($i = $offset; $i < $offset + $maxDisplayCountThisPage; $i++) : ?>
        <div class="content">
            <?php $contentString = $searchResult[$i]["sentences"] ?>
            <p><?php echo nl2br($contentString) ?></p>
        </div>
        <br>
    <?php endfor ?> <br>
</div>