<div class="step-content">
	<div class="wizard-who row">
		<div class="col-md-3">
			<h3><?php esc_html_e( 'Tell us what type of traveller you are?', 'thesafaripartners-child' ); ?></h3>
			<p><?php esc_html_e( 'Select what type of traveller you are.', 'thesafaripartners-child' ); ?></p>
		</div>
		<div class="col-md-9">
			<?php
			$terms = get_terms( 'who' );
			?>

			<?php foreach ( $terms as $term ) { ?>
				<!-- post -->
				<article class="col-md-2 status-publish hentry">
					<div class="checkbox-wrapper">
						<input class="btn-check"  type="checkbox" name="fwp_who" value="<?php echo esc_html( apply_filters( 'the_title', $term->slug ) ); ?>" />
						<span aria-hidden="true"></span>
					</div>
					<div class="lsx-to-widget-thumb">
					<?php

							$wizard_img = get_field('wizard_image');
							$size = 'medium'; // (thumbnail, medium, large, full or custom size)

							if( $wizard_img) {
								echo wp_get_attachment_image( $wizard_img, $size );
							} else { ?>

					</div>
					<div class="lsx-to-content">
						<?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>
					</div>
				</article>
			<?php } ?>

			<?php wp_reset_query(); ?>
		</div>
	</div>
</div>`