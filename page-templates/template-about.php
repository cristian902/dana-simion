<?php
/**
 * Template Name: About
 */
get_header();

$about_background =  get_theme_mod('about_background',get_template_directory_uri() . '/inc/images/Rectangle-5-copy.png' );
if( !empty($about_background)) {
	?>
    <div class="col-md-6 about-background">
        <img src="<?php echo esc_url($about_background); ?>">
    </div>
	<?php
}
get_template_part( 'template-parts/about', 'education' );
get_template_part( 'template-parts/about', 'timeline' );

get_footer();
