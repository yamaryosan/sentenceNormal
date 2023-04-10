// ページの一番上の項目の番号を取得
function getFirstResultNumberFromQuery() {
  const firstUnitSpan = document.querySelector("footer > div > span");
  const firstResultNumber = firstUnitSpan.text;
  return firstResultNumber;
}

// 現在のページの一番上の取得
function getCurrentFirstResultNumber() {
  return getFirstResultNumberFromQuery();
}

// 遷移元のページの一番上の番号を取得
function getPreviousFirstResultNumber() {
  const data = JSON.parse(sessionStorage.getItem("storage"));
  if (data === null) {
    return getCurrentFirstResultNumber();
  } else {
    return data.firstResultNumber;
  }
}

export default getPreviousFirstResultNumber;
