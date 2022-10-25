<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package test
 */

get_header();
?>

<?php if ( have_posts() ) : ?>

    <div class="container">

    <div class="row prod-boxes">

		<?php
		/* Start the Loop */
		while ( have_posts() ) :
			the_post(); ?>

            <div class="p-box col-lg-4 col-md-6 col-12">
                <div class="inn">
                    <a class="a-img" href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail(); ?>
                    </a>
                    <a href="<?php the_permalink(); ?>" class="title">
						<?php the_title(); ?>
                    </a>
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>" class="bt-n">
                        До товару
                    </a>
                </div>
            </div>

		<?php

		endwhile; ?>

        <div class="col-12">
			<?php the_posts_pagination(); ?>
        </div>
    </div>

<?php
else :

	get_template_part( 'template-parts/content', 'none' );

endif;
?>
    </div>
<?php
get_footer();
