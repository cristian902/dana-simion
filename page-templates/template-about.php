<?php
/**
 * Template Name: About
 */
get_header(); ?>
<div class="col-md-6 about-background">
	<img src="<?php echo get_template_directory_uri() . '/inc/images/Rectangle-5-copy.png' ?>">
</div>
<?php
get_template_part( 'template-parts/about', 'education' );
get_template_part( 'template-parts/about', 'timeline' );

get_footer();
