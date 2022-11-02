<?php
/**
 * Class Admin
 *
 * @package   tsp_child\classes
 * @author    LightSpeed
 * @license   GPL-2.0+
 * @link
 * @copyright 2020 LightSpeed
 */

namespace tsp_child\classes;

/**
 * Class Admin
 *
 * @package tsp_child\classes
 */
class Admin {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object tsp_child\classes\Admin()
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
		add_filter( 'lsx_wetu_tour_refresh_url', array( $this, 'set_importer_defaults' ), 10, 1 );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \tsp_child\classes\Admin()    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * The tour URL to ping.
	 *
	 * @param string $url
	 * @return string
	 */
	public function set_importer_defaults( $url ) {
		$url = str_replace( '&type=Sample', '&type=personal', $url );
		$url = str_replace( '&type', '&operatorid=3487&type', $url );
		return $url;
	}
}
