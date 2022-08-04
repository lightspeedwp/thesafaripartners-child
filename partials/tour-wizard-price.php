<div id="Price" class="tabcontent">
	<div class="col-md-12 col-sm-12">
		<div class="lsx-tour-module">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					
					lsx_entry_before();
					?>

					<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>
						<?php lsx_entry_top(); ?>
						<div class="col-md-5 lsx-contact-module-image">
					<div class="lsx-banner-image-wrap">
									<picture>
										<?php echo get_the_post_thumbnail( $page->ID, 'full' ); ?>
									<picture>
							

							</div>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-7">
							<div class="lsx-to-archive-wrapper">
								<div class="lsx-to-tour-content">
									<div class="entry-content col-xs-12 col-sm-12 col-md-12 lsx-to-tour-content">
										<div class="tab-pane <?php echo $active; ?>" id="dates-prices">
											<?php
											$dates_prices = get_post_meta( get_the_ID(), 'bs_tour_dates_prices', false );
											?>
											<article id="post-<?php the_ID(); ?>" class="dates-prices hentry">
												<?php

												if ( $dates_prices ) {
													?>
													<table class="table table-striped">
																<?php
																$body_array = false;

																$start_date_column    = false;
																$end_date_column      = false;
																$price_sharing_column = false;
																$single_add_column    = false;
																$park_fees_column     = false;
																$footnote_column      = false;

																foreach ( $dates_prices as $row ) {
																	$currency = get_post_meta( get_the_ID(), 'bs_tour_currency', true );
																	switch ( $currency ) {
																		case 'USD':
																			$symbol = '$';
																			break;

																		case 'EUR':
																			$symbol = '€';
																			break;

																		case 'GBP':
																			$symbol = '£';
																			break;

																		case 'ZAR':
																			$symbol = 'R';
																			break;

																		case 'CAD':
																			$symbol = '$';
																			break;

																		default:
																			$symbol   = '$';
																			$currency = 'USD';
																			break;
																	}

																	if ( 'USD' == $currency || 'CAD' == $currency ) {
																		$currency_letter = ' ' . $currency;
																	} else {
																		$currency_letter = ' '; }

																	$tab_row = '<tr>';

																	if ( $row['start_date'] ) {
																		$tab_row          .= '<td class="start-date" data-gform-date="' . date( 'm/d/Y', strtotime( $row['start_date'] ) ) . '">' . date( 'd M Y', strtotime( $row['start_date'] ) ) . '</td>';
																		$start_date_column = true;
																	}
																	if ( $row['end_date'] ) {
																		$tab_row        .= '<td class="end-date" data-gform-date="' . date( 'm/d/Y', strtotime( $row['end_date'] ) ) . '">' . date( 'd M Y', strtotime( $row['end_date'] ) ) . '</td>';
																		$end_date_column = true;
																	}
																	if ( $row['price_sharing'] ) {
																		$tab_row             .= '<td class="price-sharing"><span class="amount"  data-currency="' . $currency . '">' . $currency_letter . ' ' . $symbol . $row['price_sharing'] . '</span></td>';
																		$price_sharing_column = true;
																	}
																	if ( $row['single_add'] ) {
																		$tab_row          .= '<td class="single-add"><span class="amount" data-currency="' . $currency . '">' . $currency_letter . ' ' . $symbol . $row['single_add'] . '</span></td>';
																		$single_add_column = true;
																	}
																	if ( $row['park_fees'] ) {
																		$tab_row         .= '<td class="park-fees"><span class="amount" data-currency="' . $currency . '">' . $currency_letter . ' ' . $symbol . $row['park_fees'] . '</span></td>';
																		$park_fees_column = true;
																	}

																	$tab_row .= '<td class="book-now-wrapper"><button data-toggle="modal" data-target="#tour-request-modal" data-title="' . get_the_title( get_the_ID() ) . '" class="btn btn-default dates-prices-book-now popup-inquire">Book Now</button></td>';

																	$tab_row .= '</tr>';

																	$body_array[] = $tab_row;
																}
																?>

														<thead>
															<tr>
																<?php
																if ( $start_date_column ) {
																	echo '<th>Start Date:</th>';
																}
																if ( $end_date_column ) {
																	echo '<th>End Date:</th>';
																}
																if ( $price_sharing_column ) {
																	echo '<th>Price Sharing:</th>';
																}
																if ( $single_add_column ) {
																	echo '<th>Single Add:</th>';
																}
																if ( $park_fees_column ) {
																	echo '<th>Park Fees:</th>';
																}
																echo '<th></th>';
																?>
															</tr>
														</thead>

														<tbody>
															<?php
															if ( false != $body_array ) {
																echo implode( '', $body_array );
															}
															?>
														<tbody>
													</table>
													<?php
												}
												?>

												<?php
												$footnote = get_post_meta( get_the_ID(), 'bs_tour_footnote', true );
												if ( false != $footnote ) {
													echo '<p>' . $footnote . '</p>';
												}
												?>
												<div class="clearfix"></div>
											</article><!-- #post-## -->
										</div>

										<?php
										$active = '';
										$tour_included     = lsx_to_included( '', '', false );
										$tour_not_included = lsx_to_not_included( '', '', false );

										if ( null !== $tour_included || null !== $tour_not_included ) {
											$class = 'col-xs-12 col-sm-6';

											if ( ( null === $tour_included && null !== $tour_not_included ) || ( null !== $tour_included && null === $tour_not_included ) ) {
												$class = 'col-xs-12';
											}
											?>

											<div class="intab">
												<button class="intablink" id="includes" onclick="openinCity(event, 'Include')"><?php esc_html_e( 'Included', 'tour-operator' ); ?></button>
												<button class="intablink" id="excludes" onclick="openinCity(event, 'Exclude')"><?php esc_html_e( 'Excluded', 'tour-operator' ); ?></button>
											</div>
											<h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title hidden-lg" <?php lsx_to_collapsible_attributes_not_post( 'collapse-included-excluded' ); ?>><?php esc_html_e( 'Included / Not Included', 'tour-operator' ); ?></h2>

											<?php
											if ( null !== $tour_included ) {
												?>
												<div id="Include" class="intabcontent" style="display: block;">
													<div class=" included">
														<div class="entry-content">
															<?php echo wp_kses_post( apply_filters( 'the_content', wpautop( $tour_included ) ) ); ?>
														</div>
													</div>
												</div>
											<?php
											}
											if ( null !== $tour_not_included ) {
												?>
												<div id="Exclude" class="intabcontent" >
													<div class="not-included">
														<div class="entry-content">
															<?php echo wp_kses_post( apply_filters( 'the_content', wpautop( $tour_not_included ) ) ); ?>
														</div>
													</div>
												</div>
											<?php
											}
										}
									?>
								</div>
							</div>
						</div>
					</div>
							
					<?php lsx_entry_bottom(); ?>

				</article>

				<?php
				lsx_entry_after();
				}
			}
			wp_reset_query();
			?>
		</div>
	</div>
	<div class="lsx-single-contact">
						<div class="tours-nav">
							<div class="col-md-4">
								<button class="btn lsx-btn popup-inquire">Book It!</button>
							</div>
							<div class="col-md-4">
								<button class="btn lsx-btn">DOWNLOAD ITINERY</button>
							</div>
							<div class="col-md-4 dropdown-share">
								<button class="btn lsx-btn -lsx-share-initiated">Share with a Friend</button>
								<div class="dropdown-content">
								<?php
				if ( class_exists( 'LSX_Sharing' ) ) {
					lsx_content_sharing();
				} else {
					if ( function_exists( 'sharing_display' ) ) {
						sharing_display( '', true );
					}
				}
				?>
 								 </div>
							</div>
						</div>
						</div>
</div>
