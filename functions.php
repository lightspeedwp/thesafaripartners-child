<?php
/**
 * LSX Starter Child functions
 *
 * @package tsp-child
 */

require get_stylesheet_directory() . '/classes/class-core.php';
$theme_instance = \tsp_child\classes\Core::get_instance();

/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Footer Subscribe',
		'id'            => 'footer_sub',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );

// Creating the widget
class wpb_widget extends WP_Widget {

function __construct() {
parent::__construct(

// Base ID of your widget
'wpb_widget',

// Widget name will appear in UI
__('WPBeginner Widget', 'wpb_widget_domain'),

// Widget description
array( 'description' => __( 'Sample widget based on WPBeginner Tutorial', 'wpb_widget_domain' ), )
);
}

// Creating widget front-end

public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
echo __( 'Hello, World!', 'wpb_widget_domain' );
echo $args['after_widget'];
}

// Widget Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'wpb_widget_domain' );
}
// Widget admin form
?>
<ul>

<?php
// Define our WP Query Parameters
$the_query = new WP_Query( 'posts_per_page=5' ); ?>

<?php
// Start our WP Query
while ($the_query -> have_posts()) : $the_query -> the_post();
// Display the Post Title with Hyperlink
?>

<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>

<li><?php
// Display the Post Excerpt
the_excerpt(__('(more…)')); ?></li>

<?php
// Repeat the process and reset once it hits the limit
endwhile;
wp_reset_postdata();
?>
</ul>
<?php
}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}

// Class wpb_widget ends here
}

// Register and load the widget
function wpb_load_widget() {
    register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' )
