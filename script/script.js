document.addEventListener('DOMContentLoaded', function () {
    // Menu toggle functionality
    const menuLink = document.querySelector('a[data-target="menu"]');
    const menuPanel = document.getElementById('menuPanel');
    const body = document.body;
    let isMenuOpen = false;

    menuLink.addEventListener('click', function (event) {
        event.preventDefault();
        if (!isMenuOpen) {
            menuPanel.style.display = 'block';
            setTimeout(() => {
                menuPanel.classList.add('open');
            }, 10); // Delay to allow the display to take effect
            body.classList.add('no-scroll');
            menuLink.querySelector('i').className = 'fas fa-times'; // Change icon to close (X)
            isMenuOpen = true;
        } else {
            menuPanel.classList.remove('open');
            body.classList.remove('no-scroll');
            menuLink.querySelector('i').className = 'fas fa-bars'; // Change icon to hamburger (☰)
            isMenuOpen = false;
        }
    });

    document.addEventListener('click', function (event) {
        if (isMenuOpen && !menuPanel.contains(event.target) && event.target !== menuLink) {
            menuPanel.classList.remove('open');
            body.classList.remove('no-scroll');
            menuLink.querySelector('i').className = 'fas fa-bars'; // Change icon to hamburger (☰)
            isMenuOpen = false;
        }
    });

    menuPanel.addEventListener('transitionend', function () {
        if (!isMenuOpen) {
            menuPanel.style.display = 'none';
        }
    });

    // Navigation links functionality
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('.section-content');

    navLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            // Retirer la classe active de toutes les sections
            sections.forEach(section => {
                section.classList.remove('active');
                section.style.display = 'none';
            });

            // Ajouter la classe active à la section correspondante
            const targetId = this.getAttribute('data-target');
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.classList.add('active');
                targetSection.style.display = 'block';
            }
        });
    });
});