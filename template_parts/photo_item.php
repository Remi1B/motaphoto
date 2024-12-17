<?php
    // Récupérer les informations avec la fonction get_info
    $info = get_info('medium');
    $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    $categorie_value = $info['categorie']['value'] ?? '';
    $categorie_value_safe = esc_attr(explode(', ', $categorie_value)[0]);
    $reference_value = esc_attr($info['reference']['value'] ?? '');
?>
<article class="photo_block">
    <div class="photo_item"
         data-image-url="<?php echo esc_url($image_url); ?>" 
         data-categorie="<?php echo $categorie_value_safe; ?>" 
         data-reference="<?php echo $reference_value; ?>">
        <?php echo $info['image_html']; ?>
    </div>
    <div class="photo_survol">
        <div class="photo_overlay">
            <a class="photo_overlay-fullscreen" role="button" aria-label="Ouvrir en fullscreen">
                <i class="fa-solid fa-expand"></i>
            </a>
            <a class="photo_overlay-eye" href="<?php the_permalink();?>">
                <i class="fa-regular fa-eye fa-2xl"></i>
            </a>
            <div class="photo_overlay_infos">
                <div class="photo_overlay_infos-Ref" aria-label="référence de la photo : <?php the_title(); ?>">
                    <p><?= $reference_value ?></p>
                </div>
                <div class="photo_overlay_infos-Cat" aria-label="catégorie de la photo : <?php the_title(); ?>">
                    <p><?=  $categorie_value_safe ?></p>
                </div>
            </div> 
        </div>
    </div>
</article>
