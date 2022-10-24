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
	 * @var array
	 */
	public $current_attachments = array();

	/**
	 * Holds the an array of attachment ids
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public $images_used = array(0);

	/**
	 * Holds the last postID used
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public $last_post_id = false;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function __construct() {
		add_filter( 'lsx_to_itinerary_empty_attachments', array( $this, 'find_next_image' ), 10, 2 );
		add_filter( 'lsx_to_itinerary_thumbnail_src', array( $this, 'departure_day_image' ), 11, 3 );
		add_filter( 'tsp_date_prices_image', array( $this, 'date_prices_image' ), 10, 1 );
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
		if ( false !== $item_id && 0 !== $item_id && '' !== $item_id ) {
			$this->last_post_id    = $item_id;

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
				shuffle( $this->current_attachments[ $item_id ] );
			} else {
				$gallery = get_post_meta( $item_id, 'gallery', false );
				if ( false !== $gallery && ! empty( $gallery ) ) {
					$this->current_attachments[ $item_id ] = $gallery;
					shuffle( $this->current_attachments[ $item_id ] );
				}
			}
		}
	}

	/**
	 * Overwrites the departure days thumbanil with the tours featured image.
	 *
	 * @param $thumbnail_src string
	 * @param $index string
	 * @param $count string
	 * @return string
	 */
	function departure_day_image( $thumbnail_src = false, $index = 1, $count = 0, $size = 'lsx-thumbnail-square' ) {
		if ( $count <= $index ) {
			$next_image = false;

			global $tour_itinerary;
			// Then look for a second use image.
			if ( false === $next_image && 0 !== $tour_itinerary->last_item_id && '' !== $tour_itinerary->last_item_id ) {
				$next_image = $this->find_next_image( $tour_itinerary->last_item_id, $tour_itinerary );
				if ( false !== $next_image ) {
					$tour_itinerary->save_used_image( $next_image );
					$this->save_used_image( $next_image );
				}
			}

			// Then look for a second use image.
			if ( false === $next_image && 0 !== $this->last_post_id && '' !== $this->last_post_id ) {
				$next_image = $this->find_next_image( $this->last_post_id, $tour_itinerary );
				if ( false !== $next_image ) {
					$this->save_used_image( $next_image );
				}
			}

			// If there is one use it.
			if ( false !== $next_image ) {
				
				$temp_src_array   = wp_get_attachment_image_src( $next_image, 'large' );
				if ( is_array( $temp_src_array ) ) {
					$thumbnail_src = $temp_src_array[0];
				}
			}
		}
		return $thumbnail_src;
	}

	public function date_prices_image( $thumbnail_src = false ) {
		$thumbnail_src = $this->departure_day_image( $thumbnail_src, 1, 1 );
		return $thumbnail_src;
	}

	/**
	 * Save the id of the images that have already been displayed.
	 *
	 * @param   $image_id   | string
	 */
	public function save_used_image( $image_id = false ) {
		if ( false !== $image_id ) {
			$this->images_used[] = $image_id;
		}
	}
}
