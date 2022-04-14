<?php
/**
 * Travel Style Widget Content Part
 *
 * @package     tour-operator
 * @category    travel-style
 * @subpackage  widget
 */

 function hstngr_register_widget() {
 register_widget( 'hstngr_widget' );
 }
 add_action( 'widgets_init', 'hstngr_register_widget' );
 class hstngr_widget extends WP_Widget {
 function __construct() {
 parent::__construct(
 // widget ID
 'hstngr_widget',
 // widget name
 __('Hostinger Sample Widget', ' hstngr_widget_domain'),
 // widget description
 array( 'description' => __( 'Hostinger Widget Tutorial', 'hstngr_widget_domain' ), )
 );
 }
 public function widget( $args, $instance ) {
 $title = apply_filters( 'widget_title', $instance['title'] );
 echo $args['before_widget'];
 //if title is present
 if ( ! empty( $title ) )
 echo $args['before_title'] . $title . $args['after_title'];

//output
global $term, $taxonomy, $disable_placeholder, $disable_text, $disable_single_link;

if ( empty( $disable_single_link ) ) {
	$title_link = esc_url( get_term_link( $term, $taxonomy ) );
} else {
	$title_link = '';
}
?>

<article class="term-<?php echo esc_attr( $term->term_id ); ?> <?php echo esc_attr( $taxonomy ); ?> type-<?php echo esc_attr( $taxonomy ); ?> status-publish hentry">
	<div class="term-intro">
		<div class"col-md-6">
		<h4 class="lsx-to-widget-title text-center">
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
	</div>
	<div class"col-md-6">
	<h4 class="lsx-to-widget-title text-center">
		<?php
					if ( ! empty( $title_link ) ) {
?>
<a href="<?php echo esc_url( $title_link ); ?>"><?php } ?>
			SEE ALL <?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>
		<?php
					if ( ! empty( $title_link ) ) {
?>
</a><?php } ?>
	</h4>
</div>
</div>
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

	<div class="lsx-to-widget-content">
		<h4 class="lsx-to-widget-title text-center">
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
			// 	lsx_to_term_tagline( $term->term_id, '<p class="lsx-to-widget-tagline text-center">', '</p>' );
			// }
		?>


		<?php if ( ! empty( $title_link ) ) { ?>
			<p>
				<a href="<?php echo esc_url( $title_link ); ?>" class="moretag"><?php esc_html_e( 'MAKE AN INQUIRY', 'tour-operator' ); ?></a>
			</p>
		<?php } ?>
	</div>
</article>
<?php
echo $args['after_widget'];
}
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) )
$title = $instance[ 'title' ];
else
$title = __( 'Default Title', 'hstngr_widget_domain' );
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php
}
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
}
