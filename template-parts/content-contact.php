<div class="container">
	<div class="row">
		<div class="col-lg-8 offset-lg-4">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php
					the_title('<h2 class="entry-title">', '</h2>'); ?>
				</header><!-- .entry-header -->
				<div class="entry-content">
					<?php
					the_content( sprintf(
						wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'danasimion' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'danasimion' ),
						'after'  => '</div>',
					) ); ?>
				</div>
			</article>
		</div>
	</div>
</div>