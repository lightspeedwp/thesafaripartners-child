<?php
/**
 * Class FrontEnd
 *
 * @package   tsp_child\classes
 * @author    LightSpeed
 * @license   GPL-2.0+
 * @link
 * @copyright 2020 LightSpeed
 */

namespace tsp_child\classes;

/**
 * Class Frontend
 *
 * @package tsp_child\classes
 */
class Frontend {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object tsp_child\classes\Frontend()
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 11 );
		add_action( 'wp_head', array( $this, 'wp_head' ), 200 );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \tsp_child\classes\Frontend()    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Enqueues the parent and the child theme styles.
	 *
	 * @package    tsp-child
	 * @subpackage setup
	 */
	public function scripts() {
		if ( defined( 'SCRIPT_DEBUG' ) ) {
			$prefix = '';
			$suffix = '';
		} else {
			$prefix = '';
			$suffix = '.min';
		}
		// https://github.com/lightspeeddevelopment/tsp-child.git
		// Fonts from LSX Theme. Add these lines if your website will use a different font.
		// wp_dequeue_style( 'lsx-header-font' );
		// wp_dequeue_style( 'lsx-body-font' );
		// wp_dequeue_style( 'lsx_font_scheme' );

		// Google Fonts. Add these lines if your website will use a different font.
		// wp_enqueue_style( 'tsp-child-quattrocento-sans', 'https://fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i' );

		wp_enqueue_script( 'tsp-child-scripts', get_stylesheet_directory_uri() . '/assets/js/' . $prefix . 'custom' . $suffix . '.js', array( 'jquery' ) );
	}

	public function wp_head() {
		remove_action( 'lsx_content_wrap_before', 'lsx_to_single_content_top', 110 );
		remove_action( 'lsx_content_bottom', 'lsx_to_destination_single_content_bottom' );
		remove_action( 'lsx_content_bottom', 'lsx_to_tour_single_content_bottom' );
		remove_action( 'lsx_to_fast_facts', 'lsx_to_destination_single_fast_facts' );
		remove_action( 'lsx_to_fast_facts', 'lsx_to_tour_single_fast_facts' );
		add_action( 'lsx_content_bottom', 'lsx_to_destination_tours_tsp' );
		add_action( 'lsx-thumbnail-single', 'lsx_to_destination_single_fast_facts' );
		remove_action( 'init', 'lsx_register_block_patterns', 9 );
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
add_action( 'init', 'lsx_child_register_block_patterns', 9 );
