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

		/**
		 * Enable category thumbnail.
		 */
		add_theme_support('category-thumbnails');


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

		/**
		 * Image sizes
		 */
		add_image_size('category-size', 360, 240, true);
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

	wp_enqueue_script( 'danasimion-script', get_template_directory_uri() . '/js/scripts.js', array('jquery','jquery-bootstrap'), DANASIMION_VERSION );

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

/**
 * Inline style.
 */
function danasimion_inline_style(){
	$style = '';
	$about_avatar = get_theme_mod('about_avatar',get_template_directory_uri() . '/inc/images/dana_profil.jpg');
	if( !empty($about_avatar) ){
		$style .= '.avatar-wrapper{background-image: url("'.esc_url($about_avatar).'");}';
	}
	wp_add_inline_style('danasimion-style',$style);
}
add_action( 'wp_enqueue_scripts', 'danasimion_inline_style' );

/**
 * Numeric post pagination.
 */
function danasimion_numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/** Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/** Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/** Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/** Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/** Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/** Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/** Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";

}

/**
 * Remove single post page
 */
function danasimion_single_post_404( $query ) {
	if ( $query->is_main_query() && $query->is_single() )
		$query->is_404 = true;
}
add_action( 'pre_get_posts', 'danasimion_single_post_404' );

/**
 * Create custom post type
 */
function danasimion_create_posttype() {

	register_post_type( 'paintings',
		// CPT Options
		array(
			'labels' => array(
				'name' => esc_html__( 'Paintings','danasimion' ),
				'singular_name' => esc_html__( 'Painting','danasimion' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'paintings'),
			'taxonomies' => array( 'categories' ),
			'supports' => array(
			    'title',
                'editor',
                'excerpt',
                'author',
                'thumbnail',
            ),
			'menu_icon' => 'dashicons-admin-customizer',
		)
	);
}
add_action( 'init', 'danasimion_create_posttype' );

//hook into the init action and call create_book_taxonomies when it fires


//create a custom taxonomy name it topics for your posts

function danasimion_category_taxonomy() {

	register_taxonomy('categories', array('paintings'), array(
		'hierarchical' => true,
		'labels' => $labels = array(
			'name' => esc_html__( 'Categories', 'danasimion' ),
			'singular_name' => esc_html__( 'Category', 'danasimion' ),
        ),
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'topic' ),
	));

}
add_action( 'init', 'danasimion_category_taxonomy', 0 );
