<?php
/**
 * Tours Widget Content Part
 *
 * @package     tour-operator
 * @category    tours
 * @subpackage  widget
 */

global $disable_placeholder, $disable_text, $disable_view_more, $post;

$has_single = ! lsx_to_is_single_disabled();
$permalink  = '';

if ( $has_single ) {
	$permalink = get_the_permalink();
}
?>

<?php lsx_widget_entry_before(); ?>

<article <?php post_class( 'filterDiv facet-box' ); ?>>

	<?php lsx_widget_entry_top(); ?>

	<?php if ( empty( $disable_placeholder ) ) { ?>
		<div class="lsx-to-widget-thumb">
			<?php
			if ( false !== $has_single ) {
				?>
<a href="<?php echo esc_url( $permalink ); ?>"><?php } ?>
				<?php lsx_thumbnail( 'lsx-block-post-grid-landscape' ); ?>
			<?php
			if ( false !== $has_single ) {
				?>
</a><?php } ?>
		</div>
	<?php } ?>

	<div class="lsx-to-widget-content">
				<div class="tourheight">
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


<span class="tour-except"><?php
    ob_start();
    lsx_to_widget_entry_content_top();
    the_excerpt();
    $excerpt = ob_get_clean();

    // Limit excerpt to 100 characters
    $char_limit = 120; // Set the character limit
    if (strlen($excerpt) > $char_limit) {
        $excerpt = substr($excerpt, 0, $char_limit) . '...'; // Trim the excerpt and add ellipsis
    }

    echo wp_kses_post($excerpt);
?></span>
		</div>
			<div class="lsx-to-widget-meta-data">
				<div class="tourmeta-height">
				<?php
				$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

				lsx_to_duration( '<span class="' . $meta_class . 'duration"><span class="lsx-to-meta-data-key"></span> ', '</span>' );
				lsx_to_price( '<span><span class="lsx-to-meta-data-key">' . esc_html__( 'from', 'tour-operator' ) . ':</span> ', '</span>' );
				the_terms( get_the_ID(), 'travel-style', '<span class="' . $meta_class . 'style"><span class="lsx-to-meta-data-key">' . esc_html__( 'Travel Style', 'tour-operator' ) . ':</span> ', ', ', '</span>' );
				lsx_to_connected_countries( '<span class="' . $meta_class . 'destinations"><span class="lsx-to-meta-data-key"></span> ', '</span>' );

				if ( function_exists( 'lsx_to_connected_activities' ) ) {
					lsx_to_connected_activities( '<span class="' . $meta_class . 'activities"><span class="lsx-to-meta-data-key">' . esc_html__( 'Activities', 'tour-operator' ) . ':</span> ', '</span>' );
				}
				?>
				</div>
				<p class="moretag-wrapper tourslink"><a href="<?php echo esc_url( $permalink ); ?>" class="moretag"><?php esc_html_e( 'VIEW TRIP', 'tour-operator' ); ?></a></p>
				<a href="/independent-reviews/" class="reviews-btn"><?php esc_html_e( 'VIEW REVIEWS', 'tour-operator' ); ?></a>
			</div>



		<?php lsx_widget_entry_content_bottom(); ?>
	</div>

	<?php lsx_widget_entry_bottom(); ?>

</article>
<?php lsx_widget_entry_after(); ?>
