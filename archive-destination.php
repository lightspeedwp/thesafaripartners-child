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
			<div class="wp-block-tour-operator-block-post-types tours-posts"><h2 class="lsx-title"><small></small></h2><div class="lsx-testimonial-body"><div class=" widget lsx-widget"><div class="slider-container lsx-to-widget-items"><div id="slider-11550" class="lsx-to-slider"><div class="lsx-to-slider-wrap"><div class="lsx-to-slider-inner slick-initialized slick-slider slick-dotted slick-has-arrows" data-interval="" data-slick="{ &quot;slidesToShow&quot;: 2, &quot;slidesToScroll&quot;: 2 }" role="toolbar"><button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous" role="button" style="">Previous</button><div aria-live="polite" class="slick-list"><div class="slick-track" role="listbox" style="opacity: 1; width: 7930px; transform: translate3d(-1220px, 0px, 0px);"><div class="lsx-to-widget-item-wrap lsx-destination slick-slide slick-cloned" data-slick-index="-2" id="" aria-hidden="true" tabindex="-1" style="width: 610px;">

				<?php
				/**
				 * Activity Widget Content Part
				 *
				 * @package     tour-operator
				 * @category    activity
				 * @subpackage  widget
				 */

				global $disable_placeholder, $disable_text, $disable_view_more, $post;

				$has_single = ! lsx_to_is_single_disabled();
				$permalink = '';

				if ( $has_single ) {
					$permalink = get_the_permalink();
				}
				?>
				<article <?php post_class(); ?>>
					<div class="col-md-6">
						<h3 class="lsx-to-widget-title text-left">
							<?php
				            if ( ! empty( $title_link ) ) {
				?>
				<a href="<?php echo esc_url( $title_link ); ?>"><?php } ?>
								<?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>
							<?php
				            if ( ! empty( $title_link ) ) {
				?>
				</a><?php } ?>
				</h3>
					</div>

					<?php if ( empty( $disable_placeholder ) ) { ?>
						<div class="col-md-6">
							<h4 class="lsx-to-widget-title text-left">
								<?php
					            if ( ! empty( $title_link ) ) {
					?>
					<a href="<?php echo esc_url( $title_link ); ?>"><?php } ?>
									<?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>
								<?php
					            if ( ! empty( $title_link ) ) {
					?>
					</a><?php } ?>
				</h4>
						</div>
						<div class="lsx-to-widget-thumb">
							<?php
				            if ( $has_single ) {
				?>
				<a href="<?php echo esc_url( $permalink ); ?>"><?php } ?>
								<?php lsx_thumbnail( 'lsx-thumbnail-wide' ); ?>
							<?php
				            if ( $has_single ) {
				?>
				</a><?php } ?>
						</div>
					<?php } ?>

					<div class="lsx-to-widget-content">
						<h4 class="lsx-to-widget-title text-center">
							<?php
				            if ( $has_single ) {
				?>
				<a href="<?php echo esc_url( $permalink ); ?>"><?php } ?>
								<?php the_title(); ?>
							<?php
				            if ( $has_single ) {
				?>
				</a><?php } ?>
						</h4>

						<?php
							// if ( empty( $disable_text ) ) {
							// 	lsx_to_tagline( '<p class="lsx-to-widget-tagline text-center">', '</p>' );
							// }
						?>

						<?php
							ob_start();
							lsx_to_widget_entry_content_top();
							the_excerpt();
							lsx_to_widget_entry_content_bottom();
							$excerpt = ob_get_clean();
							if ( empty( $disable_text ) && ! empty( $excerpt ) ) {
								echo wp_kses_post( $excerpt );
							} elseif ( $has_single && true !== $disable_view_more && '1' !== $disable_view_more ) {
								?>
								<p class="moretag-wrapper"><a href="<?php echo esc_url( $permalink ); ?>" class="moretag"><?php esc_html_e( 'View more', 'tour-operator' ); ?></a></p>
								<?php
							}
						?>
					</div>
				</article>

			</div></div></div><button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next" role="button" style="">Next</button><ul class="slick-dots" style="display: block;" role="tablist"><li class="slick-active" aria-hidden="false" role="presentation" aria-selected="true" aria-controls="navigation00" id="slick-slide00"><button type="button" data-role="none" role="button" tabindex="0">1</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation01" id="slick-slide01"><button type="button" data-role="none" role="button" tabindex="0">2</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation02" id="slick-slide02"><button type="button" data-role="none" role="button" tabindex="0">3</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation03" id="slick-slide03"><button type="button" data-role="none" role="button" tabindex="0">4</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation04" id="slick-slide04"><button type="button" data-role="none" role="button" tabindex="0">5</button></li></ul></div></div></div></div></div></div></div>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php //get_sidebar(); ?>

<?php
get_footer();
