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

	document.addEventListener("DOMContentLoaded", function() {
		const tables = document.querySelectorAll('table.table-striped'); // Select only tables with the class "table-striped"
		tables.forEach(table => {
			const columns = table.querySelectorAll('tr:first-child th').length || table.querySelectorAll('tr:first-child td').length;
			table.classList.add(`columns-${columns}`); // Add a class based on the number of columns
		});
	});

	document.addEventListener("DOMContentLoaded", function() {
		const tables = document.querySelectorAll('table.table-striped'); // Target only tables with class "table-striped"
		
		tables.forEach(table => {
			const headers = [];
			const thElements = table.querySelectorAll('tr:first-child th'); // Get all th elements in the first row
	
			thElements.forEach((th, index) => {
				headers[index] = th.innerText.trim(); // Store the text of each th element
			});
	
			// Loop through each row in the table
			table.querySelectorAll('tr').forEach(row => {
				row.querySelectorAll('td').forEach((td, index) => {
					if (headers[index]) {
						td.setAttribute('data-header', headers[index]); // Set a data attribute with the header name
					}
				});
			});
		});
	});

})( jQuery, window, document );