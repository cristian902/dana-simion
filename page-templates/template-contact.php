<?php
/**
 * Template Name: Contact
 */
get_header(); ?>
<div class="col-md-6 about-background">
    <img src="<?php echo get_template_directory_uri() . '/inc/images/Rectangle-5.png' ?>">
</div>
<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'contact' );

		endwhile; // End of the loop.
		?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
