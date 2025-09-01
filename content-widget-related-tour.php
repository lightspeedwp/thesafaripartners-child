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

	<div class="tsp-related-tour-content">
		<?php lsx_widget_entry_content_top(); ?>

        <h4 class="tsp-widget-title text-center">
            <?php if ( false !== $has_single ) { ?>
                <a href="<?php echo esc_url( $permalink ); ?>">
            <?php } ?>
            <?php the_title(); ?>
            <?php if ( false !== $has_single ) {?>
                </a>
            <?php } ?>
        </h4>

        <div class="tsp-related-tour-meta">
            <?php
            $meta_class = 'tsp-meta tsp-meta-data-';

            lsx_to_duration('<div class="tsp-meta tsp-duration"><i class="tsp-icon tsp-icon-duration"></i><span><span class="' . $meta_class . '"></span><span> ',  esc_html__(' Days', 'tour-operator') . '</span></span></div>');
            echo '<div class="tsp-meta tsp-countries">';
            lsx_to_connected_countries('<i class="tsp-icon tsp-icon-countries"></i><span><span class="' . $meta_class . '"></span><span> ', '</span></span>');
            echo '</div>';
            ?>
        </div>

        <div class="tour-excerpt"><?php
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
            ?>
        </div>

        <a href="<?php echo esc_url( $permalink ); ?>" class="tsp-tour-button"><?php esc_html_e( 'VIEW TRIP', 'tour-operator' ); ?></a>
		<?php lsx_widget_entry_content_bottom(); ?>

	<?php lsx_widget_entry_bottom(); ?>

</article>
<?php lsx_widget_entry_after(); ?>
