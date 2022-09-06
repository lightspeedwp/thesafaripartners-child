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
		add_action( 'init', array( $this, 'budget_taxonomy_setup' ), 90 );
		add_action( 'init', array( $this, 'tour_type_setup' ), 100 );
		add_filter( 'register_taxonomy_args', array( $this, 'change_taxonomies_slug' ), 10, 2 );
		add_filter( 'register_post_type_args', array( $this, 'change_post_types' ), 10, 2 );
		add_filter( 'lsx_to_js_params', array( $this, 'slider_variables' ), 10, 1 );
		add_action( 'admin_menu', array( $this, 'register_sub_menus' ) );

		$this->menu_position = 100;
		add_filter( 'tour-operator-menu-position', array( $this, 'admin_menu_position' ), 10, 2 );

		//remove the filters we need
		add_filter( 'lsx_to_disable_map', array( $this, 'disable_map' ), 10, 1 );
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
		load_child_theme_textdomain( 'thesafaripartners-child', get_stylesheet_directory() . '/languages' );

		register_nav_menus(
			array(
				'filter-menu' => esc_html__( 'Filter Menu', 'thesafaripartners-child' ),
			)
		);

		add_filter( 'facetwp_api_can_access', function( $boolean ) {
			return true;
		});
	}

	// Register Custom Taxonomy
	public function who_taxonomy_setup() {
		$labels = array(
			'name'                       => _x( 'Who', 'Taxonomy General Name', 'thesafaripartners-child' ),
			'singular_name'              => _x( 'Who', 'Taxonomy Singular Name', 'thesafaripartners-child' ),
			'menu_name'                  => __( 'Who', 'thesafaripartners-child' ),
			'all_items'                  => __( 'All Items', 'thesafaripartners-child' ),
			'parent_item'                => __( 'Parent Item', 'thesafaripartners-child' ),
			'parent_item_colon'          => __( 'Parent Item:', 'thesafaripartners-child' ),
			'new_item_name'              => __( 'New Item Name', 'thesafaripartners-child' ),
			'add_new_item'               => __( 'Add New Item', 'thesafaripartners-child' ),
			'edit_item'                  => __( 'Edit Item', 'thesafaripartners-child' ),
			'update_item'                => __( 'Update Item', 'thesafaripartners-child' ),
			'view_item'                  => __( 'View Item', 'thesafaripartners-child' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'thesafaripartners-child' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'thesafaripartners-child' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'thesafaripartners-child' ),
			'popular_items'              => __( 'Popular Items', 'thesafaripartners-child' ),
			'search_items'               => __( 'Search Items', 'thesafaripartners-child' ),
			'not_found'                  => __( 'Not Found', 'thesafaripartners-child' ),
			'no_terms'                   => __( 'No items', 'thesafaripartners-child' ),
			'items_list'                 => __( 'Items list', 'thesafaripartners-child' ),
			'items_list_navigation'      => __( 'Items list navigation', 'thesafaripartners-child' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'rewrite'             => array(
				'slug' => 'who',
			),
			'show_in_rest'               => true,
		);
		register_taxonomy( 'who', 'tour', $args );
	}

	public function when_taxonomy_setup() {

		$labels = array(
			'name'                       => _x( 'When', 'Taxonomy General Name', 'thesafaripartners-child' ),
			'singular_name'              => _x( 'When', 'Taxonomy Singular Name', 'thesafaripartners-child' ),
			'menu_name'                  => __( 'When', 'thesafaripartners-child' ),
			'all_items'                  => __( 'All Items', 'thesafaripartners-child' ),
			'parent_item'                => __( 'Parent Item', 'thesafaripartners-child' ),
			'parent_item_colon'          => __( 'Parent Item:', 'thesafaripartners-child' ),
			'new_item_name'              => __( 'New Item Name', 'thesafaripartners-child' ),
			'add_new_item'               => __( 'Add New Item', 'thesafaripartners-child' ),
			'edit_item'                  => __( 'Edit Item', 'thesafaripartners-child' ),
			'update_item'                => __( 'Update Item', 'thesafaripartners-child' ),
			'view_item'                  => __( 'View Item', 'thesafaripartners-child' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'thesafaripartners-child' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'thesafaripartners-child' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'thesafaripartners-child' ),
			'popular_items'              => __( 'Popular Items', 'thesafaripartners-child' ),
			'search_items'               => __( 'Search Items', 'thesafaripartners-child' ),
			'not_found'                  => __( 'Not Found', 'thesafaripartners-child' ),
			'no_terms'                   => __( 'No items', 'thesafaripartners-child' ),
			'items_list'                 => __( 'Items list', 'thesafaripartners-child' ),
			'items_list_navigation'      => __( 'Items list navigation', 'thesafaripartners-child' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'rewrite'             => array(
				'slug' => 'when',
			),
			'show_in_rest'               => true,
		);
		register_taxonomy( 'when', 'tour', $args );
	}

	public function budget_taxonomy_setup() {

		$labels = array(
			'name'                       => _x( 'Budget', 'Taxonomy General Name', 'thesafaripartners-child' ),
			'singular_name'              => _x( 'Budget', 'Taxonomy Singular Name', 'thesafaripartners-child' ),
			'menu_name'                  => __( 'Budget', 'thesafaripartners-child' ),
			'all_items'                  => __( 'All Items', 'thesafaripartners-child' ),
			'parent_item'                => __( 'Parent Item', 'thesafaripartners-child' ),
			'parent_item_colon'          => __( 'Parent Item:', 'thesafaripartners-child' ),
			'new_item_name'              => __( 'New Item Name', 'thesafaripartners-child' ),
			'add_new_item'               => __( 'Add New Item', 'thesafaripartners-child' ),
			'edit_item'                  => __( 'Edit Item', 'thesafaripartners-child' ),
			'update_item'                => __( 'Update Item', 'thesafaripartners-child' ),
			'view_item'                  => __( 'View Item', 'thesafaripartners-child' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'thesafaripartners-child' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'thesafaripartners-child' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'thesafaripartners-child' ),
			'popular_items'              => __( 'Popular Items', 'thesafaripartners-child' ),
			'search_items'               => __( 'Search Items', 'thesafaripartners-child' ),
			'not_found'                  => __( 'Not Found', 'thesafaripartners-child' ),
			'no_terms'                   => __( 'No items', 'thesafaripartners-child' ),
			'items_list'                 => __( 'Items list', 'thesafaripartners-child' ),
			'items_list_navigation'      => __( 'Items list navigation', 'thesafaripartners-child' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'rewrite'             => array(
				'slug' => 'budget',
			),
			'show_in_rest'               => true,
		);
		register_taxonomy( 'budget', 'tour', $args );
	}

	public function tour_type_setup() {
		$labels = array(
			'name'                       => _x( 'Tour Type', 'Taxonomy General Name', 'thesafaripartners-child' ),
			'singular_name'              => _x( 'Tour Type', 'Taxonomy Singular Name', 'thesafaripartners-child' ),
			'menu_name'                  => __( 'Tour Types', 'thesafaripartners-child' ),
			'all_items'                  => __( 'All Types', 'thesafaripartners-child' ),
			'parent_item'                => __( 'Parent Type', 'thesafaripartners-child' ),
			'parent_item_colon'          => __( 'Parent Type:', 'thesafaripartners-child' ),
			'new_item_name'              => __( 'New Type Name', 'thesafaripartners-child' ),
			'add_new_item'               => __( 'Add New Type', 'thesafaripartners-child' ),
			'edit_item'                  => __( 'Edit Type', 'thesafaripartners-child' ),
			'update_item'                => __( 'Update Type', 'thesafaripartners-child' ),
			'view_item'                  => __( 'View Type', 'thesafaripartners-child' ),
			'separate_items_with_commas' => __( 'Separate types with commas', 'thesafaripartners-child' ),
			'add_or_remove_items'        => __( 'Add or remove types', 'thesafaripartners-child' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'thesafaripartners-child' ),
			'popular_items'              => __( 'Popular Types', 'thesafaripartners-child' ),
			'search_items'               => __( 'Search Types', 'thesafaripartners-child' ),
			'not_found'                  => __( 'Not Found', 'thesafaripartners-child' ),
			'no_terms'                   => __( 'No items', 'thesafaripartners-child' ),
			'items_list'                 => __( 'Types list', 'thesafaripartners-child' ),
			'items_list_navigation'      => __( 'Types list navigation', 'thesafaripartners-child' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => false,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'rewrite'             		 => false,
			'show_in_rest'               => true,
		);
		register_taxonomy( 'tour-type', array( 'tour' ), $args );
	}

	/**
	 * Register the taxonomy menus.
	 *
	 * @return void
	 */
	public function register_sub_menus() {
		add_submenu_page( 'tour-operator', __( 'Who', 'thesafaripartners-child' ), __( 'Who', 'thesafaripartners-child' ), 'edit_posts', 'edit-tags.php?taxonomy=who' );
		add_submenu_page( 'tour-operator', __( 'When', 'thesafaripartners-child' ), __( 'When', 'thesafaripartners-child' ), 'edit_posts', 'edit-tags.php?taxonomy=when' );
		add_submenu_page( 'tour-operator', __( 'Budget', 'thesafaripartners-child' ), __( 'Budget', 'thesafaripartners-child' ), 'edit_posts', 'edit-tags.php?taxonomy=budget' );
		add_submenu_page( 'tour-operator', __( 'Tour Type', 'thesafaripartners-child' ), __( 'Tour Type', 'thesafaripartners-child' ), 'edit_posts', 'edit-tags.php?taxonomy=tour-type' );
	}

	public function admin_menu_position( $position, $config ) {
		if ( empty( $config ) ) {
			$position = $this->menu_position;
			$this->menu_position++;
		}
		return $position;
	}

	/**
	 * Disable the TO map on certain pages.
	 *
	 * @param boolean $disable
	 * @return boolean
	 */
	public function disable_map( $disable = false ) {
		if ( is_post_type_archive( 'destination' ) ) {
			$disable = true;
		}
		return $disable;
	}

	/**
	 * CHanges the slugs of the taxonomies
	 *
	 * @param array $args
	 * @param string $taxonomy
	 * @return array
	 */
	public function change_taxonomies_slug( $args, $taxonomy ) {
   
		/*item category*/
		if ( 'travel-style' === $taxonomy ) {
		   $args['rewrite']['slug'] = 'safari-style';
		   $args['labels']['menu_name'] = 'Safari Styles';
		}
		
		return $args;
	}

	/**
	 * CHanges the slugs of the taxonomies
	 *
	 * @param array $args
	 * @param string $taxonomy
	 * @return array
	 */
	public function change_post_types( $args, $post_type ) {
		if ( 'destination' === $post_type ) {
		   $args['has_archive'] = false;
		}
		return $args;
	}

	/**
	 * Alter the slider parameters.
	 *
	 * @param array $args
	 * @return array
	 */
	public function slider_variables( $args = array() ) {
		$args['tablet']['breakpoint'] = 900;
		$args['tablet']['slidesToShow'] = 2;
		$args['tablet']['slidesToScroll'] = 2;
		$args['tablet']['arrows'] = true;
		$args['mobile']['arrows'] = true;
		return $args;
	}
}
