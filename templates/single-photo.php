<?php get_header(); ?>

<main id="main-content">
    <?php
    if (have_posts()) :
         the_post();
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="post_infos">
            <div class="post_description">
                <h2><?php the_title(); ?></h2>
                <div class="post_content">
                    <?php the_content(); ?>
                </div>
                
                <!-- Afficher les champs personnalisés SCF -->
                <div class="post_custom-fields">
                    <?php
                    $reference_field = get_field_object('reference');
                    $reference_label = isset($reference_field['label']) ? $reference_field['label'] : 'Référence';
                    $reference_value = get_post_meta(get_the_ID(), 'reference', true);
                    if ($reference_value) {
                        echo '<p>' . mb_strtoupper($reference_label . ': ' . $reference_value, 'UTF-8') . '</p>';
                    }

                    $categorie_terms = get_the_terms(get_the_ID(), 'categorie');
                    if ($categorie_terms && !is_wp_error($categorie_terms)) {
                        $categorie_names = wp_list_pluck($categorie_terms, 'name');
                        $categorie_value = implode(', ', $categorie_names); // Si plusieurs termes sont associés
                        $categorie_label = get_taxonomy('categorie')->labels->singular_name;
                        echo '<p>' . mb_strtoupper($categorie_label . ': ' . $categorie_value, 'UTF-8') . '</p>';
                    }

                    $format_terms = get_the_terms(get_the_ID(), 'format');
                    if ($format_terms && !is_wp_error($format_terms)) {
                        $format_names = wp_list_pluck($format_terms, 'name');
                        $format_value = implode(', ', $format_names);
                        $format_label = get_taxonomy('format')->labels->singular_name;
                        echo '<p>' . mb_strtoupper($format_label . ': ' . $format_value, 'UTF-8') . '</p>';
                    }

                    $type_field = get_field_object('type');
                    $type_label = isset($type_field['label']) ? $type_field['label'] : 'Type';
                    $type_value = get_post_meta(get_the_ID(), 'type', true);
                    if ($type_value) {
                        echo '<p>' . mb_strtoupper($type_label . ': ' . $type_value, 'UTF-8') . '</p>';
                    }

                    $annee_terms = get_the_terms(get_the_ID(), 'annee');
                    if ($annee_terms && !is_wp_error($annee_terms)) {
                        $annee_names = wp_list_pluck($annee_terms, 'name');
                        $annee_value = implode(', ', $annee_names);
                        $annee_label = get_taxonomy('annee')->labels->singular_name;
                        echo '<p>' . mb_strtoupper($annee_label . ': ' . $annee_value, 'UTF-8') . '</p>';
                    }
                    ?>
                </div>
            </div>

            <?php if (has_post_thumbnail()) : ?>
            <div class="post_featured-image">
                <?php the_post_thumbnail('large');?>
            </div>
        </div>
        <div class="interactions">
            <div class="interactions_contact">
                <p>Cette photo vous intéresse ?</p>
                <a href="http://motaphoto.local/contact/">Contact</a>
            </div>
            <div class="interactions_photos">
                
            </div>
        </div>
        <?php endif; ?>
    </article>
            <?php
    else :
        echo '<p>Aucun contenu trouvé pour cet article.</p>';
    endif;
    ?>
</main>

<?php get_footer(); ?>
