const deleteButton = document.querySelector("#deleteButton");

deleteButton.addEventListener("click", function () {
  if (confirm("本当に削除しますか？")) {
    // はいのときの処理
    window.location.href = "deleteDatabasePage.php";
  } else {
    // いいえのときの処理
    // 何もしない
  }
});
