<?php
/**
 * Template Name: Travel Style
 *
 * @package lsx
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

		<?php lsx_content_top(); ?>

		<?php if ( have_posts() ) : ?>

			<?php
			while ( have_posts() ) :
				the_post();
			?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

			<?php endwhile; ?>

		<?php endif; ?>
		<?php wp_reset_query(); ?>

		<div class="notfull">

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
				);

				// Call the intro
				get_template_part( 'partials/shaman', 'intro', $args );

				// Call the wizard
				tsp_mini_wizard( $panels, $args );


				$query_args = array(
					'post_type' => 'tour',
					'post_status' => 'publish',
					'facetwp' => true,
					'posts_per_page' => -1,
				);
				tsp_mini_wizard_results( $query_args, $args ); ?>

			<?php lsx_content_bottom(); ?>
			</div>
		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php // get_sidebar(); ?>

<?php
get_footer();
