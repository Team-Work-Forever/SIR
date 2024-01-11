/* Side Menu */

/* Control Status Side-Menu (Compact) */
document.addEventListener("DOMContentLoaded", function () {
  var isOpen = localStorage.getItem("isCompact") === "true";
  var toggleSideMenu = document.getElementById("hamburger");
  var sideMenu = document.getElementById("side-menu");

  sideMenu.classList.toggle("compact", isOpen);

  toggleSideMenu.addEventListener("click", () => {
    isOpen = !isOpen;

    localStorage.setItem("isCompact", isOpen);

    sideMenu.classList.toggle("compact", isOpen);
  });
});

/* Control Selection of options on side-menu */
document.addEventListener("DOMContentLoaded", function () {
  document.body.classList.remove("hidden");

  var navItems = document.querySelectorAll(".nav-item a");

  var activeItem = localStorage.getItem("activeNavItem");

  if (!activeItem) {
    var firstNavItem = navItems[0];
    firstNavItem.classList.add("active");
    const path = firstNavItem.dataset.mcPath;
    // localStorage.setItem("activeNavItem", firstNavItem.getAttribute("href"));
    localStorage.setItem("activeNavItem", path);
  } else {
    navItems.forEach(function (item) {
      item.classList.remove("active");
    });

    var storedItem = document.querySelector(
      '.nav-item a[data-mc-path="' + activeItem + '"]'
    );
    if (storedItem) {
      storedItem.classList.add("active");
    }
  }

  navItems.forEach(function (item) {
    item.addEventListener("click", function (e) {
      const path = item.dataset.mcPath;

      if (!item.classList.contains("nav-link")) {
        e.preventDefault();
        window.location.href = item.getAttribute(path);
      }

      if (!item.classList.contains("active")) {
        // localStorage.setItem("activeNavItem", item.getAttribute("href"));
        localStorage.setItem("activeNavItem", path);

        navItems.forEach(function (otherItem) {
          otherItem.classList.remove("active");
        });

        item.classList.add("active");
      }
    });
  });
});
