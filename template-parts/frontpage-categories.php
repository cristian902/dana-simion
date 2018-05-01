<?php
$args = array("hide_empty" => 0,
              "type"      => "post",
              "orderby"   => "name",
              "order"     => "ASC" );
$categories = get_categories($args);
if( empty($categories) || count($categories) === 1  ){
    return;
}

$categories_section_title = get_theme_mod('categories_section_title', esc_html__('Themes', 'danasimion'));
$categories_section_subtitle = get_theme_mod( 'categories_section_subtitle', sprintf(esc_html__('Quisque %s fells.', 'danasimion'),
	sprintf('<strong><i>%s</i></strong>', esc_html__('bibendum interdum', 'danasimion'))));
$categories_section_number = get_theme_mod( 'categories_section_number', 3);
?>
<section class="category-section text-center">
	<div class="container">
        <?php if( !empty($categories_section_title) || !empty($categories_section_subtitle)) { ?>
            <div class="section-header">
                <?php if( !empty($categories_section_title) ) { ?>
                <h2 class="section-title"><?php echo wp_kses_post($categories_section_title); ?></h2>
                <?php }
                if( !empty( $categories_section_subtitle ) ) { ?>
                    <p class="lead section-description"><?php echo wp_kses_post($categories_section_subtitle); ?></p>
	                <?php
                } ?>
            </div>
	        <?php
        }?>

		<div class="row-centered section-content">
            <?php
            $i = 1;
            foreach( $categories as $category ){
                if( $i > $categories_section_number ){
                    break;
                }
                if( $category->slug === 'uncategorized' ){
                    continue;
                }
                $cat_id = $category->term_id;
	            $image_id = get_term_meta ( $cat_id, 'category-image-id', true );
	            $image_url = wp_get_attachment_url( $image_id );
	            $link = get_category_link( $cat_id );
	            $i++;
                ?>

                <div class="card col-sm-12 col-md-4 section-category col-centered" align="center">
                    <?php
                    if( !empty($image_url) ){
                        ?>
                        <div class="card-image-container">
                            <img class="card-img-top" src="<?php echo esc_url($image_url); ?>" alt="Card image">
                            <a href="<?php echo esc_url($link); ?>">
                                <div class="overlay">
                                    <span class='icon'>
                                        <i class="fa fa-eye"></i>
                                        <span class="icon-text">View</span>
                                    </span>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="card-body card-centered">
                        <?php
                        if( !empty($category->name) ){
                            ?>
                            <a href="<?php echo esc_url($link); ?>">
                                <h4 class="card-title">
                                    <?php echo '/'.wp_kses_post($category->name); ?>
                                </h4>
                            </a>
                            <?php
                        } ?>
	                    <?php
	                    if( !empty($category->description) ){
		                    ?>
                            <p class="card-text">
			                    <?php echo wp_kses_post($category->description); ?>
                            </p>
		                    <?php
	                    } ?>
                    </div>
                </div>
                <?php
            }
            ?>
		</div>

	</div>


</section>