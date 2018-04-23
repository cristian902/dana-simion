<?php
$jumbotron_logo = get_theme_mod('jumbotron_logo', get_template_directory_uri() . '/inc/images/Logo1.png');
$jumbotron_title = get_theme_mod( 'jumbotron_title', esc_html__('Welcome', 'danasimion') );
$jumbotron_subtitle = get_theme_mod( 'jumbotron_subtitle', esc_html__('Dana Simion ‧ Painting Expedition', 'danasimion') );
?>
<div class="jumbotron jumbotron-fluid">
	<div class="jumbotron-layers">
        <div class="jumbotron-layer1" style="background-image: url(<?php echo get_header_image(); ?>)"></div>
        <div class="jumbotron-layer2"></div>
    </div>
	<div class="container text-center jumbotron-content">
        <?php
        if( !empty( $jumbotron_logo ) ){ ?>
            <img class="jumbotron-logo" src="<?php echo esc_url($jumbotron_logo); ?>" alt="">
            <?php
        }

        if( !empty( $jumbotron_title ) || !empty($jumbotron_subtitle) ) { ?>
            <div class="jumbotron-text">
                <?php
                if ( ! empty( $jumbotron_title ) ) { ?>
                    <h2 class="display-3 jumbotron-title"><?php echo wp_kses_post( $jumbotron_title ); ?></h2>
                    <?php
                }

                if ( ! empty( $jumbotron_subtitle ) ) { ?>
                    <p class="lead jumbotron-subtitle"><?php echo wp_kses_post( $jumbotron_subtitle ); ?></p>
                    <?php
                } ?>
            </div>
                <?php
        }
        ?>
	</div>
</div>