<div class="lsx-wizard-step">
	<h4>2. <?php esc_html_e( 'What', 'thesafaripartners-child' ); ?></h4>
	<div class="step-content">
		<div class="wizard-what">
			<div class="col-md-3">
				<h3><?php esc_html_e( 'What interests you?', 'thesafaripartners-child' ); ?></h3>
				<p><?php esc_html_e( 'Let us what interests you', 'thesafaripartners-child' ); ?></p>
			</div>

			<div class="col-md-9">

				<?php
				$terms = get_terms( 'travel-style' );
				?>

				<?php foreach ( $terms as $term ) : ?>
					<!-- post -->
					<article class="col-md-2 status-publish hentry">
						<div class="checkbox-wrapper">
							<input class="btn-check"  type="checkbox" name="fwp_what" value="<?php echo esc_html( apply_filters( 'the_title', $term->slug ) ); ?>" />
							<span aria-hidden="true"></span>
						</div>

						<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) : ?>
							<div class="lsx-to-widget-thumb">
								<?php lsx_to_term_thumbnail( $term->term_id, 'lsx-full' ); ?>
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
		</div>
	</div>
</div>