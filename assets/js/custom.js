;/**
 * LSX Starter Child scripts
 *
 * @package 	thesafaripartners-child
 */(function($, window, document, undefined) {

	'use strict';

	$(function() {

		var $slider = $(".slick-slider");
	  
		var slickOptions = {
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  arrows: true,
		  dots: false,
		  // infinite: true,
		  mobileFirst: true,
		  autoplay: false,
		  responsive: [{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				prevArrow: $(".slick-next"),
				nextArrow: $(".slick-next"),
				mobileFirst: true,
				arrows: true,
				dots: false,
				infinite: false,
			  }
			},
			{
			  breakpoint: 991,
			  settings: {
				slidesToShow: 2,
			  }
			},
			{
			  breakpoint: 1199,
			  settings: {
				slidesToShow: 4,
			  }
			},
			{
			  breakpoint: 1599,
			  settings: {
				slidesToShow: 4,
			  }
			}
		  ]
		};
	  
		$($slider).slick(slickOptions);
	  
		$(window).on('resize orientationchange', function() {
		  $($slider).slick("resize");
		});
	  
	  });

})( jQuery, window, document );