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
<div class="row lsx-to-archive-items">
				<div class="wp-block-tour-operator-block-post-types toptours-posts lsx-to-archive-template-<?php echo esc_attr( tour_operator()->archive_layout ); ?> lsx-to-archive-template-image-<?php echo esc_attr( tour_operator()->archive_list_layout_image_style ); ?>">
					<div class="slider-container lsx-to-widget-items lsx-to-archive-template-grid">
						<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>" class="lsx-to-slider">
							<div class="lsx-to-slider-wrap">
								<div class="lsx-to-slider-inner" data-slick='{ "slidesToShow": 4, "slidesToScroll": 4 }'>
					<?php
					while ( have_posts() ) :
						the_post();
						?>

						<div class="lsx-to-widget-item-wrap <?php echo esc_attr( lsx_to_archive_class( 'lsx-to-archive-item' ) ); ?>">
							<article <?php post_class(); ?>>

								<?php lsx_widget_entry_top(); ?>

								<?php if ( empty( $disable_placeholder ) ) { ?>
									<div class="lsx-to-widget-thumb">
										<?php
										if ( false !== $has_single ) {
											?>
							<a href="<?php echo esc_url( $permalink ); ?>"><?php } ?>
											<?php lsx_thumbnail( 'lsx-thumbnail-wide' ); ?>
										<?php
										if ( false !== $has_single ) {
											?>
							</a><?php } ?>
									</div>
								<?php } ?>

								<div class="lsx-to-widget-content">

									<?php lsx_widget_entry_content_top(); ?>

									<h4 class="lsx-to-widget-title text-center">
										<?php
										if ( false !== $has_single ) {
											?>
							<a href="<?php echo esc_url( $permalink ); ?>"><?php } ?>
											<?php the_title(); ?>
										<?php
										if ( false !== $has_single ) {
											?>
							</a><?php } ?>
									</h4>

									<?php
										// if ( empty( $disable_text ) ) {
										// lsx_to_tagline( '<p class="lsx-to-widget-tagline text-center">', '</p>' );
										// }
									?>


									<?php
									ob_start();
									lsx_to_widget_entry_content_top();
									the_excerpt();

									$excerpt = ob_get_clean();

										echo wp_kses_post( $excerpt );
									?>
										<div class="lsx-to-widget-meta-data">
											<?php
											$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

											lsx_to_price( '<span class="' . $meta_class . 'price"><span class="lsx-to-meta-data-key">' . esc_html__( 'from', 'tour-operator' ) . ':</span> ', '</span>' );
											lsx_to_duration( '<span class="' . $meta_class . 'duration"><span class="lsx-to-meta-data-key">' . esc_html__( 'Duration', 'tour-operator' ) . ':</span> ', '</span>' );
											lsx_to_connected_countries( '<span class="' . $meta_class . 'destinations"><span class="lsx-to-meta-data-key">' . esc_html__( 'Destinations', 'tour-operator' ) . ':</span> ', '</span>' );

											if ( function_exists( 'lsx_to_connected_activities' ) ) {
												lsx_to_connected_activities( '<span class="' . $meta_class . 'activities"><span class="lsx-to-meta-data-key">' . esc_html__( 'Activities', 'tour-operator' ) . ':</span> ', '</span>' );
											}
											?>
											<p class="moretag-wrapper tourslink"><a href="<?php echo esc_url( $permalink ); ?>" class="moretag"><?php esc_html_e( 'VIEW TRIP', 'tour-operator' ); ?></a></p>
										</div>



									<?php lsx_widget_entry_content_bottom(); ?>
								</div>

								<?php lsx_widget_entry_bottom(); ?>

							</article>
						</div>


					<?php endwhile; ?>
				</div>
				</div>
				</div>
			</div></div></div>

					<div class="row lsx-to-archive-items lsx-to-archive-template-<?php echo esc_attr( tour_operator()->archive_layout ); ?> lsx-to-archive-template-image-<?php echo esc_attr( tour_operator()->archive_list_layout_image_style ); ?>">
<div class="safari-styles desinations-landing-style">

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

<div class="lsx-to-widget-item-wrap <?php echo esc_attr( lsx_to_archive_class( 'lsx-to-archive-item' ) ); ?>">
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
				// lsx_to_tagline( '<p class="lsx-to-widget-tagline text-center">', '</p>' );
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
</div>

<?php endwhile; ?>

</div></div>

				</div>

			<?php else : ?>

				<?php get_template_part( 'partials/content', 'none' ); ?>

			<?php endif; ?>



		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php // get_sidebar(); ?>

<?php
get_footer();
