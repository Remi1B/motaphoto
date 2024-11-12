<?php get_header(); ?>

<main id="main-content">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
    ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <!-- Afficher le titre de l'article -->
                <h1><?php the_title(); ?></h1>
                
                <!-- Afficher l'image mise en avant si elle existe -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="featured-image">
                        <?php the_post_thumbnail('large'); // Taille de l'image ?>
                    </div>
                <?php endif; ?>
                
                <!-- Afficher le contenu de l'article -->
                <div class="content">
                    <?php the_content(); ?>
                </div>
                
                <!-- Afficher les champs personnalisés SCF -->
                <div class="custom-fields">
                    
                    <!-- Référence (Texte) -->
                    <div class="custom-field">
                        <?php
                        $reference_field = get_field_object('reference'); // Récupère les infos du champ personnalisé
                        $reference_label = isset($reference_field['label']) ? $reference_field['label'] : 'Référence'; // Récupère le label du champ
                        $reference_value = get_post_meta(get_the_ID(), 'reference', true);
                        if ($reference_value) {
                            echo '<p>' . mb_strtoupper($reference_label . ': ' . $reference_value, 'UTF-8') . '</p>';
                        }
                        ?>
                    </div>

                    <!-- Catégorie (Taxonomie) -->
                    <div class="custom-field">
                        <?php
                        $categorie_terms = get_the_terms(get_the_ID(), 'categorie'); // 'categorie' est la taxonomie
                        if ($categorie_terms && !is_wp_error($categorie_terms)) {
                            $categorie_names = wp_list_pluck($categorie_terms, 'name');
                            $categorie_value = implode(', ', $categorie_names); // Si plusieurs termes sont associés
                            $categorie_label = get_taxonomy('categorie')->labels->singular_name; // Récupère le label de la taxonomie
                            echo '<p>' . mb_strtoupper($categorie_label . ': ' . $categorie_value, 'UTF-8') . '</p>';
                        }
                        ?>
                    </div>

                    <!-- Format (Taxonomie) -->
                    <div class="custom-field">
                        <?php
                        $format_terms = get_the_terms(get_the_ID(), 'format'); // 'format' est la taxonomie
                        if ($format_terms && !is_wp_error($format_terms)) {
                            $format_names = wp_list_pluck($format_terms, 'name');
                            $format_value = implode(', ', $format_names); // Si plusieurs termes sont associés
                            $format_label = get_taxonomy('format')->labels->singular_name; // Récupère le label de la taxonomie
                            echo '<p>' . mb_strtoupper($format_label . ': ' . $format_value, 'UTF-8') . '</p>';
                        }
                        ?>
                    </div>

                    <!-- Type -->
                    <div class="custom-field">
                        <?php
                        $type_field = get_field_object('type');
                        $type_label = isset($type_field['label']) ? $type_field['label'] : 'Type'; // Récupère le label
                        $type_value = get_post_meta(get_the_ID(), 'type', true);
                        if ($type_value) {
                            echo '<p>' . mb_strtoupper($type_label . ': ' . $type_value, 'UTF-8') . '</p>';
                        }
                        ?>
                    </div>

                    <!-- Année  -->
                    <div class="custom-field">
                        <?php
                        $annee_terms = get_the_terms(get_the_ID(), 'annee');
                        if ($annee_terms && !is_wp_error($annee_terms)) {
                            $annee_names = wp_list_pluck($annee_terms, 'name');
                            $annee_value = implode(', ', $annee_names); // Si plusieurs termes sont associés
                            $annee_label = get_taxonomy('annee')->labels->singular_name; // Récupère le label de la taxonomie
                            echo '<p>' . mb_strtoupper($annee_label . ': ' . $annee_value, 'UTF-8') . '</p>';
                        }
                        ?>
                    </div>

                </div>
            </article>
    <?php
        endwhile;
    else :
        echo '<p>Aucun contenu trouvé pour cet article.</p>';
    endif;
    ?>
</main>

<?php get_footer(); ?>
