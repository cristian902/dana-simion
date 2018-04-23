<?php
/**
 * danasimion Theme Customizer
 *
 * @package danasimion
 */
define('DANASIMION_CUSTOMIZER_CONTROLS_PATH',get_template_directory() . '/inc/customizer/customizer-controls/');

function danasimion_load_customize_classes( $wp_customize ) {
	require_once DANASIMION_CUSTOMIZER_CONTROLS_PATH . 'customizer-repeater/functions.php';
}
add_action( 'customize_register', 'danasimion_load_customize_classes', 0 );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function danasimion_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'danasimion_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'danasimion_customize_partial_blogdescription',
		) );
	}


	$wp_customize->add_panel( 'header_settings', array(
		'title' => esc_html__('Header','danasimion'),
		'priority' => 10,
	) );

	$wp_customize->add_section( 'nav_contact' , array(
		'title'    => esc_html__( 'Navbar contact', 'danasimion' ),
		'panel'    => 'header_settings',
		'priority' => 30,
	) );

	$wp_customize->add_setting( 'header_contact_content', array(
		'sanitize_callback' => 'customizer_repeater_sanitize'
	));

	$wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'header_contact_content', array(
		'label'   => esc_html__('Contact box','customizer-repeater'),
		'section' => 'nav_contact',
		'priority' => 1,
		'customizer_repeater_icon_control' => true,
		'customizer_repeater_title_control' => true,
		'customizer_repeater_text_control' => true,
	) ) );

	$header_image_section = $wp_customize->get_section('header_image');
	if( !empty($header_image_section ) ){
		$header_image_section->panel = 'header_settings';
		$header_image_section->priority = 35;
	}
	$wp_customize->add_section( 'jumbotron_content' , array(
		'title'    => esc_html__( 'Header content', 'danasimion' ),
		'panel'    => 'header_settings',
		'priority' => 40,
	) );

	$wp_customize->add_setting( 'jumbotron_logo', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => get_template_directory_uri() . '/inc/images/Logo1.png'
	));

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'jumbotron_logo',
			array(
				'label'      => esc_html__( 'Header logo', 'danasimion' ),
				'section'    => 'jumbotron_content',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting( 'jumbotron_title', array(
		'default' => esc_html__('Welcome', 'danasimion'),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'jumbotron_title', array(
		'type' => 'text',
		'label' => esc_html__( 'Header main title', 'danasimion' ),
		'section' => 'jumbotron_content', // Add a default or your own section
		'priority' => 15,
	) );

	$wp_customize->add_setting( 'jumbotron_subtitle', array(
		'default' => esc_html__('Dana Simion ‧ Painting Expedition', 'danasimion'),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'jumbotron_subtitle', array(
		'type' => 'text',
		'label' => esc_html__( 'Header subtitle', 'danasimion' ),
		'section' => 'jumbotron_content', // Add a default or your own section
		'priority' => 20,
	) );
}
add_action( 'customize_register', 'danasimion_customize_register', 15 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function danasimion_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function danasimion_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function danasimion_customize_preview_js() {
	wp_enqueue_script( 'danasimion-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'danasimion_customize_preview_js' );
