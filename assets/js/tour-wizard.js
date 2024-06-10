
function openCity(evt, cityName) {
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	}
	document.getElementById(cityName).style.display = "block";
	evt.currentTarget.className += " active";

	jQuery( '.tablinks[data-wrapper="'+cityName+'"]' ).addClass('active');

	if ( 'Maps' === cityName ) {
		jQuery(".lsx-map-placeholder").click();
	}

	checkForSliders( jQuery( '#'+cityName ) );
}
function openinCity(evt, eventName) {
	var i, intabcontent, intablink;
	intabcontent = document.getElementsByClassName("intabcontent");
	for (i = 0; i < intabcontent.length; i++) {
		intabcontent[i].style.display = "none";
	}
	intablink = document.getElementsByClassName("intablink");
	for (i = 0; i < intablink.length; i++) {
		intablink[i].className = intablink[i].className.replace(" active", "");
	}
	document.getElementById(eventName).style.display = "block";
	evt.currentTarget.className += " active";
}

function checkForSliders( $next ) {
	if ( 0 < $next.find( '.tour-accommodation-gallery .slider-content' ).length ) {
		var currentID = $next.find( '.tour-accommodation-gallery').attr('data-slider-id');

		$next.find( '.tour-accommodation-gallery .placeholder-image').hide();
		$next.find( '.tour-accommodation-gallery .slider-content').show();

		$next.find( '.tour-accommodation-gallery .accomodation-slider:not(.slick-initialized )').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			fade: true,
			dots: false,
			//asNavFor: '.accom-slider-' + currentID + ' .accomodation-nav',
			responsive: [
				{
					breakpoint: 1280,
					settings: {
						arrows: true,
						dots: false,
						prevArrow : '<button type="button" class="slick-prev">&laquo;</button>',
						nextArrow : '<button type="button" class="slick-next">&raquo;</button>',
					}
				}
			]
		});
		/*$next.find( '.tour-accommodation-gallery .accomodation-nav').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			asNavFor: '.accom-slider-' + currentID + ' .accomodation-slider',
			dots: false,
			centerMode: true,
			focusOnSelect: true,
			prevArrow : '<button type="button" class="slick-prev">&laquo;</button>',
			nextArrow : '<button type="button" class="slick-next">&raquo;</button>',
		});*/
	}

	if ( 0 < $next.find( '.related-tours-wrapper .lsx-to-slider-inner' ).length ) {
		$next.find( '.related-tours-wrapper .lsx-to-slider-inner' ).slick('unslick');
		let settings = {
			"draggable": false,
			"infinite": false,
			"swipe": false,
			"cssEase": "ease-out",
			"dots": true,
			"slidesToShow": 2,
			"slidesToScroll": 2,
			"autoplay": true,
			"autoplaySpeed": 6000,
			"responsive": [
				{
					"breakpoint": 900,
					"settings": {
						"slidesToShow": 2,
						"slidesToScroll": 2,
						"draggable": true,
						"arrows": true,
						"swipe": true
					}
				},
				{
					"breakpoint": 600,
					"settings": {
						"slidesToShow": 1,
						"slidesToScroll": 1,
						"draggable": true,
						"arrows": true,
						"swipe": true
					}
				}
			]
		};
		$next.find( '.related-tours-wrapper .lsx-to-slider-inner' ).slick(settings);
	}
}

