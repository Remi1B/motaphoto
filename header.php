<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header">
        <div class="header_menu">
            <a href="<?php echo home_url( '/' ); ?>">
                <img class="header_logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/nathalie-logo.png" alt="Logo">
            </a>
            <?php get_template_part('template_parts/menu_header'); ?>  
        </div>
    </header>
    
    <?php wp_body_open(); ?>