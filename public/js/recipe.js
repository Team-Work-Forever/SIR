// Steps
function setVariablesStep(step_id, step_number, description, step_name) {
  if (step_name == null) {
    step_name = "undefined";
  }

  document.getElementById("step_id").value = step_id;
  document.getElementById("step_number").value = step_number;
  document.getElementById("step_description").value = description;
}

function clearStepVariables() {
  document.getElementById("step_id").value = "";
  document.getElementById("step_number").value = "";
  document.getElementById("step_description").value = "";
  document.getElementById("step_name").value = "";
}

function checkStepId() {
  if (
    document.getElementById("step_id").value !== null &&
    document.getElementById("step_id").value !== ""
  ) {
    document.getElementById("submitButton").value = "editStep";
  } else {
    document.getElementById("submitButton").value = "addStep";
  }
}

// Ingredients
const ingredients = [];

function AddIngredient(ingredient_id, quantity, ingredient_unit) {
  const found = false;

  ingredients.forEach((ingredient) => {
    if (ingredient[0] == ingredient_id) {
      ingredient[1] = quantity;
      found = true;
    }
  });

  if (!found) {
    ingredients.push([ingredient_id, quantity, ingredient_unit]);
  }

  updateIngredientsInput();
}

function updateIngredientsInput() {
  document.getElementById("ingredients").value = JSON.stringify(ingredients);
}

function clearIngredients() {
  document.getElementById("quant").value = "";
  ingredients.length = 0;
  updateIngredientsInput();
}

// Image
function changeCover(event) {
  const recipe_id = event.target.dataset.msRecipeid;
  const selectedCover = document.getElementById("selectedCover" + recipe_id);
  const fileInput = document.getElementById("coverInput" + recipe_id);
  const reader = new FileReader();

  if (fileInput.files.length !== 1) {
    return;
  }

  const selectedFile = fileInput.files[0];

  reader.onload = function (e) {
    const currentCoverData = e.target.result;
    selectedCover.src = currentCoverData;
  };

  reader.readAsDataURL(selectedFile);
}
