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

	$wp_customize->add_section( 'header_contact' , array(
		'title'    => esc_html__( 'Header contact', 'danasimion' ),
		'panel'    => 'header_settings',
		'priority' => 30,
	) );

	$wp_customize->add_setting( 'header_contact_content', array(
		'sanitize_callback' => 'customizer_repeater_sanitize'
	));

	$wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'header_contact_content', array(
		'label'   => esc_html__('Contact box','customizer-repeater'),
		'section' => 'header_contact',
		'priority' => 1,
		'customizer_repeater_icon_control' => true,
		'customizer_repeater_title_control' => true,
		'customizer_repeater_text_control' => true,
	) ) );
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
