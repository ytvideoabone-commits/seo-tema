document.addEventListener('DOMContentLoaded', function () {
  const list = document.getElementById('seo-package-feature-list');
  const addButton = document.querySelector('.seo-package-add-feature');
  if (!list || !addButton) return;

  addButton.addEventListener('click', function () {
    const row = document.createElement('div');
    row.className = 'seo-package-feature';
    row.innerHTML = '<input class="widefat" type="text" name="seo_package_features[]"><button type="button" class="button-link-delete seo-package-remove-feature">Sil</button>';
    list.appendChild(row);
    row.querySelector('input').focus();
  });

  list.addEventListener('click', function (event) {
    if (event.target.classList.contains('seo-package-remove-feature')) {
      event.target.closest('.seo-package-feature').remove();
    }
  });
});
