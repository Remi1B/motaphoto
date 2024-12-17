<div class="hero_header">
    <?php
    // Vérifier si la page a une image mise en avant
    if (has_post_thumbnail()) {
        // Afficher l'image mise en avant
        the_post_thumbnail('full', array('class' => 'hero_header-img'));
    } else {
        // Requête photo format paysage aléatoire
        $args_banner = array(
            'post_type' => 'photo', 
            'posts_per_page' => 1,
            'orderby' => 'rand',
            'tax_query' => array(
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => 'paysage',
                ),
            ),
        );
        
        $banner = new WP_Query($args_banner);
        
        if ($banner->have_posts()) {
            while ($banner->have_posts()) {
                $banner->the_post();
                the_post_thumbnail('full', array('class' => 'hero_header-img'));
            }
            wp_reset_postdata();
        } 
    }
    
        // Récupérer le contenu principal de la page
    $content = apply_filters('the_content', get_the_content());

    // Extraire le premier <h1> trouvé dans le contenu
    preg_match('/<h1[^>]*>(.*?)<\/h1>/is', $content, $matches);

    // Afficher le <h1> trouvé ou un texte par défaut si aucun <h1> n'est présent
    if (!empty($matches[1])) {
        echo '<h1 class="hero_header-title">' . $matches[1] . '</h1>';
    } else {
        echo '<h1 class="hero_header-title">PHOTOGRAPHE EVENT</h1>';
    }
    ?>
</div>