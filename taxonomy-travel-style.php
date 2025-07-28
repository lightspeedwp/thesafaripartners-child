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
	<?php $term = get_queried_object(); ?>
	<h2 class="category-title"><?php $subheading = get_field('subheading', $term); echo $subheading; ?></h2>

		<div class="col-sm-8">
			<div class="lsx-to-widget-description">
				
				<p class="category-description"><?php echo $term->description; ?></p>
			</div>
		</div>

		<div class="col-sm-4">
			<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) { ?>
				<div class="lsx-to-widget-thumb">
				<?php

					$image_id = get_field('page-image', $term, false); 
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

	<?php 
		
		
		$query_args = array(
			'post_type' => 'tour',
			'post_status' => 'publish',
			'facetwp' => true,
			'tax_query' => array(
				array(
					'taxonomy' => 'travel-style',
					'field'    => 'term_id',
					'terms'    => array( get_queried_object_id() ),
				),
			),
		);
		tsp_mini_wizard_results( $query_args, $args );

		/*$panels = array(
			0 => array( 'who' ),
			1 => array( 'what' ),
			2 => array( 'where' ),
			3 => array( 'when' ),
			4 => array( 'budget' ),
		);
		$args = array( 
			'selected' => array( get_queried_object_id() ),
			'title'    => get_term_meta( get_queried_object_id(), 'shaman_title', true ),
			'tagline'  => get_term_meta( get_queried_object_id(), 'shaman_tagline', true ),
		);

		// Call the intro
		get_template_part( 'partials/shaman', 'intro', $args );

		// Call the wizard
		tsp_mini_wizard( $panels, $args );*/
	?>
</main><!-- #main -->

<?php lsx_content_after(); ?>

</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php // get_sidebar(); ?>

<?php
get_footer();