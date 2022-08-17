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

											$price_row_amount = get_post_meta( get_the_ID(), 'price_row', true );
											if ( false !== $price_row_amount && 0 !== $price_row_amount ) {

												$column_titles   = array();
												$table_data      = array();
												$row_counter     = 0;
												$currency        = 'USD';
												$currency_letter = 'USD';
												$symbol          = '$';

												// Grab the rows and process the data
												do {
													// Grab all of the row data
													$rc_num  = 1;
													$rc_data = array();

													do {

														$value = get_post_meta( get_the_ID(), 'price_row_' . $row_counter . '_column_' . $rc_num, true );
														if ( '' !== $value && false !== $value ) {
															switch( $rc_num ) {
																case 1:
																case 2:
																	$rc_data[ $rc_num - 1 ] = '<td class="date" data-gform-date="' . date( 'm/d/Y', strtotime( $value ) ) . '">' . date( 'd M Y', strtotime( $value ) ) . '</td>';
																	break;

																default:
																	$rc_data[ $rc_num - 1 ] = '<td class="park-fees"><span class="amount" data-currency="' . $currency . '">' . $currency_letter . ' ' . $symbol . $value . '</span></td>';
																	break;
															}
														}
														$rc_num++;

													} while ( 7 > $rc_num );

													$column_titles              = array_keys( $rc_data );

													$rc_data[] = '<td class="book-now-wrapper"><button data-toggle="modal" data-target="#tour-request-modal" data-title="' . get_the_title( get_the_ID() ) . '" class="btn btn-default dates-prices-book-now popup-inquire">Book Now</button></td>';

													$table_data[ $row_counter ] = implode( '', $rc_data );
													$row_counter++;
												} while ( $row_counter < $price_row_amount );


												if ( ! empty( $table_data ) && isset( $table_data[0] ) && ! empty( $table_data[0] ) ) {
													?>
														<article id="post-<?php the_ID(); ?>" class="dates-prices hentry">
															<table class="table table-striped">
																<thead>
																	<tr>
																		<?php
																		// Format the column Titles
																		foreach( $column_titles as $column_index ) {
																			echo '<th>' . get_post_meta( get_the_ID(), 'column_titles_column_' . $column_index, true ) . '</th>';
																		}
																		echo '<th></th>';
																		?>
																	</tr>
																</thead>
																<tbody>
																	<tr><?php echo implode( '</tr><tr>', $table_data ); ?></tr>
																</tbody>
															</table>
														</article>
													<?php
												}
											}
											?>
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
