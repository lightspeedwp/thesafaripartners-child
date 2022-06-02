<?php
/**
 * Destination Content Part
 *
 * @package  tour-operator
 * @category destination
 */

global $lsx_to_archive, $post;

if ( 1 !== $lsx_to_archive ) {
	$lsx_to_archive = false;
}
?>

<?php lsx_entry_before(); ?>

<article id="destination-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>
	<?php lsx_entry_top(); ?>

	<?php if ( is_single() && false === $lsx_to_archive ) { ?>

		<div class="entry-content col-xs-12 col-sm-12 col-md-7">
			<div class="lsx-to-summary">
				<h2 class="lsx-to-summary-title"><?php the_title(); ?></h2>
				<?php
					$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

					lsx_to_price( '<span class="' . $meta_class . 'price"><span class="lsx-to-meta-data-key">' . esc_html__( 'From price', 'tour-operator' ) . ':</span> ', '</span>' );
					lsx_to_duration( '<span class="' . $meta_class . 'duration"><span class="lsx-to-meta-data-key">' . esc_html__( 'Duration', 'tour-operator' ) . ':</span> ', '</span>' );
					the_terms( get_the_ID(), 'travel-style', '<span class="' . $meta_class . 'style"><span class="lsx-to-meta-data-key">' . esc_html__( 'Travel Style', 'tour-operator' ) . ':</span> ', ', ', '</span>' );
					lsx_to_connected_countries( '<span class="' . $meta_class . 'destinations"><span class="lsx-to-meta-data-key">' . esc_html__( 'Destinations', 'tour-operator' ) . ':</span> ', '</span>' );

					if ( function_exists( 'lsx_to_connected_activities' ) ) {
						lsx_to_connected_activities( '<span class="' . $meta_class . 'activities"><span class="lsx-to-meta-data-key">' . esc_html__( 'Activities', 'tour-operator' ) . ':</span> ', '</span>' );
					}
				?>
			</div>

			<?php the_content(); ?>
			<?php lsx_to_sharing(); ?>

		</div>
		<div class="col-xs-12 col-sm-12 col-md-5 to-facts-wrapper">
		<?php lsx_thumbnail( 'lsx-thumbnail-wide' ); ?>
				</div>

	<?php } elseif ( is_search() || empty( tour_operator()->options[ get_post_type() ]['disable_entry_text'] ) ) { ?>

		<div <?php lsx_to_entry_class( 'entry-content' ); ?>>
                                       <?php
			lsx_to_entry_content_top();
			the_excerpt();
			lsx_to_entry_content_bottom();
		?>
        </div>

	<?php } ?>

	<?php lsx_entry_bottom(); ?>

</article>

<?php
lsx_entry_after();
