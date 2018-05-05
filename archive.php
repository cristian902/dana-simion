<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package danasimion
 */

get_header();

get_template_part('template-parts/category', 'presentation-header')

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main category-grid">

            <div class="container">
                <div class="row">
                <?php if ( have_posts() ) : ?>

                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();

                        /*
                         * Include the Post-Type-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/category', 'content' );

                    endwhile;

	                danasimion_numeric_posts_nav();

                else :

                    get_template_part( 'template-parts/content', 'none' );

                endif; ?>
                </div>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
