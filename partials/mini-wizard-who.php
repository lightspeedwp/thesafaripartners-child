<div class="step-content">
	<div class="wizard-who row">
		<div class="col-md-3">
			<h3><?php esc_html_e( 'Who is Traveling?', 'thesafaripartners-child' ); ?></h3>
			<p><?php esc_html_e( 'Click on the type of traveller you are.', 'thesafaripartners-child' ); ?></p>
		</div>
		<div class="col-md-9">
			<?php
			$terms = get_terms( 'who' );
			?>

			<?php foreach ( $terms as $term ) { ?>
				<!-- post -->
					
				<article class="col-md-2 status-publish hentry">
					<div class="checkbox-clear">

						<?php
						$checked = '';
						if ( ! empty( $args ) && isset( $args['selected'] ) && ( in_array( $term->term_id, $args['selected'] ) || in_array( $term->slug, $args['selected'] ) ) ) {
							$checked = 'checked';
						}
						?>
						<input class="clear-check"  type="checkbox" <?php echo esc_attr( $checked ); ?> name="fwp_who" value="<?php echo esc_html( apply_filters( 'the_title', $term->slug ) ); ?>" />
						<span aria-hidden="true"></span>
					</div>
					<div class="lsx-to-widget-thumb">
						<?php
						$image_id = get_field('wizard_image', $term, false); 
						$image = wp_get_attachment_image_src($image_id);
						?>
						<img src="<?php echo $image[0]; ?>" />
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