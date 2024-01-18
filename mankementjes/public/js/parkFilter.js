const filterSelect = document.querySelector("select#parkFilter");

filterSelect.addEventListener("change", function () {
    const park = this.value;
    const mankementjes = document.querySelectorAll("div.mankementje");

    if (park == "none") {
        mankementjes.forEach((mankementje) => {
            mankementje.classList.remove("d-none");
        });
        return;
    }

    mankementjes.forEach((mankementje) => {
        if (mankementje.dataset.park == park) {
            mankementje.classList.remove("d-none");
        } else {
            mankementje.classList.add("d-none");
        }
    });
});
