;/**
 * LSX Starter Child scripts
 *
 * @package 	thesafaripartners-child
 */(function($, window, document, undefined) {

	'use strict';
})( jQuery, window, document );

if ($('.lsx-readmore').find('p').length) {

	$(".lsx-readmore").each(function(i) {
  
	  var splitFirstPara = '300';
	  var maxFirstParaLength = '350';
	  var firstPara = $(this).find('p').first().text();
	  var firstParaLength = firstPara.length;
  
  
	  if (firstParaLength > maxFirstParaLength) {
  
		var frontSentence = firstPara.split('').slice(0, splitFirstPara).join('');
		var endSentence = firstPara.split('').slice(splitFirstPara, ).join('');
		var newSentence = '<p>' + frontSentence + '<button class="readMore" data-toggleShow="' + i + '">read more...</button><span class="toggleShow" data-toggleShow="' + i + '" style="display:none;">' + endSentence + '</span></p>';
  
		$(this).find('p').first().replaceWith(newSentence);
		$(this).find('p').first().nextAll().addClass('toggleShow').attr('data-toggleshow', i).hide();
  
	  } else {
  
		$(this).find('p').first().nextAll().addClass('toggleShow').attr('data-toggleshow', i).hide();
		$(this).find('p').first().after('<button class="readMore" data-toggleShow="' + i + '">read more</button>');
  
	  }
  
	  $(this).append('<button class="minimise" data-toggleShow="' + i + '" style="display:none;">minimise</button>');
  
	});
  
	$("button.readMore").click(function() {
  
	  var sameSectionItems = $(this).attr('data-toggleshow');
  
	  $(this).hide();
	  $('.toggleShow[data-toggleshow="' + sameSectionItems + '"]').fadeIn();
	  $('.minimise[data-toggleshow="' + sameSectionItems + '"]').fadeIn();
  
  
	});
  
	$("button.minimise").click(function() {
  
	  var sameSectionItems = $(this).attr('data-toggleshow');
  
	  $(this).hide();
	  $('.toggleShow[data-toggleshow="' + sameSectionItems + '"]').fadeOut();
	  $('.readMore[data-toggleshow="' + sameSectionItems + '"]').fadeIn();
  
	});
  
  }