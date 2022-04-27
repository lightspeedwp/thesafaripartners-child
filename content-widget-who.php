<?php
/**
 * Travel Style Widget Content Part
 *
 * @package     tour-operator
 * @category    travel-style
 * @subpackage  widget
 */

 $the_query = new WP_Query( array(
     'post_type' => 'tours',
     'tax_query' => array(
         array (
             'taxonomy' => 'who',
             'field' => 'slug',
         )
     ),
 ) );

 while ( $the_query->have_posts() ) :
     $the_query->the_post();
		 ?>
 			<div class="lsx-to-widget-thumb">

 <a href="<?php echo esc_url( $title_link ); ?>">
 					<img alt="Placeholder" class="attachment-responsive wp-post-image lsx-responsive" src="<?php echo esc_url( lsx\legacy\Placeholders::placeholder_url( null, null, array( 750, 350 ) ) ); ?>">

 </a>
 			</div>


 	<div class="lsx-to-widget-content bottom">
 		<h4 class="lsx-to-widget-title text-left">

 <a href="<?php echo esc_url( $title_link ); ?>">
 				<?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>

 </a>
 </h4>	<?php
 endwhile;

 wp_reset_postdata();

global $term, $taxonomy, $disable_placeholder, $disable_text, $disable_single_link;

if ( empty( $disable_single_link ) ) {
	$title_link = esc_url( get_term_link( $term, $taxonomy ) );
} else {
	$title_link = '';
}
?>
<article class="term-<?php echo esc_attr( $term->term_id ); ?> <?php echo esc_attr( $taxonomy ); ?> type-<?php echo esc_attr( $taxonomy ); ?> status-publish hentry">
	<div class="tour-styles-top-info">
	<div class="col-md-6">
		<h3 class="lsx-to-widget-title text-left">
			<?php
			if ( ! empty( $title_link ) ) {
				?>
<a href="<?php echo esc_url( $title_link ); ?>"><?php } ?>
				<?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>
			<?php
			if ( ! empty( $title_link ) ) {
				?>
</a><?php } ?>
</h3>
	</div>
	<div class="col-md-6 lsx-to-widget">
		<h4 class="lsx-to-widget-title text-right">
			<?php
			if ( ! empty( $title_link ) ) {
				?>
<a href="<?php echo esc_url( $title_link ); ?>"><?php } ?>
			SEE ALL	<?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>
			<?php
			if ( ! empty( $title_link ) ) {
				?>
</a><?php } ?>
		</h4>
	</div></div>
	<?php if ( empty( $disable_placeholder ) ) { ?>
		<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) : ?>
			<div class="lsx-to-widget-thumb">
				<?php
				if ( ! empty( $title_link ) ) {
					?>
<a href="<?php echo esc_url( $title_link ); ?>"><?php } ?>
					<?php lsx_to_term_thumbnail( $term->term_id, 'lsx-thumbnail-wide' ); ?>

				<?php
				if ( ! empty( $title_link ) ) {
					?>
</a><?php } ?>
			</div>
		<?php else : ?>
			<div class="lsx-to-widget-thumb">
				<?php
				if ( ! empty( $title_link ) ) {
					?>
<a href="<?php echo esc_url( $title_link ); ?>"><?php } ?>
					<img alt="Placeholder" class="attachment-responsive wp-post-image lsx-responsive" src="<?php echo esc_url( lsx\legacy\Placeholders::placeholder_url( null, null, array( 750, 350 ) ) ); ?>">
				<?php
				if ( ! empty( $title_link ) ) {
					?>
</a><?php } ?>
			</div>
		<?php endif; ?>
	<?php } ?>

	<div class="lsx-to-widget-content bottom">
		<h4 class="lsx-to-widget-title text-left">
			<?php
			if ( ! empty( $title_link ) ) {
				?>
<a href="<?php echo esc_url( $title_link ); ?>"><?php } ?>
				<?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>
			<?php
			if ( ! empty( $title_link ) ) {
				?>
</a><?php } ?>
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
