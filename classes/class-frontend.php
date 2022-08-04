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
		add_action( 'pre_get_posts', array( $this, 'set_main_query_arguments' ), 200, 1 );

		add_filter( 'searchwp\query\results', array( $this, 'get_swp_relevance' ), 10, 2 );
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

		wp_enqueue_script( 'thesafaripartners-child-scripts', get_stylesheet_directory_uri() . '/assets/js/' . $prefix . 'custom' . $suffix . '.js', array( 'jquery' ) );

		if ( is_singular( array( 'tour' ) ) ) {
			//wp_enqueue_script( 'thesafaripartners-child-wizard-bootstrap', get_stylesheet_directory_uri() . '/assets/js/wizard.js', array( 'jquery' ), TSP_CHILD_VER, true );
			wp_enqueue_script( 'thesafaripartners-child-tour-wizard', get_stylesheet_directory_uri() . '/assets/js/tour-wizard.js', array( 'jquery' ), TSP_CHILD_VER, true );
			wp_enqueue_script( 'thesafaripartners-child-tour-wizard', get_stylesheet_directory_uri() . '/assets/js/readmore.js', array( 'jquery' ), TSP_CHILD_VER, true );
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

			if ( $query->is_post_type_archive( 'destination' )  ) {
				$query->set( 'post_type', 'tour' );
				$query->set( 'posts_per_page', -1 );
				$query->set( 'nopagin', true );
			}
		}
	}

	public function get_swp_relevance( $results, $query ){
		global $search_relevance;

		if( empty( $results) ){
			return $results;
		}
		$search_relevance = array();
	
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
				$search_relevance[$result] = round( ( $posts_relevance[$result] * 100 ) / $max_relevance );
			}
		}		
	
		return $results;
	}
}

/**
 * LSX Banners Taxonomy Class
 *
 * @package   LSX Banners
 * @author    LightSpeed
 * @license   GPL3
 * @link
 * @copyright 2016 LightSpeed
 */
class LSX_Taxonomy_Admin {

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
			'thumbnail' => esc_html__( 'Thumbnail', 'lsx-banners' ),
			'tagline' => esc_html__( 'Tagline', 'lsx-banners' ),
			'expert' => esc_html__( 'Expert', 'lsx-banners' ),
			'banner_video' => esc_html__( 'Video URL', 'lsx-banners' ),
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
				// add_action( "{$taxonomy}_add_form_fields",  array( $this, 'add_thumbnail_form_field'  ),3 );
				add_action( "edit_{$taxonomy}", array( $this, 'save_meta' ), 10, 2 );
				add_action( "{$taxonomy}_edit_form_fields", array( $this, 'add_thumbnail_form_field' ), 3, 1 );
				add_action( "{$taxonomy}_edit_form_fields", array( $this, 'add_tagline_form_field' ), 3, 1 );
				add_action( "{$taxonomy}_edit_form_fields", array( $this, 'add_banner_video_form_field' ), 3, 1 );
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
	 * Output the form field for this metadata when adding a new term
	 *
	 * @since 1.0.0
	 */
	public function add_thumbnail_form_field( $term = false ) {

		if ( is_object( $term ) ) {
			$value = get_term_meta( $term->term_id, 'thumbnail', true );
			$image_preview = wp_get_attachment_image_src( $value, 'thumbnail' );
			if ( is_array( $image_preview ) ) {
				$image_preview = '<img src="' . $image_preview[0] . '" width="' . $image_preview[1] . '" height="' . $image_preview[2] . '" class="alignnone size-thumbnail wp-image-' . $value . '" />';
			}
		} else {
			$image_preview = false;
			$value = false;
		}
		?>
		<tr class="form-field term-thumbnail-wrap">
			<th scope="row"><label for="thumbnail"><?php esc_html_e( 'Featured Image', 'lsx-banners' ); ?></label></th>
			<td>
				<input class="input_image_id" type="hidden" name="thumbnail" value="<?php echo esc_attr( $value ); ?>">
				<div class="thumbnail-preview">
					<?php echo wp_kses_post( $image_preview ); ?>
				</div>
				<a style="
				<?php
				if ( '' !== $value && false !== $value ) {
					?>
					display:none;<?php } ?>" class="button-secondary lsx-thumbnail-image-add"><?php esc_html_e( 'Choose Image', 'lsx-banners' ); ?></a>
				<a style="
				<?php
				if ( '' === $value || false === $value ) {
					?>
					display:none;<?php } ?>" class="button-secondary lsx-thumbnail-image-remove"><?php esc_html_e( 'Remove Image', 'lsx-banners' ); ?></a>
				<?php wp_nonce_field( 'lsx_banners_save_term_thumbnail', 'lsx_banners_term_thumbnail_nonce' ); ?>
			</td>
		</tr>
		<?php
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
	public function add_tagline_form_field( $term = false ) {
		if ( is_object( $term ) ) {
			$value = get_term_meta( $term->term_id, 'tagline', true );
		} else {
			$value = false;
		}
		?>
		<tr class="form-field term-tagline-wrap">
			<th scope="row"><label for="tagline"><?php esc_html_e( 'Banner tagline', 'lsx-banners' ); ?></label></th>
			<td>
				<input name="tagline" id="tagline" type="text" value="<?php echo esc_attr( $value ); ?>" size="40" aria-required="true">
			</td>
		</tr>
		<?php
	}

	/**
	 * Output the form field for this metadata when adding a new term
	 *
	 * @since 1.0.0
	 */
	public function add_banner_video_form_field( $term = false ) {
		if ( is_object( $term ) ) {
			$value = get_term_meta( $term->term_id, 'banner_video', true );
		} else {
			$value = false;
		}
		?>
		<tr class="form-field term-youtube-wrap">
			<th scope="row"><label for="banner_video"><?php esc_html_e( 'Banner Video URL (mp4)', 'lsx-banners' ); ?></label></th>
			<td>
				<input name="banner_video" id="banner_video" type="text" value="<?php echo esc_attr( $value ); ?>" size="40" aria-required="true">
			</td>
		</tr>
		<?php
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
 * Checks if the current term has a thumbnail
 *
 * @param   $term_id
 */
function lsx_has_term_thumbnail( $term_id = false ) {
	if ( false !== $term_id ) {
		$term_thumbnail = get_term_meta( $term_id, 'thumbnail', true );
		if ( false !== $term_thumbnail && '' !== $term_thumbnail ) {
			return true;
		}
	}
	return false;
}

/**
 * Outputs the current terms thumbnail
 *
 * @param   $term_id string
 */
function lsx_term_thumbnail( $term_id = false, $size = 'lsx-thumbnail-wide' ) {
	if ( false !== $term_id ) {
		echo wp_kses_post( lsx_get_term_thumbnail( $term_id, $size ) );
	}
}

/**
 * Outputs the current terms thumbnail
 *
 * @param   $term_id string
 */
function lsx_get_term_thumbnail( $term_id = false, $size = 'lsx-thumbnail-wide' ) {
	if ( false !== $term_id ) {
		$term_thumbnail_id = get_term_meta( $term_id, 'thumbnail', true );
		$img               = wp_get_attachment_image_src( $term_thumbnail_id, $size );
		$image_url         = $img[0];
		$img               = '<img alt="thumbnail" class="attachment-responsive wp-post-image lsx-responsive" src="' . $image_url . '" />';
		$img               = apply_filters( 'lsx_lazyload_slider_images', $img, $term_thumbnail_id, $size, false, $image_url );
		return $img;
	}
}