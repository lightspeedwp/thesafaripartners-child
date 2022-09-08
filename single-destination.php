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

				<section class="lsx-to-section-new <?php lsx_to_collapsible_class( 'destination', false ); ?>">
					<h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title hidden-lg" <?php lsx_to_collapsible_attributes_not_post( 'collapse-summary' ); ?>><?php esc_html_e( 'Summary', 'tour-operator' ); ?></h2>

					
							<div class="content-area col-sm-12 col-sm-12">
								<?php lsx_to_content( 'content', 'destination' ); ?>
							</div>
						
				</section>

			<?php endwhile; ?>

			<?php get_template_part( 'partials/shaman-intro', '1' ); ?>


			<?php
				$panels = array(
					0 => array( 'who' ),
					1 => array( 'what' ),
					2 => array( 'where' ),
					3 => array( 'when' ),
					4 => array( 'budget' ),
				);
				$args = array( 
					'selected' => array( get_the_ID() ),
					'title' => get_post_meta( get_the_ID(), 'shaman_title', true ),
				);
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