// ページの一番上の項目の番号を保存
function setFirstResultNumber() {
  const firstResultNumber = getFirstResultNumberFromQuery();
  sessionStorage.setItem(
    "storage",
    JSON.stringify({ firstResultNumber: firstResultNumber })
  );
}

export default setFirstResultNumber;
