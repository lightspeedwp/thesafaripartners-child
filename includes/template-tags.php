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
	<form id="wizard" class="lsx-wizard mini-wizard-form" action="<?php echo home_url('/'); ?>" method="GET" style="display: none;">

		<?php
		$counter = 0;
		foreach ( $panels as $panel  ) {
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
	</form>

	<div class="facetwp-hidden-filters hidden" style="display:none;">
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'filter-menu',
				)
			);
		?>
	</div>
	<?php
}