<?php
/**
 * Récupère les posts précédent et suivant, en gérant les cas particuliers
 * où l'article est le premier ou le dernier.
 */
function get_adjacent_posts_with_loop($post_id) {
    global $post;

    // Forcer le post global au cas où
    $current_post = get_post($post_id);

    // Récupérer le précédent post
    $previous_post = get_previous_post();
    if (!$previous_post) {
        // Si aucun post précédent, récupérer le dernier post publié
        $args = [
            'post_type' => $current_post->post_type,
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_status' => 'publish',
        ];
        $previous_post = get_posts($args);
        $previous_post = !empty($previous_post) ? $previous_post[0] : null;
    }

    // Récupérer le prochain post
    $next_post = get_next_post();
    if (!$next_post) {
        // Si aucun post suivant, récupérer le premier post publié
        $args = [
            'post_type' => $current_post->post_type,
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'ASC',
            'post_status' => 'publish',
        ];
        $next_post = get_posts($args);
        $next_post = !empty($next_post) ? $next_post[0] : null;
    }

    return [
        'previous' => $previous_post,
        'next' => $next_post,
    ];
}