<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package test
 */

get_header();
?>

    <main id="primary" class="site-main">

        <section class="inn-banner clean">
            <?= wp_get_attachment_image(get_field('background'), 'full'); ?>
        </section>
        <section class="article">
            <div class="container">
                <a href="<?php the_permalink(get_option( 'page_for_posts' )); ?>" class="back">
                    <?php esc_html_e('To articles list', 'oilgroup'); ?>
                </a>
                <h2 class="title">
                    <?php the_title(); ?>
                </h2>
                <div class="date">
                    <?php the_date('d.m.Y') ?>
                </div>
                <div class="article-inn">

                    <?php the_content(); ?>
                </div>
            </div>

        </section>

    </main><!-- #main -->

<?php
get_footer();
