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

echo '<a class="mobile_menu-open" aria-controls="mobile_nav" aria-label="Ouvrir le menu"><i class="fa-solid fa-bars"></i></a>';
echo '<a class="mobile_menu-close" aria-controls="mobile_nav" aria-label="Fermer le menu"><i class="fa-solid fa-xmark fa-xl"></i></i></a>';

if (has_nav_menu('mobile_menu')) {
    wp_nav_menu(array(
        'theme_location' => 'mobile_menu',
        'container' => 'nav',
        'container_class' => 'mobile_nav',
        'menu_class' => 'mobile_menu',
        'fallback_cb' => false
    ));
} else {
    echo '<p>Veuillez configurer le menu mobile dans l’administration.</p>';
}
