<?php
/**
 * oilgroup functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package oilgroup
 */

use Yoast\WP\SEO\Repositories\Indexable_Repository;

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

// Translations domain
load_theme_textdomain( 'oilgroup', get_template_directory() . '/languages' );

// Add automatic rss support
add_theme_support( 'automatic-feed-links' );

// Let WordPress manage the document title
add_theme_support( 'title-tag' );

// Enable support for Post Thumbnails on posts and pages
add_theme_support( 'post-thumbnails' );

add_theme_support( 'yoast-seo-breadcrumbs' );

// This theme uses wp_nav_menu() in one location.
register_nav_menus(
	array(
		'topbar'  => esc_html__( 'Верхнє меню', 'oilgroup' ),
		'primary' => esc_html__( 'Головне меню', 'oilgroup' ),
		'footer1' => esc_html__( 'Меню в футері 1', 'oilgroup' ),
		'footer2' => esc_html__( 'Меню в футері 2', 'oilgroup' ),
		'footer3' => esc_html__( 'Меню в футері 3', 'oilgroup' ),
	)
);

// Switch default core markup to output valid HTML5.
add_theme_support(
	'html5',
	array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	)
);

// Add theme support for selective refresh for widgets.
add_theme_support( 'customize-selective-refresh-widgets' );

// Register widget area
function oilgroup_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'oilgroup' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'oilgroup' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'oilgroup_widgets_init' );

