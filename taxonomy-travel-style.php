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

					<?php
$loop = new WP_Query( array( 'post_type' => 'destination', 'posts_per_page' => 10 ) );

while ( $loop->have_posts() ) : $loop->the_post();
?>

<div class="<?php echo esc_attr( lsx_to_archive_class( 'lsx-to-archive-item' ) ); ?>">
	<article <?php post_class(); ?>>

		<?php if ( empty( $disable_placeholder ) ) { ?>
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

				echo wp_kses_post( $excerpt );

				?>
					<p class="moretag-wrapper"><a href="<?php echo esc_url( $permalink ); ?>" class="moretag"><?php esc_html_e( 'View more', 'tour-operator' ); ?></a></p>

		</div>
	</article>
</div>

<?php endwhile; ?>

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
