<?php
/**
 * LSX Starter Child functions
 *
 * @package thesafaripartners-child
 */


function tsp_init_wizard() {
	wp_enqueue_script( 'thesafaripartners-child-wizard', get_stylesheet_directory_uri() . '/assets/js/wizard.js', array( 'jquery' ), TSP_CHILD_VER, true );
	$param_array = array(
		'auth'    => 'bGlnaHRzcGVlZDpkM3ZvbnN0ckBAdDQ2',
		'homeURL' => home_url('/'),
	);
	wp_localize_script( 'thesafaripartners-child-wizard', 'tsp_wizard_params', $param_array );
}


function tsp_mini_wizard( $panels = array(), $args = array() ) {
	if ( empty( $panels ) ) {
		return;
	}
	?>
	<form class="mini-wizard-wrapper" action="<?php echo home_url('/'); ?>" method="GET">

		<?php 
		if ( isset( $panels['intro'] ) ) {
			get_template_part( 'partials/mini-wizard', $panels['intro'] );
		}
		?>

		<div id="wizard" class="lsx-wizard mini-wizard-form" style="display: none;">
			<?php
			$counter = 0;
			foreach ( $panels as $panel_key => $panel  ) {

				if ( 'intro' === $panel_key ) {
					continue;
				}

				if ( 0 === $counter ) {
					$active = 'active';
				} else {
					$active = '';
				}
				if ( is_array( $panel ) ) {
					echo '<div class="lsx-wizard-step ' . $active . '">';
					echo wp_kses_post( '<h4>' . implode( '-', $panel ) . '</h4>' );
					foreach ( $panel as $panel_content ) {
						get_template_part( 'partials/mini-wizard', $panel_content, $args );
					}
					echo '</div>';
				} else {
					echo '<div class="lsx-wizard-step ' . $active . '">';
					echo wp_kses_post( '<h4>' . $panel . '</h4>' );
					get_template_part( 'partials/mini-wizard', $panel, $args );
					echo '</div>';
				}

				$counter++;
			}

			tsp_init_wizard();
			?>
		</div>
	</form>
	<?php
}

function tsp_mini_wizard_results( $query_args = array(), $panel_args = array() ) {
	if ( empty( $query_args ) ) {
		return;
	}
	$tours = new WP_Query( $query_args );
	if ( $tours->have_posts() ) {
		global $lsx_to_archive;
		$lsx_to_archive = 1;

		$selected = array();
		if ( ! empty( $panel_args ) && isset( $panel_args['selected'] ) && ! empty( $panel_args['selected'] ) ) {
			$selected = $panel_args['selected'];
		}

		?>
		<div class="facetwp-hidden-filters hidden">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'filter-menu',
				)
			);
			?>
		</div>
		<div class="tsp-seperator"></div>

		<div class="slider-container mini-wizard-results lsx-to-widget-items lsx-to-archive-template-grid toptours-posts" >
			<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>">
			<div class="lsx-to-slider-wrap">
				<div class="lsx-to-slider-inner slick-slider" data-interval="6000" data-slick='{ "slidesToShow": 4, "slidesToScroll": 4 }'>
					<?php
					while ( $tours->have_posts() ) {
						$tours->the_post();

						if ( ! empty( $selected ) && in_array( get_the_ID(), $selected ) ) {
							continue;
						}
						?>
						<div class="<?php echo esc_attr( lsx_to_archive_class( 'lsx-to-widget-item-wrap lsx-tour' ) ); ?>">
							<?php lsx_to_content( 'content-widget', 'tour' ); ?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			</div>
		</div>

		<?php
	} else {
	get_template_part( 'partials/content', 'none' );
	} 
	wp_reset_query();
}

/**
 * Adding in afunction to call the search relevance.
 *
 * @param integer $post_id
 * @return string
 */
function tsp_get_search_relevance( $post_id = 0 ) {
	global $search_relevance;
	$return = '';
	if ( 0 !== $post_id && null !== $search_relevance && isset( $search_relevance[ $post_id ] ) ) {
		switch ( $search_relevance[ $post_id ] ) {
			case $search_relevance[ $post_id ] > 80 :
				$relevance_class = 'red';
				break;
			default:
				$relevance_class = 'orange';
				break;
		}
		$return = '<span class="' . $relevance_class . '">' . $search_relevance[ $post_id ] . '%</span>';
	}
	return $return;
}

/**
 * Outputs the accommodation gallery ready as a slider.
 *
 * @param integer $post_id
 * @return string
 */
function tsp_accommodation_gallery( $post_id = 0 ) {
	$return = '';
	if ( 0 !== $post_id ) {
		?>
		<div class="tour-accommodation-gallery" data-slider-id="<?php echo esc_attr( $post_id ); ?>">
			<div class="lsx-banner-image-wrap placeholder-image">
				<?php echo get_the_post_thumbnail( $post_id, 'full' ); ?>
			</div>
			<div class="slider-content accom-slider-<?php echo esc_attr( $post_id ); ?>" style="display:none;">
				<?php
					$gallery_images = get_post_meta( $post_id, 'gallery', false );
					if ( ! empty( $gallery_images ) ) {
						$slider_content = array( '<div class="accomodation-slider lsx-to-slider-inner">' );
						$slider_nav     = array( '<div class="accomodation-nav lsx-to-slider-inner">' );

						$slider_content[] = '<div class="image-slide">' .get_the_post_thumbnail( $post_id, 'large' ) . '</div>';
						$slider_nav[]     = '<div class="nav-slide">' . get_the_post_thumbnail( $post_id, 'thumbnail-wide' ) . '</div>';

						foreach ( $gallery_images as $gallery_image ) {
							$slider_content[] = '<div class="image-slide">' . wp_get_attachment_image( $gallery_image, 'large' ) . '</div>';
							$slider_nav[]     = '<div class="nav-slide">' . wp_get_attachment_image( $gallery_image, 'thumbnail-wide' ) . '</div>';
						}

						$slider_content[] = '</div>';
						$slider_nav[]     = '</div>';

						echo wp_kses_post( implode( '', $slider_content ) );
						echo wp_kses_post( implode( '', $slider_nav ) );
					}
				?>
			</div>
		</div>
		<?php
	}
	return $return;
}