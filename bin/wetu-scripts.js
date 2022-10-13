;/**
 * LSX Starter Child scripts
 *
 * @package 	thesafaripartners-child
 */(function($, window, document, undefined) {

	'use strict';



	$(document).ready(function () {
		
		// Grab a list of the WETU IDS and Titles

		let items = [];
		let names = [];
		jQuery( '#grid .customRow' ).each(function(){
			let idTag = jQuery(this).attr('data-identifier');
			let title = jQuery(this).attr('data-name');

			items.push( idTag+','+title );
			names.push( title );
		});
		console.log( items );
		console.log( names );
	});


})( jQuery, window, document );