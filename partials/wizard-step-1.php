<div class="lsx-wizard-step">
	<h4>1. <?php esc_html_e( 'Who', 'thesafaripartners-child' ); ?></h4>
	<div class="step-content">
		<div class="wizard-who">
			<div class="col-md-3">
				<h3><?php esc_html_e( 'Who is Traveling?', 'thesafaripartners-child' ); ?></h3>
				<p><?php esc_html_e( 'Click on the type of traveller you are.', 'thesafaripartners-child' ); ?></p>
			</div>
			<div class="col-md-9">
				<?php
				$terms = get_terms( 'who' );
				?>

				<?php foreach ( $terms as $term ) : ?>
					<!-- post -->
					<article class="col-md-2 status-publish hentry">
						<div class="checkbox-wrapper">
							<input class="clear-check"  type="checkbox" name="fwp_who" value="<?php echo esc_html( apply_filters( 'the_title', $term->slug ) ); ?>" />
							<span aria-hidden="true"></span>
						</div>

						<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) : ?>
							<div class="lsx-to-widget-thumb">
							<?php
						$image_id = get_field('wizard_image', $term, false); 
						$image = wp_get_attachment_image_src($image_id);
						?>
						<img src="<?php echo $image[0]; ?>" />
							</div>
						<?php else : ?>
							<div class="lsx-to-widget-thumb">
								<img alt="Placeholder" class="attachment-responsive wp-post-image lsx-responsive" src="<?php echo esc_url( lsx\legacy\Placeholders::placeholder_url( null, null, array( 750, 350 ) ) ); ?>">
							</div>
						<?php endif; ?>

						<div class="lsx-to-content">
							<?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>
						</div>
					</article>
				<?php endforeach; ?>

				<?php wp_reset_query(); ?>
			</div>
			<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
		</div>
	</div>
</div>