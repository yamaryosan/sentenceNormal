function getCurrentPageDisplayCount() {
  const displayCountForm = document.querySelector("#display_count");
  const displayCount = displayCountForm.value;
  return displayCount;
}

export default getCurrentPageDisplayCount;