;(function ($, window, document, undefined) {
	var settings;

	////////////////////////////////////////// Public methods

	var pub = {

		init: function (options) {

			return this.each(function () {

				var $this = $(this),
					data = $this.data('lsxWizard'),
					lsxWizard = $('<div />', {
						text: $this.attr('title')
					});

				//#region If the plugin hasn't been initialized yet
				if (!data) {

					$(this).data('lsxWizard', {});

					$this.hide();

					///////////////////////// Main configurable options object

					settings = $.extend(true, $.fn.lsxWizard.defaults, options);
					var globalMinHeight = settings.lsxWizard.minHeight;
					var buttonFinishText = settings.lsxWizard.localization.buttons.finish;
					var buttonLoadingText = settings.lsxWizard.localization.buttons.loading;
					var activeStep = settings.lsxWizard.activeStep;

					$(this).data('lsxWizard').settings = settings;

					///////////////////////// Prepare Wizard components

					var $stepsWrapper = getStepsWrapperTemplate(globalMinHeight);
					var $buttons = getButtonsTemplate(settings);
					var $steps = $this.find(".lsx-wizard-step");

					$buttonNext = $buttons.find(".lsx-wizard-button-next");
					$buttonPrevious = $buttons.find(".lsx-wizard-button-previous");

					///////////////////////// Place Wizard component

					$stepsWrapper.append($steps);       // Place steps in the steps wrapper
					$this.append($stepsWrapper);        // Place the steps wrapper that now contains all the steps in the original container
					$this.append($buttons);             // Place Buttons right after the steps wrapper

					///////////////////////// Shape Step elements

					$steps.css({
						'position': 'absolute',
						'min-height': globalMinHeight + 'px',
						'width': '100%'
					});

					////////////////////////// Mark each step element with its current position to
					////////////////////////// easily keep track of the order (starting with 1)

					$.each($steps, function (i, step) {
						$(step).attr('data-position', i + 1);
						//markStepAsCompleted(i - 1, $this, settings);
					})

					var $progressButtonsTemplate = getProgressButtonsTemplate($steps, settings);
					$this.prepend($progressButtonsTemplate);

					/////////////////////////// Find the active step or set the first step active as default

					if (!$(".active").length) {
						$steps.eq(activeStep - 1).addClass("active");
						highlightActiveElement($this);
					}

					var $activeStep = $stepsWrapper.find(".active");
					var activeElementPosition = parseInt($activeStep.data('position'), 10);

					$.each($steps, function (i, step) {

						var $step = $(step);
						var $newStepTitleTemplate = getStepTitleTemplate(i, $step, settings);
						$step.prepend($newStepTitleTemplate);

						if ((i + 1) < activeElementPosition) {
							moveStepLeft($step);
							markStepAsCompleted(i + 1, $this, settings);
						} else if ((i + 1) > activeElementPosition) {
							moveStepRight($step);
						} else {
							showStep($step); // Only one element should satisfy this condition
							highlightActiveElement($this);
							markStepAsCompleted(i + 1, $this, settings);
						}
					});

					var $progressButtonsBorderBottom = getProgressButtonsBorderBottomTemplate(settings);
					$progressButtonsTemplate.after($progressButtonsBorderBottom);

					/////////////////////////// We can now show the plugin component
					$this.show();

					/////////////////////////// Activate buttons accordingly to which step is active

					// If final step is shown
					if (activeElementPosition === $steps.length) {
						setFinishButton($this);
					}

					// If first step is shown
					if (activeElementPosition === 1) {
						$this.find('.lsx-wizard-button-previous').hide();
					}

					$this.trigger("beForeEventRegistration.lsxWizard", this, $this);

					/////////////////////////// Register event handlers

					$this.find('.lsx-wizard-button-previous').on( 'click', function (e) {
						e.preventDefault();
						var $elementToSlide = $this.find(".lsx-wizard-steps-wrapper .active");
						$this.trigger("onButtonPreviousClick.lsxWizard", this);

						if ($.isFunction(settings.onButtonPreviousClick)) {
							// Trigger the override callback it the callback is set at the plugin initialization...
							settings.onButtonPreviousClick.call(this);
						} else {
							// ...slide right imediatelly otherwise.
							slideRight($elementToSlide, settings, $this);
						}
					} );

					$this.on("slideRightSuccess.lsxWizard", function () {
						resizeWizardStepsWrapper($this);
					});

					$this.on("slideLeftSuccess.lsxWizard", function () {
						resizeWizardStepsWrapper($this);
					});

					$this.find('.lsx-wizard-button-next').on('click',function (e) {
						e.preventDefault();
						var $elementToSlide = $this.find(".lsx-wizard-steps-wrapper .active");

						if ($.isFunction(settings.onButtonNextClick)) {
							// Trigger the override callback it the callback is set at the plugin initialization...
							settings.onButtonNextClick.call(this);
						} else {
							// ...slide left imediatelly otherwise.
							slideLeft($elementToSlide, settings, $this);
						}
					});

					// Stepper navigation
					$this.find('.lsx-wizard-progress-buttons a:not(.active)').click(function (e) {
						e.preventDefault();
						var nextElement = jQuery(this).parent().attr('data-position');
						var $elementToSlide = $this.find(".lsx-wizard-steps-wrapper .active");
						slideMeTo($elementToSlide, nextElement , settings, $this);
					});

					/////////////////////////// Testing Success Icon

					var $progressButtonsPlaceholder = $progressButtonsTemplate.find(".lsx-wizard-progress-buttons");
					var $progressButtons = $progressButtonsPlaceholder.children();

					/////////////////////////// Store plugin data

					$this.data('lsxWizard').target = $this;
					$this.data('lsxWizard').lsxWizard = lsxWizard;
					$this.data('lsxWizard').settings = settings;

					resizeWizardStepsWrapper($this);

					whoSingleSelection();
					budgetSingleSelection();

					$.isFunction(settings.onInitSuccess) && settings.onInitSuccess.call(this);
					$this.trigger("initSuccess.lsxWizard", this);
				}
				//#endregion
			});
		},
		isFinalElementShown: function (a, b) {
			var activeElementPosition = getActiveElementPosition($(this));
			if (activeElementPosition === countElements($(this))) {
				return true;
			} else {
				return false;
			}
		},
		hideButtonNext: function () {
			// TODO: implement
		},
		hideButtonPrevious: function () {
			// TODO: implement
		},
		previous: function () {
			previous($plugin);
		},
		next: function () {
			$plugin = $(this);
			var settings = $plugin.data('lsxWizard').settings;
			var $elementToSlide = $plugin.find(".lsx-wizard-steps-wrapper .active");
			slideLeft($elementToSlide, settings, $plugin);
		},
		first: function (a) {
			previous(a, true);
			$plugin.on("slideRightSuccess.lsxWizard", function (event, goToFirst) {
				if (goToFirst == true)
					previous(a, true);
			});

		},
		final: function () {
			// TODO: implement
		},
		// disables the "previous" button for the provided step
		disablePreviousButton: function (stepNumber) {
			// TODO: implement
		},

		// enables the "previous" button for the provided step
		enablePreviousButton: function (stepNumber) {
			// TODO: implement
		},
		getActiveStep: function () {
			$plugin = $(this);
			return parseInt($plugin.find(".lsx-wizard-steps-wrapper .active").attr("data-position"), 10);
		}
	};

	////////////////////////////////////////// Private functions

	function resizeWizardStepsWrapper($this) {
		var $wizardStepsWrapper = $this.find(".lsx-wizard-steps-wrapper");
		var $activeStep = $wizardStepsWrapper.find(".active");

		$wizardStepsWrapper.clearQueue().animate({
			"height": $activeStep.height() + "px"
		});
	}

	function slideLeft($elementToSlide, settings, $plugin, slideSuccessCallback) {
		if ($elementToSlide.next().length) {

			$elementToSlide.clearQueue().animate({
				'margin-left': '-100%'
			});

			var $next = $elementToSlide.next();

			$next.clearQueue().animate({
				'margin-left': 0
			}, function () {

				$plugin.find(".lsx-wizard-step").removeClass("active");
				$next.addClass("active");

				var activeElementPosition = highlightActiveElement($plugin);
				var stepsCount = $plugin.find(".lsx-wizard-step").length;

				markStepAsCompleted(activeElementPosition, $plugin, settings);

				if (activeElementPosition === stepsCount) {
					setFinishButton($plugin);
					$.isFunction(settings.onSlideLeftLimitReached) && settings.onSlideLeftLimitReached.call($plugin);
					$plugin.trigger("slideLeftLimitReached.lsxWizard", this);
				}

				if ( 1 < activeElementPosition ) {
					$plugin.find('.lsx-wizard-button-previous').show();
				} else if (activeElementPosition === stepsCount) {
					$plugin.find('.lsx-wizard-button-previous').hide();
				}

				// Check for any sliders that need initializing
				checkForSliders( $next );

				$.isFunction(settings.onSlideLeftFinished) && settings.onSlideLeftFinished.call($plugin);
				$plugin.trigger("slideLeftSuccess.lsxWizard", this);
			});

		}

	}

	function slideRight($elementToSlide, settings, $plugin, goToFirst) {

		if ($elementToSlide.prev().length) {

			// Move the target element to the right first (out of the visual field)...
			$elementToSlide.clearQueue().animate({
				'margin-left': '100%'
			});

			// ...find the previous step element and move it into the visual field, thus making it the new active element.
			var $prev = $elementToSlide.prev();

			$prev.clearQueue().animate({
				'margin-left': 0
			}, function () {

				$plugin.find(".lsx-wizard-step").removeClass("active");

				$prev.addClass("active");

				var activeElementPosition = highlightActiveElement($plugin);
				unmarkStepAsCompleted(activeElementPosition, $plugin);

				if (activeElementPosition === 1) {
					$plugin.find('.lsx-wizard-button-previous').hide();
					$plugin.find('.lsx-wizard-button-next').show();

					$.isFunction(settings.onSlideRightLimitReached) && settings.onSlideRightLimitReached.call($plugin);
					$plugin.trigger("slideRightLimitReached.lsxWizard", this);
				} else {
					
					$plugin.find('.lsx-wizard-button-previous').show();
					$plugin.find('.lsx-wizard-button-next').show();

					if ($plugin.find('.lsx-wizard-button-next').hasClass('btn-success')) {
						unsetFinishButton($plugin, settings);
					}
				}

				$.isFunction(settings.onSlideRightFinished) && settings.onSlideRightFinished.call($plugin);
				$plugin.trigger("slideRightSuccess.lsxWizard", goToFirst);
			});

		}
	}

	function slideMeTo($elementToSlide, $nextSelector, settings, $plugin, slideSuccessCallback) {

		var nextElement = $plugin.find('.lsx-wizard-step[data-position="'+$nextSelector+'"]');

		if (nextElement.length) {

			jQuery('html, body').animate({
				scrollTop: $plugin.offset().top - 100
			}, 100);

			$elementToSlide.clearQueue().animate({
				'margin-left': '-100%'
			});

			var $next = nextElement;

			$next.clearQueue().animate({
				'margin-left': 0
			}, function () {

				$(".lsx-wizard-step").removeClass("active");
				$next.addClass("active");

				var activeElementPosition = highlightActiveElement($plugin);
				var stepsCount = $plugin.find(".lsx-wizard-step").length;

				markStepAsCompleted(activeElementPosition, $plugin, settings);

				if (activeElementPosition === stepsCount) {
					setFinishButton($plugin);
					$.isFunction(settings.onSlideLeftLimitReached) && settings.onSlideLeftLimitReached.call($plugin);
					$plugin.trigger("slideLeftLimitReached.lsxWizard", this);
				} else {
					if ($plugin.find('.lsx-wizard-button-next').hasClass('btn-success')) {
						unsetFinishButton($plugin, settings);
					}
					$plugin.find('.lsx-wizard-button-previous').show();
				}

				$plugin.trigger("slideMeToSuccess.lsxWizard", this);
				$plugin.trigger("slideLeftSuccess.lsxWizard", this);
			});

		}
	}

	function getButtonsTemplate(settings) {
		var $buttons = $("" +
			"<div class='lsx-wizard-buttons-wrapper row'>" +
				"<div class='col-md-12'>" +
					"<button class='btn btn-primary pull-left lsx-wizard-button-previous'></button>" +
					"<button class='btn btn-primary pull-right lsx-wizard-button-next' data-loading-text='" + settings.lsxWizard.localization.buttons.loading + "'></button>" +
				"</div>" +
			"</div>" +
		"").css({
			'display': 'block'
		});

		var $iconPrevious = $("<span class='glyphicon glyphicon-chevron-left pull-left'></span>");
		var $iconPreviousText = $("<span>" + settings.lsxWizard.localization.buttons.previous + "</span>");
		$iconPrevious.css(settings.lsxWizard.buttons.previous.icon.css);
		$iconPreviousText.css(settings.lsxWizard.buttons.previous.text.css);

		var $iconNext = $("<span class='glyphicon glyphicon-chevron-right pull-right'></span>");
		var $iconNextText = $("<span>" + settings.lsxWizard.localization.buttons.next + "</span>");
		$iconNext.css(settings.lsxWizard.buttons.next.icon.css);
		$iconNextText.css(settings.lsxWizard.buttons.next.text.css);

		$buttons.find(".btn").css(settings.lsxWizard.buttons.css);

		$buttons.find(".lsx-wizard-button-previous")
			//.append($iconPrevious)
			.append($iconPreviousText);

		$buttons.find(".lsx-wizard-button-next")
			//.append($iconNext)
			.append($iconNextText);

		return $buttons;
	}

	function highlightActiveElement($plugin) {

		// find the active element position
		var $stepsWrapper = $plugin.find(".lsx-wizard-steps-wrapper");
		var $activeElement = $stepsWrapper.find(".active");
		var activeElementPosition = parseInt($activeElement.data('position'), 10);

		var $progressButtons = $plugin.find(".lsx-wizard-progress-buttons");
		$progressButtons.find(".active").removeClass("active");
		$progressButtons.find("li[data-position='" + activeElementPosition + "']").addClass("active");

		return activeElementPosition;
	}

	function getStepsWrapperTemplate(globalMinHeight) {
		var result = $("<div class='lsx-wizard-steps-wrapper'></div>")
			.css({
				'position': 'relative',
				'overflow': 'hidden',
				'width': '100%',
				'min-height': '84vh'
			});
		return result;
	}

	function getProgressButtonsTemplate($steps, settings) {

		var $progessButtonsWrapper = $("" +
			"<div class='lsx-wizard-progress-buttons-wrapper row'>" +
					"<ul class='nav nav-pills nav-justified lsx-wizard-progress-buttons'>" +
					"</ul>" +
			"</div>" +
		"").css({
			'display': 'block'
		});

		$.each($steps, function (i, step) {
			var $step = $(step);
			var cls = "";
			var pos = parseInt($step.data('position'), 10);

			var $progressButton = $("" +
				"<li class='steps" + $step.attr('data-position') + "' data-position='" + $step.attr('data-position') + "'><a href='#'>" + $step.find('h4').html() + "</a></li>" +
			"");

			if ($step.hasClass("active") && settings.lsxWizard.progressButtons.markActive) {
				$progressButton.removeClass('default');
				$progressButton.addClass('active');
			}

			$progressButton.css(settings.lsxWizard.progressButtons.css);

			$progessButtonsWrapper.find(".lsx-wizard-progress-buttons").append($progressButton);

		});

		return $progessButtonsWrapper
	}

	function getProgressButtonsBorderBottomTemplate(settings) {

		var $hr = $("");

		$hr.css(settings.lsxWizard.progressButtons.borderBottom.css);

		return $hr;

	}

	function getStepTitleTemplate(i, $step, settings) {

		var stepNumber = i + 1;
		var $stepTitle = $step.find("h4");
		var stepTitleText = $stepTitle.html();

		var $stepNumber = $("<h4 class='pull-left'>" + stepNumber + "</h4>");
		var $stepText = $("<span>" + stepTitleText + "</span>")
		$stepTitle.remove();

		var $newStepTitle = $("" +
			"" +
		"");

		$newStepTitle.find(".lsx-wizard-step-title-number").css(settings.lsxWizard.steps.title.number.css);
		$newStepTitle.find(".lsx-wizard-step-title-text").css(settings.lsxWizard.steps.title.text.css);

		return $newStepTitle;
	}

	function moveStepLeft($s) {
		$s.css({
			'margin-left': '-100%'  // move all lower steps to the left
		});
	}

	function moveStepRight($s) {
		$s.css({
			'margin-left': '100%'  // move all lower steps to the left
		});
	}

	function showStep($s) {
		$s.css({
			'margin-left': 0
		});
	}

	function getActiveElementPosition($pluginElement) {
		var stringResult = $pluginElement
			.find(".lsx-wizard-steps-wrapper")
			.find(".active").data('position');

		return parseInt(stringResult, 10);
	}

	function countElements($pluginElement) {
		return $pluginElement.find(".lsx-wizard-step").length;
	}

	function setFinishButton($pluginElement, text) {
		var $finishButton = $pluginElement.find(".lsx-wizard-button-next:not(.ignore-text)");

		var txt = $pluginElement.data('lsxWizard').settings.lsxWizard.localization.buttons.finish;
		if (text)
			txt = text;

		$finishButton.css(settings.lsxWizard.buttons.finish.text.css);

		$('.tablinks.accommodation-tablink').show();

		if ( 'wizard2' !== $pluginElement.prop('id') ) {
			$finishButton
			.removeClass('btn-primary')
			.addClass('btn-success')
			.html(txt);	
		}
	}

	function unsetFinishButton($pluginElement, settings) {
		var $finishButton = $pluginElement.find(".lsx-wizard-button-next:not(.ignore-text)");
		var txt = $pluginElement.data('lsxWizard').settings.lsxWizard.localization.buttons.next;
		var $iconNext = $("<span class='glyphicon glyphicon-chevron-right pull-right'></span>");
		var $iconNextText = $("<span>" + settings.lsxWizard.localization.buttons.next + "</span>");
		$iconNext.css(settings.lsxWizard.buttons.next.icon.css);

		$iconNextText.css(settings.lsxWizard.buttons.next.text.css);

		$('.tablinks.accommodation-tablink').hide();

		if ( 'wizard2' !== $pluginElement.prop('id') ) {
			$finishButton
				.removeClass('btn-success')
				.addClass('btn-primary')
				.html("")
				.append($iconNextText)
				.show();
				//.append($iconNext)
		}
	}

	function markStepAsCompleted(activeElementPosition, $plugin, settings) {

		$plugin.find("[data-position='" + (activeElementPosition - 1) + "']").addClass("completed");


		// find the target progressButton to mark as completed
		var $progressButton = $plugin.find(".lsx-wizard-progress-buttons").find("[data-position='" + (activeElementPosition - 1) + "']");

		// create a new success icon to place it on the progress button
		var $successIcon = $("<span class='" + settings.lsxWizard.progressButtons.completed.icon.cssClass + " lsx-wizard-icon-step-completed'></span>")
			.css(settings.lsxWizard.progressButtons.completed.icon.css);

		var $a = $progressButton.find("a");
		// When the step is completed, the progress button must show it with a new style (gray by default)...
		$a.css(settings.lsxWizard.progressButtons.completed.css);
		// ...and with a success icon appended.
		$a.append($successIcon);
	}

	function unmarkStepAsCompleted(activeElementPosition, $plugin) {

		var $progressButton = $plugin.find(".lsx-wizard-progress-buttons").find("[data-position='" + activeElementPosition + "']");
		$progressButton.find(".lsx-wizard-icon-step-completed").remove();
		var $a = $progressButton.find("a");
		$a.removeAttr("style");
	}

	function previous($plugin, goToFirst) {
		var settings = $plugin.data('lsxWizard').settings;
		var $elementToSlide = $plugin.find(".lsx-wizard-steps-wrapper .active");
		var activeStep = parseInt($plugin.find(".lsx-wizard-steps-wrapper .active").attr("data-position"), 10);
		if (activeStep > 0) {
			slideRight($elementToSlide, settings, $plugin, goToFirst);
		}
	}

	////////////////////////////////////////// Plugin definition

	$.fn.lsxWizard = function (method) {

		if (pub[method]) {
			return pub[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return pub.init.apply(this, arguments);
		} else {
			$.error('Method ' + method + ' does not exist on jQuery.lsxWizard');
		}

	};

	////////////////////////////////////////// Plugin Options

	let setReadMoreDescriptions = function() {
		$( '.entry-content.lsx-readmore' ).each( function() {
			let word_limit = 35;
			if ( 1 < $( this ).children().length ) {
				let counter = 0;
				$( this ).children().each( function() {

					//check for an empty P
					if ( '&nbsp;' === $(this).html() ) {
						$(this).remove();
					} else {
						counter++;
						p_words = $.trim( $(this).html() );
					}
				} );

				//$( this ).append( '<a class="read-more">Read More</a>' )
			}
		} );

		$( '.entry-content.lsx-readmore .read-more' ).each( function() {
			$( this ).on( 'click', function( event ){

				let collapse = false;
				if ( $(this).hasClass( 'open' ) ) {
					collapse = true;
					$( this ).html('Read More');
					$( this ).removeClass( 'open' );
					$( this ).parents( '.entry-content.lsx-readmore' ).removeClass( 'open' );
				} else {
					$( this ).html('Read Less');
					$( this ).addClass( 'open' );
					$( this ).parents( '.entry-content.lsx-readmore' ).addClass( 'open' );
				}

				let counter = 0;
				$( this ).parent('.entry-content.lsx-readmore').children().each( function(){
					counter++;

					//check for an empty P
					if ( $(this).html() ) {
						$(this).remove();
					}

					if ( true === collapse ) {
						if ( 1 < counter && ! $( this ).hasClass('read-more' ) ) {
							$( this ).hide();
						}
					} else {
						if ( ! $( this ).hasClass('read-more' ) ) {
							$( this ).show();
						}
					}
					
				});
			} );
		});
	};

	let createItineraryNavigation = function( $itinerary ) {
		let itineraryItems = [];
		let current_days   = [];
		let counter = 0;

		$itinerary.find(".itinerary-item .lsx-to-tour-content").each(function(){
			itineraryItems.push($(this).find('.lsx-to-archive-content-title').html());
			current_days.push($(this).find('.heading-destinations').html());
			$(this).find('.heading-destinations').remove();
		});

		// Run through and inject the new text.
		$itinerary.find(".itinerary-item .lsx-to-tour-content .lsx-to-archive-content-title").each(function(){
			let nextIndex = counter + 1;
			let prevIndex = counter - 1;

			let navEle    = '<div class="itinerary-navigation">';
			if ( 0 != counter ) {
				navEle += '<button class="lsx-wizard-button-previous ignore-text"><span></span></button>';
			} else {
				navEle += '<span class="first-day ignore-text">' + itineraryItems[counter] + '</span>';
			}

			navEle += '<span class="current-title">' + itineraryItems[counter] + '</span>';

			if ( counter != ( itineraryItems.length - 1 ) ) {
				navEle += '<button class="lsx-wizard-button-next ignore-text"><span>' + itineraryItems[nextIndex] + '</span></button>';
			} else {
				navEle += '<span class="last-day ignore-text">' + itineraryItems[counter] + '</span>';
			}

			navEle += '</div>';
			$(this).replaceWith( navEle );
			counter++;
		});
	};

	function populatePrefferedDatesField() {
		$('#pum-173766').on('pumAfterOpen', function (event) {
			if ( 0 < $.fn.popmake.last_open_trigger.length ) {
				let date_value = $.fn.popmake.last_open_trigger.attr('data-gform-value');
				if ( 0 < $('#input_4_27').length ) {
					$('#input_4_27').val(date_value);
				}
			}
		});
	};

	function whoSingleSelection() {
		if ( 0 < $('.wizard-who').length ) {
			$('.wizard-who .checkbox-clear input[type="checkbox"]').each(function(event){
				$(this).on('click', function(){
					$('.wizard-who .checkbox-clear input[type="checkbox"]').each(function(event){
						$(this).removeAttr( 'checked' );
						$(this).prop( 'checked', false );
					});
					$(this).prop( 'checked', true ).trigger("change");				
				});
			});
		}
	};

	function budgetSingleSelection() {
		if ( 0 < $('.wizard-budget').length ) {
			$('.wizard-budget .checkbox-wrapper input[type="checkbox"]').each(function(event){
				$(this).on('click', function(){

					$('.wizard-budget .checkbox-wrapper input[type="checkbox"]').each(function(event){
						$(this).removeAttr( 'checked' );
						$(this).prop( 'checked', false );
					});

					$(this).prop( 'checked', true ).trigger("change");				
				});
			});
		}
	};

	$.fn.lsxWizard.defaults = {
		lsxWizard: {
			minHeight: 400,
			activeStep: 1,
			localization: {
				buttons: {
					next: 'Next',
					previous: 'Previous',
					finish: 'Finish',
					loading: 'Loading...'
				}
			},
			progressButtons: {
				borderBottom: {
					css: {
						'border-width': '4px',
						'border-color': '#E6E6E6'
					}
				},
				css: {
					'padding': '0 4px',

				},
				markActive: false,
				completed: {
					css: {
						'background-color': '#E6E6E6'
					},
					icon: {
						cssClass: 'glyphicon glyphicon-ok-sign',
						css: {
							'position': 'absolute',
							'top': '-20px',
							'right': '-17px',
							'font-size': '4em',
							'color': 'green'
						}
					}
				}

			},
			steps: {
				title: {
					number: {
						css: {
							'background-color': '#E6E6E6',
							'-webkit-border-radius': '300px',
							'-moz-border-radius': '300px',
							'border-radius': '300px',
							'color': '#FFFFFF',
							'float': 'left',
							'font-size': '36px',
							'height': '70px',
							'margin-right': '10px',
							'text-align': 'center',
							'width': '70px',
							'font-weight': 'bold',
							'padding-top': '8px'
						}
					},
					text: {
						css: {
							'color': '#158CBA',
							'font-size': '36px',
							'float': 'left',
							'font-size': '36px',
							'margin-top': '8px'
						}
					}
				},
				content: {

				}
			},
			buttons: {
				previous: {
					text: {
						css: {
							//'float': 'right',
							//'font-size': '14px',
							//'margin-top': '2px',
							//'margin-left': '7px'
						}
					},
					icon: {
						css: {
							//'font-size': '24px'
						}
					}

				},
				next: {
					text: {
						css: {
							//'float': 'left',
							//'font-size': '14px',
							//'margin-top': '2px',
							//'margin-right': '7px'
						}
					},
					icon: {
						css: {
							//'font-size': '14px'
						}
					}
				},
				'css': {
					//'padding-bottom': '10px'
				},
				finish: {
					text: {
						css: {
							'display': 'none',
							//'float': 'left',
							//'font-size': '20px',
							//'margin-top': '2px',
							//'margin-right': '7px'
						}
					}
				},
				'css': {
					//'padding-bottom': '10px'
				}

			}
		}
	};
	// Get the element with id="defaultOpen" and click on it
	//document.getElementsByClassName("tours-wizard").click();

	$(document).ready(function () {
		$("#wizard").on('beForeEventRegistration.lsxWizard', function( event ) {
			createItineraryNavigation( $("#wizard") );
		} );

		$("#wizard").lsxWizard();
		$("#wizard2").lsxWizard();

		setReadMoreDescriptions();
		populatePrefferedDatesField();
	});
	
	document.addEventListener('DOMContentLoaded', function() {
    const scrollContainers = document.querySelectorAll('.entry-content.lsx-readmore');

    scrollContainers.forEach(container => {
        const scrollUpButton = container.previousElementSibling; // Assumes the scroll up button is directly before the container
        const scrollDownButton = container.nextElementSibling; // Assumes the scroll down button is directly after the container

        function checkAndToggleScrollButtons() {
            console.log('Checking:', container.scrollHeight, 'vs', container.clientHeight);
            if (container.scrollHeight > 300 && container.scrollHeight > container.clientHeight) {
                console.log('Showing scroll buttons.');
                scrollDownButton.style.display = 'block';
                scrollUpButton.style.display = 'block';
            } else {
                console.log('Hiding scroll buttons.');
                scrollDownButton.style.display = 'none';
                scrollUpButton.style.display = 'none';
            }
        }

        checkAndToggleScrollButtons(); // Initial check
        setInterval(checkAndToggleScrollButtons, 1000); // Check every second to handle dynamic content changes

        scrollDownButton.addEventListener('click', function(event) {
            event.preventDefault();
            container.scrollBy({ top: 100, behavior: 'smooth' });
        });

        scrollUpButton.addEventListener('click', function(event) {
            event.preventDefault();
            container.scrollBy({ top: -100, behavior: 'smooth' });
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const scrollContainers = document.querySelectorAll('.dates-prices.hentry');

    scrollContainers.forEach(container => {
        const scrollButton = container.nextElementSibling; // Adjust this if the button isn't directly after the container

        function checkAndToggleScrollButton() {
            console.log('Checking:', container.scrollHeight, 'vs', container.clientHeight);
            // Show the button if the content height is greater than the container height
            if (container.scrollHeight > container.clientHeight) {
                console.log('Showing scroll button.');
                scrollButton.style.display = 'block'; // Ensure your button has a class or specific styling to display
            } else {
                console.log('Hiding scroll button.');
                scrollButton.style.display = 'none';
            }
        }

        checkAndToggleScrollButton(); // Initial check
        window.addEventListener('resize', checkAndToggleScrollButton); // Check on window resize

        scrollButton.addEventListener('click', function(event) {
            event.preventDefault();
            container.scrollBy({ top: 100, behavior: 'smooth' }); // Scrolls down
        });
    });
});
	
})( jQuery, window, document );