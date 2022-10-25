<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package test
 */

get_header();
the_post();
?>

    <main id="primary" class="site-main">

        <section class="prod-top">
            <div class="container">
                <div class="crumbs">
					<?php
					if ( function_exists( 'yoast_breadcrumb' ) ) {
						doublee_breadcrumbs();
					}
					?>
                </div>
            </div>
        </section>

        <section class="prod-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
						<?php the_post_thumbnail() ?>
                    </div>
                    <div class="col-lg-7">
                        <h1 class="title">
							<?php the_title(); ?>
                        </h1>
						<?php if ( get_field( 'sku' ) ) : ?>
                            <div class="sub">
                                <?php esc_html_e('SKU'); ?>: <?php the_field( 'sku' ) ?>
                            </div>
						<?php endif; ?>
                        <div class="text-block">
                          <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<?php if ( get_field( 'variations' ) ) : ?>
            <section class="variations">
                <div class="container">
                    <div class="title-block">
                        <h2 class="title revert">
							<?php esc_html_e( 'Variations', 'oilgroup' ); ?>
                        </h2>
                        <div class="no-access">
							<?php esc_html_e( 'This product is not available on the internet', 'oilgroup' ); ?>.
                            <a href="#"><?php esc_html_e( 'Connect with us', 'oilgroup' ); ?></a>
                        </div>
                    </div>
                    <div class="variations-inn">
                        <div class="row topper">
                            <div class="col-lg-4">
								<?php the_field( 'variations_column1_name' ) ?>
                            </div>
                            <div class="col-lg-3">
								<?php the_field( 'variations_column2_name' ) ?>
                            </div>
                            <div class="col-lg-2">
								<?php the_field( 'variations_column3_name' ) ?>
                            </div>
                            <div class="col-lg-3">
								<?php the_field( 'variations_column4_name' ) ?>
                            </div>
                        </div>

						<?php if ( have_rows( 'variations' ) ): ?>
							<?php while ( have_rows( 'variations' ) ): the_row(); ?>
                                <div class="row vars">
                                    <div class="col-lg-4 name">
										<?= get_sub_field( 'variations_column1_value' ) ?>
                                    </div>
                                    <div class="col-lg-3 price">
										<?= get_sub_field( 'variations_column2_value' ) ?>
                                    </div>
                                    <div class="col-lg-2 accesbl">
										<?php if ( get_sub_field( 'column3' )['variations_column3_link'] ) : ?>
                                            <a href="<?= get_sub_field( 'column3' )['variations_column3_link'] ?>">
												<?= get_sub_field( 'column3' )['variations_column3_value'] ?>
                                            </a>
										<?php elseif ( get_sub_field( 'column3' )['variations_column3_value'] ) : ?>
											<?= get_sub_field( 'column3' )['variations_column3_value'] ?>
										<?php endif; ?>
                                    </div>
                                    <div class="col-lg-3">
										<?php if ( get_sub_field( 'column4' )['variations_column4_link'] ) : ?>
                                            <a href="<?= get_sub_field( 'column4' )['variations_column4_link'] ?>">
												<?= get_sub_field( 'column4' )['variations_column4_value'] ?>
                                            </a>
										<?php elseif ( get_sub_field( 'column4' )['variations_column4_value'] ) : ?>
											<?= get_sub_field( 'column4' )['variations_column4_value'] ?>
										<?php endif; ?>
                                    </div>
                                </div>
							<?php endwhile; ?>
						<?php endif; ?>
                    </div>
                </div>
            </section>
		<?php endif; ?>
		<?php if ( get_field( 'characteristics' ) ) : ?>
            <section class="chars">
                <div class="container">
                    <h2 class="title">
						<?php esc_html_e( 'Characteristics', 'oilgroup' ); ?>
                    </h2>
					<?php
					$characteristics = get_field( 'characteristics' );
					$middle          = (int) ceil( count( $characteristics ) / 2 ) + 1;
					?>
                    <div class="hars-inn row">
						<?php

						// Check rows exists.
						if ( have_rows( 'characteristics' ) ):
						$i = 0;
						// Loop through rows.
						while ( have_rows( 'characteristics' ) ) :
						the_row();
						$i ++;
						if ( $i === 1 || $i === $middle ) {
						if ( $i === $middle ) {
							echo '</div>';
						}
						?>
                        <div class="col-lg-6">

							<?php } ?>

                            <div class="row">
                                <div class="col-6">
                                    <div class="name">
                                        <?= get_sub_field('parameter') ?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="desc">
	                                    <?= get_sub_field('value') ?>
                                    </div>
                                </div>
                            </div>

                            <?php

							endwhile;
							endif; ?>
                        </div>
                    </div>
            </section>
		<?php endif; ?>
		<?php get_template_part( 'template-parts/content', 'phonescontact' ) ?>

    </main><!-- #main -->

<?php
get_footer();
