
<div class="step-content">
	<div class="wizard-where row">
		<div class="col-md-3">
			<h3><?php esc_html_e( 'Where in Africa would you like to go?', 'thesafaripartners-child' ); ?></h3>
			<p><?php esc_html_e( 'Select any countries which may interest you, or if you are not sure, skip this section', 'thesafaripartners-child' ); ?></p>
		</div>
		<div class="col-md-9">
			<div class="safari-styles desinations-landing-style">
				<?php
				$the_query = new WP_Query(
					array(
						'post_type'   => 'destination',
						'post_parent' => 0,
					)
				);

				while ( $the_query->have_posts() ) :
					global $post;
					$the_query->the_post();
					?>
					<div class="lsx-to-widget-item-wrap col-xs-3 col-sm-2 lsx-travel-style destinations-archive lsx-to-archive-item">
						<div class="lsx-to-widget-thumb">
							<div class="checkbox-wrapper">
								<input class="btn-check"  type="checkbox" value="<?php echo get_the_ID(); ?>" name="fwp_where" />
								<span aria-hidden="true"></span>
							</div>
							<?php lsx_thumbnail( 'medium' ); ?>
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