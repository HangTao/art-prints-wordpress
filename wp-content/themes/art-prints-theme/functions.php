<?php
/**
 * Art Prints Theme
 *
 * @package Art_Prints_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define theme constants
 */
define( 'ART_PRINTS_THEME_VERSION', '1.0.0' );
define( 'ART_PRINTS_THEME_DIR', get_template_directory() );
define( 'ART_PRINTS_THEME_URI', get_template_directory_uri() );

/**
 * Setup theme support and features
 */
function art_prints_theme_setup() {
	// Add theme support
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Add custom logo support
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Register navigation menus
	register_nav_menus( array(
		'primary'   => esc_html__( 'Primary Menu', 'art-prints-theme' ),
		'footer'    => esc_html__( 'Footer Menu', 'art-prints-theme' ),
		'social'    => esc_html__( 'Social Links', 'art-prints-theme' ),
	) );

	// Add theme support for WooCommerce
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'art_prints_theme_setup' );

/**
 * Enqueue styles and scripts
 */
function art_prints_theme_enqueue_assets() {
	// Enqueue main stylesheet
	wp_enqueue_style(
		'art-prints-theme-style',
		ART_PRINTS_THEME_URI . '/css/style.css',
		array(),
		ART_PRINTS_THEME_VERSION
	);

	// Enqueue Bootstrap CSS
	wp_enqueue_style(
		'art-prints-theme-bootstrap',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
		array(),
		'5.3.0'
	);

	// Enqueue Font Awesome
	wp_enqueue_style(
		'art-prints-theme-fontawesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
		array(),
		'6.4.0'
	);

	// Enqueue main JavaScript
	wp_enqueue_script(
		'art-prints-theme-main',
		ART_PRINTS_THEME_URI . '/js/main.js',
		array( 'jquery' ),
		ART_PRINTS_THEME_VERSION,
		true
	);

	// Enqueue Bootstrap JS
	wp_enqueue_script(
		'art-prints-theme-bootstrap',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
		array(),
		'5.3.0',
		true
	);

	// Localize script for AJAX
	wp_localize_script( 'art-prints-theme-main', 'artPrintsTheme', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce'    => wp_create_nonce( 'art_prints_nonce' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'art_prints_theme_enqueue_assets' );

/**
 * Enqueue admin styles
 */
function art_prints_theme_enqueue_admin_assets() {
	wp_enqueue_style(
		'art-prints-theme-admin',
		ART_PRINTS_THEME_URI . '/css/admin.css',
		array(),
		ART_PRINTS_THEME_VERSION
	);
}
add_action( 'admin_enqueue_scripts', 'art_prints_theme_enqueue_admin_assets' );

/**
 * Set content width
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}

/**
 * Custom image sizes
 */
add_image_size( 'art-prints-gallery-thumb', 300, 300, true );
add_image_size( 'art-prints-gallery-full', 800, 600, true );
add_image_size( 'art-prints-featured', 1200, 400, true );

/**
 * Register widget areas
 */
function art_prints_theme_register_widgets() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'art-prints-theme' ),
		'id'            => 'primary-sidebar',
		'description'   => esc_html__( 'Main sidebar for pages and posts', 'art-prints-theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'art-prints-theme' ),
		'id'            => 'footer-widgets',
		'description'   => esc_html__( 'Widgets displayed in footer', 'art-prints-theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s col-md-3">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'art_prints_theme_register_widgets' );

/**
 * Custom excerpt length
 */
function art_prints_theme_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'art_prints_theme_excerpt_length' );

/**
 * Custom excerpt more text
 */
function art_prints_theme_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'art_prints_theme_excerpt_more' );

/**
 * Add theme body class
 */
function art_prints_theme_body_class( $classes ) {
	$classes[] = 'art-prints-theme';
	return $classes;
}
add_filter( 'body_class', 'art_prints_theme_body_class' );
