<?php get_header(); ?>

<main id="main-content">
    <?php
    if (have_posts()) :
         the_post();
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('post_article'); ?>>
        <div class="post_infos">
            <div class="post_description">
                <h2><?php the_title(); ?></h2>

                <!-- Afficher les champs personnalisés SCF -->
                <div class="post_custom-fields">
                    <?php
                        $info = get_info('full');

                        // Parcourir et afficher chaque élément
                        foreach ($info as $key => $data) {
                            if (!empty($data['value'])) {
                                echo "<p>{$data['label']} : {$data['value']}</p>";
                            }
                        }
                    ?>
                </div>
            </div>

            <?php if (!empty($info['image_html'])) : ?>
                <div class="post_featured-image">
                    <?php echo $info['image_html']; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="interactions">
            <div class="interactions_contact">
                <p>Cette photo vous intéresse ?</p>
                <a class="modale-button interactions_contact-button" href="#">Contact</a>
            </div>
            <div class="interactions_photos">
                <?php 
                $adjacent_posts = get_adjacent_posts_with_loop(get_the_ID());

                // Article précédent
                if ($adjacent_posts['previous']) :
                    $prev_post = $adjacent_posts['previous'];
                    $prev_post_thumbnail = get_the_post_thumbnail($prev_post->ID, 'thumbnail');
                    $prev_post_link = get_permalink($prev_post->ID);
                ?>
                    <div class="interactions_photos-previous">
                        <a href="<?php echo esc_url($prev_post_link); ?>">
                            <i class="fa-solid fa-arrow-left-long arrow_left"></i>
                        </a>
                        <div class="interactions_photos-left">
                            <?php echo $prev_post_thumbnail; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php 
                // Article suivant
                if ($adjacent_posts['next']) :
                    $next_post = $adjacent_posts['next'];
                    $next_post_thumbnail = get_the_post_thumbnail($next_post->ID, 'thumbnail');
                    $next_post_link = get_permalink($next_post->ID);
                ?>
                    <div class="interactions_photos-next">
                        <a href="<?php echo esc_url($next_post_link); ?>">
                        <i class="fa-solid fa-arrow-right-long arrow_right"></i>
                        </a>
                        <div class="interactions_photos-right">
                            <?php echo $next_post_thumbnail; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <section class="post_related">
            <?php
                // Récupérer les informations du post actuel
                $current_post_id = get_the_ID();
                $current_categories = wp_get_post_terms($current_post_id, 'categorie', ['fields' => 'ids']);

                if (!empty($current_categories)) {
                    // Requête pour deux photos aléatoires dans les mêmes catégories, excluant le post actuel
                    $related_photos_query = new WP_Query([
                        'post_type' => 'photo',
                        'posts_per_page' => 2,
                        'orderby' => 'rand',
                        'post__not_in' => [$current_post_id],
                        'tax_query' => [
                            [
                                'taxonomy' => 'categorie',
                                'field'    => 'term_id',
                                'terms'    => $current_categories,
                            ],
                        ],
                    ]);

                    if ($related_photos_query->have_posts()) : ?>
                        <h3>Vous aimerez aussi</h3>
                        <div class="photo_gallery">
                            <?php
                            while ($related_photos_query->have_posts()) :
                                $related_photos_query->the_post();
                                get_template_part('template_parts/photo_item');
                            endwhile;
                            ?>
                        </div>
                        <?php wp_reset_postdata(); ?>
                    <?php endif;
                }
            ?>
        </section>
    </article>
            <?php
    else :
        echo '<p>Aucun contenu trouvé pour cet article.</p>';
    endif;
    ?>
</main>

<?php get_footer(); ?>
