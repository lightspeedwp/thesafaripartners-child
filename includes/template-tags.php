<?php
/**
 * LSX Starter Child functions
 *
 * @package thesafaripartners-child
 */


function tsp_init_wizard() {
	wp_enqueue_script( 'thesafaripartners-child-wizard-bootstrap', get_stylesheet_directory_uri() . '/assets/js/wizard.js', array( 'jquery' ), TSP_CHILD_VER, true );
	wp_enqueue_script( 'thesafaripartners-child-wizard', get_stylesheet_directory_uri() . '/assets/js/wizard.js', array( 'jquery', 'thesafaripartners-child-wizard-bootstrap' ), TSP_CHILD_VER, true );
}
