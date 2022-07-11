<div class="lsx-wizard-step">
	<h4>4. <?php esc_html_e( 'When', 'thesafaripartners-child' ); ?></h4>
	<div class="step-content">
		<div class="wizard-when">
			<div class="col-md-12">
				<h2><?php esc_html_e( 'Where in Africa?', 'thesafaripartners-child' ); ?></h2>
				<p><?php esc_html_e( 'Let us what interests you', 'thesafaripartners-child' ); ?></p>
			</div>
			<div class="col-md-12">
				<?php
					$months = array(
						'january' => __( 'January', 'thesafaripartners-child' ),
						'february' => __( 'February', 'thesafaripartners-child' ),
						'march' => __( 'March', 'thesafaripartners-child' ),
						'april' => __( 'April', 'thesafaripartners-child' ),
						'nay' => __( 'May', 'thesafaripartners-child' ),
						'june' => __( 'June', 'thesafaripartners-child' ),
						'july' => __( 'July', 'thesafaripartners-child' ),
						'august' => __( 'August', 'thesafaripartners-child' ),
						'september' => __( 'September', 'thesafaripartners-child' ),
						'october' => __( 'October', 'thesafaripartners-child' ),
						'november' => __( 'November', 'thesafaripartners-child' ),
						'december' => __( 'December', 'thesafaripartners-child' )
					);

					foreach ( $months as $key => $month ) {
						?>
						<article class="col-md-3 travelwhen">
							<div class="checkbox-wrapper">
								<input class="btn-check"  type="checkbox" name="fwp_interests" value="<?php echo esc_html( $key ); ?>" />
								<span aria-hidden="true"></span>
								<label><?php echo esc_html( $month ); ?><label>
							</div>
						</article>
						<?php
					}
				?>
			</div>
		</div>
	</div>
</div>