<?php
/**
 * Destination Archive
 *
 * @package  tour-operator
 * @category destination
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

			<?php 
				$panels = array(
					0 => array( 'who' ),
					1 => array( 'what' ),
					3 => array( 'where' ),
					3 => array( 'when' ),
					4 => array( 'budget' ),
				);
				$args = array();
				tsp_mini_wizard( $panels, $args );
			?>

			<?php
				$current_destination = get_the_ID();
				$query_args = array(
					'post_type' => 'tour',
					'post_status' => 'publish',
					'facetwp' => true,
				);
				tsp_mini_wizard_results( $query_args, $args );
			?>

			<?php 
				$panels = array(
					0 => array( 'who' ),
					1 => array( 'what' ),
					3 => array( 'where' ),
					3 => array( 'when' ),
					4 => array( 'budget' ),
				);
				tsp_mini_wizard( $panels );
			?>

			<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php // get_sidebar(); ?>

<?php
get_footer();
