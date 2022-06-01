<?php
/**
 * LSX Starter Child functions
 *
 * @package tsp-child
 */

require get_stylesheet_directory() . '/classes/class-core.php';
$theme_instance = \tsp_child\classes\Core::get_instance();

if ( apply_filters( 'lsx_to_page_navigation_disable', false, get_post_type() ) ) {
		return false;
	}

/**
 * Register our sidebars and widgetized areas.
 */
function arphabet_widgets_init() {

	register_sidebar(
		array(
			'name'          => 'Footer Subscribe',
			'id'            => 'footer_sub',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'arphabet_widgets_init' );

function home_widgets_init() {

	register_sidebar(
		array(
			'name'          => 'Home Why',
			'id'            => 'why-us',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'home_widgets_init' );



/**
* Outputs the destinations attached tours
*
* @package     tour-operator
* @subpackage  template-tags
* @category    destination
*/
function lsx_to_destination_tours_tsp() {
global $lsx_to_archive, $wp_query;

if ( post_type_exists( 'tour' ) && is_singular( 'destination' ) ) {
	$args = array(
		'from'      => 'tour',
		'to'        => 'destination',
		'column'    => '4',
		'before'    => '<section id="tours" class="lsx-to-section toptours-posts' . lsx_to_collapsible_class() . '"><h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title left" ' . lsx_to_collapsible_attributes( 'collapse-tours' ) . '>' . lsx_to_get_post_type_section_title( 'tour', '', esc_html__( 'Featured Tours', 'tour-operator' ) ) . '</h2><div id="collapse-tours" class="collapse in"><div class="collapse-inner">',
		'after'     => '</div></div></section>',
	);

	lsx_to_connected_panel_query( $args );
}
}

register_pattern (
    'lssx/who-we-are',
    array (
        'title'   => __( 'Who We Are', 'lsx' ),
        'content' => "<!-- wp:lsx-blocks/lsx-container {\"containerPaddingTop\":5.5,\"containerPaddingRight\":1,\"containerPaddingBottom\":2.5,\"containerPaddingLeft\":1,\"containerMarginTop\":2,\"containerMarginBottom\":2,\"containerBackgroundColor\":\"#ffffff\",\"className\":\"about-6\"} -->\n\t\t\t<div style=\"background-color:#ffffff;padding-left:1%;padding-right:1%;padding-bottom:2.5%;padding-top:5.5%;margin-top:2%;margin-bottom:2%\" class=\"wp-block-lsx-blocks-lsx-container about-6 aligncenter lsx-block-container\"><div class=\"lsx-container-inside\"><div class=\"lsx-container-content\" style=\"max-width:1200px\"><!-- wp:columns -->\n\t\t\t<div class=\"wp-block-columns\"><!-- wp:column -->\n\t\t\t<div class=\"wp-block-column\"><div class=\"image-box\"><figure class=\"image-box-img\"><img alt=\"Placeholder\" class=\"attachment-responsive wp-post-image lsx-responsive\" src=\"https://thesafaripartners-upgraded.lightspeedwp.dev/wp-content/uploads/2022/04/Screen-Shot-2022-04-21-at-3.09.04-PM.png\"></figure>\n\n\t\t\t<div class=\"box-content\"><h3 class=\"box-title\">We are local</h3><p class=\"box-description\">We are based in Noth America &amp; available to speak to you. </p></div></div></div>\n\t\t\t<!-- /wp:column -->\n\n\t\t\t<!-- wp:column -->\n\t\t\t<div class=\"wp-block-column\"><div class=\"image-box\"><figure class=\"image-box-img\"><img alt=\"Placeholder\" class=\"attachment-responsive wp-post-image lsx-responsive\" src=\"https://thesafaripartners-upgraded.lightspeedwp.dev/wp-content/uploads/2022/04/Screen-Shot-2022-04-21-at-3.09.04-PM.png\"></figure>\n\n\t\t\t<div class=\"box-content\"><h3 class=\"box-title\">We are Experts</h3><p class=\"box-description\">We have been to Africa and have a passion to share it.</p></div></div></div>\n\t\t\t<!-- /wp:column -->\n\n\t\t\t<!-- wp:column -->\n\t\t\t<div class=\"wp-block-column\"><div class=\"image-box\"><figure class=\"image-box-img\"><img alt=\"Placeholder\" class=\"attachment-responsive wp-post-image lsx-responsive\" src=\"https://thesafaripartners-upgraded.lightspeedwp.dev/wp-content/uploads/2022/04/Screen-Shot-2022-04-21-at-3.09.04-PM.png\"></figure>\n\n\t\t\t<div class=\"box-content\"><h3 class=\"box-title\">We Build Your Dreams</h3><p class=\"box-description\">We will create the perfect itinerary for you, based on your needs! </p></div></div></div>\n\t\t\t<!-- /wp:column -->\n\n\t\t\t<!-- wp:column -->\n\t\t\t<div class=\"wp-block-column\"><div class=\"image-box\"><figure class=\"image-box-img\"><img alt=\"Placeholder\" class=\"attachment-responsive wp-post-image lsx-responsive\" src=\"https://thesafaripartners-upgraded.lightspeedwp.dev/wp-content/uploads/2022/04/Screen-Shot-2022-04-21-at-3.09.04-PM.png\"></figure>\n\n\t\t\t<div class=\"box-content\"><h3 class=\"box-title\">We Do it All</h3><p class=\"box-description\">We can offer a complete travel package including flights and insurance.</p></div></div></div>\n\t\t\t<!-- /wp:column --></div>\n\t\t\t<!-- /wp:columns --></div></div></div>\n\t\t\t<!-- /wp:lsx-blocks/lsx-container -->",
    )
);
