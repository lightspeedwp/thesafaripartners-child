<?php
/**
 * LSX Starter Child functions
 *
 * @package thesafaripartners-child
 */


function tsp_init_wizard() {
	wp_enqueue_script( 'thesafaripartners-child-wizard-bootstrap', get_stylesheet_directory_uri() . '/assets/js/wizard.js', array( 'jquery' ), TSP_CHILD_VER, true );
	wp_enqueue_script( 'thesafaripartners-child-wizard', get_stylesheet_directory_uri() . '/assets/js/wizard.js', array( 'jquery', 'thesafaripartners-child-wizard-bootstrap' ), TSP_CHILD_VER, true );
}


function tsp_mini_wizard( $panels = array() ) {
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
						get_template_part( 'partials/mini-wizard', $panel_content );
					}
					echo '</div>';
				} else {
					echo '<div class="lsx-wizard-step ' . $active . '">';
					echo wp_kses_post( '<h4>' . $panel . '</h4>' );
					get_template_part( 'partials/mini-wizard', $panel );
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