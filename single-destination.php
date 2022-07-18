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

				<section id="summary" class="lsx-to-section-new <?php lsx_to_collapsible_class( 'destination', false ); ?>">
					<h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title hidden-lg" <?php lsx_to_collapsible_attributes_not_post( 'collapse-summary' ); ?>><?php esc_html_e( 'Summary', 'tour-operator' ); ?></h2>

					<div id="collapse-summary" class="collapse in">
						<div class="collapse-inner">
							<div class="row">
								<?php lsx_to_content( 'content', 'destination' ); ?>
							</div>
						</div>
					</div>
				</section>


			<?php endwhile; ?><?php wp_reset_query(); ?>

		<?php get_template_part( 'partials/shaman-intro', '1' ); ?>

<?php 
	if ( have_posts() ) {

		$panels = array(
			0 => array( 'what' ),
			1 => array( 'where' ),
			2 => array( 'when' ),
			3 => array( 'budget' ),
		);
		tsp_mini_wizard( $panels );

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

		<div class="slider-container mini-wizard-results lsx-to-widget-items lsx-to-archive-template-grid toptours-posts" >
		<h3><?php esc_html_e( 'Our picks for', 'thesafaripartners-child' ); ?> <span style="text-transform:lowercase;"><?php echo $term->name; ?></span></h3>
			<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>" class="lsx-to-slider">
				<div class="lsx-to-slider-wrap">
					<div class="lsx-to-slider-inner slick-slider" data-interval="6000" data-slick='{ "slidesToShow": 4, "slidesToScroll": 4 }'>
					<?php
					while ( have_posts() ) {
						the_post();
						?>
						<div class="lsx-to-widget-item-wrap lsx-tour slick-slide">
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
	?>
</main><!-- #main -->

<?php lsx_content_after(); ?>

</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php // get_sidebar(); ?>

<?php
get_footer();