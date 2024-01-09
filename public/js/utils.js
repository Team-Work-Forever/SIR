function goTo(path) {
  window.location.href = path;
}

/* Open Modal */
document.addEventListener("DOMContentLoaded", function () {
  var params = new URLSearchParams(window.location.search);
  var modalName = params.get("modal");

  if (modalName) {
    openModal(modalName);
  }
});

function openModal(modalName) {
  var modal = document.getElementById(modalName);

  modal.classList.add("show");
  modal.style.display = "block";
  modal.setAttribute("aria-hidden", "false");
  document.body.classList.add("modal-open");
}

function closeModal(modalName) {
  var modal = document.getElementById(modalName);

  modal.classList.remove("show");
  modal.style.display = "none";
  modal.setAttribute("aria-hidden", "true");
  document.body.classList.remove("modal-open");
}

/* Shares */
function share(message, type) {
  const currentURL = window.location.href;
  navigator.clipboard
    .writeText(currentURL)
    .then(function () {
      showToast(message, type);
    })
    .catch(function (err) {
      showToast("Erro ao copiar para a área de transferência!", "error");
    });
}

function shareRecipe(host, recipe_id, event) {
  event.stopPropagation();

  const url = "http://" + host + "/app/detailsrecipe?id=" + recipe_id;
  navigator.clipboard
    .writeText(url)
    .then(function () {
      showToast(
        "URL da receita copiado para a área de transferência! (para partilhar a receita colocar como pública)",
        "success"
      );
    })
    .catch(function (err) {
      showToast("Erro ao copiar para a área de transferência!", "error");
    });
}

/* Toasts */
const toast = document.querySelector(".toast");
const close = document.querySelector(".toast .close");
const error_msg = document.querySelector(".toast .error");

close.addEventListener("click", function (e) {
  e.preventDefault();
  hideToast();
});

function showToast(message, type = "") {
  if (toast.classList.contains("active")) {
    setTimeout(() => {
      hideToast();
    }, 5000);
  }

  toast.classList.add("active");
  toast.classList.forEach((item) => {
    if (item === "toast" || item === "active") return;
    toast.classList.remove(item);
  });

  if (type === "success" || type === "error" || type === "warning") {
    toast.classList.add(type);
  }

  error_msg.innerHTML = message ?? "There is no message set";

  setTimeout(() => {
    hideToast();
  }, 5000);
}

document.addEventListener("keydown", function (event) {
  if (event.key === "Escape" || event.key === "Esc") {
    hideToast();
  }
});

function hideToast() {
  toast.classList.remove("active");
}
