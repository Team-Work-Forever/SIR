  document.addEventListener('DOMContentLoaded', function () {
    var navItems = document.querySelectorAll('.nav-item .nav-link');
    var sections = document.querySelectorAll('section');

    window.addEventListener('scroll', function () {
      var scrollPosition = window.scrollY;

      sections.forEach(function (section) {
        var sectionTop = section.offsetTop -10;
        var sectionBottom = sectionTop + section.offsetHeight;

        if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
          // Remove a classe 'active' de todos os itens
          navItems.forEach(function (navItem) {
            navItem.classList.remove('active');
          });

          // Encontra o link correspondente à secção e adiciona a classe 'active'
          var correspondingLink = document.querySelector('a[href="#' + section.id + '"]');
          if (correspondingLink) {
            correspondingLink.classList.add('active');
          }

        }
    });
    });
  });

  var daySelect = document.getElementById("day");
  for (var i = 1; i <= 31; i++) {
    var option = document.createElement("option");
    option.value = i;
    option.text = i;
    daySelect.appendChild(option);
  }

  // Preencher os meses
  var monthSelect = document.getElementById("month");
  var months = [
    "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
    "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
  ];
  for (var i = 1; i <= 12; i++) {
    var option = document.createElement("option");
    option.value = i;
    option.text = months[i - 1];
    monthSelect.appendChild(option);
  }

  // Preencher os anos (assumindo um intervalo de 100 anos)
  var yearSelect = document.getElementById("year");
  var currentYear = new Date().getFullYear();
  for (var i = currentYear; i >= currentYear - 100; i--) {
    var option = document.createElement("option");
    option.value = i;
    option.text = i;
    yearSelect.appendChild(option);
  }