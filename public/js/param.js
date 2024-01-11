const params = new URLSearchParams(window.location.search);
for (const [paramName, paramValue] of params) {
  const element = document.getElementById(paramName);
  if (element) {
    element.value = paramValue;
  }
}
