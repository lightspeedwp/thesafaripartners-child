<div class="step-content">
	<div class="wizard-what row">
		<div class="col-md-3">
			<h3><?php esc_html_e( 'What interests you?', 'thesafaripartners-child' ); ?></h3>
			<p><?php esc_html_e( 'Select all the experiences you would enjoy. Choose as many as you like.', 'thesafaripartners-child' ); ?></p>
		</div>

		<div class="col-md-9">

			<?php
			$style_args = array(
				'meta_key' => 'inspire_order',
				'orderby' => 'meta_value_num',
				'order' => 'ASC',
				'hide_empty' => 0,
			);
			$terms = get_terms( 'travel-style', $style_args );
			?>

			<?php foreach ( $terms as $term ) : ?>
				<!-- post -->
				<article class="col-xs-3 col-sm-2 status-publish hentry">
					<div class="checkbox-wrapper">
						<?php
						$checked = '';
						if ( ! empty( $args ) && isset( $args['selected'] ) && ( in_array( $term->term_id, $args['selected'] ) || in_array( $term->slug, $args['selected'] ) ) ) {
							$checked = 'checked';
						}
						?>
						<input class="btn-check"  type="checkbox" <?php echo esc_attr( $checked ); ?> name="fwp_what" value="<?php echo esc_html( apply_filters( 'the_title', $term->slug ) ); ?>" />
						<span aria-hidden="true"></span>
					</div>

					<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) : ?>
						<div class="lsx-to-widget-thumb">
							<?php lsx_to_term_thumbnail( $term->term_id, 'large' ); ?>
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