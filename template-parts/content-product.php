<div class="p-box col-lg-4 col-md-6 col-12">
    <div class="inn">
        <a class="a-img" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'full' ); ?>
        </a>
        <a href="<?php the_permalink(); ?>" class="title">
			<?php the_title(); ?>
        </a>
        <div class="sub">
			<?php esc_html_e( 'Usage', 'oilgroup' ); ?>
        </div>
		<?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>" class="bt-n">
			<?php esc_html_e( 'Go to product', 'oilgroup' ); ?>
        </a>
    </div>
</div>
<?php if ( $args['c'] === 6 ) : ?>
    <div class="col-lg-12 d-sm-none">
        <section class="consult">
            <img src="<?= get_template_directory_uri(); ?>/assets/images/dest/bg-cons.jpg" alt="" class="bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="title">
                            Потрібна консультація? Ми завжди на зв’язку!
                        </h2>
                        <a href="" class="btn arr">
                            Дізнатись більше
                        </a>
                    </div>
                    <div class="col-lg-6">
						<span>
							Ви можете телефонувати нам при виникненні будь-яких питань
						</span>
                        <a href="tel:380507010070" class="tel">
                            +38 (050) 70-100-70

                        </a>
                        <a href="tel:380987020070" class="tel">
                            +38 (098) 70-200-70
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php elseif ( $args['c'] === 12 ) : ?>
    <div class="col-lg-12 d-sm-none">
        <section class="consult w-btn">
            <img src="<?= get_template_directory_uri(); ?>/assets/images/dest/bg-cons.jpg" alt="" class="bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="title">
                            Шукаєте наш офіс у своєму місті?
                        </h2>
                        <a href="" class="btn arr">
                            Дізнатись більше
                        </a>
                    </div>

                </div>
            </div>
        </section>
    </div>
<?php endif; ?>
