const navbarButton = document.getElementById("navbarButton");
const navbarCollapse = document.getElementById("navbarResponsive");

navbarButton.addEventListener("click", () => {
    console.log("test");
    navbarCollapse.classList.toggle("show");
});
