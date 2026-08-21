(function () {
  const toggle = document.querySelector('.mobile-menu-toggle');
  const menu = document.getElementById('mobile-menu');

  if (!toggle || !menu) {
    return;
  }

  toggle.addEventListener('click', function () {
    const expanded = toggle.getAttribute('aria-expanded') === 'true';
    toggle.setAttribute('aria-expanded', String(!expanded));
    menu.hidden = expanded;
  });
})();
