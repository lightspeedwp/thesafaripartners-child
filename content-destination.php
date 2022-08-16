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

	<?php lsx_entry_top(); ?>
<div class="archive-intro row">
	<?php $term = get_queried_object(); ?>
	<h2 class="category-title"><?php the_field('subheading'); ?></h2>

		<div class="col-sm-8">
			<div class="lsx-to-widget-description">
				
				<p class="category-description"><?php the_content(); ?></p>
			</div>
		</div>

		<div class="col-sm-4">
				<div class="lsx-to-widget-thumb">
				<?php if( get_field('page-image') ): ?>
    				<img src="<?php the_field('page-image'); ?>" />
				<?php endif; ?>
				</div>
			
			<?php wp_reset_query(); ?>
		</div>
	</div>

	<?php lsx_entry_bottom(); ?>


<?php
lsx_entry_after();
