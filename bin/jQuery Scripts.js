;/**
 * LSX Starter Child scripts
 *
 * @package 	thesafaripartners-child
 */(function($, window, document, undefined) {

	'use strict';



	$(document).ready(function () {
		
		// Grab a list of actions and triggers

		let actions_triggers = [];
		jQuery( '.listTriggersActions .zf-input-checkbox label' ).each(function(){
			let idTag = jQuery(this).html();
			actions_triggers.push( idTag );
		});
		console.log( actions_triggers.join(',') );


		// Grab a list of the Zoho Landing Pages Integrations

		let actions_triggers = [];
		jQuery( '.category-wrap .addon-wrap h5' ).each(function(){
			let idTag = jQuery(this).html();
			actions_triggers.push( idTag );
		});
		console.log( actions_triggers.join(',') );
	});


})( jQuery, window, document );