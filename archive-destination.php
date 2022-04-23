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
					<?php } ?>

					<div class="<?php echo esc_attr( lsx_to_archive_class( 'lsx-to-archive-item' ) ); ?>">
						<div aria-live="polite" class="slick-list"><div class="slick-track" role="listbox" style="opacity: 1; width: 7930px; transform: translate3d(-1220px, 0px, 0px);"><div class="lsx-to-widget-item-wrap lsx-destination slick-slide slick-cloned" data-slick-index="-2" id="" aria-hidden="true" tabindex="-1" style="width: 610px;">

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

						</div></div></div>
					</div>

					<?php if ( $GLOBALS['wp_query']->post_count === $count ) { ?>
						</div>
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
