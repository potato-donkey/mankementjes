const filterSelect = document.querySelector("select#parkFilter");

if (filterSelect) {
  filterSelect.addEventListener("change", function () {
    const park = this.value;
    const mankementjes = document.querySelectorAll("div.mankementje");

    if (park == "none") {
      mankementjes.forEach((mankementje) => {
        mankementje.classList.remove("d-none");
      });

      document.getElementById("noMankementjes").classList.add("d-none");
      return;
    }

    mankementjes.forEach((mankementje) => {
      if (mankementje.dataset.park == park) {
        mankementje.classList.remove("d-none");
      } else {
        mankementje.classList.add("d-none");
      }
    });

    // Count amount of mankementjes without d-none class
    const count = document.querySelectorAll(
      "div.mankementje:not(.d-none)"
    ).length;

    if (count == 0) {
      document.getElementById("noMankementjes").classList.remove("d-none");
    } else {
      document.getElementById("noMankementjes").classList.add("d-none");
    }
  });
}
