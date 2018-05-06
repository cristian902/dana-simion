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

	/**
	 * Remove unused controls
	 */
	$controls_to_remove = array(
		'background_image',
		'background_color',
	);
	foreach ($controls_to_remove as $control_name ){
		$control_to_remove  = $wp_customize->get_control($control_name);
		if( !empty( $control_to_remove ) ){
			$wp_customize->remove_control($control_name);
		}
	}

	$sections_to_remove = array(
		'colors',
		'background_image'
	);
	foreach ($sections_to_remove as $section_name ){
		$section_to_remove = $wp_customize->get_section($section_name);
		if( !empty( $section_to_remove ) ){
			$wp_customize->remove_section($section_name);
		}
	}

	$wp_customize->add_panel( 'header_settings', array(
		'title' => esc_html__('Header','danasimion'),
		'priority' => 30,
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
		'label'   => esc_html__('Contact box','danasimion'),
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



//	$wp_customize->add_setting( 'jumbotron_logo', array(
//		'sanitize_callback' => 'esc_url_raw',
//		'default' => get_template_directory_uri() . '/inc/images/Logo1.png'
//	));
//
//	$wp_customize->add_control(
//		new WP_Customize_Image_Control(
//			$wp_customize,
//			'jumbotron_logo',
//			array(
//				'label'      => esc_html__( 'Header logo', 'danasimion' ),
//				'section'    => 'jumbotron_content',
//				'priority' => 10,
//			)
//		)
//	);
//
//	$wp_customize->add_setting( 'jumbotron_title', array(
//		'default' => esc_html__('Welcome', 'danasimion'),
//		'sanitize_callback' => 'sanitize_text_field',
//	) );
//
//	$wp_customize->add_control( 'jumbotron_title', array(
//		'type' => 'text',
//		'label' => esc_html__( 'Header main title', 'danasimion' ),
//		'section' => 'jumbotron_content', // Add a default or your own section
//		'priority' => 15,
//	) );
//
//	$wp_customize->add_setting( 'jumbotron_subtitle', array(
//		'default' => esc_html__('Dana Simion ‧ Painting Expedition', 'danasimion'),
//		'sanitize_callback' => 'sanitize_text_field',
//	) );
//
//	$wp_customize->add_control( 'jumbotron_subtitle', array(
//		'type' => 'text',
//		'label' => esc_html__( 'Header subtitle', 'danasimion' ),
//		'section' => 'jumbotron_content', // Add a default or your own section
//		'priority' => 20,
//	) );

	$wp_customize->add_panel( 'frontpage_sections', array(
		'title' => esc_html__('Frontpage sections','danasimion'),
		'priority' => 20,
	) );

	$wp_customize->add_section( 'slider_section' , array(
		'title'    => esc_html__( 'Slider section', 'danasimion' ),
		'panel'    => 'frontpage_sections',
		'priority' => 5,
	) );

	$wp_customize->add_setting( 'header_slider_content', array(
		'sanitize_callback' => 'customizer_repeater_sanitize'
	));

	$wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'header_slider_content', array(
		'label'   => esc_html__('Header slider','danasimion'),
		'section' => 'slider_section',
		'priority' => 1,
		'customizer_repeater_image_control' => true,
		'customizer_repeater_image2_control' => true,
		'customizer_repeater_title_control' => true,
		'customizer_repeater_subtitle_control' => true,
	) ) );

	$wp_customize->add_section( 'categories_section' , array(
		'title'    => esc_html__( 'Categories section', 'danasimion' ),
		'panel'    => 'frontpage_sections',
		'priority' => 10,
	) );

	$wp_customize->add_setting( 'categories_section_title', array(
		'default' => esc_html__('Themes', 'danasimion'),
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'categories_section_title', array(
		'type' => 'text',
		'label' => esc_html__( 'Categories title', 'danasimion' ),
		'section' => 'categories_section', // Add a default or your own section
		'priority' => 10,
	) );

	$wp_customize->add_setting( 'categories_section_subtitle', array(
		'default' => sprintf(esc_html__('Quisque %s fells.', 'danasimion'),
			sprintf('<strong><i>%s</i></strong>', esc_html__('bibendum interdum', 'danasimion'))),
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'categories_section_subtitle', array(
		'type' => 'text',
		'label' => esc_html__( 'Categories subtitle', 'danasimion' ),
		'section' => 'categories_section', // Add a default or your own section
		'priority' => 15,
	) );

	$wp_customize->add_setting( 'categories_section_number', array(
		'default' => 3,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'categories_section_number', array(
		'type' => 'number',
		'label' => esc_html__( 'Number of items', 'danasimion' ),
		'section' => 'categories_section', // Add a default or your own section
		'priority' => 20,
		'input_attrs' => array(
            'min' => '1', 'step' => '1',
          ),
	) );

	$wp_customize->add_section( 'contact_button_section' , array(
		'title'    => esc_html__( 'Contact button section', 'danasimion' ),
		'panel'    => 'frontpage_sections',
		'priority' => 15,
	) );

	$wp_customize->add_setting( 'contact_button_label', array(
		'default' => esc_html__('Get in touch', 'danasimion'),
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'contact_button_label', array(
		'type' => 'text',
		'label' => esc_html__( 'Button label', 'danasimion' ),
		'section' => 'contact_button_section', // Add a default or your own section
		'priority' => 15,
	) );

	$wp_customize->add_setting( 'contact_button_link', array(
		'default' =>  home_url( '/contact' ),
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'contact_button_link', array(
		'type' => 'text',
		'label' => esc_html__( 'Button link', 'danasimion' ),
		'section' => 'contact_button_section', // Add a default or your own section
		'priority' => 205,
	) );

	$wp_customize->add_section( 'footer_content' , array(
		'title'    => esc_html__( 'Footer', 'danasimion' ),
		'priority' => 35,
	) );

	$wp_customize->add_setting( 'footer_copyright', array(
		'default' => esc_html__('Copyright 2018 - All rights reserved', 'danasimion'),
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'footer_copyright', array(
		'type' => 'text',
		'label' => esc_html__( 'Copyright', 'danasimion' ),
		'section' => 'footer_content', // Add a default or your own section
		'priority' => 10,
	) );

	$wp_customize->add_setting( 'footer_logo', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => get_template_directory_uri() . '/inc/images/DS-Logo-copy.png'
	));

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'footer_logo',
			array(
				'label'      => esc_html__( 'Footer logo', 'danasimion' ),
				'section'    => 'section',
				'priority' => 15,
			)
		)
	);

	$wp_customize->add_panel( 'about_content' , array(
		'title'    => esc_html__( 'About', 'danasimion' ),
		'priority' => 25,
	) );

	$wp_customize->add_section( 'about_education' , array(
		'title'    => esc_html__( 'Education', 'danasimion' ),
		'priority' => 5,
		'panel'    => 'about_content'
	) );

	$wp_customize->add_setting( 'about_avatar', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => get_template_directory_uri() . '/inc/images/dana_profil.jpg'
	));

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'about_avatar',
			array(
				'label'      => esc_html__( 'Avatar', 'danasimion' ),
				'section'    => 'about_education',
				'priority' => 5,
			)
		)
	);

	$wp_customize->add_setting( 'education_title', array(
		'default' => esc_html__('Education', 'danasimion'),
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'education_title', array(
		'type' => 'text',
		'label' => esc_html__( 'Title', 'danasimion' ),
		'section' => 'about_education', // Add a default or your own section
		'priority' => 10,
	) );

	$wp_customize->add_setting( 'education_content', array(
		'sanitize_callback' => 'customizer_repeater_sanitize'
	));

	$wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'education_content', array(
		'label'   => esc_html__('Content','danasimion'),
		'section' => 'about_education',
		'priority' => 15,
		'customizer_repeater_text_control' => true,
		'customizer_repeater_text2_control' => true,
	) ) );



	$wp_customize->add_section( 'about_timeline' , array(
		'title'    => esc_html__( 'Timeline', 'danasimion' ),
		'priority' => 10,
		'panel'    => 'about_content'
	) );

	$wp_customize->add_setting( 'timeline_title', array(
		'default' => esc_html__('Exhibitions', 'danasimion'),
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'timeline_title', array(
		'type' => 'text',
		'label' => esc_html__( 'Title', 'danasimion' ),
		'section' => 'about_timeline', // Add a default or your own section
		'priority' => 10,
	) );

	$wp_customize->add_setting( 'about_timeline', array(
		'sanitize_callback' => 'customizer_repeater_sanitize'
	));

	$wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'about_timeline', array(
		'label'   => esc_html__('Timeline','danasimion'),
		'section' => 'about_timeline',
		'priority' => 15,
		'item_name' => esc_html__('Year','danasimion'),
		'customizer_repeater_repeater_control' => true,
		'customizer_repeater_title_control' => true,
	) ) );


	$wp_customize->add_section( 'environment_gallery' , array(
		'title'    => esc_html__( 'Environment gallery', 'danasimion' ),
		'priority' => 26,
	) );

	$wp_customize->add_setting( 'environment_backgrounds', array(
		'sanitize_callback' => 'customizer_repeater_sanitize'
	));

	$wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'environment_backgrounds', array(
		'label'   => esc_html__('Environment backgrounds','danasimion'),
		'section' => 'environment_gallery',
		'priority' => 15,
		'customizer_repeater_image_control' => true,
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
