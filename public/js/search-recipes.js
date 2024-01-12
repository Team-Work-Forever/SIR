function filterRecipes() {
  const searchInput = document.getElementById("searchInput");
  const filter = searchInput.value.toUpperCase();

  // Collect active recipes
  const activeRows = document.querySelectorAll(
    ".active-recipes-table tbody tr"
  );

  activeRows.forEach(function (row) {
    const name = row.querySelector("td:nth-child(4)").textContent.toUpperCase();
    const category = row
      .querySelector("td:nth-child(7)")
      .textContent.toUpperCase();

    if (category.includes(filter) || name.includes(filter)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });

  // Collect removed recipes
  const removedRows = document.querySelectorAll(
    ".removed-recipes-table tbody tr"
  );

  removedRows.forEach(function (row) {
    const name = row.querySelector("td:nth-child(2)").textContent.toUpperCase();
    const category = row
      .querySelector("td:nth-child(5)")
      .textContent.toUpperCase();

    if (category.includes(filter) || name.includes(filter)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}

document.getElementById("searchInput").addEventListener("input", filterRecipes);
