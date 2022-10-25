<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package test
 */

get_header();
?>

    <main>
		<?php
		$blocks = parse_blocks( get_the_content( null, false, apply_filters( 'wpml_object_id', 250, 'page' ) ) );
		foreach ( $blocks as $block ) {
			echo render_block( $block );
		}
		?>

    </main><!-- #main -->

<?php
get_footer();
