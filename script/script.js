
document.addEventListener('DOMContentLoaded', function () {
    const menuLink = document.querySelector('a[data-target="menu"]');
    const menuPanel = document.getElementById('menuPanel');
    let isMenuOpen = false;

    menuLink.addEventListener('click', function (event) {
        event.preventDefault();
        if (!isMenuOpen) {
            menuPanel.style.display = 'block';
            setTimeout(() => {
                menuPanel.classList.add('open');
            }, 10); // Delay to allow the display to take effect
            menuLink.querySelector('i').className = 'fas fa-times'; // Change icon to close (X)
            isMenuOpen = true;
        } else {
            menuPanel.classList.remove('open');
            setTimeout(() => {
                menuPanel.style.display = 'none';
            }, 600); // Delay to allow the transition to complete
            menuLink.querySelector('i').className = 'fas fa-bars'; // Change icon to hamburger (☰)
            isMenuOpen = false;
        }
    });


    document.addEventListener('click', function (event) {
        if (isMenuOpen && !menuPanel.contains(event.target) && event.target !== menuLink) {
            menuPanel.classList.remove('open');
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



var lastScrollTop = 0;

window.addEventListener("scroll", function () {
    var currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (currentScroll > lastScrollTop) {
        // Scroll vers le bas
        document.querySelector('.navbar-bottom').style.transform = 'translateY(100%)';
    } else {
        // Scroll vers le haut
        document.querySelector('.navbar-bottom').style.transform = 'translateY(0)';
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Pour prendre en compte le défilement vers le haut
}, false);


document.addEventListener('DOMContentLoaded', function() {
    function adjustMenuPanelHeight() {
        const header = document.querySelector('.header');
        const navbarBottom = document.querySelector('.navbar-bottom');
        const menuPanel = document.querySelector('.menu-panel');

        const headerHeight = header.offsetHeight;
        const navbarHeight = navbarBottom.offsetHeight;

        menuPanel.style.bottom = `${navbarHeight}px`;
        menuPanel.style.height = `calc(100vh - ${headerHeight + navbarHeight}px)`;
    }

    // Adjust height on initial load
    adjustMenuPanelHeight();

    // Adjust height on window resize
    window.addEventListener('resize', adjustMenuPanelHeight);
});
