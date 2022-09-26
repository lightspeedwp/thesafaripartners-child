
<div class="step-content">
	<div class="wizard-where row">
		<div class="col-md-3">
			<h3><?php esc_html_e( 'Where in Africa?', 'thesafaripartners-child' ); ?></h3>
			<p><?php esc_html_e( 'Do you know where you might want to go? Select any countries that may interest you, or if you are not sure, skip this section.', 'thesafaripartners-child' ); ?></p>
		</div>
		<div class="col-md-9">
			<div class="safari-styles desinations-landing-style">
				<?php
				$the_query = new WP_Query(
					array(
						'post_type'      => 'destination',
						'post_parent'    => 0,
						'posts_per_page' => -1,
						'orderby'=>'menu_order',
						'order' => 'ASC',
						'meta_key' => 'featured',
					)
				);

				while ( $the_query->have_posts() ) :
					global $post;
					$the_query->the_post();
					?>
					<div class="lsx-to-widget-item-wrap col-xs-3 col-sm-2 lsx-travel-style destinations-archive lsx-to-archive-item">
						<div class="lsx-to-widget-thumb">
							<div class="checkbox-wrapper">
								<?php
								$checked = '';
								if ( ! empty( $args ) && isset( $args['selected'] ) && ( in_array( $post->ID, $args['selected'] ) || in_array( $post->post_name, $args['selected'] ) ) ) {
									$checked = 'checked';
								}
								?>
								<input class="btn-check" <?php echo esc_attr( $checked ); ?> type="checkbox" value="<?php echo get_the_ID(); ?>" name="fwp_where" />
								<span aria-hidden="true"></span>
							</div>
							<?php lsx_thumbnail( 'large' ); ?>
						</div>

						<div class="lsx-to-content">
							<?php the_title(); ?>
						</div>
					</div>

					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
			</div>
		</div>
	</div>
</div>