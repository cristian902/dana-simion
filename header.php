<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package danasimion
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <div class="site-branding">
                <?php the_custom_logo(); ?>
                <?php
                if ( is_front_page() && is_home() ) { ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                              rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	                <?php
                } else { ?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                             rel="home"><?php bloginfo( 'name' ); ?></a></p>
	                <?php
                }

                $danasimion_description = get_bloginfo( 'description', 'display' );
                if ( $danasimion_description || is_customize_preview() ) {
                    ?>
                    <p class="site-description">
                        <?php echo $danasimion_description; /* WPCS: xss ok. */ ?></p>
                    <?php
                }
                ?>

                </div>
                <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbar9">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php
                $header_contact_content = get_theme_mod('header_contact_content');
                $container_class = 'collapse navbar-collapse';
                if( !empty( $header_contact_content ) ){
                    $container_class .= ' has-content-above';
                } ?>
                <div class="<?php echo esc_attr($container_class) ?>" id="navbar9">
                <?php
                do_action('before_header_ul');
                wp_nav_menu( array(
	                'theme_location'	=> 'menu-1',
	                'depth'				=> 2, // 1 = with dropdowns, 0 = no dropdowns.
	                'container'			=> false,
	                'menu_class'		=> 'navbar-nav ml-auto',
	                'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
	                'walker'			=> new WP_Bootstrap_Navwalker()
                ) );
                ?>
                </div>
            </div>
        </nav>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
