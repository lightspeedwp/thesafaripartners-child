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
<div class="archive-intro row">
	<?php $term = get_queried_object(); ?>
	<h2 class="category-title"><?php the_title(); ?></h2>

		<div class="col-sm-8">
			<div class="lsx-to-widget-description">
				
				<p class="category-description"><?php the_content(); ?></p>
			</div>
		</div>

		<div class="col-sm-4">
			<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) { ?>
				<div class="lsx-to-widget-thumb">
				<?php lsx_thumbnail( 'lsx-block-post-grid-square' ); ?>
				</div>
			<?php } else { ?>
				<div class="lsx-to-widget-thumb">
					<img alt="Placeholder" class="attachment-responsive wp-post-image lsx-responsive" src="<?php echo esc_url( lsx\legacy\Placeholders::placeholder_url( null, null, array( 750, 350 ) ) ); ?>">
				</div>
			<?php } ?>
			<?php wp_reset_query(); ?>
		</div>
	</div>

	<?php lsx_entry_bottom(); ?>

</article>

<?php
lsx_entry_after();
