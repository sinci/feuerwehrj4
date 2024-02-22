// Parent icon Navbar
let parentItems = document.querySelectorAll('.nav-item.deeper.parent');
parentItems.forEach(function(parentItem) {
    let dropParentIcon = document.createElement('span');
    dropParentIcon.setAttribute("uk-icon", "icon: chevron-down");
    let anchor = parentItem.querySelector('a');
    anchor.appendChild(dropParentIcon);
});

// Mobile Parent
