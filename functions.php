<?php
/**
 * bully functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bully
 */

if ( ! function_exists( 'bully_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bully_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on bully, use a find and replace
	 * to change 'bully' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'bully', get_template_directory() . '/languages' );

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
	 * Theme Logo
	 */
	add_theme_support( 'custom-logo' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'cover', 1280, 300, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'bully' ),
		'menu-2' => esc_html__( 'User', 'bully' ),
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

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'bully_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bully_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bully_content_width', 1140 );
}
add_action( 'after_setup_theme', 'bully_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bully_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bully' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bully' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'bully_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bully_scripts() {
	wp_enqueue_style( 'bully-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bully-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bully-js', get_template_directory_uri() . '/assets/js/custom.js', '', '', true );

	wp_enqueue_script( 'bully-font-awesome', '//use.fontawesome.com/958f87841b.js' );
	wp_enqueue_script( 'bully-google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAT5vS9U3S5QkN-f2cwPN-Am4C1vc7zElE' );
	wp_enqueue_script( 'bully-navigation', get_template_directory_uri() . '/assets/js/navigation.js', '', '', true );
}
add_action( 'wp_enqueue_scripts', 'bully_scripts' );

/**
 * LOGIN / LOGOUT LINK TO MENU
 */
// function wti_loginout_menu_link( $items, $args ) {
// 	if ($args->theme_location == 'menu-1') {
// 		if (is_user_logged_in()) {
// 			$items .= '<li><a href="'. home_url( '/profile/' ) .'">'. __("My Account") .'</a></li>';
// 		} else {
// 			$items .= '<li><a href="'. wp_login_url(get_permalink()) .'">'. __("Login") .'</a></li>';
// 		}
// 	}
// 	return $items;
// }
// add_filter( 'wp_nav_menu_items', 'wti_loginout_menu_link', 10, 2 );

function new_nav_menu_items($items, $args) {
	if ($args->theme_location == 'menu-1') {
		if (is_user_logged_in()) {
			$loginlink = '<li><a href="'. home_url( '/profile/' ) .'">'. __("My Account") .'</a></li>';
		} else {
			$loginlink = '<li><a href="'. wp_login_url(get_permalink()) .'">'. __("Login") .'</a></li>';
		}
		$items = $loginlink . $items;
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'new_nav_menu_items', 10, 2 );


/**
 * CUSTOM EXCERPT
 */
function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	} 
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	$excerpt = str_replace(',', '.', $excerpt);
	echo $excerpt;
}

function my_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyAT5vS9U3S5QkN-f2cwPN-Am4C1vc7zElE');
}

add_action('acf/init', 'my_acf_init');


/**
 * Custom posts types
 */
require get_template_directory() . '/inc/cpts.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
