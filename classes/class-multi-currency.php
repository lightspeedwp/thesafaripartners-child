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
class Multi_Currency {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object tsp_child\classes\Multi_Currency()
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
		add_filter( 'lsx_to_tour_custom_fields', array( $this, 'fields' ), 80, 1 );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \tsp_child\classes\WETU_Automation()    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 *  adds in our multiple prices field
	 */
	public function fields( $meta_boxes ) {
			$currency_options = array(
				'' => 'Default',
				'ZAR' => 'ZAR',
				'USD' => 'USD',
				'EUR' => 'EUR',
			);

			$new_boxes = array();
			$injected = false;
			if ( ! empty( $meta_boxes ) ) {
				foreach ( $meta_boxes as $meta_box ) {
					if ( 'price' === $meta_box['id'] ) {
						$new_boxes[] = array(
							'id' => 'price',
							'name' => 'Price',
							'type' => 'text',
						);
						$new_boxes[] = array(
							'id' => 'currency',
							'name' => 'Currency',
							'type' => 'select',
							'options' => $currency_options,
						);
						$injected = true;
						continue;
					}
					$new_boxes[] = $meta_box;
				}
			}
			if ( true === $injected ) {
				$meta_boxes = $new_boxes;
			}
		return $meta_boxes;
	}
}
