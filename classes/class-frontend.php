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

class TO_Taxonomy_Admin {

	public $taxonomies = array( 'category' );

	public $fields = false;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	public function __construct( $taxonomies = false ) {
		add_action( 'admin_init', array( $this, 'init' ), 100 );
		if ( false !== $taxonomies ) {
			$this->taxonomies = $taxonomies;
		}

		$this->fields = array(
			'expert' => esc_html__( 'Expert', 'lsx-banners' ),
		);
	}

	/**
	 * Output the form field for this metadata when adding a new term
	 *
	 * @since 1.0.0
	 */
	public function init() {
		$this->taxonomies = apply_filters( 'lsx_taxonomy_admin_taxonomies', $this->taxonomies );

		if ( false !== $this->taxonomies ) {
			add_action( 'create_term', array( $this, 'save_meta' ), 10, 2 );
			foreach ( $this->taxonomies as $taxonomy ) {
				add_action( "edit_{$taxonomy}", array( $this, 'save_meta' ), 10, 2 );
				add_action( "{$taxonomy}_edit_form_fields", array( $this, 'add_tagline_form_field' ), 3, 1 );
			}
		}
	}
	/**
	 * Output the form field for this metadata when adding a new term
	 *
	 * @since 1.0.0
	 */
	public function widget_taxonomies( $taxonomies ) {
		if ( false !== $this->taxonomies ) {
			$taxonomies = array_merge( $taxonomies, $this->taxonomies );
		}
		return $taxonomies;
	}

	/**
	 * Saves the Taxnomy term banner image
	 *
	 * @since 1.0.0
	 *
	 * @param  int    $term_id
	 * @param  string $taxonomy
	 */
	public function save_meta( $term_id = 0, $taxonomy = '' ) {
		if ( ! wp_verify_nonce( sanitize_text_field( $_REQUEST['lsx_banners_term_thumbnail_nonce'] ), 'lsx_banners_save_term_thumbnail' ) ) {
			return;
		}
		if ( false !== $this->fields ) {
			foreach ( $this->fields as $slug => $label ) {
				if ( empty( $_POST[ $slug ] ) ) {
					delete_term_meta( $term_id, $slug );
				} else {
					update_term_meta( $term_id, $slug, $_POST[ $slug ] );
				}
			}
		}
	}

