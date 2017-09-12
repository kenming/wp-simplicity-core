<?php
/**
 * Simplicity Core functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Simplicity Core
 */

if ( ! function_exists( 'simplicity_core_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function simplicity_core_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Simplicity Core, use a find and replace
		 * to change 'simplicity-core' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'simplicity-core', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'simplicity-core' ),
		) );

		// Add editor CSS to style the Wordpress visual post / post editor. Ours mainly
		// pulls in all of our fron-end CSS.
		add_editor_style( 'assets/css/editor-style.css');


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
		add_theme_support( 'custom-background', apply_filters( 'simplicity_core_custom_background_args', array(
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
add_action( 'after_setup_theme', 'simplicity_core_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function simplicity_core_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'simplicity_core_content_width', 1140 );
}
add_action( 'after_setup_theme', 'simplicity_core_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function simplicity_core_scripts() {
	wp_enqueue_style( 'simplicity-core-style', get_stylesheet_uri() );

    // load bootstrap css
    wp_enqueue_style( 'simplicity-core-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap/bootstrap.min.css' );	

    // load font awesome css
	wp_enqueue_style( 'simplicity-core-fontawesome', get_template_directory_uri() . '/assets/css/font-awesome/font-awesome.min.css' , array(), '4.7.0', 'all' );
	
    // load bootstrap.js
    wp_enqueue_script('simplicity-core-bootstrapjs', get_template_directory_uri().'/assets/js/bootstrap/bootstrap.min.js', array('jquery') );

	wp_enqueue_script( 'simplicity-core-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'simplicity-core-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'simplicity_core_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/assets/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/assets/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/assets/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/assets/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/assets/inc/jetpack.php';
}

/**
 * Load Widgets file.
 */
require get_template_directory() . '/assets/inc/widgets.php';

