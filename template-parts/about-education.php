<?php
$education_title = get_theme_mod('education_title', esc_html__('Education','danasimion'));
$education_content = get_theme_mod( 'education_content');
$about_avatar = get_theme_mod('about_avatar',get_template_directory_uri() . '/inc/images/dana_profil.jpg');
?>
<div class="container">
	<div class="row">
		<div class="col-lg-4 col-sm-12 avatar-section">
            <?php if( !empty($about_avatar)) { ?>
                <div class="avatar-wrapper"></div>
	            <?php
            }
            ?>
		</div>
		<div class="col-lg-8 col-sm-12 education-section">
			<?php
			if( !empty($education_title)){ ?>
				<h2 class="section-title">
					<?php echo wp_kses_post($education_title); ?>
				</h2>
				<?php
			}

			if( !empty($education_content)) {
				$education_content_decoded = json_decode($education_content);
				if( !empty($education_content_decoded)) {
					foreach ($education_content_decoded as $education_entry) {
						$text    = $education_entry->text;
						$subtitle = $education_entry->text2;
						if( !empty($text) || !empty($subtitle) ) {
							?>
							<div class="education-entry">
								<?php
								if( !empty($text) ) { ?>
									<div class="education-content">
										<?php echo wp_kses_post($text); ?>
									</div>
									<?php
								}
								if( !empty($subtitle)) {
									?>
									<div class="education-description">
										<?php echo wp_kses_post($subtitle); ?>
									</div>
									<?php
								}?>
							</div>
							<?php
						}
					}
				}
			}?>
		</div>
	</div>
</div>