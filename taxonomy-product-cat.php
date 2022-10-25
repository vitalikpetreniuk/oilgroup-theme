<?php
get_header();
global $wp_query;
?>

    <main>

        <section class="inn-banner">
			<?= wp_get_attachment_image( get_field( 'background', get_queried_object() ), 'full' ) ?>
            <div class="container">
                <div class="blue-block <?= hexCodeToClass( get_field( 'card_color', get_queried_object() ) ) ?>">
                    <div class="crumbs">
						<?php
						if ( function_exists( 'yoast_breadcrumb' ) ) {
							doublee_breadcrumbs();
						}
						?>
                    </div>
                    <h1 class="title">
						<?= get_queried_object()->name ?>
                    </h1>
                </div>
                <p class="collapse"><?php get_queried_object()->description ?></p>
            </div>
        </section>

        <section class="prod-catalog" data-id="<?= get_queried_object_id(); ?>">
            <div class="prod-catalog-vars" style="display:none;"><?= serialize($wp_query->query_vars) ?></div>
            <div class="container">
                <div class="row prod-catalog-row">
                    <?php get_template_part('template-parts/content', 'filter') ?>
                    <div class="col-lg-9">
                        <div class="row prod-boxes">
							<?php
                            if ( have_posts() ) {
								$c = 0;
								while ( have_posts() ) {
									the_post();
									?>
									<?php get_template_part( 'template-parts/content', 'product' ); ?>
									<?php
								}
							}
							?>
                            <div class="col-12">
								<?php the_posts_pagination(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="loader-wrapper hidden">
                <span class="loader"></span>
            </div>
        </section>

		<?php get_template_part( 'template-parts/content', 'phonescontact' ) ?>

    </main><!-- #main -->

<?php
get_footer();
