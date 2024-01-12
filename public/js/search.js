function filterCards() {
  const searchInput = document.getElementById("searchInput");
  const filter = searchInput.value.toUpperCase();
  const cards = document.querySelectorAll(".cardItem");

  cards.forEach(function (card) {
    const title = card.querySelector(".card-title").textContent.toUpperCase();
    const description = card
      .querySelector(".card-text")
      .textContent.toUpperCase();

    if (title.includes(filter) || description.includes(filter)) {
      card.style.display = "";
    } else {
      card.style.display = "none";
    }
  });
}

document.getElementById("searchInput").addEventListener("input", filterCards);
