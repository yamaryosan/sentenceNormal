<div class="col-md-9 mx-auto search_form_container">
    <form name="search_form" action=<?php echo "preview" ?> method="GET">
        <!-- 検索語を入力するフォーム -->
        <div class="form-group">
            <label>検索語</label>
            <input type="text" class="form-control" name="search_word" placeholder="検索語を入力" value='<?php echo $previousSearchWord ?>'>
        </div>
        <!-- 検索箇所を入力するフォーム -->
        <div class="radio_container">
            <label>どこを検索？</label>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" id="radio_1" name="search_target" value="title">
                <label class="form-check-label" for="radio_1">タイトル</label>
            </div>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" id="radio_2" name="search_target" value="content">
                <label class="form-check-label" for="radio_2">本文</label>
            </div>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" id="radio_3" name="search_target" value="both" checked>
                <label class="form-check-label" for="radio_3">両方</label>
            </div>
        </div>
        <!-- 検索開始ボタン -->
        <a href="javascript:document.search_form.submit()" class="btn btn-primary search_button">検索</a>
        <!-- ページネーションのために設けている -->
        <input type="hidden" name="page" value="1">
        <input type="hidden" name="display_number" value="25">
    </form>
</div>