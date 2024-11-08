<!-- Exemple de structure single.php -->
<?php get_header(); ?>

<div class="content-area">
    <main>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1>
                
                <div class="post-meta">
                    <span><?php echo get_the_date(); ?></span> | 
                    <span><?php the_author(); ?></span>
                </div>
                
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                
                <?php if ( comments_open() || get_comments_number() ) : ?>
                    <?php comments_template(); ?>
                <?php endif; ?>
            </article>
        <?php endwhile; endif; ?>
    </main>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>