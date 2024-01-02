function updateButton(event) {
  const recipe_id = event.target.dataset.msTipimage;
  const fileInput = document.getElementById("imageUpload" + recipe_id);

  if (fileInput.files.length !== 1) {
    return;
  }

  submit(event);
}

function submit(event) {
  const recipe_id = event.target.dataset.msTipimage;
  const form = document.getElementById("hiddenSubmitButton");
  const fileInput = document.getElementById("imageUpload" + recipe_id);

  if (fileInput.files.length !== 1) {
    event.preventDefault();
  } else {
    form.click();
  }
}
