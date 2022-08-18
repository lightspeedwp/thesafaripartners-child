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

				$field_ids = array(
					1 => 'field_62fcebf69657c',
					2 => 'field_62fcec159657d',
					3 => 'field_62fcec319657e',
					4 => 'field_62fcec389657f',
					5 => 'field_62fcec3f96580',
					6 => 'field_62fcec4796581',
					7 => 'field_62fcec4e96582',
				);

				//a:5:{s:10:"start_date";s:10:"08/14/2014";s:8:"end_date";s:10:"08/08/2014";s:13:"price_sharing";s:3:"500";s:10:"single_add";s:3:"300";s:9:"park_fees";s:3:"200";}
				//a:3:{i:0;a:5:{i:0;s:10:"01/21/2014";i:1;s:10:"03/23/2014";i:2;s:4:"R400";i:3;s:3:"100";i:4;s:3:"400";}i:1;a:5:{i:0;s:10:"01/21/2014";i:1;s:10:"06/27/2014";i:2;s:3:"350";i:3;s:3:"150";i:4;s:0:"";}i:2;a:5:{i:0;s:10:"03/01/2014";i:1;s:10:"04/01/2014";i:2;s:3:"250";i:3;s:3:"100";i:4;s:2:"70";}}
				//delete_post_meta($_GET['post'],'tour_schedule_upload');

				$tour_schedule = get_post_meta( $_GET['post'], 'tour_schedule_upload', true );

				if ( false != $tour_schedule ) {
					$schedule = get_attached_file( $tour_schedule );

					$handle = fopen( $schedule, 'r' );
					$r      = 0;

					$file_headers  = array();

					//first delete the old data
					$number_of_rows = get_post_meta( $_GET['post'], 'price_row', true );

					if ( false !== $number_of_rows && 0 !== $number_of_rows ) {
						$counter = 0;
						do {
							delete_post_meta( $_GET['post'], 'price_row_' . $counter . '_column_1' );
							delete_post_meta( $_GET['post'], 'price_row_' . $counter . '_column_2' );
							delete_post_meta( $_GET['post'], 'price_row_' . $counter . '_column_3' );
							delete_post_meta( $_GET['post'], 'price_row_' . $counter . '_column_4' );
							delete_post_meta( $_GET['post'], 'price_row_' . $counter . '_column_5' );
							delete_post_meta( $_GET['post'], 'price_row_' . $counter . '_column_6' );
							delete_post_meta( $_GET['post'], 'price_row_' . $counter . '_column_7' );

							//Delete the hidden fields.
							delete_post_meta( $_GET['post'], '_price_row_' . $counter . '_column_1' );
							delete_post_meta( $_GET['post'], '_price_row_' . $counter . '_column_2' );
							delete_post_meta( $_GET['post'], '_price_row_' . $counter . '_column_3' );
							delete_post_meta( $_GET['post'], '_price_row_' . $counter . '_column_4' );
							delete_post_meta( $_GET['post'], '_price_row_' . $counter . '_column_5' );
							delete_post_meta( $_GET['post'], '_price_row_' . $counter . '_column_6' );
							delete_post_meta( $_GET['post'], '_price_row_' . $counter . '_column_7' );
							$counter++;
						} while ( $counter < $number_of_rows );
						delete_post_meta( $_GET['post'], 'price_row' );
						delete_post_meta( $_GET['post'], '_price_row' );
					}

					while ( ( $row_data = fgetcsv( $handle, 1000, ',' ) ) !== false ) {
						//skip first row = columnheaders
						if ( $r == 0 ) {
							
							// Save the titles
							$file_headers = $row_data;
							foreach ( $file_headers as $f_key => $f_value ) {
								delete_post_meta( $_GET['post'], 'column_titles_column_' . ( $f_key + 1 ) );
								add_post_meta( $_GET['post'], 'column_titles_column_' . ( $f_key + 1 ), $f_value, true );
							}
						}

						if ( $r > 0 ) {

							$num = count( $row_data );

							if ( $num && $num > 1 ) {

								$header_counter = 1;
								//loop through the columns and grab the values
								foreach ( $file_headers as $f_key => $f_value ) {

									if ( false === $f_value || '' === $f_value || null === $f_value ) {
										continue;
									}

									if ( 1 === $header_counter || 2 === $header_counter ) {
										$value = date('m/d/Y',strtotime($row_data[$f_key]));
									} else {
										$value = preg_replace("/[^A-Za-z0-9 ]/", '', $row_data[$f_key]);
									}

									add_post_meta( $_GET['post'], 'price_row_' . ( $r-1 ) . '_column_' . $header_counter, $value, true );
									add_post_meta( $_GET['post'], '_price_row_' . ( $r-1 ) . '_column_' . $header_counter, $field_ids[ $header_counter ], true );

									$header_counter++;
								}

							}//end Num if
						}//en $r if

						$r++;
					}//end of the while

					add_post_meta( $_GET['post'], 'price_row', ($r-1), true );
					add_post_meta( $_GET['post'], '_price_row', 'field_62fcebb79657b', true );

					wp_delete_attachment( $tour_schedule );
					delete_post_meta( $_GET['post'], 'tour_schedule_upload' );
				}
			}//End of the schedule import if statement
		}
	}
}
