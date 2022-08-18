<?php
/**
 * Bootstrap Dates and Prices Administration
 *
 * @package   bootstrap-prices-dates-impoter
 * @author    LightSpeed <info@lsdev.biz>
 * @license   GPL-2.0+
 * @copyright 2014 LightSpeed
 */
namespace tsp_child\classes;

if ( ! class_exists( 'Dates_Prices_Admin' ) ) {
	class Dates_Prices_Admin {

		/**
		 * Instance of this class.
		 *
		 * @since    1.0.0
		 *
		 * @var      object
		 */
		protected static $instance = null;

		/**
		 * Return an instance of this class.
		 *
		 * @return    object    A single instance of this class.
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Initialize the plugin by setting localization and loading public scripts
		 * and styles.
		 */
		function __construct() {
			add_action( 'init', array( $this, 'import_values' ), 10 );
		}

		/**
		 * imports the values and saves them.
		 *
		 * @param   $post   The current WP Post Object
		 */
		function import_values() {

			if ( is_admin() && isset( $_GET['post'] ) && 'tour' == get_post_type( $_GET['post'] ) ) {

				//a:5:{s:10:"start_date";s:10:"08/14/2014";s:8:"end_date";s:10:"08/08/2014";s:13:"price_sharing";s:3:"500";s:10:"single_add";s:3:"300";s:9:"park_fees";s:3:"200";}
				//a:3:{i:0;a:5:{i:0;s:10:"01/21/2014";i:1;s:10:"03/23/2014";i:2;s:4:"R400";i:3;s:3:"100";i:4;s:3:"400";}i:1;a:5:{i:0;s:10:"01/21/2014";i:1;s:10:"06/27/2014";i:2;s:3:"350";i:3;s:3:"150";i:4;s:0:"";}i:2;a:5:{i:0;s:10:"03/01/2014";i:1;s:10:"04/01/2014";i:2;s:3:"250";i:3;s:3:"100";i:4;s:2:"70";}}
				//delete_post_meta($_GET['post'],'tour_schedule_upload');

				$tour_schedule = get_post_meta( $_GET['post'], 'tour_schedule_upload', true );

				if ( false != $tour_schedule ) {
					$schedule = get_attached_file( $tour_schedule );

					$handle = fopen( $schedule, 'r' );
					$errors = '';
					$r      = 0;

					$file_headers  = array();
					$schedule_data = array();

					$old_values = get_post_meta( $_GET['post'], 'bs_tour_dates_prices', false );
					delete_post_meta( $_GET['post'], 'bs_tour_dates_prices' );

					while ( ( $row_data = fgetcsv( $handle, 1000, ',' ) ) !== false ) {
						//skip first row = columnheaders
						if ( $r == 0 ) {
							$file_headers = $row_data;
						}

						if ( $r > 0 ) {

							$num = count( $row_data );

							if ( $num && $num > 1 ) {

								$temp_array = array();

								//loop through the columns and grab the values
								foreach ( $file_headers as $f_key => $f_value ) {

									//print_r($row_data[$f_key]);print_r('-');print_r($f_key);print_r('<br />');

									switch ( ltrim( rtrim( $f_value ) ) ) {
										case 'Start Date':
											$temp_array['start_date'] = date( 'm/d/Y', strtotime( $row_data[ $f_key ] ) );
											break;
										case 'End Date':
											$temp_array['end_date'] = date( 'm/d/Y', strtotime( $row_data[ $f_key ] ) );
											break;

										case 'Price Sharing':
											$temp_array['price_sharing'] = preg_replace( '/[^A-Za-z0-9 ]/', '', $row_data[ $f_key ] );
											break;

										case 'Single Addon Price':
											$temp_array['single_add'] = preg_replace( '/[^A-Za-z0-9 ]/', '', $row_data[ $f_key ] );
											break;

										case 'Park Fees':
											$temp_array['park_fees'] = preg_replace( '/[^A-Za-z0-9 ]/', '', $row_data[ $f_key ] );
											break;
									}
								}

								add_post_meta( $_GET['post'], 'bs_tour_dates_prices', $temp_array );

								//print_r($temp_array);

							}//end Num if
						}//en $r if

						$r++;
					}//end of the while

					wp_delete_attachment( $tour_schedule );
					delete_post_meta( $_GET['post'], 'tour_schedule_upload' );
				}
			}//End of the schedule import if statement
		}
	}
}
