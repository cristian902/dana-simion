<?php
$contact_button_label = get_theme_mod('contact_button_label', esc_html__('Get in touch', 'danasimion') );
$contact_button_link = get_theme_mod( 'contact_button_link', home_url( '/contact' ) );
if( !empty($contact_button_label) && !empty($contact_button_link)){ ?>
	<section class="contact-button-section">
		<div class="container">
			<div class="row-centered section-content">
				<div class="col-md-4 col-centered">
					<a href="<?php echo esc_url($contact_button_link); ?>" class="btn btn-red contact-button"><?php echo wp_kses_post($contact_button_label); ?></a>
				</div>
			</div>
		</div>
	</section>
<?php
}
?>
