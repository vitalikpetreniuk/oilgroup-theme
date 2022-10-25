<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package test
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header id="site-header" class="header">
    <div class="top-bar">
        <div class="container">
			<?php wp_nav_menu( array(
				'theme_location' => 'topbar',
				'container'      => false
			) ) ?>
        </div>
    </div>
    <div class="mid-bar">
        <div class="container">
            <div class="logo">
                <a href="<?= home_url(); ?>">
                    <img src="<?php the_field( 'logo', 'option' ) ?>" alt="">
                </a>
            </div>
            <div class="search-block">
                <form action="/" method="get">
                    <input name="s" placeholder="<?php esc_html_e( 'Search', 'oilgroup' ); ?>" type="text">
                    <div class="cld"></div>
                    <input value="" type="submit">
                </form>
            </div>
            <div class="right-block">
                <div class="lang">
					<?php echo do_shortcode( '[wpml_language_switcher]
<div class="{{ css_classes }} my-custom-switcher">
  
<ul>
   {% for code, language in languages %}
<li class="{{ language.css_classes }} my-custom-switcher-item">
           <a href="{{ language.url }}">
           <span>{{ language.native_name }}</span>
               {% if language.flag_url %}
                   <img src="{{ language.flag_url }}" alt="{{ language.code }}" title="{{ language.flag_title }}">
               {% endif %}
           </a>
</li>
  
   {% endfor %}
</ul>
  
</div>
[/wpml_language_switcher]' ) ?>
                </div>

                <button class="menu-btn"
                        onclick="this.classList.toggle('opened');this.setAttribute('aria-expanded', this.classList.contains('opened'))"
                        aria-label="Main Menu">
                    <svg width="100" height="100" viewBox="0 0 100 100">
                        <path class="line line1"
                              d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058"/>
                        <path class="line line2" d="M 20,50 H 80"/>
                        <path class="line line3"
                              d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <nav class="menu">
        <div class="container">
			<?php wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'main-menu',
					'container'      => false
				)
			) ?>
            <div class="lang-mob">
				<?php echo do_shortcode( '[wpml_language_switcher]
<div class="{{ css_classes }} my-custom-switcher">
  
<ul>
   {% for code, http://127.0.0.1:8000 in languages %}
  {% language %}
<li class="{{ language.css_classes }} my-custom-switcher-item">
           <a href="{{ language.url }}">
           <span>{{ language.native_name }}</span>
               {% if language.flag_url %}
                   <img src="{{ language.flag_url }}" alt="{{ language.code }}" title="{{ language.flag_title }}">
               {% endif %}
           </a>
</li>
  
   {% endfor %}
</ul>
  
</div>
[/wpml_language_switcher]' ) ?>
            </div>
        </div>
    </nav>
</header>
<main class="main">
