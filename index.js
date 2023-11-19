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