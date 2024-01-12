function filterUsers() {
  const searchInput = document.getElementById("searchInput");
  const filter = searchInput.value.toUpperCase();

  // Collect active users
  const activeRows = document.querySelectorAll(".active-users-table tbody tr");

  activeRows.forEach(function (row) {
    const email = row
      .querySelector("td:nth-child(4)")
      .textContent.toUpperCase();
    const name = row.querySelector("td:nth-child(5)").textContent.toUpperCase();

    if (email.includes(filter) || name.includes(filter)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });

  // Collect removed users
  const removedRows = document.querySelectorAll(
    ".removed-users-table tbody tr"
  );

  removedRows.forEach(function (row) {
    const email = row
      .querySelector("td:nth-child(2)")
      .textContent.toUpperCase();
    const name = row.querySelector("td:nth-child(3)").textContent.toUpperCase();

    if (email.includes(filter) || name.includes(filter)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}

document.getElementById("searchInput").addEventListener("input", filterUsers);
