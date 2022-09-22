<div class="step-content">
	<div class="wizard-budget row">
		<div class="col-md-3">
			<h3><?php esc_html_e( 'What is your budget?', 'thesafaripartners-child' ); ?></h3>
			<p><?php esc_html_e( 'If you have an idea of your budget let us know here, or skip it if you wish.', 'thesafaripartners-child' ); ?></p>
		</div>
		<div class="col-md-9">
			<?php
			$args = array(
				'meta_key' => 'inspire_order',
				'orderby' => 'meta_key',
				'order' => 'ASC',
				'hide_empty' => 0,
			);
			$terms = get_terms( 'budget', $args );
			?>

			<?php foreach ( $terms as $term ) : 
				
				$value = apply_filters( 'the_title', $term->slug );
				?>
				<!-- post -->
				<article class="col-md-2 status-publish hentry">
					<div class="checkbox-wrapper">
						<?php
						$checked = '';
						if ( ! empty( $args ) && isset( $args['selected'] ) && ( in_array( $term->term_id, $args['selected'] ) || in_array( $term->slug, $args['selected'] ) ) ) {
							$checked = 'checked';
						}
						?>
						<input id="budget-<?php echo esc_html( $value ); ?>" class="btn-check" <?php echo esc_attr( $checked ); ?> type="checkbox" name="fwp_budget" value="<?php echo esc_html( $value ); ?>" />
						<span aria-hidden="true"></span>
					</div>

					<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) : ?>
						<div class="lsx-to-widget-thumb">
							<label for="budget-<?php echo esc_html( $value ); ?>"><?php lsx_to_term_thumbnail( $term->term_id, 'full' ); ?></label>
						</div>
					<?php else : ?>
						<div class="lsx-to-widget-thumb">
							<label for="budget-<?php echo esc_html( $value ); ?>"><img alt="Placeholder" class="attachment-responsive wp-post-image lsx-responsive" src="<?php echo esc_url( lsx\legacy\Placeholders::placeholder_url( null, null, array( 750, 350 ) ) ); ?>"></label>
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