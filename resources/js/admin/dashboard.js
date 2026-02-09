// Toggle Sidebar
const toggleBtn = document.getElementById('toggleBtn');
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const sidebarMenu = document.getElementById('sidebarMenu');

if (toggleBtn) {
    toggleBtn.addEventListener('click', function () {
        sidebarMenu.classList.toggle('show');
    });
}

// Fermer le sidebar quand on clique sur un lien (mobile)
const sidebarLinks = document.querySelectorAll('.sidebar-menu a');
sidebarLinks.forEach(link => {
    link.addEventListener('click', function () {
        if (window.innerWidth <= 768) {
            sidebarMenu.classList.remove('show');
        }
    });
});

// Marquer le lien actif
const currentLocation = location.pathname;
sidebarLinks.forEach(link => {
    if (link.getAttribute('href') === currentLocation) {
        link.classList.add('active');
    } else {
        link.classList.remove('active');
    }
});

// Gérer le responsive
window.addEventListener('resize', function () {
    if (window.innerWidth > 768) {
        sidebarMenu.classList.remove('show');
    }
});
