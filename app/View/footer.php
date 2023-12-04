<script>
  const hamburgerNavbar = document.querySelector(".hamburger-nav");
  const navMenu_el = document.querySelector('.nav-menu');
  const navLink_el = document.querySelectorAll('.nav-link');

  hamburgerNavbar.addEventListener('click', () => {
    navMenu_el.classList.toggle('nav-menu-active');
    navLink_el.forEach(link => {
      link.addEventListener('click', () => {
        navMenu_el.classList.remove('nav-menu-active');
      })
    })
  })

  const navbar_el = document.querySelector('.nav');

  let lastScrollTop = 0;
  window.addEventListener('scroll', () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (scrollTop > lastScrollTop) {
      if (navbar_el.classList.contains('nav-scroll-down')) {
        navbar_el.classList.replace('nav-scroll-down', 'nav-scroll-up');
      } else {
        navbar_el.classList.add('nav-scroll-up');
      }
    } else {
      navbar_el.classList.replace('nav-scroll-up', 'nav-scroll-down');
    }
    lastScrollTop = scrollTop;
  })
</script>


</body>

</html>