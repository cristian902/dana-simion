
<?php
$pid = get_the_ID();
$image = get_the_post_thumbnail_url($pid, 'category-size');
$image_full = get_the_post_thumbnail_url($pid, 'full');
$title = get_the_title();
$paintings_dimension = get_field('paintings_dimension', $pid);
$materials = get_field( 'materials', $pid );
?>
<div class="card col-md-4 category-item" data-toggle="lightbox" data-gallery="gallery">
	<?php
	if( !empty($image) ) {
		?>
		<img class="card-img-top" src="<?php echo esc_url($image); ?>" alt="Card image cap">
		<?php
	}
	?>
	<div class="card-body nopadding">
		<?php
		if( !empty($title)) { ?>
			<h5 class="card-title"><?php echo wp_kses_post($title); ?></h5>
			<?php
		}

		if( !empty($paintings_dimension)){ ?>
			<p class="card-text"><?php echo wp_kses_post($paintings_dimension);?></p>
		    <?php
        }

		if( !empty($materials)) {
			?>
			<p class="card-text"><?php echo wp_kses_post($materials);?></p>
			<?php
		}

		?>
	</div>
    <div tabindex="-1" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php if( !empty($title)){ ?>
                <div class="modal-header">
                    <h3 class="modal-title"><?php echo wp_kses_post($title); ?></h3>
                </div>
                <?php } ?>
                <?php if( !empty($image_full)) { ?>
                <div class="modal-body">
                    <img src="<?php echo esc_url($image_full); ?>">
                </div>
                <?php } ?>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>