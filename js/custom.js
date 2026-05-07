// Parent icon Navbar
let parentItems = document.querySelectorAll('.nav-item.deeper.parent');
parentItems.forEach(function(parentItem) {
    let dropParentIcon = document.createElement('span');
    dropParentIcon.setAttribute("uk-icon", "icon: chevron-down");
    let anchor = parentItem.querySelector('a');
    anchor.appendChild(dropParentIcon);
});

// Mobile Offcanvas: Aktive Parent-Items aufklappen (nach UIkit-Init)
UIkit.util.on(document, 'show', '#offcanvas-nav', function() {
    document.querySelectorAll('.uk-offcanvas-bar .nav-item.active.deeper.parent').forEach(function(parentItem) {
        let dropdown = parentItem.querySelector('.uk-navbar-dropdown');
        if (dropdown) dropdown.classList.add('uk-open');
        let icon = parentItem.querySelector('a .uk-icon');
        if (icon) icon.setAttribute('uk-icon', 'icon: chevron-up');
    });
});

// Mobile Offcanvas Accordion
document.addEventListener('click', function(e) {
  var icon = e.target.closest('.uk-offcanvas-bar .nav-item.deeper.parent > a .uk-icon');
  if (!icon) return;

  e.preventDefault();
  e.stopPropagation();

  var dropdown = icon.closest('li').querySelector('.uk-navbar-dropdown');
  if (!dropdown) return;

  var isOpen = dropdown.classList.contains('uk-open');
  dropdown.classList.toggle('uk-open', !isOpen);
  icon.setAttribute('uk-icon', isOpen ? 'icon: chevron-down' : 'icon: chevron-up');
});
