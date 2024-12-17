jQuery(document).ready(function ($) {
    // Initialisation pour les catégories
    $('.photo_filters-category').select2({
        dropdownParent: $('.photo_filters-taxonomy') // Assure que le dropdown est dans le bon conteneur
    });

    // Initialisation pour les formats
    $('.photo_filters-format').select2({
        dropdownParent: $('.photo_filters-taxonomy')
    });

    // Initialisation pour l'ordre
    $('.photo_filters-order').select2({
        dropdownParent: $('.photo_filters-orderby')
    });

    // Rendre la recherche non modifiable
    $('.custom-select').on('select2:open', function () {
        $('.select2-search__field').prop('readonly', true);
    });

    // Vérifier si la valeur sélectionnée est la valeur par défaut
    $('.custom-select').on('select2:select', function () {
        const selectContainer = $(this).next('.select2-container');
        const defaultValue = $(this).find('option').first().val();
        const selectedValue = $(this).val();
        // Si la valeur sélectionnée est la valeur par défaut, on enlève la classe
        if (selectedValue === defaultValue) {
            selectContainer.removeClass('select2-active');
        } else {
            selectContainer.addClass('select2-active');
        }
    });
});