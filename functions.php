<?php
/**
 * danasimion functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package danasimion
 */

define('DANASIMION_VERSION', '1.0.0');
define('DANASIMION_PHPINC', get_template_directory_uri() . '/inc/');

if ( ! function_exists( 'danasimion_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function danasimion_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on danasimion, use a find and replace
		 * to change 'danasimion' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'danasimion', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'danasimion' ),
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
		add_theme_support( 'custom-background', apply_filters( 'danasimion_custom_background_args', array(
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
add_action( 'after_setup_theme', 'danasimion_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function danasimion_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'danasimion_content_width', 640 );
}
add_action( 'after_setup_theme', 'danasimion_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function danasimion_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'danasimion' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'danasimion' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'danasimion_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function danasimion_scripts() {

	wp_enqueue_style( 'bootstrap-style', DANASIMION_PHPINC . 'vendors/bootstrap/css/bootstrap.min.css', array(), DANASIMION_VERSION);

	wp_enqueue_style( 'fontawesome-style', DANASIMION_PHPINC . 'vendors/fontawesome/font-awesome.min.css', array(), DANASIMION_VERSION );

	wp_enqueue_style( 'danasimion-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery-bootstrap', DANASIMION_PHPINC . 'vendors/bootstrap/js/bootstrap.min.js', array('jquery'), DANASIMION_VERSION );

	wp_enqueue_script( 'danasimion-navigation', get_template_directory_uri() . '/js/navigation.js', array(), DANASIMION_VERSION, true );

	wp_enqueue_script( 'danasimion-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), DANASIMION_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'danasimion_scripts' );

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
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load Bootstrap navwalker.
 */
require get_template_directory() . '/inc/vendors/bootstrap/class-wp-bootstrap-navwalker.php';



/**
 * Display header contact boxes before menu.
 */
function danasinion_display_header_contact(){
	$header_contact_content = get_theme_mod('header_contact_content');
	if( empty($header_contact_content) ){
		return;
	}

	$header_contact_content_decoded = json_decode($header_contact_content, true);
	if( empty($header_contact_content_decoded) ){
		return;
	}

	echo '<div class="content-above-nav-menu w-100">';
	$i = 1;
	foreach ($header_contact_content_decoded as $contact_box){
		$title = $contact_box['title'];
		$text = $contact_box['text'];
		$icon = $contact_box['icon_value'];
		echo '<div class="header-box-item float-md-right d-none d-md-block">';
		if( !empty($icon) ){
			echo '<div class="header-contact-icon">';
			echo '<i class="fa '. esc_attr($icon) . '"></i>';
			echo '</div>';
		}
		if(!empty($title) || !empty($text)){
			echo '<div class="header-contact-content">';
				echo '<p class="header-contact-title">';
				echo  wp_kses_post($title);
				echo '</p>';
				echo '<p class="header-contact-text">';
				echo  wp_kses_post($text);
				echo '</p>';

			echo '</div>';
		}
		echo '</div>';
	}
	echo '</div>';

}
add_action('before_header_ul','danasinion_display_header_contact');
