const navbarButton = document.getElementById("navbarButton");
const navbarCollapse = document.getElementById("navbarResponsive");

navbarButton.addEventListener("click", () => {
  navbarCollapse.classList.toggle("show");
});
