<?php 

function get_info($image_size = 'medium') {
    $post_id = get_the_ID();

    // Référence
    $reference_field = get_field_object('reference');
    $reference_label = isset($reference_field['label']) ? $reference_field['label'] : 'Référence';
    $reference_value = get_post_meta($post_id, 'reference', true);

    // Catégorie
    $categorie_label = 'Catégorie'; // Par défaut
    $categorie_value = '';
    $categorie_terms = get_the_terms($post_id, 'categorie');
    if ($categorie_terms && !is_wp_error($categorie_terms)) {
        $categorie_names = wp_list_pluck($categorie_terms, 'name');
        $categorie_value = implode(', ', $categorie_names);
        $categorie_label = get_taxonomy('categorie')->labels->singular_name;
    }

    // Format
    $format_label = 'Format'; // Par défaut
    $format_value = '';
    $format_terms = get_the_terms($post_id, 'format');
    if ($format_terms && !is_wp_error($format_terms)) {
        $format_names = wp_list_pluck($format_terms, 'name');
        $format_value = implode(', ', $format_names);
        $format_label = get_taxonomy('format')->labels->singular_name;
    }

    // Type
    $type_field = get_field_object('type');
    $type_label = isset($type_field['label']) ? $type_field['label'] : 'Type';
    $type_value = get_post_meta($post_id, 'type', true);

    // Année
    $annee_label = 'Année';
    $annee_value = get_the_date('Y', $post_id);

    // Image
    ob_start();
    the_post_thumbnail($image_size, array('class' => 'lightbox-image'));
    $image_html = ob_get_clean();
    // Retourner les données sous forme de tableau
    return [
        'reference' => ['label' => $reference_label, 'value' => $reference_value],
        'categorie' => ['label' => $categorie_label, 'value' => $categorie_value],
        'format' => ['label' => $format_label, 'value' => $format_value],
        'type' => ['label' => $type_label, 'value' => $type_value],
        'annee' => ['label' => $annee_label, 'value' => $annee_value],
        'image_html' => $image_html,
    ];
}