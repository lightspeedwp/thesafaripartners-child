<?php
/**
 * Destination Archive
 *
 * @package  tour-operator
 * @category destination
 */
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

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

			<?php
$loop = new WP_Query( array( 'post_type' => 'destination', 'posts_per_page' => 10 ) );

while ( $loop->have_posts() ) : $loop->the_post();
?>



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


<?php endwhile; ?>

			<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php //get_sidebar(); ?>

<?php
get_footer();
