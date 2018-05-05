<div class="categories-header" style="background-image:url(<?php echo get_template_directory_uri() . '/inc/images/bed1.jpg' ?>)">



    <?php
    $args = array(
        'post_type' => 'paintings',
        'post_status' => 'published',
        'taxonomy-name' => 'paintings',
        'numberposts' => -1,
    );
    $number_of_posts = count( get_posts( $args ) );

    $max_page = floor($number_of_posts/9);
    if( $number_of_posts % 9 !== 0){
        $max_page += 1;
    }

    ?>
    <div id="cat-carousel" class="carousel slide">
        <div class="paintings-carousel carousel-inner offset-md-4 col-md-4">
            <?php
            if ( have_posts() ) {
                $is_first = true;
                $post_index = 1;
                while ( have_posts() ) {
                    the_post();

                    $id = get_the_ID();
                    $thumbnail = get_the_post_thumbnail_url();
                    ?>
                    <div class="<?php if($is_first){ echo 'active';} ?> item carousel-item" data-slide-number="<?php echo esc_attr( $post_index ); ?>">
                        <img src="<?php echo esc_url($thumbnail); ?>" class="img-fluid">
                    </div>
                    <?php
                    $is_first = false;
                    $post_index++;
                }
            }
            ?>
        </div>
        <div class="col-md-2 offset-md-1 paintings-grid" data-max-page="<?php echo esc_attr($max_page); ?>" data-current-page="1">

            <?php
            if ( have_posts() ) {
                $post_index = 1;
                $is_first_page = true;
                while ( have_posts() ) {
                    the_post();
                    $id = get_the_ID();
                    $post_thumb = get_the_post_thumbnail_url($id,'category-grid-thumb');
                    if( $post_index % 9 === 1 ){ ?>
                        <div class="page page-<?php echo esc_attr(floor($post_index/9) + 1); if($is_first_page){ echo esc_attr(' current');}?>">
                        <?php
                    }

                    if( $post_index % 3 === 1 ){?>
                        <div class="row">
                        <?php
                    } ?>
                    <div class="list-inline-item col-md-4">
                        <a id="carousel-selector-<?php echo esc_attr($id); ?>" class="" data-slide-to="<?php echo esc_attr($post_index-1); ?>" data-target="#cat-carousel">
                            <img src="<?php echo esc_url($post_thumb); ?>" class="img-fluid">
                        </a>
                    </div>
                    <?php
                    if( $post_index % 3 === 0 || $post_index === $number_of_posts){?>
                        </div>
                        <?php
                    }
                    if( $post_index % 9 === 0 || $post_index === $number_of_posts){ ?>
                        </div>
                        <?php
                    }
                    $is_first_page = false;
                    $post_index++;
                }
            }
            if( $max_page > 1 ) {
                ?>
                <nav>
                    <ul class="grid-pagination pagination">
                        <li class="page-item"><a class="page-link prev" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link next" href="#">Next</a></li>
                    </ul>
                </nav>
                <?php
            }?>
        </div>
    </div>

</div>