	/**
	 * Output the form field for this metadata when adding a new term
	 *
	 * @since 1.0.0
	 */
	public function add_expert_form_field( $term = false ) {
		if ( is_object( $term ) ) {
			$value = get_term_meta( $term->term_id, 'expert', true );
		} else {
			$value = false;
		}

		$experts = get_posts(
			array(
				'post_type' => 'team',
				'posts_per_page' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC',
			)
		);
		?>

		<tr class="form-field term-expert-wrap">
			<th scope="row">
				<label for="expert"><?php esc_html_e( 'Expert', 'lsx-banners' ); ?></label>
			</th>

			<td>
				<select name="expert" id="expert" aria-required="true">
					<option value=""><?php esc_html_e( 'None', 'lsx-banners' ); ?></option>

					<?php
					foreach ( $experts as $expert ) {
						echo '<option value="' . esc_attr( $expert->ID ) . '"' . selected( $value, esc_attr( $expert->ID ), false ) . '>' . esc_attr( $expert->post_title ) . '</option>';
					}
					?>
				</select>
			</td>
		</tr>

		<?php
	}
}

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
		add_action( 'pre_get_posts', array( $this, 'set_main_query_arguments' ), 200, 1 );

		// Frontend general
		add_action( 'lsx_banner_container_bottom', array( $this, 'archive_banner_navigation' ), 200 );
		add_filter( 'lsx_to_get_itinerary_ids_meta_key', array( $this, 'mobile_map_keys' ), 10, 1 );
		add_filter( 'lsx_to_itinerary_title', array( $this, 'mobile_itinerary_title' ), 10, 2 );
		add_filter( 'lsx_to_parents_only', array( $this, 'order_tour_countries' ), 20, 2 );
		add_filter( 'the_content', array( $this, 'the_content' ), 100 );
		add_filter( 'lsx_currencies_nav_additional_items', array( $this, 'order_currency_dropdown' ), 10, 1 );

		// Gravity Forms Functions
		add_filter( 'gform_pre_render_4', array( $this, 'populate_prices_dropdown' ) );
		add_filter( 'gform_pre_validation_4', array( $this, 'populate_prices_dropdown' ) );
		add_filter( 'gform_pre_submission_filter_4', array( $this, 'populate_prices_dropdown' ) );
		add_filter( 'gform_field_value_tour_type', array( $this, 'populate_tour_type' ) );

		// LSX Sharing function
		add_filter( 'lsx_sharing_additional_buttons', array( $this, 'display_email_sharing' ), 10, 2 );

		// Search functions
		add_filter( 'searchwp\query\results', array( $this, 'get_swp_relevance' ), 10, 2 );
		add_filter( 'facetwp_filtered_post_ids', array( $this, 'sort_serch_results' ) , 10, 2 );
		add_filter( 'facetwp_query_args', array( $this, 'facetwp_filtered_query_args' ) , 10, 2 );
		add_filter( 'megamenu_search_replacement_html', array( $this, 'search_header_html' ), 10, 1 );
		add_filter( 'rest_post_collection_params', array( $this, 'rest_params' ) , 10, 2 );

		// Rest Functions
		add_filter( 'rest_prepare_tour', array( $this, 'add_tour_archive_template_to_rest' ), 10, 3 );
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
	 * @package    thesafaripartners-child
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
		// https://github.com/lightspeeddevelopment/thesafaripartners-child.git
		// Fonts from LSX Theme. Add these lines if your website will use a different font.
		// wp_dequeue_style( 'lsx-header-font' );
		// wp_dequeue_style( 'lsx-body-font' );
		// wp_dequeue_style( 'lsx_font_scheme' );

		// Google Fonts. Add these lines if your website will use a different font.
		// wp_enqueue_style( 'thesafaripartners-child-quattrocento-sans', 'https://fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i' );

		wp_enqueue_script( 'thesafaripartners-child-scripts', get_stylesheet_directory_uri() . '/assets/js/' . $prefix . 'custom' . $suffix . '.js', array( 'jquery', 'jquery-ui-core' ) );

		if ( is_singular( array( 'tour' ) ) ) {
			wp_enqueue_script( 'thesafaripartners-child-tour-wizard', get_stylesheet_directory_uri() . '/assets/js/tour-wizard.js', array( 'jquery' ), TSP_CHILD_VER, true );
		}
	}

	public function wp_head() {
		remove_action( 'lsx_content_wrap_before', 'lsx_to_single_content_top', 110 );
		remove_action( 'lsx_content_bottom', 'lsx_to_destination_single_content_bottom' );
		remove_action( 'lsx_content_bottom', 'lsx_to_tour_single_content_bottom' );
		remove_action( 'lsx_to_fast_facts', 'lsx_to_destination_single_fast_facts' );
		remove_action( 'lsx_to_fast_facts', 'lsx_to_tour_single_fast_facts' );
		add_action( 'lsx_content_bottom', 'lsx_to_destination_tours_tsp' );
		add_action( 'lsx-thumbnail-single', 'lsx_to_destination_single_fast_facts' );

		remove_action( 'lsx_to_map_meta', 'lsx_to_accommodation_meta' );
		add_action( 'lsx_to_map_meta', 'tsp_map_meta' );
	}


	public function set_main_query_arguments( $query ) {
		if ( ! is_admin() && $query->is_main_query() ) {

			$taxonomies = array(
				'who',
				'travel-style',
			);

			if ( true === $query->is_tax( $taxonomies )  ) {
				$query->set( 'posts_per_page', -1 );
				$query->set( 'nopagin', true );
				$query->set( 'post_type', 'tour' );
			}

			if ( is_search() ) {
				$query->set( 'posts_per_page', -1 );
				$query->set( 'nopagin', true );
				$query->set( 'post_type', 'tour' );
				$query->set( 'orderby', 'relevance' );
			}
		}
	}

	public function get_swp_relevance( $results, $query ){
		global $search_relevance;

		if( empty( $results) ){
			return $results;
		}
		$search_relevance = array();

		if ( class_exists( 'SearchWP' ) ) {
			remove_filter( 'searchwp\query\results', array( $this, 'get_swp_relevance' ) );
			$max_relevance_query = new \SearchWP\Query( $query->get_keywords( true ),
				[
					'engine' => $query->get_engine()->get_name(),
					'per_page' => 1
				]
			);
			$max_relevance = (int)$max_relevance_query->results[0]->relevance;
			$posts_relevance = wp_list_pluck( $query->get_raw_results(), 'relevance', 'id' );
			
			foreach( $results as $index => $result ){
				if ( isset( $posts_relevance[$result] ) ) {
					$relevance = round( ( $posts_relevance[$result] * 100 ) / $max_relevance );
					$search_relevance[$result] = $relevance;
	
					if ( (int) $relevance < 50 ) {
						unset( $results[ $index ] );
					}
				}
			}
		}

		//sort the results by the relevance.
		if ( ! empty( $results ) ) {
			arsort( $search_relevance );
			$results = array_keys( $search_relevance );
		}
	
		return $results;
	}

	public function populate_prices_dropdown( $form ) {
		foreach ( $form['fields'] as &$field ) {
			if ( $field->type != 'select' || strpos( $field->cssClass, 'dates-prices-dropdown' ) === false ) {
				continue;
			}
			$choices = array();

			$price_row_amount = get_post_meta( get_the_ID(), 'price_row', true );
			if ( false !== $price_row_amount && 0 !== $price_row_amount ) {
				$row_counter = 0;

				do {
					$start_date = get_post_meta( get_the_ID(), 'price_row_' . $row_counter . '_column_1', true );
					$end_date   = get_post_meta( get_the_ID(), 'price_row_' . $row_counter . '_column_2', true );

					$choices[] = array( 'text' => $start_date . '-' . $end_date, 'value' => $start_date . '-' . $end_date );
					$row_counter++;
				} while ( $row_counter < $price_row_amount );
			}
			// update 'Select a Post' to whatever you'd like the instructive option to be
			$field->placeholder = 'Select a date';
			$field->choices = $choices;
		}
	 
		return $form;
	}

	/**
	 * Adds the archive template to the pages.
	 *
	 * @param object $response /WP_REST_Response
	 * @param object $post WP_Post
	 * @param object $request WP_REST_Request
	 * @return object
	 */
	public function add_tour_archive_template_to_rest( $response, $post, $request ) {
		if ( isset( $response->data['type'] ) && 'tour' === $response->data['type'] ) {
			$response->data['search_results'] = '';

			global $search_request_vars;
			$search_request_vars = $request->get_query_params();

			ob_start();
			setup_postdata( $post );
			echo '<div class="' . lsx_to_archive_class( 'lsx-to-widget-item-wrap lsx-tour' ). '">';
			lsx_get_template_part();
			echo '</div>';
			wp_reset_postdata();
			$contents = ob_get_clean();
			$response->data['search_results'] = $contents;
		}
		return $response;
	}

	public function display_email_sharing( $sharing_html = '', $sharing_obj ) {
		$sharing_html .= '<span class="lsx-sharing-button lsx-sharing-button-email"><a href="#lsx-sharing-email"><span class="fa fa-email" aria-hidden="true"></span></a></span>';
		return $sharing_html;
	}


	/**
	 * Sorts the facet search by the relevance score.
	 *
	 * @param array $post_ids
	 * @param obj $class
	 * @return array
	 */
	public function sort_serch_results( $post_ids, $class ) {
		global $relevance_scores;
		$relevance_scores = array();

		foreach ( $post_ids as $post_id ) {
			$relevance_scores[ $post_id ] = str_replace( '%', '', tsp_get_search_relevance( $post_id ) );
		}
		if ( ! empty( $relevance_scores ) ) {
			arsort( $relevance_scores, SORT_NUMERIC );
			$post_ids = array_keys( $relevance_scores );
		}

		return $post_ids;
	}

	/**
	 * Sets the facetWP query args.
	 *
	 * @param array $query_args
	 * @param obj $class
	 * @return array
	 */
	public function facetwp_filtered_query_args( $query_args, $class ) {
		$query_args['orderby'] = 'post__in';
		return $query_args;
	}

	public function search_header_html( $html ) {
		if ( is_search() ) {
			$html = '<div class="mega-search-wrap">';
			$html .= do_shortcode( '[facetwp facet="search"]' );
			$html .= '</div>';
		} else {
			$html = '<div class="mega-search-wrap">';
			$html .= '<form class="mega-search expand-to-left mega-search-closed" role="search" action="' . home_url() . '" siq_id="autopick_1577">';
			$html .= '<span class="dashicons dashicons-search search-icon"></span>';
			$html .= '<input type="submit" value="Search">';
			$html .= '<input type="hidden" name="s" value="">';
			$html .= '<input type="text" aria-label="Search..." data-placeholder="Search..." placeholder="Search..." name="fwp_search">';
			$html .= '</form>';
			$html .= '</div>';
		}
		return $html;
	}

	public function archive_banner_navigation() {
		if ( is_singular( array( 'destination' ) ) ) {
			echo do_shortcode( '[banner_navigation selector="#main" mobile-top="-100"]' );
		}
		if ( is_tax( 'travel-style' ) ) {
			echo do_shortcode( '[banner_navigation extra-top="-70" selector="#main" mobile-top="-50"]' );
		}
	}

	/**
	 * Changing the map key for mobile tours.
	 *
	 * @param string $key
	 * @return string
	 */
	public function mobile_map_keys( $key ) {
		if ( has_term( array( 'mobile-train', 'mobile-boat' ), 'tour-type' ) ) {
			$key = 'destination_to_tour';
		}
		return $key;
	}

	/**
	 * Adds in the mobile "On Train" heading.
	 *
	 * @param string $title
	 * @param object $tour_itinerary
	 * @return string
	 */
	public function mobile_itinerary_title( $title, $tour_itinerary ) {
		if ( has_term( array( 'mobile-train', 'mobile-boat' ), 'tour-type' ) ) {
			if ( ! isset( $tour_itinerary->itinerary['destination_to_tour'] ) || ( isset( $tour_itinerary->itinerary['destination_to_tour'] ) && '' === $tour_itinerary->itinerary['destination_to_tour'] ) ) {
				$title = esc_html__( 'On train', 'thesafaripartners-child' );
			}
		}
		return $title;
	}

	/**
	 * Returns an original country order.
	 *
	 * @param array $connected_ids
	 * @param string $meta_key
	 * @return array
	 */
	public function order_tour_countries( $connected_ids, $meta_key ) {
		global $tour_itinerary;
		if ( !empty( $connected_ids ) && 'destination_to_tour' === $meta_key ) {
			$countries = lsx_to_get_tour_itinerary_ids( 'destination_to_tour' );
			$new_items = array();
			foreach ( $countries as $country ) {
				$temp_parent = wp_get_post_parent_id( $country );
				if ( 0 !== $temp_parent && '0' !== $temp_parent && false !== $temp_parent ) {
					$new_items[] = $temp_parent;
				}
			}
			$connected_ids = $new_items;
		}
		return $connected_ids;
	}

	/**
	 * Stip any unwanted code from our text.
	 *
	 * @param string $content
	 * @return string
	 */
	public function the_content( $content ) {
		return $content;
	}

	public function order_currency_dropdown( $additional_currencies ) {
		$additional_currencies = array(
			'USD' => 'on',
			'CAD' => 'on',
			'EUR' => 'on',
			'GBP' => 'on',
			'AUD' => 'on',
			'NZD' => 'on',
			'JPY' => 'on',
			'AED' => 'on',
		);
		return $additional_currencies;
	}

	public function rest_params( $params, $post_type ) {
		if ( isset( $params['per_page'] ) ) {
			$params['per_page']['maximum'] = 100;
			$params['per_page']['default'] = 100;
		}
		return $params;
	}

	/**
	 * Undocumented function
	 *
	 * @param [type] $value
	 * @return void
	 */
	public function populate_tour_type($value){
		global $post; 
		$terms = get_the_terms( $post->ID, 'tour-type' );
		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$value = $term->name;
			}
		}
		return $value;
	}
}