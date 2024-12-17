document.addEventListener('DOMContentLoaded', () => {
    const photoGallery = document.querySelector('.photo_gallery');

    // Vérifier si la galerie de photos existe avant d'exécuter le reste du script
    if (!photoGallery) {
        return; // Quitter le script si .photo_gallery n'est pas présent
    }

    const lightbox = document.getElementById('lightbox');
    const lightboxImage = lightbox.querySelector('.lightbox_open-image');
    const lightboxRef = lightbox.querySelector('.lightbox_infos-ref');
    const lightboxCat = lightbox.querySelector('.lightbox_infos-categorie');
    const closeButton = lightbox.querySelector('.lightbox_close-btn');
    const leftArrow = lightbox.querySelector('.lightbox_arrow-left');
    const rightArrow = lightbox.querySelector('.lightbox_arrow-right');

    let currentIndex = 0;

    // Utilisation de la délégation d'événements pour les éléments chargés dynamiquement
    photoGallery.addEventListener('click', function(e) {
        // Vérifier si le clic provient du bouton fullscreen
        const fullscreenButton = e.target.closest('.photo_overlay-fullscreen');
        
        if (fullscreenButton) {
            e.preventDefault();

            // Trouver l'élément parent .photo_block
            const photoBlock = fullscreenButton.closest('.photo_block');
            if (photoBlock) {
                // Trouver l'élément .photo_item dans le bloc photo
                const photoItem = photoBlock.querySelector('.photo_item');
                
                if (photoItem) {
                    // Trouver l'index du .photo_item dans la galerie
                    const allPhotoItems = Array.from(document.querySelectorAll('.photo_item'));
                    currentIndex = allPhotoItems.indexOf(photoItem);

                    // Récupérer les données de l'image
                    const imageUrl = photoItem.getAttribute('data-image-url');
                    const ref = photoItem.getAttribute('data-reference');
                    const cat = photoItem.getAttribute('data-categorie');

                    // Mettre à jour la lightbox avec les données
                    lightboxImage.src = imageUrl;
                    lightboxRef.textContent = ref;
                    lightboxCat.textContent = cat;

                    // Afficher la lightbox
                    lightbox.classList.add('active');
                }
            }
        }
    });

    // Fermer la lightbox
    closeButton.addEventListener('click', () => {
        lightbox.classList.remove('active');
    });
    window.addEventListener("click", function (event) {
        if (event.target === lightbox) {
            lightbox.classList.remove('active');
        }
    });

    // Navigation
    leftArrow.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = document.querySelectorAll('.photo_item').length - 1; // Revenir à la dernière image
        }
        updateLightboxContent();
    });

    rightArrow.addEventListener('click', () => {
        if (currentIndex < document.querySelectorAll('.photo_item').length - 1) {
            currentIndex++;
        } else {
            currentIndex = 0; // Revenir à la première image
        }
        updateLightboxContent();
    });

    // Fonction pour mettre à jour le contenu de la lightbox
    function updateLightboxContent() {
        const photoItem = document.querySelectorAll('.photo_item')[currentIndex];
        const imageUrl = photoItem.getAttribute('data-image-url');
        const ref = photoItem.getAttribute('data-reference');
        const cat = photoItem.getAttribute('data-categorie');

        lightboxImage.src = imageUrl;
        lightboxRef.textContent = ref;
        lightboxCat.textContent = cat;
    }

    // Fermer la lightbox avec la touche "Échap"
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && lightbox.classList.contains('active')) {
            lightbox.classList.remove('active');
        }
    });
});