;/**
 * LSX Starter Child scripts
 *
 * @package 	thesafaripartners-child
 */(function($, window, document, undefined) {

	'use strict';
	document.querySelector('#readmore').addEventListener("click", function(e) {
		e.preventDefault();
		document.querySelector('#toggledText').classList.toggle('toggle');
	  });

})( jQuery, window, document );