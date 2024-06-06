function toggleSearch() {
    var searchContainer = document.querySelector('.search-container');
    var searchInput = document.getElementById('searchInput');
    if (searchContainer.classList.contains('open')) {
        searchContainer.classList.remove('open');
    } else {
        searchContainer.classList.add('open');
        searchInput.focus(); // Mettre le focus sur le champ de recherche
    }
}


// pour filtrer les liens et soumettre le formulaire

document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.querySelector('.form-inline');
    const searchInput = document.getElementById('searchInput');
    const navLinks = document.querySelectorAll('.nav-link');
    const sectionContents = document.querySelectorAll('.section-content');
    const messageContainer = document.getElementById('messageContainer');

    searchForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Empêche le rechargement de la page

        const searchTerm = searchInput.value.toLowerCase().trim();
        
        // Vérifier s'il y a un terme de recherche
        if (!searchTerm) {
            messageContainer.textContent = 'Veuillez entrer un terme de recherche.';
            return;
        }
        
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

        if (!hasMatch) {
            messageContainer.textContent = 'Aucun résultat trouvé.';
        } else {
            messageContainer.textContent = '';
        }
    });

    searchInput.addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase().trim();

        if (searchTerm === '') {
            messageContainer.textContent = ''; // Effacer le message lorsque le champ est vide
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

// pano a ap gen menm hauteur ak header a

document.addEventListener('DOMContentLoaded', function() {
    function adjustSearchContainerHeight() {
        const header = document.querySelector('.header');
        const searchContainer = document.querySelector('.search-container');

        const headerHeight = header.offsetHeight;

        // Ajuste la hauteur du conteneur de recherche en fonction de la hauteur de l'en-tête
        searchContainer.style.height = `${headerHeight}px`;
    }

    // Adjust height on initial load
    adjustSearchContainerHeight();

    // Adjust height on window resize
    window.addEventListener('resize', adjustSearchContainerHeight);
});