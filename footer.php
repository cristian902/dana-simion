<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package danasimion
 */
$footer_logo = get_theme_mod('footer_logo', get_template_directory_uri() . '/inc/images/DS-Logo-copy.png');
$footer_copyright = get_theme_mod('footer_copyright', esc_html__('Copyright 2018 - All rights reserved', 'danasimion') );
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
        <div class="container">
            <div class="site-info">
                <?php
                if( !empty($footer_logo) ) { ?>
                    <img src="<?php echo esc_url( $footer_logo ); ?>" class="footer-logo">
	                <?php
                }
                if( !empty($footer_copyright) ) { ?>
                    <p class="footer-copyright"><?php echo wp_kses_post($footer_copyright); ?></p>
	                <?php
                }?>
            </div><!-- .site-info -->
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
