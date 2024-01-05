function filterIngredients(event) {
  const filter = event.target.value.toUpperCase();
  const ingredients = document.querySelectorAll(".model-section .row");
  ingredients.forEach(function (ingredient) {
    const labelElement = ingredient.querySelector(".form-check label");
    if (labelElement) {
      const label = labelElement.textContent.toUpperCase();
      if (label.includes(filter)) {
        ingredient.style.display = "";
      } else {
        ingredient.style.display = "none";
      }
    }
  });
}

function filterIngredientsPage(event) {
  const filter = event.target.value.toUpperCase();
  const ingredients = document.querySelectorAll(".queryById .row");

  ingredients.forEach(function (ingredient) {
    const labelElement = ingredient.querySelector(".form-check label");

    if (labelElement) {
      const label = labelElement.textContent.toUpperCase();

      if (label.includes(filter)) {
        ingredient.style.display = "";
      } else {
        ingredient.style.display = "none";
      }
    }
  });
}
