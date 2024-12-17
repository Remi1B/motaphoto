<?php
function mon_theme_enqueue_assets() {
    wp_enqueue_style('mon-theme-style', get_template_directory_uri() . '/assets/style.css');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/fonts/fontawesome-free-6.7.1-web/css/all.css');

    wp_enqueue_script('modale_contact', get_stylesheet_directory_uri() . '/js/modale_contact.js', array(), null, true);
    wp_enqueue_style('select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
    wp_enqueue_script('select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), null, true);
    wp_enqueue_script('load_photos', get_stylesheet_directory_uri() . '/js/load_photos.js', array('jquery', 'select2-js'), null, true);
    wp_enqueue_script('click_select', get_stylesheet_directory_uri() . '/js/click_select.js', array('jquery', 'select2-js'), null, true);
    wp_localize_script('load_photos', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
    wp_enqueue_script('lightbox', get_stylesheet_directory_uri() . '/js/lightbox.js', array(), null, true);
    wp_enqueue_script('menu_mobile', get_stylesheet_directory_uri() . '/js/menu_mobile.js', array(), null, true);

}
add_action('wp_enqueue_scripts', 'mon_theme_enqueue_assets');
function mon_theme_supports() {
    // Ajouter la prise en charge des images mises en avant
    add_theme_support( 'post-thumbnails' );

    // Ajouter la prise en charge du logo personnalisé
    add_theme_support( 'custom-logo', array(
        'height'      => 14, 
        'width'       => 216, 
    ) );

    // Ajouter automatiquement le titre du site dans l'en-tête du site
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'mon_theme_supports' );
// Enregistre les menus
function mon_theme_register_menus() {
    register_nav_menus(
        array(
            'header_menu' => __('Header Menu'),
            'footer_menu' => __('Footer Menu'),
            'mobile_menu' => __('Menu mobile'),
        )
    );
}
add_action('init', 'mon_theme_register_menus');

function cptui_register_my_cpts() {
    // Post Type: Photos
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

require_once get_template_directory() . '/includes/function_ajax.php';
require_once get_template_directory() . '/includes/function_get_info.php';
require_once get_template_directory() . '/includes/function_post-loop.php';

// Recupère la Ref.photo dans la modale de contact
function prefill_cf7_field_with_acf($tag) {
    if ($tag['name'] !== 'your-subject') {
        return $tag;
    }
    if (is_singular('photo')) {
        $post_id = get_the_ID();
        $acf_reference = get_field('reference', $post_id);

        if ($acf_reference) {
            $tag['values'] = [$acf_reference];
        }
    }
    return $tag;
}
add_filter('wpcf7_form_tag', 'prefill_cf7_field_with_acf');