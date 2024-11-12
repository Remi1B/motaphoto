<?php
if (has_nav_menu('header_menu')) {
    wp_nav_menu(array(
        'theme_location' => 'header_menu',
        'container' => 'nav',
        'container_class' => 'header_nav',
        'menu_class' => 'menu',
        'fallback_cb' => false
    ));
} else {
    echo '<p>Veuillez configurer le menu dans l’administration.</p>';
}
