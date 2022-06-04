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

function lsx_child_register_block_patterns() {
	$block_pattern_categories = array(
		'featured' => array( 'label' => __( 'Featured', 'lsx' ) ),
		'footer'   => array( 'label' => __( 'Footers', 'lsx' ) ),
		'header'   => array( 'label' => __( 'Headers', 'lsx' ) ),
		'query'    => array( 'label' => __( 'Query', 'lsx' ) ),
		'pages'    => array( 'label' => __( 'Pages', 'lsx' ) ),
	);

	/**
	 * Filters the theme block pattern categories.
	 *
	 * @since LSX 1.0
	 *
	 * @param array[] $block_pattern_categories {
	 *     An associative array of block pattern categories, keyed by category name.
	 *
	 *     @type array[] $properties {
	 *         An array of block category properties.
	 *
	 *         @type string $label A human-readable label for the pattern category.
	 *     }
	 * }
	 */
	$block_pattern_categories = apply_filters( 'lsx_block_pattern_categories', $block_pattern_categories );

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}

	$block_patterns = array(
		'who-we-are',
	);

	/**
	 * Filters the theme block patterns.
	 *
	 * @since LSX 1.0
	 *
	 * @param array $block_patterns List of block patterns by name.
	 */
	$block_patterns = apply_filters( 'lsx_block_patterns', $block_patterns );

	foreach ( $block_patterns as $block_pattern ) {
		$pattern_file = get_child_theme_file_path( '/includes/patterns/' . $block_pattern . '.php' );

		register_block_pattern(
			'lsx/' . $block_pattern,
			require $pattern_file
		);
	}
}
add_action( 'init', 'lsx_child_register_block_patterns', 120 );
