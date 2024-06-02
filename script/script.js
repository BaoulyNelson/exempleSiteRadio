document.addEventListener('DOMContentLoaded', function () {
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
});


document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('.section-content');

    navLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            // Retirer la classe active de toutes les sections
            sections.forEach(section => {
                section.classList.remove('active');
            });

            // Ajouter la classe active à la section correspondante
            const targetId = this.getAttribute('data-target');
            document.getElementById(targetId).classList.add('active');
        });
    });
});



function toggleSearch() {
    var searchContainer = document.querySelector('.search-container');
    var searchInput = document.getElementById('searchInput');
    if (searchContainer.style.display === 'flex') {
        searchContainer.style.display = 'none';
    } else {
        searchContainer.style.display = 'flex';
        searchInput.focus(); // Mettre le focus sur le champ de recherche
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.querySelector('.form-inline');
    const searchInput = document.getElementById('searchInput');
    const navLinks = document.querySelectorAll('.nav-link');
    const sectionContents = document.querySelectorAll('.section-content');
    const messageContainer = document.getElementById('messageContainer');

    searchForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Empêche le rechargement de la page

        const searchTerm = searchInput.value.toLowerCase().trim();
        let hasMatch = false;

        // Masquer tous les contenus et réinitialiser les liens
        sectionContents.forEach(function (section) {
            section.style.display = 'none';
        });

        navLinks.forEach(function (link) {
            const linkText = link.textContent.toLowerCase().trim();
            const linkParent = link.parentElement;

            if (linkText.includes(searchTerm)) {
                linkParent.style.display = 'block';

                // Afficher le contenu associé
                const targetId = link.getAttribute('data-target');
                const correspondingSection = document.getElementById(targetId);
                correspondingSection.style.display = 'block';

                hasMatch = true;
            } else {
                linkParent.style.display = 'none';
            }
        });

        if (!hasMatch || searchTerm === '') {
            messageContainer.textContent = 'Aucun résultat trouvé.';
        } else {
            messageContainer.textContent = '';
        }
    });

    searchInput.addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase().trim();

        if (searchTerm === '') {
            messageContainer.textContent = '';
            resetDisplay();
            return;
        }

        let hasMatch = false;

        navLinks.forEach(function (link) {
            const linkText = link.textContent.toLowerCase().trim();
            const linkParent = link.parentElement;

            if (linkText.includes(searchTerm)) {
                linkParent.style.display = 'block';
                hasMatch = true;
            } else {
                linkParent.style.display = 'none';
            }
        });

        if (!hasMatch) {
            messageContainer.textContent = 'Aucun résultat trouvé.';
        } else {
            messageContainer.textContent = '';
        }
    });

    function resetDisplay() {
        navLinks.forEach(function (link) {
            link.parentElement.style.display = 'block';
        });

        sectionContents.forEach(function (section) {
            section.style.display = 'none';
        });
    }
});