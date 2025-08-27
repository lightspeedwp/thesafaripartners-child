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

		<p class="lsx-review"><?php
// Get the post content and apply the_content filters to it.
$content = apply_filters('the_content', get_the_content());

// Strip all HTML tags from the content.
$content = strip_tags($content);

// Define the Read More link.
$read_more_link = sprintf('<a href="%1$s" class="read-more">Read More</a>', esc_url(get_permalink()));

// Check if the content is longer than the limit.
if (strlen($content) > 260) {
    // Trim the content to 200 characters.
    $content = substr($content, 0, 260) . '... ' . $read_more_link;
}

// Display the trimmed content.
echo wp_kses_post(wpautop($content));
?></p>
	<?php $reviewer_name = get_post_meta( get_the_ID(), 'reviewer_name', true ); ?>
				<p class="lsx-review-author"><?php echo esc_html( $reviewer_name ); ?></p>


		</blockquote>


</article>
