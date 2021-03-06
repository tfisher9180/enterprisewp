<?php
/**
 * EnterpriseWP functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package EnterpriseWP
 */

if ( ! function_exists( 'enterprisewp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function enterprisewp_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on EnterpriseWP, use a find and replace
		 * to change 'enterprisewp' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'enterprisewp', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary-navigation' => esc_html__( 'Primary Navigation', 'enterprisewp' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'enterprisewp_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'enterprisewp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function enterprisewp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'enterprisewp_content_width', 640 );
}
add_action( 'after_setup_theme', 'enterprisewp_content_width', 0 );

/**
 * Google fonts
 */
function enterprisewp_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Roboto or Poppins, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$font_families = array();

	$roboto = _x( 'on', 'Roboto font: on or off', 'enterprisewp' );
	$poppins = _x( 'on', 'Poppins font: on or off', 'enterprisewp' );

	if ( 'off' !== $roboto ) {
		$font_families[] = 'Roboto:400,700';
	}

	if ( 'off' !== $poppins ) {
		$font_families[] = 'Poppins:700';
	}

	if ( in_array( 'on', array( $roboto, $poppins ) ) ) {
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

function enterprisewp_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'enterprisewp-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'enterprisewp_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function enterprisewp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'enterprisewp' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'enterprisewp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'enterprisewp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function enterprisewp_scripts() {
	wp_enqueue_style( 'enterprisewp-fonts', enterprisewp_fonts_url(), array(), null );

	wp_enqueue_style( 'enterprisewp-style', get_stylesheet_uri() );

	wp_enqueue_script( 'enterprisewp-scripts', get_template_directory_uri() . '/js/theme.js', array( 'jquery' ), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'enterprisewp_scripts' );

/**
 * Check for custom logo.
 *
 * @return boolean
 */
function enterprisewp_logo() {
	return get_theme_mod( 'logo_img' ) ? true : false;
}

/**
 * Get custom logo url.
 *
 * @return string
 */
function enterprisewp_get_logo() {
	return wp_get_attachment_url( get_theme_mod( 'logo_img' ) );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
