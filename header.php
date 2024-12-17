<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name=description content="Nathalie Mota, photographe professionnelle dans l’événementiel.">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header">
        <div class="header_menu">
            <?php
            if ( function_exists( 'the_custom_logo' ) ) {
                the_custom_logo();
            }
            ?>
            <?php get_template_part('template_parts/menu_header'); ?>  
        </div>
    </header>
    
    <?php wp_body_open(); ?>