<?php
function mon_theme_enqueue_styles() {
    wp_enqueue_style('mon-theme-style', get_template_directory_uri() . '/assets/style.css');
}
add_action('wp_enqueue_scripts', 'mon_theme_enqueue_styles');


// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );