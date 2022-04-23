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

			<?php if ( have_posts() ) : ?>

				<?php
					$header_before = '';
					$group_items_by_continent = false;

					if ( isset( tour_operator()->options['destination'] ) && isset( tour_operator()->options['destination']['group_items_by_continent'] ) ) {
						$group_items_by_continent = true;
					}

					$count = 0;
				?>

				<?php
                while ( have_posts() ) :
the_post();
?>

					<?php
						if ( true === $group_items_by_continent ) {
							$header_current = get_the_terms( get_the_id(), 'continent' );
							$header_html = '';

							if ( ! is_wp_error( $header_current ) && is_array( $header_current ) && ! empty( $header_current ) ) {
								$header_current = $header_current[0]->name;

								if ( $header_before !== $header_current ) {
									$header_html = '<h3 class="lsx-to-archive-items-separator lsx-title">' . $header_current . '</h3>';
									$header_before = $header_current;
								}
							}
						}

						$count++;
					?>

					<?php if ( $count > 1 && true === $group_items_by_continent && ! empty( $header_html ) ) { ?>
						</div>
					<?php } ?>

					<?php if ( 1 === $count || ( true === $group_items_by_continent && ! empty( $header_html ) ) ) { ?>
						<?php if ( true === $group_items_by_continent && ! empty( $header_html ) ) { ?>
							<?php echo wp_kses_post( $header_html ); ?>
						<?php } ?>

						<div class="row lsx-to-archive-items lsx-to-archive-template-<?php echo esc_attr( tour_operator()->archive_layout ); ?> lsx-to-archive-template-image-<?php echo esc_attr( tour_operator()->archive_list_layout_image_style ); ?>">
<div class="wp-block-tour-operator-block-post-types tours-posts"><h2 class="lsx-title"><small></small></h2><div class="lsx-testimonial-body"><div class=" widget lsx-widget"><div class="slider-container lsx-to-widget-items"><div id="slider-11550" class="lsx-to-slider"><div class="lsx-to-slider-wrap"><div class="lsx-to-slider-inner slick-initialized slick-slider slick-dotted slick-has-arrows" data-interval="" data-slick="{ &quot;slidesToShow&quot;: 2, &quot;slidesToScroll&quot;: 2 }" role="toolbar"><button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous" role="button" style="">Previous</button><div aria-live="polite" class="slick-list"><div class="slick-track" role="listbox" style="opacity: 1; width: 7930px; transform: translate3d(-1220px, 0px, 0px);"><div class="lsx-to-widget-item-wrap lsx-destination slick-slide slick-cloned" data-slick-index="-2" id="" aria-hidden="true" tabindex="-1" style="width: 610px;">
					<?php } ?>

						<?php lsx_to_content( 'content', 'destination' ); ?>

					<?php if ( $GLOBALS['wp_query']->post_count === $count ) { ?>
						</div>
						</div></div></div><button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next" role="button" style="">Next</button><ul class="slick-dots" style="display: block;" role="tablist"><li class="slick-active" aria-hidden="false" role="presentation" aria-selected="true" aria-controls="navigation00" id="slick-slide00"><button type="button" data-role="none" role="button" tabindex="0">1</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation01" id="slick-slide01"><button type="button" data-role="none" role="button" tabindex="0">2</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation02" id="slick-slide02"><button type="button" data-role="none" role="button" tabindex="0">3</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation03" id="slick-slide03"><button type="button" data-role="none" role="button" tabindex="0">4</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation04" id="slick-slide04"><button type="button" data-role="none" role="button" tabindex="0">5</button></li></ul></div></div></div></div></div></div></div>
					<?php } ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'partials/content', 'none' ); ?>

			<?php endif; ?>

			<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php //get_sidebar(); ?>

<?php
get_footer();
