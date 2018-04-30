
<?php
$pid = get_the_ID();
$image = get_the_post_thumbnail_url($pid, 'category-size');
$title = get_the_title();
$excerpt = get_the_excerpt();
$content = get_the_content();
?>
<div class="card col-md-4 category-item">
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

		if( !empty($excerpt)) {
			?>
			<p class="card-text"><?php echo wp_kses_post($excerpt);?></p>
			<?php
		}

		if( !empty($content)){ ?>
			<p class="card-text"><?php echo wp_kses_post(ucfirst($content));?></p>
		    <?php
        }
		?>
	</div>
</div>