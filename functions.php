<?php
/**
 * functions and definitions
 */
 
/**
 * definitions
 */
define( 'PRESENTATION_NAME', 'Presentation' );
define( 'PRESENTATION_VERSION', '1.0' );
define( 'PRESENTATION_AUTHOR', 'Sean Davis' );
define( 'PRESENTATION_HOME', 'https://easydigitaldownloads.com/' );


if ( ! function_exists( 'presentation_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function presentation_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'presentation', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails on posts and pages
	add_theme_support( 'post-thumbnails' );

	// Enable support for Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'chat' ) );
	
	// add a hard cropped (for uniformity) image size for the product grid
	add_image_size( 'product-img', 540, 360, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'presentation' ),
	) );
	register_nav_menus( array(
		'header' => __( 'Header Menu (no drop-downs)', 'presentation' ),
	) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // presentation_setup
add_action( 'after_setup_theme', 'presentation_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function presentation_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'presentation' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => __( 'EDD Sidebar', 'presentation' ),
		'id'            => 'sidebar-edd',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'presentation_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function presentation_scripts() {
	// main stylesheet
	wp_enqueue_style( 'presentation-style', get_stylesheet_uri() );
	
	// color stylesheet
	if ( get_theme_mod( 'presentation_stylesheet' ) == 'blue' ) :
		wp_enqueue_style( 'presentation-design', get_template_directory_uri() . '/inc/css/blue.css' );
	elseif ( get_theme_mod( 'presentation_stylesheet' ) ==  'turquoise' ) :
		wp_enqueue_style( 'presentation-design', get_template_directory_uri() . '/inc/css/turquoise.css' );
	elseif ( get_theme_mod( 'presentation_stylesheet' ) ==  'purple' ) :
		wp_enqueue_style( 'presentation-design', get_template_directory_uri() . '/inc/css/purple.css' );
	elseif ( get_theme_mod( 'presentation_stylesheet' ) ==  'midnight' ) :
		wp_enqueue_style( 'presentation-design', get_template_directory_uri() . '/inc/css/midnight.css' );
	elseif ( get_theme_mod( 'presentation_stylesheet' ) ==  'orange' ) :
		wp_enqueue_style( 'presentation-design', get_template_directory_uri() . '/inc/css/orange.css' );
	elseif ( get_theme_mod( 'presentation_stylesheet' ) ==  'red' ) :
		wp_enqueue_style( 'presentation-design', get_template_directory_uri() . '/inc/css/red.css' );
	elseif ( get_theme_mod( 'presentation_stylesheet' ) ==  'gray' ) :
		wp_enqueue_style( 'presentation-design', get_template_directory_uri() . '/inc/css/gray.css' );
	else :
		wp_enqueue_style( 'presentation-design', get_template_directory_uri() . '/inc/css/blue.css' );
	endif;
	
	// font awesome
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/inc/fonts/font-awesome/css/font-awesome.min.css' );
	
	// navigation toggle
	wp_enqueue_script( 'presentation-navigation', get_template_directory_uri() . '/inc/js/navigation.js', array(), '20120206', true );
	
	wp_enqueue_script( 'presentation-skip-link-focus-fix', get_template_directory_uri() . '/inc/js/skip-link-focus-fix.js', array(), '20130115', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'presentation_scripts' );

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
 * Updater class
 */
require get_template_directory() . '/inc/updater.php';


/** ===============
 * Adjust excerpt length
 */
function presentation_custom_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'presentation_custom_excerpt_length', 999 );


/** ===============
 * Replace excerpt ellipses with new ellipses and link to full article
 */
function presentation_excerpt_more( $more ) {
	if ( is_page_template( 'edd_templates/edd-store-front.php' ) || is_post_type_archive( 'download' ) ) {
		return '...';
	} else {
		return '...</p> <div class="continue-reading"><a class="more-link" href="' . get_permalink( get_the_ID() ) . '">' . get_theme_mod( 'presentation_read_more', __( 'Read More', 'presentation' ) . ' &rarr;' ) . '</a></div>';
	}
}
add_filter( 'excerpt_more', 'presentation_excerpt_more' );


/** ===============
 * Add .top class to the first post in a loop
 */
function presentation_first_post_class( $classes ) {
	global $wp_query;
	if ( 0 == $wp_query->current_post )
		$classes[] = 'top';
	return $classes;
}
add_filter( 'post_class', 'presentation_first_post_class' );


/** ===============
 * Only show regular posts in search results
 */
function presentation_search_filter( $query ) {
	if ( $query->is_search && !is_admin )
		$query->set( 'post_type', 'post' );
	return $query;
}
add_filter( 'pre_get_posts','presentation_search_filter' );


/** ===============
 * Allow comments on downloads
 */
function presentation_edd_add_comments_support( $supports ) {
	$supports[] = 'comments';
	return $supports;	
}
add_filter( 'edd_download_supports', 'presentation_edd_add_comments_support' );

	
/** ===============
 * No purchase button below download content
 */
remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );