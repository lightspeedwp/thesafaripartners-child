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

    document.addEventListener('DOMContentLoaded', function() {
        const expandBtns = document.querySelectorAll('.tsp-expand-btn');
        const collapseBtns = document.querySelectorAll('.tsp-collapse-btn');

        expandBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                document.getElementById(target + '-short').style.display = 'none';
                document.getElementById(target + '-full').style.display = 'block';
            });
        });

        collapseBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                document.getElementById(target + '-full').style.display = 'none';
                document.getElementById(target + '-short').style.display = 'block';
            });
        });

        document.querySelectorAll('.tsp-modal-expand-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const targetId = btn.dataset.target;
                const fullEl   = document.getElementById(targetId);
                const wrapper  = btn.closest('.tsp-modal-description-wrapper');
                const shortEl  = wrapper.querySelector('.tsp-modal-description-short');
                const collapseBtn = wrapper.querySelector('.tsp-modal-collapse-btn');

                if (!fullEl || !shortEl || !collapseBtn) return;

                // Expand
                fullEl.style.display  = 'block';
                shortEl.style.display = 'none';
                btn.style.display     = 'none';
                collapseBtn.style.display = 'inline-block';
            });
        });

        document.querySelectorAll('.tsp-modal-collapse-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const targetId = btn.dataset.target;
                const fullEl   = document.getElementById(targetId);
                const wrapper  = btn.closest('.tsp-modal-description-wrapper');
                const shortEl  = wrapper.querySelector('.tsp-modal-description-short');
                const expandBtn = wrapper.querySelector('.tsp-modal-expand-btn');

                if (!fullEl || !shortEl || !expandBtn) return;

                // Collapse
                fullEl.style.display  = 'none';
                shortEl.style.display = 'block';
                btn.style.display     = 'none';
                expandBtn.style.display = 'inline-block';
            });
        });

        const galleries = document.querySelectorAll('.tour-accommodation-gallery .accomodation-slider');

        galleries.forEach(function(gallery) {
            if (!$(gallery).hasClass('slick-initialized')) {
                $(gallery).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    fade: true,
                    dots: true,
                    responsive: [
                        {
                            breakpoint: 1280,
                            settings: {
                                arrows: true,
                                dots: true,
                                prevArrow: '<button type="button" class="slick-prev">&laquo;</button>',
                                nextArrow: '<button type="button" class="slick-next">&raquo;</button>',
                            }
                        }
                    ]
                });
            }
        });

        $('.lsx-modal').on('shown.bs.modal', function () {
            $(this).find('.accomodation-slider').slick('setPosition');
        });

        $('#hide-search-filters, #apply-search-filters').on('click', function() {
            bodyScrollUnlock();
            $('.search-sidebar').removeClass('active');
        });

        $('#reset-search-filters').on('click', function() {
            $('.search-sidebar').removeClass('active');
            bodyScrollUnlock();
            FPW.reset();
        });
    
        $('#show-search-filters').on('click', function() {
            bodyScrollLock();
            $('.search-sidebar').addClass('active');
        });

        const tourGallery = document.querySelector('#gallery .gallery');
        if (tourGallery && !$(tourGallery).hasClass('slick-initialized')) {
            $(tourGallery).slick({
                slidesToShow: 3,
                slidesToScroll: 3,
                arrows: true,
                dots: false,
                infinite: true,
                responsive: [
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
        }


        function bodyScrollLock() {
            const body = document.body;
            const scrollY = window.scrollY || document.documentElement.scrollTop;
            body.style.position = 'fixed';
            body.style.top = `-${scrollY}px`;
            body.style.left = '0';
            body.style.right = '0';
            body.style.width = '100vw';
            body.dataset.scrollY = scrollY;
            body.classList.add('sidebar-open');
        }
        
        function bodyScrollUnlock() {
            const body = document.body;
            const scrollY = body.dataset.scrollY ? parseInt(body.dataset.scrollY, 10) : 0;
            body.style.position = '';
            body.style.top = '';
            body.style.left = '';
            body.style.right = '';
            body.style.width = '';
            body.classList.remove('sidebar-open');
            window.scrollTo({ top: scrollY, left: 0, behavior: 'instant' }); // Instant scroll
            delete body.dataset.scrollY;
        }
    
        var initialLoad = true;
    
        $(document).on('facetwp-loaded', function() {
            if (!initialLoad) {
                return; // Skip the first load
            }
            var url = window.location.href;
            // Match either /safari-style/{value} 
            var facetRegex = /\/(?:safari-style|who)\/([^\/?#]+)/i;
            var match = url.match(facetRegex);
            if (match && match[1]) {
                var selectedValue = decodeURIComponent(match[1]).toLowerCase();
                $('.facetwp-checkbox').each(function() {
                    var checkbox = $(this);
                    var value = checkbox.data('value');
                    if (value === selectedValue) {
                        checkbox.addClass('checked');
                        var parentLi = checkbox.closest('li');
    
                        while (parentLi.parent().closest('li').length && parentLi.parent().closest('li').parents('#mega-menu-filter-menu').length) {
                            parentLi = parentLi.parent().closest('li');
                        }
                        parentLi.addClass('mega-toggle-on');
    
                    }
                });
            }
    
            if (window.location.pathname === '/safari-styles/') {
                $('.search-sidebar a.mega-menu-link').each(function() {
                    if ($(this).text().trim() === 'Safari Style') {
                        $(this).parent('li').addClass('mega-toggle-on');
                    }
                });
            }
    
            // Match either /destination/{value} 
            var destRegex = /\/(?:destination)\/([^\/?#]+)/i;
            var destMatch = url.match(destRegex);
            if (destMatch && destMatch[1]) {
                var selectedValue = decodeURIComponent(destMatch[1]).toLowerCase();
                $('.facetwp-checkbox').each(function() {
                    var checkbox = $(this);
                    var value = checkbox.html().toLowerCase();
                    // strip any html tags
                    value = value.replace(/<[^>]*>/g, '').trim();
                    // strip any number like (123) from facets
                    value = value.replace(/\s*\(\d+\)\s*/g, ' ');
                    value = value.trim();
                    value = value.replace(/\s+/g, '-');
                    if (value === selectedValue) {
                        checkbox.addClass('checked');
                        var parentLi = checkbox.closest('li');
    
                        while (parentLi.parent().closest('li').length && parentLi.parent().closest('li').parents('#mega-menu-filter-menu').length) {
                            parentLi = parentLi.parent().closest('li');
                        }
                        parentLi.addClass('mega-toggle-on');
    
                    }
                });
            }
    
            initialLoad = false;
        });
        
    
        $(document).on('facetwp-loaded', function() {
            setTimeout(function() {
                var $main = $('#main.search-main');
                var $postWrapper = $('.post-wrapper.facetwp-template');
                
                if ($postWrapper.find('.post, article, .search-result-item').length === 0) {
                    $main.addClass('no-results');
                } else {
                    $main.removeClass('no-results');
                }
            }, 100); // Small delay to ensure DOM is updated
        });
    
        $(document).on('click', '.lsx-review-readmore', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var $excerpt = $btn.closest('.lsx-review-excerpt');
            var $full = $excerpt.siblings('.lsx-review-full');
            $excerpt.hide();
            $full.show();
        });
    
        $(document).on('click', '.lsx-review-readless', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var $full = $btn.closest('.lsx-review-full');
            var $excerpt = $full.prev('.lsx-review-excerpt');
            $excerpt.show();
            $full.hide();
        });
    });

    

})( jQuery, window, document );