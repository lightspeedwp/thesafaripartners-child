<?php
/**
 * Tour Single Template
 *
 * @package     tour-operator
 * @category    tour
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">
			<?php lsx_content_top(); ?>

			<?php
			while ( have_posts() ) :
				the_post();
				?>

				<section id="overview" class="content-area clearfix <?php lsx_to_collapsible_class( 'tour', true ); ?>">
                    <div class="tsp-collapse-title lsx-to-collapse-title lsx-title text-center visible-xs" <?php lsx_to_collapsible_attributes_not_post( 'collapse-overview' ); ?>><?php esc_html_e( 'Overview', 'tour-operator' ); ?></div>
                    <div id="collapse-overview" class="collapse in">
                        <div class="collapse-inner">
                            <?php get_template_part( 'content', 'tour' ); ?>
                        </div>
                    </div>
				</section>

			<?php endwhile; ?>

			<?php lsx_content_bottom(); ?>

            <?php
            // Maps
            if ( function_exists( 'lsx_to_has_map' ) && lsx_to_has_map() ) {
            ?>
            <section id="tour-map" class="lsx-to-section <?php lsx_to_collapsible_class( 'tour', false ); ?>">
                <div class="tsp-collapse-title lsx-to-collapse-title lsx-title text-center visible-xs" <?php lsx_to_collapsible_attributes_not_post( 'collapse-tour-map' ); ?>><?php esc_html_e( 'Map', 'tour-operator' ); ?></div>

                <div id="collapse-tour-map" class="collapse in">
                    <div class="collapse-inner">
                        <h2 class="tsp-section-title text-center"><?php esc_html_e( 'Map', 'tour-operator' ); ?></h2>
                        <?php lsx_to_map(); ?>
                    </div>
                </div>
            </section>
            <?php
			}

            if( tsp_has_gallery()) { ?>
                <section id="gallery" class="lsx-to-section <?php lsx_to_collapsible_class( 'tour', false ); ?>">
                    <div class="tsp-collapse-title lsx-to-collapse-title lsx-title text-center visible-xs" <?php lsx_to_collapsible_attributes_not_post( 'collapse-gallery' ); ?>><?php esc_html_e( 'Gallery', 'tour-operator' ); ?></div>

                    <div id="collapse-gallery" class="collapse in">
                        <div class="collapse-inner">
                            <h2 class="tsp-section-title text-center"><?php esc_html_e( 'Gallery', 'tour-operator' ); ?></h2>
                            <?php lsx_to_gallery(); ?>
                        </div>
                    </div>
                </section>
            <?php }

			if ( function_exists( 'lsx_to_videos' ) ) {
				lsx_to_videos( '<section id="videos" class="lsx-to-section ' . lsx_to_collapsible_class() . '"><h2 class="tsp-section-title lsx-to-collapse-title lsx-title" ' . lsx_to_collapsible_attributes( 'collapse-videos' ) . '>' . esc_html__( 'Videos', 'tour-operator' ) . '</h2><div id="collapse-videos" class="collapse"><div class="collapse-inner">', '</div></div></section>' );
			} elseif ( class_exists( 'Envira_Videos' ) ) {
				lsx_to_envira_videos( '<section id="videos" class="lsx-to-section ' . lsx_to_collapsible_class() . '"><h2 class="tsp-section-title lsx-to-collapse-title lsx-title" ' . lsx_to_collapsible_attributes( 'collapse-videos' ) . '>' . esc_html__( 'Videos', 'tour-operator' ) . '</h2><div id="collapse-videos" class="collapse"><div class="collapse-inner">', '</div></div></section>' );
			}

			// Itinerary
			if ( lsx_to_has_itinerary() ) {
				$itinerary_count = 1;
				?>
				<section id="itinerary" class="lsx-to-section <?php lsx_to_collapsible_class( 'tour', false ); ?>">
                    <div class="tsp-collapse-title lsx-to-collapse-title lsx-title text-center visible-xs" <?php lsx_to_collapsible_attributes_not_post( 'collapse-itinerary' ); ?>><?php esc_html_e( 'Day-by-Day Itinerary', 'tour-operator' ); ?></div>

					<div id="collapse-itinerary" class="collapse in">
						<div class="collapse-inner">
                            <h2 class="tsp-section-title text-center"><?php esc_html_e( 'Day-by-Day Itinerary', 'tour-operator' ); ?></h2>

							<div class="tsp-itinerary-list">
								<?php while ( lsx_to_itinerary_loop() ) { ?>
									<?php
										lsx_to_itinerary_loop_item();
										$thumb = lsx_to_itinerary_thumbnail('lsx-thumbnail-single');
									?>

									<div id="day-<?php echo esc_attr( $itinerary_count ); ?>" <?php lsx_to_itinerary_class( 'tsp-itinerary-day' ); ?>>
                                            <div class="tsp-itinerary-content">
                                                <h3><?php tsp_itinerary_title(); ?></h3>
                                                <?php
                                                lsx_to_itinerary_accommodation( '<div><i class="tsp-icon tsp-icon-accommodation"></i><span class="tsp-meta-key">' . esc_html__( 'Accommodation', 'tour-operator' ) . ': </span> ', '</div>' );
                                                lsx_to_itinerary_room_basis( '<div><i class="tsp-icon tsp-icon-room-basis"></i><span class="tsp-meta-key">' . esc_html__( 'Room basis', 'tour-operator' ) . ': </span> ', '</div>' );
                                                ?>
                                                <div class="entry-content">
                                                    <?php tsp_itinerary_description(); ?>
                                                </div>
                                            </div>

                                        <div class="tsp-itinerary-thumb">
                                            <?php echo wp_kses_post( '<img alt="thumbnail" class="attachment-responsive wp-post-image lsx-responsive" src="' . $thumb . '">' ); ?>
                                        </div>
									</div>
									<?php
									$itinerary_count++;
								}
								?>
							</div>
						</div>
					</div>

					<?php lsx_to_itinerary_read_more(); ?>
				</section>
			<?php
			}


            if (tsp_has_prices()) { ?>
            <section id="dates-prices" class="lsx-to-section <?php lsx_to_collapsible_class( 'tour', false ); ?>">
                <div class="tsp-collapse-title lsx-to-collapse-title lsx-title text-center visible-xs" <?php lsx_to_collapsible_attributes_not_post( 'collapse-dates-prices' ); ?>><?php esc_html_e( 'Dates & Prices', 'tour-operator' ); ?></div>

                <div id="collapse-dates-prices" class="collapse in">
                    <div class="collapse-inner">
                        <h2 class="tsp-section-title text-center"><?php esc_html_e( 'Dates & Prices', 'tour-operator' ); ?></h2>

                        <?php
                        $price_row_amount = get_post_meta(get_the_ID(), 'price_row', true);
                        if (false !== $price_row_amount && 0 !== $price_row_amount) {

                            $column_titles = array();
                            $table_data = array();
                            $row_counter = 0;
                            $currency = 'USD';
                            $currency_letter = 'USD';
                            $symbol = '$';

                            // Grab the rows and process the data
                            do {
                                // Grab all of the row data
                                $rc_num = 1;
                                $rc_data = array();
                                $btn_val = '';
                                $skip_row = false;

                                //date check
                                $start_date = get_post_meta(get_the_ID(), 'price_row_' . $row_counter . '_column_2', true);
                                if ('' !== $start_date && false !== $start_date) {
                                    $now = strtotime('now');
                                    $start_date2 = strtotime($start_date);
                                    if ($start_date2 < $now) {
                                        $skip_row = true;
                                    }
                                }

                                if (false === $skip_row) {
                                    do {
                                        $value = get_post_meta(get_the_ID(), 'price_row_' . $row_counter . '_column_' . $rc_num, true);
                                        if ('' !== $value && false !== $value) {
                                            switch ($rc_num) {
                                                case 1:
                                                    $rc_data[$rc_num - 1] = '<td class="date" data-gform-date="' . date('m/d/Y', strtotime($value)) . '">' . date('d M Y', strtotime($value)) . '</td>';
                                                    $btn_val = date('m/d/Y', strtotime($value));
                                                    break;

                                                case 2:
                                                    $rc_data[$rc_num - 1] = '<td class="date" data-gform-date="' . date('m/d/Y', strtotime($value)) . '">' . date('d M Y', strtotime($value)) . '</td>';
                                                    $btn_val .= '-' . date('m/d/Y', strtotime($value));
                                                    break;

                                                default:
                                                    if (function_exists('lsx_currencies_get_price_html')) {
                                                        $args = array(
                                                                'currency_tag' => false,
                                                        );
                                                        $rc_data[$rc_num - 1] = '<td class="park-fees">' . lsx_currencies_get_price_html($value, get_the_ID(), $args) . '</td>';
                                                    } else {
                                                        $rc_data[$rc_num - 1] = '<td class="park-fees"><span class="amount" data-currency="' . $currency . '">' . ' ' . $symbol . $value . '</span></td>';
                                                    }
                                                    break;
                                            }
                                        }
                                        $rc_num++;

                                    } while (8 > $rc_num);

                                    $column_titles = array_keys($rc_data);

                                    $rc_data[] = '<td class="book-now-wrapper"><button data-toggle="modal" data-gform-value="' . $btn_val . '" data-target="#tour-request-modal" data-title="' . get_the_title(get_the_ID()) . '" class="btn btn-default dates-prices-book-now popup-inquire row-' . $row_counter . '">REQUEST DATE</button></td>';

                                    $table_data[$row_counter] = implode('', $rc_data);
                                }
                                $row_counter++;

                            } while ($row_counter < $price_row_amount);

                            if (!empty($table_data)) {
                                ?>
                                <article id="post-<?php the_ID(); ?>">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <?php
                                            // Format the column Titles
                                            $counter = 1;
                                            foreach ($column_titles as $column_index) {
                                                $style = '';
                                                if (1 === $counter || 2 === $counter) {
                                                    $style = 'style="min-width:120px"';
                                                }
                                                echo '<th ' . $style . '>' . get_post_meta(get_the_ID(), 'column_titles_column_' . $counter, true) . '</th>';
                                                $counter++;
                                            }

                                            echo '<th class="whitebg" style="min-width: 100px;">' . wp_nav_menu(
                                                            array(
                                                                    'theme_location' => 'currency-selector',
                                                                    'echo' => false,
                                                            ),
                                                    ) . '</th>';
                                            ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr><?php echo implode('</tr><tr>', $table_data); ?></tr>
                                        </tbody>
                                    </table>

                                    <?php
                                    $footnote = get_post_meta( get_the_ID(), 'prices_footnote', true );
                                    if ( false !== $footnote && '' !== $footnote ) {
                                        echo '<p class="footnote"><small>' . $footnote . '</small></p>';
                                    }
                                    ?>

                                    <?php if ( has_term( 'tailored-tour', 'tour-type' ) ) { ?>
                                        <p><?php esc_html_e('Dates reflect seasonality, please enquire for specific availability.', 'thesafaripartners-child'); ?></p>
                                    <?php } ?>

                                    <?php if (!empty($table_data)) { ?>
                                    <p>
                                        <?php esc_html_e( 'Prices are based on current exchange rates. The selling currency may be different from the one displayed.', 'thesafaripartners-child' ); ?>
                                    </p>

                                    <?php } ?>

                                    <?php tsp_included_block(); ?>
                                </article>
                                <?php
                            }
                        }

                    ?></div>
                </div>
            </section>
            <?php }


			if ( function_exists( 'lsx_to_tour_specials' ) ) {
				lsx_to_tour_specials();
			}

			if ( function_exists( 'tsp_tour_reviews' ) ) { ?>
                <section id="reviews" class="lsx-to-section <?php lsx_to_collapsible_class( 'tour', false ); ?>">
                    <div class="tsp-collapse-title lsx-to-collapse-title lsx-title text-center visible-xs" <?php lsx_to_collapsible_attributes_not_post( 'collapse-reviews' ); ?>><?php esc_html_e( 'Customer Reviews', 'tour-operator' ); ?></div>

                    <div id="collapse-reviews" class="collapse in">
                        <div class="collapse-inner">
                            <h2 class="tsp-section-title text-center"><?php esc_html_e( 'Customer Reviews', 'tour-operator' ); ?></h2>
                            <?php tsp_tour_reviews(); ?>
                        </div>
                    </div>
                </section>

			<?php } ?>
		</main><!-- #main -->
		<?php lsx_content_after(); ?>
	</div><!-- #primary -->
<?php lsx_content_wrap_after(); ?>
<?php
get_footer();
