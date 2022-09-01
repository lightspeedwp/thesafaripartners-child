<?php
/**
 * Class Core
 *
 * @package   tsp_child\classes
 * @author    LightSpeed
 * @license   GPL-2.0+
 * @link
 * @copyright 2020 LightSpeed
 */

namespace tsp_child\classes;

use stdClass;

/**
 * Class Core
 *
 * @package tsp_child\classes
 */
class Core {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object tsp_child\classes\Core()
	 */
	protected static $instance = null;

	/**
	 * Setup
	 *
	 * @var object tsp_child\classes\Setup();
	 */
	public $setup;

	/**
	 * Admin
	 *
	 * @var object tsp_child\classes\Admin();
	 */
	public $admin;

	/**
	 * FrontEnd
	 *
	 * @var object tsp_child\classes\Frontend();
	 */
	public $frontend;

	/**
	 * Search
	 *
	 * @var object tsp_child\classes\Search();
	 */
	public $search;

	/**
	 * Holds the FaceWP instances
	 *
	 * @var object tsp_child\classes\facetwp\Post_Connections();
	 */
	public $facetwp;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function __construct() {
		require_once get_stylesheet_directory() . '/classes/class-setup.php';
		$this->setup = Setup::get_instance();

		require_once get_stylesheet_directory() . '/classes/class-admin.php';
		$this->admin = Admin::get_instance();

		require_once get_stylesheet_directory() . '/classes/class-frontend.php';
		$this->frontend = Frontend::get_instance();

		require_once get_stylesheet_directory() . '/classes/class-post-connections.php';
		$this->facetwp = new stdClass();
		$this->facetwp->post_connections = \tsp_child\classes\facetwp\Post_Connections::get_instance();

		require_once get_stylesheet_directory() . '/classes/class-dates-prices-admin.php';
		$this->dates_prices = Dates_Prices_Admin::get_instance();

		require_once get_stylesheet_directory() . '/classes/class-wetu-importer.php';
		$this->wetu_importer = WETU_Importer::get_instance();

		require_once get_stylesheet_directory() . '/includes/template-tags.php';
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object tsp_child\classes\Core()    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;

	}
}
