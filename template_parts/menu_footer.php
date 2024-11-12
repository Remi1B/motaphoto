<?php
if (has_nav_menu('footer_menu')) {
    wp_nav_menu(array(
        'theme_location' => 'footer_menu',
        'container' => 'nav',
        'container_class' => 'footer_nav',
        'menu_class' => 'menu',
        'fallback_cb' => false
    ));
} else {
    echo '<p>Veuillez configurer le menu dans l’administration.</p>';
} 
