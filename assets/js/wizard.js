;(function ($, window, document, undefined) {

	var settings;

	////////////////////////////////////////// Public methods

	var tspSliderFirstLoad = true;

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

					/////////////////////////// Register event handlers

					$this.find('.lsx-wizard-button-previous').click(function (e) {
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
					});

					$this.on("slideRightSuccess.lsxWizard", function () {
						resizeWizardStepsWrapper($this);
					});

					$this.on("slideLeftSuccess.lsxWizard", function () {
						resizeWizardStepsWrapper($this);
					});

					$this.find('.lsx-wizard-button-next').click(function (e) {
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

					if ( $this.hasClass( 'mini-wizard-form' ) ) {
						refreshMiniWizardResults();
					}
					
					/////////////////////////// Testing Success Icon
					var $progressButtonsPlaceholder = $progressButtonsTemplate.find(".lsx-wizard-progress-buttons");
					var $progressButtons = $progressButtonsPlaceholder.children();

					/////////////////////////// Store plugin data

					$this.data('lsxWizard').target = $this;
					$this.data('lsxWizard').lsxWizard = lsxWizard;
					$this.data('lsxWizard').settings = settings;

					resizeWizardStepsWrapper($this);

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
			console.log('next slide');
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
	function refreshMiniWizardResults() {
		$(document).on( 'facetwp-loaded', function() {

			console.log(tspSliderFirstLoad);
			if ( true === tspSliderFirstLoad ) {
				tspSliderFirstLoad = false;
			} else {
				console.log('tsp facet loaded.');
				$( '.lsx-to-slider .lsx-to-slider-inner' ).each( function() {
					$(this).slick( {
						draggable: false,
						infinite: true,
						swipe: false,
						//cssEase: lsx_to_params.slickSlider.desktop.cssEase,
						dots: false,
						slidesToShow: 4,
						slidesToScroll: 4,
						autoplay: false,
						responsive: [
							{
								breakpoint: 992,
								settings: {
									draggable: false,
									arrows: true,
									swipe: false,
								}
							},
							{
								breakpoint: 768,
								settings: {
									slidesToShow:   1,
									slidesToScroll: 1,
									draggable:      true,
									arrows:         false,
									swipe:          true
								}
							}
						]
					} );
				});
			}
		} );
	}

	function resizeWizardStepsWrapper($this) {
		var $wizardStepsWrapper = $this.find(".lsx-wizard-steps-wrapper");
		var $activeStep = $wizardStepsWrapper.find(".active");

		$wizardStepsWrapper.clearQueue().animate({
			"height": $activeStep.height() + "px"
		});
	}

	function slideLeft($elementToSlide, settings, $plugin, slideSuccessCallback) {

		if ($elementToSlide.next().length) {

			jQuery('html, body').animate({
				scrollTop: $plugin.offset().top - 100
			}, 100);

			$elementToSlide.clearQueue().animate({
				'margin-left': '-100%'
			});

			var $next = $elementToSlide.next();

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
					$plugin.find('.lsx-wizard-button-previous').show();
				}

				var $progressButtons = $plugin.find(".lsx-wizard-progress-buttons").children();

				$.isFunction(settings.onSlideLeftFinished) && settings.onSlideLeftFinished.call($plugin);
				$plugin.trigger("slideLeftSuccess.lsxWizard", this);
			});

		} else {

			console.log($plugin);

			let selectedCheckboxes = $plugin.find('input[type="checkbox"]:checked').map(
				function(){
					return {
						'id' : $(this).val(),
						'name' : $(this).attr('name')
					}
				}).get();

			if ( $plugin.hasClass( 'insipre-wizard-form' ) ) {
				submitInspireWizard( selectedCheckboxes );
			}

			if ( $plugin.hasClass( 'mini-wizard-form' ) ) {
				submitMiniWizard( selectedCheckboxes );
			}
		}

	}

	function submitMiniWizard( selectedCheckboxes ) {

		console.log(selectedCheckboxes);

		if( typeof FWP === 'undefined' ) {
			return '';
		}

		let what = [];
		let who = [];
		let where = [];
		let when = [];
		let budget = [];

		selectedCheckboxes.forEach(function (value, index, array) {

			switch(value.name) {
				case 'fwp_who':
					who.push(value.id);
					break;
				case 'fwp_what':
					what.push(value.id);
					break;
				case 'fwp_where':
					where.push(value.id);
					break;
				case 'fwp_when':
					when.push(value.id);
					break;
				case 'fwp_budget':
					budget.push(value.id);
					break;
				default:
					// code block
			}
		});

		if ( 0 < who.length ) {
			FWP.facets['who'] = who;
		}

		if ( 0 < what.length ) {
			FWP.facets['what'] = what;
		}

		if ( 0 < where.length ) {
			FWP.facets['where'] = where;
		}

		if ( 0 < when.length ) {
			FWP.facets['when'] = when;
		}

		if ( 0 < budget.length ) {
			FWP.facets['budget'] = budget;
		}

		$( '.lsx-to-slider .lsx-to-slider-inner' ).each( function() {
			$(this).slick('unslick');
		});

		FWP.fetchData();
	}

	function submitInspireWizard( selectedCheckboxes ) {
		let urlParams = '?s=';
		let what = [];
		let who = [];
		let where = [];
		let when = [];
		let budget = [];

		selectedCheckboxes.forEach(function (value, index, array) {

			switch(value.name) {
				case 'fwp_who':
					who.push(value.id);
					break;
				case 'fwp_what':
					what.push(value.id);
					break;
				case 'fwp_where':
					where.push(value.id);
					break;
				case 'fwp_when':
					when.push(value.id);
					break;
				case 'fwp_budget':
					budget.push(value.id);
					break;
				default:
					// code block
			}
		});

		if ( 0 < who.length ) {
			urlParams = urlParams + '&fwp_who=' + who.join(',');
		}

		if ( 0 < what.length ) {
			urlParams = urlParams + '&fwp_what=' + what.join(',');
		}

		if ( 0 < where.length ) {
			urlParams = urlParams + '&fwp_where=' + where.join(',');
		}

		if ( 0 < when.length ) {
			urlParams = urlParams + '&fwp_when=' + when.join(',');
		}

		if ( 0 < budget.length ) {
			urlParams = urlParams + '&fwp_budget=' + budget.join(',');
		}

		window.location.href = $('.insipre-wizard-form').attr('action') + urlParams;
	}

	function slideRight($elementToSlide, settings, $plugin, goToFirst) {

		if ($elementToSlide.prev().length) {

			jQuery('html, body').animate({
				scrollTop: $plugin.offset().top - 100
			}, 100);

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

					$.isFunction(settings.onSlideRightLimitReached) && settings.onSlideRightLimitReached.call($plugin);
					$plugin.trigger("slideRightLimitReached.lsxWizard", this);
				} else {
					if ($plugin.find('.lsx-wizard-button-next').hasClass('btn-success')) {
						unsetFinishButton($plugin, settings);
					}
				}

				$.isFunction(settings.onSlideRightFinished) && settings.onSlideRightFinished.call($plugin);
				$plugin.trigger("slideRightSuccess.lsxWizard", goToFirst);

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
		var $finishButton = $pluginElement.find(".lsx-wizard-button-next");

		var txt = $pluginElement.data('lsxWizard').settings.lsxWizard.localization.buttons.finish;
		if (text)
			txt = text;

		$finishButton.css(settings.lsxWizard.buttons.finish.text.css);

		$finishButton
			.removeClass('btn-primary')
			.addClass('btn-success')
			.html(txt);
	}

	function unsetFinishButton($pluginElement, settings) {
		var $finishButton = $pluginElement.find(".lsx-wizard-button-next");
		var txt = $pluginElement.data('lsxWizard').settings.lsxWizard.localization.buttons.next;
		var $iconNext = $("<span class='glyphicon glyphicon-chevron-right pull-right'></span>");
		var $iconNextText = $("<span>" + settings.lsxWizard.localization.buttons.next + "</span>");
		$iconNext.css(settings.lsxWizard.buttons.next.icon.css);

		$iconNextText.css(settings.lsxWizard.buttons.next.text.css);

		$finishButton
			.removeClass('btn-success')
			.addClass('btn-primary')
			.html("")
			.append($iconNextText)
			//.append($iconNext)
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

	$.fn.lsxWizard.defaults = {
		lsxWizard: {
			minHeight: 360,
			activeStep: 1,
			localization: {
				buttons: {
					next: 'Next Step',
					previous: 'Previous Step',
					finish: 'Finish',
					loading: 'Loading...'
				}
			},
			progressButtons: {
				borderBottom: {
					css: {

					}
				},
				css: {


				},
				markActive: false,
				completed: {
					css: {

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
							'color': '#000',
							'float': 'left',
							'font-size': '36px',
							'height': '70px',
							'margin-right': '10px',
							'text-align': 'center',
							'width': '70px',
							'border-bottom': '3px solid #000',
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
							//'font-size': '20px',
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

	$(document).ready(function () {
		$("#wizard").lsxWizard();
	});

})( jQuery, window, document );