<?php
/**
 * Reviews Widget Content Part
 *
 * @package 	tour-operators
 * @category	review
 * @subpackage	widget
 */

global $disable_placeholder, $disable_text, $post;

$has_single = ! lsx_to_is_single_disabled();
$permalink = '';

if ( $has_single ) {
	$permalink = get_the_permalink();
} elseif ( ! is_post_type_archive( 'review' ) ) {
	$has_single = true;
	$permalink = get_post_type_archive_link( 'review' ) . '#review-' . $post->post_name;
}
?>
<article <?php post_class(); ?>>
	<?php if ( empty( $disable_placeholder ) ) { ?>
		<div class="lsx-to-widget-thumb">
			<?php if ( $has_single ) { ?><a href="<?php echo esc_url( $permalink ); ?>"><?php } ?>
				<?php lsx_thumbnail( 'lsx-thumbnail-wide' ); ?>
			<?php if ( $has_single ) { ?></a><?php } ?>
		</div>
	<?php } ?>


		<blockquote class="lsx-to-widget-blockquote">
		<h4 class="lsx-to-summary-title extra"><a href="<?php echo esc_url( $permalink ); ?>"><?php the_title(); ?></a></h4>
<?php
// Get the post content and apply the_content filters to it.
$full_content = apply_filters('the_content', get_the_content());

// Set the character limit for the excerpt.
$char_limit = 260;

// Strip all HTML tags for the excerpt only, but keep HTML in the full content.
$excerpt = strip_tags($full_content);

if (strlen($excerpt) > $char_limit) {
    $trimmed = substr($excerpt, 0, $char_limit);
    // Output the excerpt and the Read More button
    echo '<span class="lsx-review-excerpt">' . esc_html($trimmed) . '... ';
    echo '<a href="javascript:void(0)" class="lsx-review-readmore" aria-expanded="false">Read More</a></span>';
    // Output the full content, hidden by default, with HTML preserved
    echo '<span class="lsx-review-full" style="display:none;">' . $full_content;
    echo '<a href="javascript:void(0)" class="lsx-review-readless" aria-expanded="true">Read Less</a></span>';
} else {
    // If content is short, just show it all (with HTML)
    echo $full_content;
}
?>

	<?php $reviewer_name = get_post_meta( get_the_ID(), 'reviewer_name', true ); ?>
				<p class="lsx-review-author"><?php echo esc_html( $reviewer_name ); ?></p>


		</blockquote>


</article>