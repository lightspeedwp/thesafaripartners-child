<?php
/**
 * Tour Single Template
 *
 * @package     tour-operator
 * @category    tour
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area wizard-landing col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

					<div id="collapse-summary" class="collapse in">
						<div class="collapse-inner">
							<div class="row">


								<div class="col-md-12 outer-container">
									<div class="tab">

												<button class="tablinks tours-wizard" id="tours-wizard" onclick="openCity(event, 'Overview')">Overview</button>
												<button class="tablinks" id="page-1" onclick="openCity(event, 'Day')">Day by Day</button>
												<button class="tablinks" id="page-3" onclick="openCity(event, 'Accommodation')">Accommodation</button>
												<button class="tablinks" id="page-4" onclick="openCity(event, 'Price')">Dates & Prices</button>
												<button class="tablinks" id="page-5" onclick="openCity(event, 'Maps')">Maps & More</button>

									</div>
								</div>

												<?php get_template_part( 'partials/tour-wizard', 'overview' ); ?>

										


												<div id="Accommodation" class="tabcontent">
													<div class="col-md-12 col-sm-12">
														<div class="lsx-tour-module">
															<?php if ( have_posts() ) : ?>

																<?php
																while ( have_posts() ) :
																	the_post();
																?>

																<?php lsx_entry_before(); ?>

																<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>
																	<?php lsx_entry_top(); ?>
																	<div class="col-md-6 lsx-tour-module-image">
																		<div class="lsx-banner-image-wrap">

																		<div class="lsx-to-thumb-slot" >

																			<?php lsx_to_gallery(); ?>
																		</div>

																	</div>
																	</div>

																	<div class="col-xs-12 col-sm-12 col-md-6">
																	<div class="lsx-to-archive-wrapper">
																		<div class="lsx-to-tour-content">
																		<div class="entry-content col-xs-12 col-sm-12 col-md-12 lsx-to-tour-content">
																			<div class="lsx-to-summary">
																				<h2 class="lsx-to-summary-title">Accommodation</h2>

																			</div>


                                  <?php lsx_to_connected_accommodation();

                                  lsx_to_accommodation_posts();?>


																		</div></div></div></div>
                                  </div>


																	<?php lsx_entry_bottom(); ?>

																</article>

																<?php
																lsx_entry_after(); ?>

																<?php endwhile; ?>

															<?php endif; ?>
															<?php	wp_reset_query(); ?>
													</div>
												</div>

												<div id="Price" class="tabcontent">
													<div class="col-md-12 col-sm-12">
														<div class="lsx-tour-module">
															<?php if ( have_posts() ) : ?>

																<?php
																while ( have_posts() ) :
																	the_post();
																?>

																<?php lsx_entry_before(); ?>

																<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>
																	<?php lsx_entry_top(); ?>
																	<div class="col-md-6 lsx-tour-module-image">
																		<div class="lsx-banner-image-wrap">

																		<div class="lsx-to-thumb-slot" >
																			<picture>
																				<?php echo get_the_post_thumbnail($page->ID,'full'); ?>
																				<picture>
																		</div>

																	</div>
																	</div>

																	<div class="col-xs-12 col-sm-12 col-md-6">
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

  				$start_date_column = false;
  				$end_date_column = false;
  				$price_sharing_column = false;
  				$single_add_column = false;
  				$park_fees_column = false;
  				$footnote_column = false;

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
  							$symbol = '$';
  							$currency = 'USD';
  							break;
  					}

  					if('USD' == $currency || 'CAD' == $currency){ $currency_letter = ' '.$currency; }else{ $currency_letter = ' '; }

  					$tab_row = '<tr>';

  					if($row['start_date']){
  						$tab_row .= '<td class="start-date" data-gform-date="'.date( 'm/d/Y', strtotime( $row['start_date'] ) ).'">'.date( 'd M Y', strtotime( $row['start_date'] ) ).'</td>';
  						$start_date_column = true;
  					}
  					if($row['end_date']){
  						$tab_row .= '<td class="end-date" data-gform-date="'.date( 'm/d/Y', strtotime( $row['end_date'] ) ).'">'.date( 'd M Y', strtotime( $row['end_date'] ) ).'</td>';
  						$end_date_column = true;
  					}
  					if($row['price_sharing']){
  						$tab_row .= '<td class="price-sharing"><span class="amount"  data-currency="'.$currency.'">'.$currency_letter.' '.$symbol.$row['price_sharing'].'</span></td>';
  						$price_sharing_column = true;
  					}
  					if($row['single_add']){
  						$tab_row .= '<td class="single-add"><span class="amount" data-currency="'.$currency.'">'.$currency_letter.' '.$symbol.$row['single_add'].'</span></td>';
  						$single_add_column = true;
  					}
  					if($row['park_fees']){
  						$tab_row .= '<td class="park-fees"><span class="amount" data-currency="'.$currency.'">'.$currency_letter.' '.$symbol.$row['park_fees'].'</span></td>';
  						$park_fees_column = true;
  					}

  					$tab_row .= '<td class="book-now-wrapper"><button data-toggle="modal" data-target="#tour-request-modal" data-title="'.get_the_title(get_the_ID()).'" class="btn btn-default dates-prices-book-now">Book Now</button></td>';

  					$tab_row .= '</tr>';

  					$body_array[] = $tab_row;
  				}
  				?>

  				<thead>
  					<tr>
  						<?php
  						if($start_date_column){
  							echo '<th>Start Date:</th>';
  						}
  						if($end_date_column){
  							echo '<th>End Date:</th>';
  						}
  						if($price_sharing_column){
  							echo '<th>Price Sharing:</th>';
  						}
  						if($single_add_column){
  							echo '<th>Single Add:</th>';
  						}
  						if($park_fees_column){
  							echo '<th>Park Fees:</th>';
  						}
  						echo '<th></th>';
  						?>
  				  	</tr>
  				</thead>

  				<tbody>
  					<?php
  						if(false != $body_array){
  							echo implode('' , $body_array);
  						}
  					?>
  				<tbody>
  			</table>
  		<?php
  		} ?>

  		<?php
  		$footnote = get_post_meta( get_the_ID(), 'bs_tour_footnote', true );
  		if(false != $footnote){
  			echo '<p>'.$footnote.'</p>';
  		}
  		?>



  	<div class="clearfix"></div>
  </article><!-- #post-## -->
  		  	</div>
  		  	<?php
  			$active = "";
  			// wp_reset_query();
  		?>



                                            <?php  $tour_included = lsx_to_included( '', '', false );
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




                                                                <div id="Include" class="intabcontent" style="display: block;">
                                                                  <?php if ( null !== $tour_included ) { ?>
                                                  							<div class=" included">
                                                  								<div class="entry-content">
                                                  									<?php echo wp_kses_post( apply_filters( 'the_content', wpautop( $tour_included ) ) ); ?>
                                                  								</div>
                                                  							</div>
                                                                </div>

                                                                <div id="Exclude" class="intabcontent" >
                                                                  <?php
                                                                              }
                                                                  if ( null !== $tour_not_included ) {
                                                                              ?>
                                                  							<div class="not-included">
                                                  								<div class="entry-content">
                                                  									<?php echo wp_kses_post( apply_filters( 'the_content', wpautop( $tour_not_included ) ) ); ?>
                                                  								</div>
                                                  							</div>
                                                                </div>
                                                  						<?php } ?>


                                                  	<?php
                                                  	} ?>

																		</div></div></div></div>
</div>


																	<?php lsx_entry_bottom(); ?>

																</article>

																<?php
																lsx_entry_after(); ?>

																<?php endwhile; ?>

															<?php endif; ?>
															<?php	wp_reset_query(); ?>
													</div>
												</div>



												<div id="Maps" class="tabcontent">
													<div class="col-md-12 col-sm-12">
														<div class="lsx-tour-module">
															<?php if ( have_posts() ) : ?>

																<?php
																while ( have_posts() ) :
																	the_post();
																?>

																<?php lsx_entry_before(); ?>

																<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>
																	<?php lsx_entry_top(); ?>
																	<div class="col-md-6 lsx-tour-module-image">
																		<div class="lsx-banner-image-wrap">

																		<div class="lsx-to-thumb-slot" >
																			<?php lsx_to_map(); ?>
																		</div>

																	</div>
																	</div>

																	<div class="col-xs-12 col-sm-12 col-md-6">
																	<div class="lsx-to-archive-wrapper">
																		<div class="lsx-to-tour-content">
																		<div class="entry-content col-xs-12 col-sm-12 col-md-12 lsx-to-tour-content">

  																				<h4 class="lsx-to-summary-title"><?php the_title(); ?></h4>

  																			</div>

  																			<?php lsx_to_price( '<p class="lsx-to-meta-data lsx-to-meta-data-big lsx-to-meta-data-price"><span class="lsx-to-meta-data-key">' . esc_html__( 'From price', 'tour-operator' ) . ':</span> ', '</p>' ); ?>
                                        <?php lsx_to_tour_single_fast_facts(); ?>
                                          <?php lsx_to_related_items( 'travel-style' );

		                                          $connected_tours = get_post_meta( get_the_ID(), 'tour_to_accommodation', false );

		                                            if ( lsx_to_accommodation_display_connected_tours() && post_type_exists( 'tour' ) && is_array( $connected_tours ) && ! empty( $connected_tours ) ) {
			                                               lsx_to_related_items( $connected_tours, true, 'tour' );
		                                                 } ?>
  																		</div>




																		</div></div></div></div>
</div>


																	<?php lsx_entry_bottom(); ?>

																</article>

																<?php
																lsx_entry_after(); ?>

																<?php endwhile; ?>

															<?php endif; ?>
															<?php	wp_reset_query(); ?>
													</div>
												</div>



												<div class="tours-nav">
													<div class="col-md-4">
														<button class="btn lsx-btn popup-inquire">Book It!</button>
														</div>
														<div class="col-md-4">
															<button class="btn lsx-btn">Find out more</button>
															</div>
															<div class="col-md-4">
																<button class="btn lsx-btn">Share with a Friend</button>
																</div>
												</div>

</div></div></div>
			<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php
get_footer();
