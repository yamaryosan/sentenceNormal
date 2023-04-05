const toTopButton = document.querySelector(".top_btn");
const buttonAppearScrollAmount = 400;
const buttonOpacityMaxScrollAmount = 800;
const opacityMin = 0;
const opacityMax = 0.2;
const displacementX = buttonOpacityMaxScrollAmount - buttonAppearScrollAmount;
const displacementY = opacityMax - opacityMin;
const slope = displacementY / displacementX;
const intercept = -slope * buttonAppearScrollAmount;

/* 不透明度を計算する　*/
function calcOpacity(x) {
  if (x > buttonOpacityMaxScrollAmount) {
    return opacityMax;
  } else {
    return slope * x + intercept;
  }
}

window.onscroll = function () {
  if (
    document.body.scrollTop > buttonAppearScrollAmount ||
    document.documentElement.scrollTop > buttonAppearScrollAmount
  ) {
    toTopButton.style.opacity = calcOpacity(document.documentElement.scrollTop);
    console.log(toTopButton.style.opacity);
    toTopButton.style.display = "flex";
  } else {
    toTopButton.style.display = "none";
  }
};

toTopButton.addEventListener("click", function () {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
});
