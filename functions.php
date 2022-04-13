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

function tsp_widgets_init() {

	register_sidebar( array(
		'name'          => 'Posts Navigation',
		'id'            => 'post_nav',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );
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
}
add_action( 'widgets_init', 'tsp_widgets_init' );
