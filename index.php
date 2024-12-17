<?php
/*
Template Name: home
*/ 
get_header(); ?>
<div class="content-area">
        <?php get_template_part('template_parts/hero_header'); ?>
    <main class="index">
        <section class="photo">
            <?php get_template_part('template_parts/photo_filters'); ?>
            <!-- Galerie des photos -->
            <div class="photo_gallery">
                <!-- Les photos seront chargées ici via AJAX -->
            </div>
            <!-- Bouton pour charger plus de photos -->
            <button class="photo_load-more" data-page="1">Charger plus</button>
        </section>
    </main>
</div>

<?php get_footer(); ?>