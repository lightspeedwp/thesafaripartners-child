<?php
/**
 * LSX Starter Child functions
 *
 * @package tsp-child
 */

require get_stylesheet_directory() . '/classes/class-core.php';
require get_template_directory() . '/widgets/content-widget-travel-style.php';
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

function home_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home Why',
		'id'            => 'why-us',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'home_widgets_init' );
