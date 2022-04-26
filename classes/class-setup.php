<?php
/**
 * Class Setup
 *
 * @package   tsp_child\classes
 * @author    LightSpeed
 * @license   GPL-2.0+
 * @link
 * @copyright 2020 LightSpeed
 */

namespace tsp_child\classes;

/**
 * Class Setup
 *
 * @package tsp_child\classes
 */
class Setup {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object tsp_child\classes\Setup()
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
		add_action( 'after_setup_theme', array( $this, 'language_setup' ), 11 );
		add_action( 'init', array( $this, 'who_taxonomy_setup' ), 90 );
		add_action( 'init', array( $this, 'when_taxonomy_setup' ), 90 );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \tsp_child\classes\Setup()    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Load the text domain
	 *
	 * @return void
	 */
	public function language_setup() {
		load_child_theme_textdomain( 'tsp-child', get_stylesheet_directory() . '/languages' );
	}

	// Register Custom Taxonomy
	public function who_taxonomy_setup() {
		$labels = array(
			'name'                       => _x( 'Who', 'Taxonomy General Name', 'tsp-child' ),
			'singular_name'              => _x( 'Who', 'Taxonomy Singular Name', 'tsp-child' ),
			'menu_name'                  => __( 'Who', 'tsp-child' ),
			'all_items'                  => __( 'All Items', 'tsp-child' ),
			'parent_item'                => __( 'Parent Item', 'tsp-child' ),
			'parent_item_colon'          => __( 'Parent Item:', 'tsp-child' ),
			'new_item_name'              => __( 'New Item Name', 'tsp-child' ),
			'add_new_item'               => __( 'Add New Item', 'tsp-child' ),
			'edit_item'                  => __( 'Edit Item', 'tsp-child' ),
			'update_item'                => __( 'Update Item', 'tsp-child' ),
			'view_item'                  => __( 'View Item', 'tsp-child' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'tsp-child' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'tsp-child' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'tsp-child' ),
			'popular_items'              => __( 'Popular Items', 'tsp-child' ),
			'search_items'               => __( 'Search Items', 'tsp-child' ),
			'not_found'                  => __( 'Not Found', 'tsp-child' ),
			'no_terms'                   => __( 'No items', 'tsp-child' ),
			'items_list'                 => __( 'Items list', 'tsp-child' ),
			'items_list_navigation'      => __( 'Items list navigation', 'tsp-child' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'rewrite'                    => false,
			'show_in_rest'               => true,
		);
		register_taxonomy( 'who', array( 'tour' ), $args );
	}

	public function when_taxonomy_setup() {

		$labels = array(
			'name'                       => _x( 'When', 'Taxonomy General Name', 'tsp-child' ),
			'singular_name'              => _x( 'When', 'Taxonomy Singular Name', 'tsp-child' ),
			'menu_name'                  => __( 'When', 'tsp-child' ),
			'all_items'                  => __( 'All Items', 'tsp-child' ),
			'parent_item'                => __( 'Parent Item', 'tsp-child' ),
			'parent_item_colon'          => __( 'Parent Item:', 'tsp-child' ),
			'new_item_name'              => __( 'New Item Name', 'tsp-child' ),
			'add_new_item'               => __( 'Add New Item', 'tsp-child' ),
			'edit_item'                  => __( 'Edit Item', 'tsp-child' ),
			'update_item'                => __( 'Update Item', 'tsp-child' ),
			'view_item'                  => __( 'View Item', 'tsp-child' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'tsp-child' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'tsp-child' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'tsp-child' ),
			'popular_items'              => __( 'Popular Items', 'tsp-child' ),
			'search_items'               => __( 'Search Items', 'tsp-child' ),
			'not_found'                  => __( 'Not Found', 'tsp-child' ),
			'no_terms'                   => __( 'No items', 'tsp-child' ),
			'items_list'                 => __( 'Items list', 'tsp-child' ),
			'items_list_navigation'      => __( 'Items list navigation', 'tsp-child' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'rewrite'                    => false,
			'show_in_rest'               => true,
		);
		register_taxonomy( 'when', array( 'tour' ), $args );
	}
}
