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

		<main id="main" class="site-main" role="main">
<div class="archive-intro col-sm-12">
	<div class="col-sm-9">
	<p class="lsx-to-widget-description">
		<?php $term = get_queried_object();  ?>

	<h2 class="category-title"><?php echo $term->name; ?></h2>

	<p class="category-description"><?php echo $term->description; ?></p>
	</p>
</div>
<div class="col-sm-3">
				<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) : ?>
					<div class="lsx-to-widget-thumb">

							<?php lsx_to_term_thumbnail( $term->term_id, 'lsx-thumbnail-wide' ); ?>

					</div>
				<?php else : ?>
					<div class="lsx-to-widget-thumb">

							<img alt="Placeholder" class="attachment-responsive wp-post-image lsx-responsive" src="<?php echo esc_url( lsx\legacy\Placeholders::placeholder_url( null, null, array( 750, 350 ) ) ); ?>">

					</div>
				<?php endif; ?>
				<?php	wp_reset_query(); ?>

			</div>
		</div>

			<?php if ( have_posts() ) : ?>

				<div class="row lsx-to-archive-items lsx-to-archive-template-<?php echo esc_attr( tour_operator()->archive_layout ); ?> lsx-to-archive-template-image-<?php echo esc_attr( tour_operator()->archive_list_layout_image_style ); ?>">

					<?php
					while ( have_posts() ) :
						the_post();
						?>

						<div class="<?php echo esc_attr( lsx_to_archive_class( 'lsx-to-archive-item' ) ); ?>">
							<?php lsx_to_content( 'content', 'tour' ); ?>
						</div>


					<?php endwhile; ?>

					</div>
					<div class="row lsx-to-archive-items lsx-to-archive-template-<?php echo esc_attr( tour_operator()->archive_layout ); ?> lsx-to-archive-template-image-<?php echo esc_attr( tour_operator()->archive_list_layout_image_style ); ?>">
<div class="wp-block-tour-operator-block-post-types toptours-posts"><h2 class="lsx-title"><small></small></h2><div class="lsx-testimonial-body"><div class=" widget lsx-widget"><div class="slider-container lsx-to-widget-items"><div id="slider-16942" class="lsx-to-slider"><div class="lsx-to-slider-wrap"><div class="lsx-to-slider-inner slick-initialized slick-slider slick-dotted slick-has-arrows" data-interval="" data-slick="{ &quot;slidesToShow&quot;: 4, &quot;slidesToScroll&quot;: 4 }" role="toolbar"><button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous" role="button" style="">Previous</button><div aria-live="polite" class="slick-list"><div class="slick-track" role="listbox" style="opacity: 1; width: 5185px; transform: translate3d(-1220px, 0px, 0px);">
					<?php
					$term = get_queried_object();
					$the_query = new WP_Query( array(
					    'post_type' => 'destination',
					    'tax_query' => array(
					        array (
					            'taxonomy' => 'travel-style',
					            'field' => 'slug',
					            'terms' => $term,
					        )
					    ),
					) );

					while ( $the_query->have_posts() ) :
					    $the_query->the_post();
?>

<div class="lsx-to-widget-item-wrap lsx-tour slick-slide slick-cloned" data-slick-index="-4" id="" aria-hidden="true" tabindex="-1">

	<div class="<?php echo esc_attr( lsx_to_archive_class( 'lsx-to-archive-item' ) ); ?>">
		<?php lsx_to_content( 'content', 'destination' ); ?>
	</div>
</div>

<?php endwhile; ?>
</div></div></div><button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next" role="button" style="">Next</button><ul class="slick-dots" style="display: block;" role="tablist"><li class="slick-active" aria-hidden="false" role="presentation" aria-selected="true" aria-controls="navigation10" id="slick-slide10"><button type="button" data-role="none" role="button" tabindex="0">1</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation11" id="slick-slide11"><button type="button" data-role="none" role="button" tabindex="0">2</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation12" id="slick-slide12"><button type="button" data-role="none" role="button" tabindex="0">3</button></li></ul></div></div></div></div></div></div></div>
				</div>

			<?php else : ?>

				<?php get_template_part( 'partials/content', 'none' ); ?>

			<?php endif; ?>

			<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php // get_sidebar(); ?>

<?php
get_footer();
