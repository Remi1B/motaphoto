<?php
function mon_theme_enqueue_styles() {
    wp_enqueue_style('mon-theme-style', get_template_directory_uri() . '/assets/style.css');
}
add_action('wp_enqueue_scripts', 'mon_theme_enqueue_styles');


// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );
// Enregistre le menu "header_menu"
function mon_theme_register_menus() {
    register_nav_menus(
        array(
            'header_menu' => __('Header Menu'),
            'footer_menu' => __('Footer Menu'),
        )
    );
}
add_action('init', 'mon_theme_register_menus');

function cptui_register_my_cpts() {

    /**
     * Post Type: Photos.
     */

    $labels = [
        "name" => esc_html__( "Photos", "custom-post-type-ui" ),
        "singular_name" => esc_html__( "Photo", "custom-post-type-ui" ),
    ];

    $args = [
        "label" => esc_html__( "Photos", "custom-post-type-ui" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => false,
        "rewrite" => [ "slug" => "photo", "with_front" => true ],
        "query_var" => true,
        "supports" => [ "title", "editor", "thumbnail" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "photo", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
// Récupère le template "single-photos" dans le dossier "templates"
add_filter('single_template', function($single_template) {
    global $post;

    if ($post->post_type === 'photo') {
        $custom_template = locate_template('templates/single-photo.php');
        if ($custom_template) {
            return $custom_template;
        }
    }
    return $single_template;
});