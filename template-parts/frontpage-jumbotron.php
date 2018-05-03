
<?php
$header_slider_content = get_theme_mod('header_slider_content');
if( empty($header_slider_content)){
    return;
}
$header_slider_content_decoded = json_decode($header_slider_content);
if(empty($header_slider_content_decoded)){
    return;
}
$slides = count($header_slider_content_decoded);
?>
<div id="frontpage-carousel" class="carousel slide jumbotron jumbotron-fluid" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
        <?php
        $first_slide = true;
        foreach ($header_slider_content_decoded as $slider_item){
            $title = $slider_item->title;
            $subtitle = $slider_item->subtitle;
            $logo = $slider_item->image_url;
            $background = $slider_item->image2_url;
            ?>
            <div class="carousel-item <?php if( $first_slide === true){ echo 'active';} ?>" style="background-image: url(<?php echo esc_url($background); ?>)">
                <!--            <img class="d-block img-fluid" src="--><?php //echo esc_url($image); ?><!--" alt="First slide">-->
                <div class="jumbotron-layers">
                    <div class="jumbotron-layer1" style="background-image: url(<?php echo esc_url($background); ?>)"></div>
                    <div class="jumbotron-layer2"></div>
                </div>
                <div class="container text-center jumbotron-content">
		            <?php
		            if( !empty( $logo ) ){ ?>
                        <img class="jumbotron-logo" src="<?php echo esc_url($logo); ?>" alt="">
			            <?php
		            }

		            if( !empty( $title ) || !empty($subtitle) ) { ?>
                        <div class="jumbotron-text">
				            <?php
				            if ( ! empty( $title ) ) { ?>
                                <h2 class="display-3 jumbotron-title"><?php echo wp_kses_post( $title ); ?></h2>
					            <?php
				            }

				            if ( ! empty( $subtitle ) ) { ?>
                                <p class="lead jumbotron-subtitle"><?php echo wp_kses_post( $subtitle ); ?></p>
					            <?php
				            } ?>
                        </div>
			            <?php
		            }
		            ?>
                </div>
            </div>
            <?php
            $first_slide = false;
        }
        ?>
    </div>
    <?php if( $slides > 1) { ?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    <?php } ?>
</div>