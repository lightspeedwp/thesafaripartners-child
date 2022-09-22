<?php
/**
 * Destination Single Template
 *
 * @package     tour-operator
 * @category    destination
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

			<?php
			while ( have_posts() ) :
				the_post();
				?>
					
							<div class="content-area col-sm-12 col-sm-12">
								<?php lsx_to_content( 'content', 'destination' ); ?>
							</div>
						
		

			<?php endwhile; ?>

			<?php
				$panels = array(
					0 => array( 'who' ),
					1 => array( 'what' ),
					2 => array( 'where' ),
					3 => array( 'when' ),
					4 => array( 'budget' ),
				);
				$args = array(
					'title'    => get_post_meta( get_the_ID(), 'shaman_title', true ),
					'tagline'  => get_post_meta( get_the_ID(), 'shaman_tagline', true ),
					'selected' => array( get_the_ID() ),
				);

				// Call the intro
				get_template_part( 'partials/shaman', 'intro', $args );

				// Call the wizard
				tsp_mini_wizard( $panels, $args );
			?>

			<?php
				$current_destination = get_the_ID();
				$tours               = get_post_meta( get_the_ID(), 'tour_to_destination', false );

				if ( false !== $tours && ! empty( $tours ) && '' !== $tours ) {
					$query_args = array(
						'post_type' => 'tour',
						'post_status' => 'publish',
						'facetwp' => true,
						'post__in' => $tours,
						'posts_per_page' => 100,
					);
					tsp_mini_wizard_results( $query_args, $args );
				}
			?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php
get_footer();