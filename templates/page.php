<?php
/*
Template Name: page vide
*/ 
get_header(); ?>


<div class="content-area">
    <main>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1><?php the_title(); ?></h1>
            
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
        <?php endwhile; endif; ?>
    </main>
</div>

<?php get_footer(); ?>