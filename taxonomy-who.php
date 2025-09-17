<?php
/**
 * Who Archive.
 *
 * @package  tour-operator
 * @category who
 */

get_header(); 
$term = get_queried_object();
$tag = get_field('tagline', $term);

?>
<?php get_template_part( 'partials/who-banner', '1' ); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main entry-content" role="main">

			<div class="archive-intro row">
			<h2 class="category-title"><?php echo $tag; ?></h2>
				<div class="col-sm-8">
					<div class="lsx-to-widget-description">

						<p class="category-description"><?php echo $term->description; ?></p>
					</div>
				</div>

				<div class="col-sm-4">
			<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) { ?>
				<div class="lsx-to-widget-thumb">
				<?php

					$image_id = get_field('page_image', $term, false); 
					$size = 'medium';
					$image = wp_get_attachment_image_src($image_id, $size);

		?>
  		<img src="<?php echo $image[0]; ?>" />
				</div>
			<?php } else { ?>
				<div class="lsx-to-widget-thumb">
					<img alt="Placeholder" class="attachment-responsive wp-post-image lsx-responsive" src="<?php echo esc_url( lsx\legacy\Placeholders::placeholder_url( null, null, array( 750, 350 ) ) ); ?>">
				</div>
			<?php } ?>
			<div class="extra-cta">
				<button class="btn btn-primary pull-right lsx-wizard-button-next lsx-btn popmake-253235 pum-trigger pum-triggercta"><span>Request more information</span></button>
				</div>
			<?php wp_reset_query(); ?>
		</div>
			</div>
			<?php tsp_who_tour_search(); ?>
		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php // get_sidebar(); ?>

<?php
get_footer();
