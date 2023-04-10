// ページの一番上の項目が全体で何番目かを取得
function getFirstResultNumberFromQuery() {
  const firstUnitSpan = document.querySelector("footer > div > span");
  const firstResultNumber = firstUnitSpan.text;
  return firstResultNumber;
}

// ページの一番上の項目の番号を保存
function setFirstResultNumber() {
  const firstResultNumber = getFirstResultNumberFromQuery();
  sessionStorage.setItem(
    "storage",
    JSON.stringify({ firstResultNumber: firstResultNumber })
  );
}

export default setFirstResultNumber;
