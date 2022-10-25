<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package test
 */

?>
</main>
<footer class="footer">
    <div class="container">
        <div class="left-block">
            <div class="menu">
                <div class="title"><?php esc_html_e( 'Brands', 'oilgroup' ); ?></div>
				<?php wp_nav_menu( array(
					'theme_location' => 'footer1',
					'container'      => false
				) ); ?>
            </div>
            <div class="menu">
                <div class="title"><?php esc_html_e( 'Market segments', 'oilgroup' ); ?></div>
				<?php wp_nav_menu( array(
					'theme_location' => 'footer2',
					'container'      => false
				) ); ?>
            </div>
            <div class="menu">
                <div class="title"><?php esc_html_e( 'About us', 'oilgroup' ); ?></div>
				<?php wp_nav_menu( array(
					'theme_location' => 'footer3',
					'container'      => false
				) ); ?>
            </div>
        </div>
        <div class="right-block">
            <div class="logo">
                <a href="<?= home_url() ?>">
                    <img src="<?php the_field( 'footer_logo', 'option' ) ?>" alt="">
                </a>
            </div>
            <div class="phones">
						<span>
							<?php esc_html_e( 'Need a consultation', 'oilgroup' ); ?>?
						</span>
				<?php
				$tel1stripped = str_replace( [ ' ', '(', ')', '-' ], '', get_field( 'tel1', 'option' ) );
				$tel2stripped = str_replace( [ ' ', '(', ')', '-' ], '', get_field( 'tel2', 'option' ) );
				?>
                <a href="tel:<?= $tel1stripped ?>">
					<?php the_field( 'tel1', 'option' ) ?>
                </a>
                <a href="tel:<?= $tel2stripped ?>">
					<?php the_field( 'tel2', 'option' ) ?>
                </a>
            </div>
            <a href="#" class="btn arr">
				<?php esc_html_e( 'Contact us', 'oilgroup' ); ?>
            </a>
        </div>
    </div>
    <div class="btm-block">
				<span>
					Copyright © <?= date( 'Y' ) ?> OILGROUP
				</span>
		<?php wp_nav_menu( array(
			'theme_location' => 'topbar',
			'container'      => false
		) ) ?>
    </div>
</footer>
<div class="modal">
    <div class="bg">
    </div>
    <div class="modal-inn">
        <div>
            <div class="close"></div>
            <h2 class="title">
				<?php esc_html_e( 'Send a request', 'oilgroup' ); ?>
            </h2>
			<?php
			if ( get_locale() == 'uk' ) : ?>
				<?php echo do_shortcode( '[contact-form-7 id="646" title="Форма запиту"]' ); ?>
			<?php else: ?>
				<?php echo do_shortcode( '[contact-form-7 id="648" title="Request form"]' ); ?>
			<?php endif; ?>
        </div>

    </div>
</div>
<?php wp_footer(); ?>

</body>
</html>
