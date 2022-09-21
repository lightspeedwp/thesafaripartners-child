<div class="lsx-wizard-step">
	<h4>3. <?php esc_html_e( 'Where', 'thesafaripartners-child' ); ?></h4>
	<div class="step-content">
		<div class="wizard-where">
		<div class="col-md-3">
				<h3><?php esc_html_e( 'Where in Africa?', 'thesafaripartners-child' ); ?></h3>
				<p><?php esc_html_e( 'Do you know where you might want to go? Select any countries that may interest you, or if you are not sure, skip this section.', 'thesafaripartners-child' ); ?></p>
			</div>
			<div class="col-md-9">					
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
					<div class="col-md-2 status-publish hentry destination">
					<div class="checkbox-wrapper">
								<input class="btn-check"  type="checkbox" value="<?php echo get_the_ID(); ?>" name="fwp_where" />
								<span aria-hidden="true"></span>
							</div>
						<div class="lsx-to-widget-thumb">
							<?php lsx_thumbnail( 'lsx-block-post-grid-square' ); ?>
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