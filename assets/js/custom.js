;/**
 * LSX Starter Child scripts
 *
 * @package 	thesafaripartners-child
 */(function($, window, document, undefined) {

	'use strict';

	$(document).ready(function () {
		
		if ( $('body').hasClass('search-results') ) {

			$(document).on( 'facetwp-loaded', function() {
				$('.facetwp-facet-search .search-icon').on('click', function(event) {

					if ( $(this).parents('.mega-search').hasClass('mega-search-open') ) {
						$(this).parents('.mega-search')
						.removeClass('mega-search-open')
						.addClass('mega-search-closed');
					} else {
						$(this).parents('.mega-search')
						.addClass('mega-search-open')
						.removeClass('mega-search-closed');
					}
				});
			});
		}		
	});

})( jQuery, window, document );