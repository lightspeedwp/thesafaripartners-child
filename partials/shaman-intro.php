<div class="shaman-intro row">
		<div class="col-md-12">
			<div class="shaman-icon"></div>
			<h2 class="center h2larger">
				<?php 
				if ( false !== $args['title'] && '' !== $args['title'] && 0 !== $args['tagline'] ) {
					echo wp_kses_post( $args['title'] );
				} else {
					esc_html_e( 'The Safari Shaman is here to help you discover the perfect trip for you.', 'thesafaripartners-child' );
				}
				?>
			</h2>
			<p class="center">
				<?php 
				if ( false !== $args['tagline'] && '' !== $args['tagline'] && 0 !== $args['tagline'] ) {
					echo wp_kses_post( $args['tagline'] );
				} else {
					esc_html_e( 'Tell the Safari Shaman a little more about yourself by selecting the options below.', 'thesafaripartners-child' );
				}
				?>
			</p>
		</div>
</div>