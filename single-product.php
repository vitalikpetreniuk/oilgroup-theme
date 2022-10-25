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
                                АРТИКУЛ: <?php the_field( 'sku' ) ?>
                            </div>
						<?php endif; ?>
                        <div class="text-block">
                            <h6 class="small-title">
                                ХАРАКТЕРИСТИКИ:
                            </h6>
                            <p>
                                Lorem Ipsum/ Lorem Ipsum/ Lorem Ipsum/ Lorem Ipsum/ Lorem Ipsum/
                            </p>
                            <ul>
                                <li>
                                    - Тестовий текст
                                </li>
                                <li>
                                    - Тестовий текст
                                </li>
                                <li>
                                    - Тестовий текст
                                </li>
                                <li>
                                    - Тестовий текст
                                </li>
                            </ul>
                        </div>
                        <div class="text-block">
                            <h6 class="small-title">
                                ПЕРЕВАГИ:
                            </h6>
                            <p>
                                Lorem Ipsum/ Lorem Ipsum/ Lorem Ipsum/ Lorem Ipsum/ Lorem Ipsum/
                            </p>
                            <ul>
                                <li>
                                    - Тестовий текст
                                </li>
                                <li>
                                    - Тестовий текст
                                </li>
                                <li>
                                    - Тестовий текст
                                </li>
                                <li>
                                    - Тестовий текст
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
						<?php
						$widths = [ 4, 3, 2, 3 ];
						if ( have_rows( 'variation_naming' ) ):
							$i = 0;
							?>
							<?php while ( have_rows( 'variation_naming' ) ): the_row();
							$widths[] = get_sub_field( 'width' );
							?>
                            <div class="col-lg-<?= $widths[ $i ] ?>">
								<?= get_sub_field( 'name' ); ?>
                            </div>
							<?php
							$i ++;
						endwhile; ?>
							<?php
							$i = 0;
						endif; ?>

                    </div>
					<?php if ( have_rows( 'variations' ) ): ?>
						<?php while ( have_rows( 'variations' ) ): the_row(); ?>
                            <div class="row vars">
                                <div class="col-lg-4 name">
                                    PETRONAS Syntium 5000 XS 5W30 (50 л)
                                </div>
                                <div class="col-lg-3 price">

                                </div>
                                <div class="col-lg-2 accesbl">
                                    <a href="#">
                                        Зв’яжіться з нами
                                    </a>
                                </div>
                                <div class="col-lg-3">
                                    <a href="#">
                                        Тестове заповнення
                                    </a>
                                </div>
                            </div>
						<?php endwhile; ?>
					<?php endif; ?>
                </div>
            </div>
        </section>
        <section class="chars">
            <div class="container">
                <h2 class="title">
					<?php esc_html_e( 'Characteristics', 'oilgroup' ); ?>
                </h2>
                <div class="hars-inn row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6">
                                <div class="name">
                                    БРЕНД
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="desc">
                                    Приклад назви
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6">
                                <div class="name">
                                    БРЕНД
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="desc">
                                    Приклад назви
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<?php get_template_part( 'template-parts/content', 'phonescontact' ) ?>

    </main><!-- #main -->

<?php
get_footer();
