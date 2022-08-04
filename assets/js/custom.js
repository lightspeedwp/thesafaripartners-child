;/**
 * LSX Starter Child scripts
 *
 * @package 	thesafaripartners-child
 */(function($, window, document, undefined) {

	'use strict';
})( jQuery, window, document );

$('div.lsx-to-widget-item-wrap select').focus(function (){
	$(this).parent('.lsx-to-widget-item-wrap').find('#mega-menu-item-lsx_to_taxonomy_widget-3 .term-11090').css('width','400px');
  });