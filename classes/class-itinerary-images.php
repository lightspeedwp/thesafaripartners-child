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
class Itinerary_Images {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object tsp_child\classes\Itinerary_Images()
	 */
	protected static $instance = null;

	/**
	 * Holds the an array of gallery ids from each accommodations attached to the itinerary.
	 *
	 * @since 1.0.0
	 *
	 * @var      array
	 */
	public $current_attachments = array();

	/**
	 * Holds the an array of attachment ids
	 *
	 * @since 1.0.0
	 *
	 * @var      string
	 */
	public $images_used = array(0);

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function __construct() {
		add_filter( 'lsx_to_itinerary_empty_attachments', array( $this, 'find_next_image' ), 10, 2 );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \tsp_child\classes\Itinerary_Images()    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Undocumented function
	 *
	 * @param int $item_id
	 * @param object $itinerary_query
	 * @return int
	 */
	public function find_next_image( $item_id, $itinerary_query ) {
		$return = false;
		if ( false !== $item_id ) {
			$this->register_current_gallery( $item_id, $itinerary_query );

			if ( isset( $this->current_attachments[ $item_id ] ) && ! empty( $this->current_attachments[ $item_id ] ) ) {
				$images_left = array_diff( $this->current_attachments[ $item_id ], $this->images_used );
				if ( is_array( $images_left ) && ! empty( $images_left ) ) {
					$images_left = array_values( $images_left );
					shuffle( $images_left );
					$return = array_shift( $images_left );
				}
			}
		}

		return $return;
	}

	/**
	 * Pulls the current days accommodation and saves them for use incase an image has already been displayed.
	 *
	 * @param   $accommodation_id   | string
	 */
	public function register_current_gallery( $item_id = false, $itinerary_query ) {
		if ( false !== $item_id && ! isset( $this->current_attachments[ $item_id ] ) ) {
			if ( ! empty( $itinerary_query->current_attachments[ $item_id ] ) ) {
				$this->current_attachments[ $item_id ] = $itinerary_query->current_attachments[ $item_id ];
			} else {
				$gallery = get_post_meta( $item_id, 'gallery', false );
				if ( false !== $gallery && ! empty( $gallery ) ) {
					$this->current_attachments[ $item_id ] = $gallery;
				}
			}
		}
	}
}
