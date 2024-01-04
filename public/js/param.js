const params = new URLSearchParams(window.location.search);
for (const [paramName, paramValue] of params) {
  if (paramName == "modal") {
    console.log("Modal");
    console.log(document.getElementById(paramValue));
    if (document.getElementById(paramValue)) {
      $(window).on("load", function () {
        $("#" + paramValue).modal("show");
      });
    }
  }
  const element = document.getElementById(paramName);
  if (element) {
    element.value = paramValue;
  }
}
