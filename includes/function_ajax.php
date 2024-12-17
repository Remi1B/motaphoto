<?php  
function load_photos_ajax() {
    // Récupérer les paramètres envoyés par la requête AJAX
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $categorie = isset($_POST['categorie']) ? intval($_POST['categorie']) : '';
    $format = isset($_POST['format']) ? intval($_POST['format']) : '';
    $order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : 'ASC';

    // Construire les arguments pour WP_Query
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $page,
        'orderby' => 'date',
        'order' => $order,
    );

    if (!empty($categorie)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field'    => 'id',
            'terms'    => $categorie,
        );
    }

    if (!empty($format)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field'    => 'id',
            'terms'    => $format,
        );
    }

    // Effectuer la requête WP
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $photos = '';

        while ($query->have_posts()) {
            $query->the_post();
            ob_start();
            get_template_part('template_parts/photo_item');
            $photos .= ob_get_clean();
        }

        // Indiquer s'il reste des pages à afficher
        $has_more = $query->max_num_pages > $page;

        wp_send_json_success(array(
            'photos' => $photos,
            'has_more' => $has_more,
        ));
    } else {
        wp_send_json_error(array(
            'message' => 'Aucune photo trouvée.',
        ));
    }

    wp_die();
}

// Enregistrer les actions AJAX
add_action('wp_ajax_load_photos', 'load_photos_ajax');
add_action('wp_ajax_nopriv_load_photos', 'load_photos_ajax');