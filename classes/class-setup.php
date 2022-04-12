<?php
/**
 * Class Setup
 *
 * @package   lsx_starter_child_theme\classes
 * @author    LightSpeed
 * @license   GPL-2.0+
 * @link
 * @copyright 2020 LightSpeed
 */

namespace lsx_starter_child_theme\classes;

/**
 * Class Setup
 *
 * @package lsx_starter_child_theme\classes
 */
class Setup {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object lsx_starter_child_theme\classes\Setup()
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
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \lsx_starter_child_theme\classes\Setup()    A single instance of this class.
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
		load_child_theme_textdomain( 'lsx-starter-child-theme', get_stylesheet_directory() . '/languages' );
	}
}
