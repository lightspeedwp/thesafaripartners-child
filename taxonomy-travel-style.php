<?php
/**
 * Travel Style Archive.
 *
 * @package  tour-operator
 * @category travel-style
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

<?php lsx_content_before(); ?>

<main id="main" class="site-main entry-content" role="main">

	<div class="archive-intro row">
		<div class="col-sm-8">
			<div class="lsx-to-widget-description">
				<?php $term = get_queried_object(); ?>

				<h2 class="category-title"><?php echo $term->name; ?></h2>

				<p class="category-description"><?php echo $term->description; ?></p>
			</div>
		</div>

		<div class="col-sm-4">
			<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) { ?>
				<div class="lsx-to-widget-thumb">
					<?php lsx_to_term_thumbnail( $term->term_id, 'lsx-thumbnail-wide' ); ?>
				</div>
			<?php } else { ?>
				<div class="lsx-to-widget-thumb">
					<img alt="Placeholder" class="attachment-responsive wp-post-image lsx-responsive" src="<?php echo esc_url( lsx\legacy\Placeholders::placeholder_url( null, null, array( 750, 350 ) ) ); ?>">
				</div>
			<?php } ?>
			<?php wp_reset_query(); ?>
		</div>
	</div>

	<?php get_template_part( 'partials/shaman-intro', '1' ); ?>

	<?php 
		if ( have_posts() ) {

			$panels = array(
				0 => array( 'who', 'where' ),
				1 => array( 'when' ),
				2 => array( 'budget' ),
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
			<div class="tsp-seperator"></div>
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