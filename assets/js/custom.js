;/**
 * LSX Starter Child scripts
 *
 * @package 	thesafaripartners-child
 */(function($, window, document, undefined) {

	'use strict';
	$('.lsx-readmore p').readmore({
		speed: 500,
		collapsedHeight:200,
		collapsedMoreHeight: 400, // This is your new second height. Always bigger than collapsedHeigh. There isn't any control to that. Be careful.
		moreLink: '<a class="white-shadow" href="#">More information</a>',
		evenMoreLink: '<a class="white-shadow" href="#">Even More informations</a>', // Add new label
		lessLink: '<a href="#">Less information</a>'
	  });
})( jQuery, window, document );