<?php
/**
 * Travel Style Widget Content Part
 *
 * @package     tour-operator
 * @category    travel-style
 * @subpackage  widget
 */

global $term, $taxonomy, $disable_placeholder, $disable_text, $disable_single_link;

if ( empty( $disable_single_link ) ) {
	$title_link = esc_url( get_term_link( $term, $taxonomy ) );
} else {
	$title_link = '';
}
?>

<article id="who-single" class="term-<?php echo esc_attr( $term->term_id ); ?> <?php echo esc_attr( $taxonomy ); ?> type-<?php echo esc_attr( $taxonomy ); ?> status-publish hentry">
	<div class="checkbox-wrapper">
		<input type="checkbox" />
		<span aria-hidden="true"></span>
	</div>
	<?php if ( empty( $disable_placeholder ) ) { ?>
		<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) : ?>
			<div class="lsx-to-widget-thumb">
				<?php
				if ( ! empty( $title_link ) ) {
					?>
<?php } ?>
					<?php lsx_to_term_thumbnail( $term->term_id, 'lsx-thumbnail-wide' ); ?>

				<?php
				if ( ! empty( $title_link ) ) {
					?>
<?php } ?>
			</div>
		<?php else : ?>
			<div class="lsx-to-widget-thumb">
				<?php
				if ( ! empty( $title_link ) ) {
					?>
<?php } ?>
					<img alt="Placeholder" class="attachment-responsive wp-post-image lsx-responsive" src="<?php echo esc_url( lsx\legacy\Placeholders::placeholder_url( null, null, array( 750, 350 ) ) ); ?>">
				<?php
				if ( ! empty( $title_link ) ) {
					?>
<?php } ?>
			</div>
		<?php endif; ?>
	<?php } ?>

	<div class="lsx-to-widget-content bottom">
		<h4 class="lsx-to-widget-title text-left">
			<?php
			if ( ! empty( $title_link ) ) {
				?>
<?php } ?>
				<?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>
			<?php
			if ( ! empty( $title_link ) ) {
				?>
<?php } ?>
</h4>
		<?php
			// if ( empty( $disable_text ) ) {
			// lsx_to_term_tagline( $term->term_id, '<p class="lsx-to-widget-tagline text-center">', '</p>' );
			// }
		?>

		<?php if ( empty( $disable_text ) && ! empty( $term->description ) ) { ?>
			<p class="lsx-to-widget-description">
				<?php echo wp_kses_post( $term->description ); ?>
			</p>
		<?php } ?>

		<?php if ( ! empty( $title_link ) ) { ?>
			<p>
				<a href="<?php echo esc_url( $title_link ); ?>" class="moretag"><?php esc_html_e( 'MAKE AN INQUIRY', 'tour-operator' ); ?></a>
			</p>
		<?php } ?>
	</div>
</article>