// Enqueue scripts and styles
function oilgroup_scripts() {
	wp_enqueue_style( 'oilgroup-swiper', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css', array() );
	wp_enqueue_style( 'oilgroup-front-css', get_template_directory_uri() . '/assets/css/app.min.css', array() );
	wp_enqueue_style( 'oilgroup-lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.css', array() );
	wp_enqueue_style( 'oilgroup-style', get_stylesheet_uri(), array() );


	wp_enqueue_script( 'oilgroup-swiper', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', array() );
	wp_enqueue_script( 'oilgroup-front-js', get_template_directory_uri() . '/assets/js/app.min.js', array(
		'oilgroup-swiper',
		'jquery'
	), time() );
	wp_enqueue_script( 'oilgroup-backend', get_template_directory_uri() . '/assets/js/backend.js', array(
		'jquery'
	), time() );
}

add_action( 'wp_enqueue_scripts', 'oilgroup_scripts' );

// Load WooCommerce compatibility file
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// disable gutenberg frontend styles
function disable_gutenberg_wp_enqueue_scripts() {

	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' ); // disable woocommerce frontend block styles

}

add_filter( 'wp_enqueue_scripts', 'disable_gutenberg_wp_enqueue_scripts', 100 );

// Disable the emoji's
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

add_action( 'init', 'disable_emojis' );

function my_deregister_scripts() {
	wp_deregister_script( 'wp-embed' );
}

add_action( 'wp_footer', 'my_deregister_scripts' );

// Filter out the tinymce emoji plugin
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

add_action( 'init', 'my_custom_init' );
function my_custom_init() {
	register_post_type( 'brands', array(
		'labels'             => array(
			'name'          => 'Бренди', // Основное название типа записи
			'singular_name' => 'Бренд', // отдельное название записи типа Book
			'add_new'       => 'Додати новий',
			'edit_item'     => 'Редагувати бренд',
			'new_item'      => 'Новий бренд',
			'menu_name'     => 'Бренди'

		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	) );

	register_post_type( 'services', array(
		'labels'             => array(
			'name'          => 'Сервіси', // Основное название типа записи
			'singular_name' => 'Сервіс', // отдельное название записи типа Book
			'add_new'       => 'Додати новий',
			'edit_item'     => 'Редагувати сервіс',
			'new_item'      => 'Новий сервіс',
			'menu_name'     => 'Сервіси'

		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array(
			'slug' => 'service',
		),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	) );

	register_post_type( 'market-segments', array(
		'labels'             => array(
			'name'          => 'Сегменти ринку', // Основное название типа записи
			'singular_name' => 'Сегмент ринку', // отдельное название записи типа Book
			'add_new'       => 'Додати новий',
			'edit_item'     => 'Редагувати сегмент',
			'new_item'      => 'Новий сегмент',
			'menu_name'     => 'Сегменти ринку'

		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon'          => 'dashicons-hammer',
		'rewrite'            => true,
		'capability_type'    => 'post',
		'show_in_rest'       => true,
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	) );

	add_action( 'init', 'register_faq_post_type' );

	// Раздел вопроса - faqcat
	register_taxonomy( 'product-cat', [ 'products' ], [
		'label'             => 'Продукти',
		// определяется параметром $labels->name
		'labels'            => array(
			'name'          => 'Категорії продуктів',
			'singular_name' => 'Категорії продуктів',
			'all_items'     => 'Всі категорії продуктів',
			'menu_name'     => 'Категорії продуктів',
		),
		'public'            => true,
		'show_in_nav_menus' => true,
		// равен аргументу public
		'show_ui'           => true,
		// равен аргументу public
		'show_tagcloud'     => false,
		// равен аргументу show_ui
		'hierarchical'      => true,
		'show_admin_column' => true,
		// Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
	] );
	// Раздел вопроса - faqcat
	register_taxonomy( 'brand-cat', [ 'products' ], [
		'label'             => __( 'Brands', 'oilgroup' ),
		// определяется параметром $labels->name
		'labels'            => array(
			'name'          => __( 'Brands', 'oilgroup' ),
			'singular_name' => __( 'Brand', 'oilgroup' ),
			'all_items'     => __( 'All brands', 'oilgroup' ),
			'menu_name'     => __( 'Brands', 'oilgroup' ),
		),
		'public'            => true,
		'show_in_nav_menus' => true,
		// равен аргументу public
		'show_ui'           => true,
		// равен аргументу public
		'show_tagcloud'     => false,
		// равен аргументу show_ui
		'hierarchical'      => true,
		'show_admin_column' => true,
		// Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
	] );

	register_taxonomy( 'specifications', [ 'products' ], [
		'label'             => __( 'Specifications', 'oilgroup' ),
		// определяется параметром $labels->name
		'labels'            => array(
			'name'          => __( 'Specifications', 'oilgroup' ),
			'singular_name' => __( 'Specification', 'oilgroup' ),
			'all_items'     => __( 'All Specifications', 'oilgroup' ),
			'menu_name'     => __( 'Specifications', 'oilgroup' ),
		),
		'public'            => true,
		'show_in_nav_menus' => true,
		// равен аргументу public
		'show_ui'           => true,
		// равен аргументу public
		'show_tagcloud'     => false,
		// равен аргументу show_ui
		'hierarchical'      => true,
		'show_admin_column' => true,
		// Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
	] );

	register_taxonomy( 'viscosity', [ 'products' ], [
		'label'             => __( 'Viscosity', 'oilgroup' ),
		// определяется параметром $labels->name
		'labels'            => array(
			'name'          => __( 'Viscosity', 'oilgroup' ),
			'singular_name' => __( 'Viscosity', 'oilgroup' ),
			'all_items'     => __( 'Viscosities', 'oilgroup' ),
			'menu_name'     => __( 'Viscosity', 'oilgroup' ),
		),
		'public'            => true,
		'show_in_nav_menus' => true,
		// равен аргументу public
		'show_ui'           => true,
		// равен аргументу public
		'show_tagcloud'     => false,
		// равен аргументу show_ui
		'hierarchical'      => true,
		'show_admin_column' => true,
		// Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
	] );

	register_taxonomy( 'consistency', [ 'products' ], [
		'label'             => __( 'Consistency', 'oilgroup' ),
		// определяется параметром $labels->name
		'labels'            => array(
			'name'          => __( 'Consistency', 'oilgroup' ),
			'singular_name' => __( 'Consistency', 'oilgroup' ),
			'all_items'     => __( 'Consistencies', 'oilgroup' ),
			'menu_name'     => __( 'Consistencies', 'oilgroup' ),
		),
		'public'            => true,
		'show_in_nav_menus' => true,
		// равен аргументу public
		'show_ui'           => true,
		// равен аргументу public
		'show_tagcloud'     => false,
		// равен аргументу show_ui
		'hierarchical'      => true,
		'show_admin_column' => true,
		// Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
	] );

	register_taxonomy( 'api', [ 'products' ], [
		'label'             => __( 'API', 'oilgroup' ),
		// определяется параметром $labels->name
		'labels'            => array(
			'name'          => __( 'API', 'oilgroup' ),
			'singular_name' => __( 'API', 'oilgroup' ),
			'all_items'     => __( 'All API', 'oilgroup' ),
			'menu_name'     => __( 'API', 'oilgroup' ),
		),
		'public'            => true,
		'show_in_nav_menus' => true,
		// равен аргументу public
		'show_ui'           => true,
		// равен аргументу public
		'show_tagcloud'     => false,
		// равен аргументу show_ui
		'hierarchical'      => true,
		'show_admin_column' => true,
		// Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
	] );

	register_taxonomy( 'acea', [ 'products' ], [
		'label'             => 'ACEA',
		// определяется параметром $labels->name
		'labels'            => array(
			'name'          => 'ACEA',
			'singular_name' => 'ACEA',
			'all_items'     => __( 'All ACEA', 'oilgroup' ),
			'menu_name'     => 'ACEA',
		),
		'public'            => true,
		'show_in_nav_menus' => true,
		// равен аргументу public
		'show_ui'           => true,
		// равен аргументу public
		'show_tagcloud'     => false,
		// равен аргументу show_ui
		'hierarchical'      => true,
		'show_admin_column' => true,
		// Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
	] );

	register_post_type( 'products', [
		'label'               => 'Вопросы',
		'labels'              => array(
			'name'          => 'Каталог продуктів',
			'singular_name' => 'Продукт',
			'all_items'     => 'Всі продукти',
			'menu_name'     => 'Продукти',
		),
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => false,
		'rest_base'           => '',
		'show_in_menu'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'menu_icon'           => 'dashicons-cart',
		'hierarchical'        => false,
		'has_archive'         => 'product-cataloque',
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'taxonomies'          => array( 'product-cat', 'brand-cat' ),
	] );
}

if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page();

}

function doublee_filter_yoast_breadcrumb_items( $link_output, $link ) {

	$new_link_output = '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
	$new_link_output .= '<a href="' . $link['url'] . '" itemprop="url">' . $link['text'] . '</a>';
	$new_link_output .= '</li>';

	return $new_link_output;
}

add_filter( 'wpseo_breadcrumb_single_link', 'doublee_filter_yoast_breadcrumb_items', 10, 2 );

/**
 * Filter the output of Yoast breadcrumbs to remove <span> tags added by the plugin
 *
 * @param $output
 *
 * @return mixed
 */
function doublee_filter_yoast_breadcrumb_output( $output ) {

	$from   = '<span>';
	$to     = '</span>';
	$output = str_replace( $from, $to, $output );

	return $output;
}

add_filter( 'wpseo_breadcrumb_output', 'doublee_filter_yoast_breadcrumb_output' );


/**
 * Shortcut function to output Yoast breadcrumbs
 * wrapped in the appropriate markup
 */
function doublee_breadcrumbs() {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<ul>', '</ul>' );
	}
}

/**
 * Conditionally Override Yoast SEO Breadcrumb Trail
 * http://plugins.svn.wordpress.org/wordpress-seo/trunk/frontend/class-breadcrumbs.php
 * -----------------------------------------------------------------------------------
 */

add_filter( 'wpseo_breadcrumb_links', 'wpse_100012_override_yoast_breadcrumb_trail' );

function wpse_100012_override_yoast_breadcrumb_trail( $links ) {
	global $post;
	if ( is_singular( 'brands' ) ) {
		$brands_page  = apply_filters( 'wpml_object_id', 44, 'page' );
		$breadcrumb[] = array(
			'url'  => get_the_permalink( $brands_page ),
			'text' => get_the_title( $brands_page ),
		);

		array_splice( $links, 1, - 2, $breadcrumb );
	}

	if ( is_singular( 'services' ) ) {
		$services_page = apply_filters( 'wpml_object_id', 99, 'page' );
		$breadcrumb[]  = array(
			'url'  => get_the_permalink( $services_page ),
			'text' => get_the_title( $services_page ),
		);

		array_splice( $links, 1, - 2, $breadcrumb );
	}

	if ( is_singular( 'products' ) ) {
		$services_page = apply_filters( 'wpml_object_id', 39, 'page' );
		$breadcrumb[]  = array(
			'url'  => get_the_permalink( $services_page ),
			'text' => get_the_title( $services_page ),
		);

		array_splice( $links, 1, - 2, $breadcrumb );
	}

	if ( is_tax( 'product-cat' ) ) {
		$services_page = apply_filters( 'wpml_object_id', 39, 'page' );
		$breadcrumb[]  = array(
			'url'  => get_the_permalink( $services_page ),
			'text' => get_the_title( $services_page ),
		);

		array_splice( $links, 1, - 2, $breadcrumb );
	}

	return $links;
}

function hexCodeToClass( $code ) {
	switch ( $code ) {
		case '#003887' :
			return 'blue';
		case '#4095cf' :
			return 'l-blue';
		case '#f07d00' :
			return 'orange';
		case '#14b0a9' :
			return 'turq';
		case '#e93f33' :
			return 'lred';
		case '#c32230' :
			return 'red';
	}

	return false;
}

function bootstrap_pagination( \WP_Query $wp_query = null, $echo = true, $params = [] ) {
	if ( null === $wp_query ) {
		global $wp_query;
	}

	$add_args = [];

	//add query (GET) parameters to generated page URLs
	/*if (isset($_GET[ 'sort' ])) {
		$add_args[ 'sort' ] = (string)$_GET[ 'sort' ];
	}*/

	$pages = paginate_links( array_merge( [
			'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			'format'       => '?paged=%#%',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'type'         => 'array',
			'show_all'     => false,
			'end_size'     => 3,
			'mid_size'     => 1,
			'prev_next'    => true,
			'prev_text'    => '',
			'next_text'    => '',
			'add_args'     => $add_args,
			'add_fragment' => ''
		], $params )
	);

	if ( is_array( $pages ) ) {
		//$current_page = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
		$pagination = '<ul class="pagination">';

		foreach ( $pages as $page ) {
			$pagination .= '<li class="page-item' . ( strpos( $page, 'current' ) !== false ? ' active' : '' ) . '"> ' . str_replace( 'page-numbers', 'page-link', $page ) . '</li>';
		}

		$pagination .= '</ul>';

		if ( $echo ) {
			echo $pagination;
		} else {
			return $pagination;
		}
	}

	return null;
}

add_filter( 'pre_get_posts', function ( $query ) {
	if ( $query->is_main_query() && $query->is_search ) {
		$query->set( 'post_type', 'products' );
	}
} );


require_once 'inc/filter.php';
