document.addEventListener('DOMContentLoaded', function () {
    if (document.body.classList.contains('home')) {
        const gallery = document.querySelector('.photo_gallery');
        const loadMoreButton = document.querySelector('.photo_load-more');

        // Initialiser Select2
        const filters = jQuery('.photo_filters-category, .photo_filters-format, .photo_filters-order');
        filters.select2();

        // Fonction pour charger les photos
        function loadPhotos(page = 1) {
            const data = {
                action: 'load_photos',
                page: page,
                categorie: jQuery('.photo_filters-category').val(),
                format: jQuery('.photo_filters-format').val(),
                order: jQuery('.photo_filters-order').val(),
            };

            if (loadMoreButton) {
                loadMoreButton.disabled = true;
            }

            jQuery.post(ajax_object.ajaxurl, data, function (response) {
                if (response.success) {
                    if (page === 1) {
                        gallery.innerHTML = ''; // Réinitialiser la galerie si c'est le premier chargement
                    }
                    gallery.innerHTML += response.data.photos;

                    if (response.data.has_more) {
                        loadMoreButton.style.display = 'block';
                        loadMoreButton.disabled = false;
                    } else {
                        loadMoreButton.style.display = 'none';
                    }
                } else {
                    gallery.innerHTML = '<p>Aucune photo trouvée.</p>';
                    if (loadMoreButton) {
                        loadMoreButton.style.display = 'none';
                    }
                }
            });
        }

        // Charger les photos au chargement initial
        loadPhotos();

        // Charger plus de photos au clic sur "Charger plus"
        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', function () {
                const currentPage = parseInt(this.getAttribute('data-page')) || 1;
                const nextPage = currentPage + 1;
                loadPhotos(nextPage);
                this.setAttribute('data-page', nextPage);
            });
        }

        // Réinitialiser et recharger les photos lors du changement de filtre
        filters.on('select2:select', function () {
            if (loadMoreButton) {
                loadMoreButton.setAttribute('data-page', 1); // Réinitialiser à la première page
            }
            loadPhotos(1); // Recharger depuis la première page
        });
    }
});