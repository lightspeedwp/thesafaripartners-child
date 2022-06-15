<?php
/**
 * Template Name: Honeymoon
 *
 * @package lsx
 */

get_header(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php lsx_content_wrap_before(); ?>

<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">

	<?php lsx_content_before(); ?>

	<main id="main" class="site-main" role="main">

		<?php lsx_content_top(); ?>

		<?php if ( have_posts() ) : ?>

			<?php
			while ( have_posts() ) :
				the_post();
			?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

			<?php endwhile; ?>

		<?php endif; ?>

		<?php lsx_content_bottom(); ?>
		<div id="wizard" class="lsx-wizard" style="display: none;">

				<div class="lsx-wizard-step">
						<h4>2. What</h4>
						<div class="step-content">
							<div class="wizard-what">
								<div class="col-md-3">
									<h2>What interests you?</h2>
									<p>Let us what interests you</p>
									</div>
									<div class="col-md-9 myBtnContainer">

											<?php
											$terms = get_terms('travel-style');
											$post_tags = wp_get_post_terms($post->ID,'travel-style',array('fields' => 'slugs'));?>
											<?php foreach( $terms as $term ): ?>
													<!-- post -->

											<article class="col-md-2 status-publish hentry">
												<div class="checkbox-wrapper facetwp-checkbox" data-value="<?php echo esc_html( apply_filters( 'the_title', $term->slug ) ); ?>">
															<input class="btn-check"  type="checkbox"/>
															<span aria-hidden="true"></span>
														</div>

													<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) : ?>
														<div class="lsx-to-widget-thumb">
																<?php lsx_to_term_thumbnail( $term->term_id, 'lsx-full' ); ?>
														</div>

													<?php else : ?>
														<div class="lsx-to-widget-thumb">
																<img alt="Placeholder" class="attachment-responsive wp-post-image lsx-responsive" src="<?php echo esc_url( lsx\legacy\Placeholders::placeholder_url( null, null, array( 750, 350 ) ) ); ?>">
														</div>

													<?php endif; ?>

													<div class="lsx-to-content">
															<?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>
															</div>



											</article>
										<?php endforeach; ?>

										<?php	wp_reset_query(); ?>

										</div>
									</div>
								</div>
							</div>

				<div class="lsx-wizard-step">
						<h4>3. Where</h4>
						<div class="step-content">
							<div class="wizard-where">
								<div class="col-md-12 whereintro">
									<h2>Where in Africa?</h2>
									<p>Let us where you want to travel</p>
									</div>
									<div class="col-md-12 myBtnContainer">

										<div class="safari-styles desinations-landing-style">
											<div class="slider-container lsx-to-widget-items lsx-to-archive-template-grid">
												<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>" class="lsx-to-slider">
													<div class="lsx-to-slider-wrap">
														<div class="lsx-to-slider-inner" data-slick='{ "slidesToShow": 4, "slidesToScroll": 4 }'>
											<?php
											$the_query = new WP_Query( array(
											'post_type' => 'destination',
											'post_parent' => 0,
										) );

										while ( $the_query->have_posts() ) :
											$the_query->the_post();?>


															<div class="lsx-to-widget-item-wrap col-xs-4 col-sm-3 lsx-travel-style destinations-archive lsx-to-archive-item">
																<div class="lsx-to-widget-thumb">

																	<div class="checkbox-wrapper">
																		<input class="btn-check"  type="checkbox" onclick="filterSelection('destination-<?php the_title();?>')" />
																		<span aria-hidden="true"></span>
																	</div>
																		<?php lsx_thumbnail( 'lsx-thumbnail-full' ); ?>
																</div>

																	<div class="lsx-to-content">
																			<?php the_title(); ?>
																		</div>
																	</div>

															<?php endwhile; ?>
															<?php	wp_reset_query(); ?>
															</div>
															</div>
															</div>
															</div>
															</div>


								</div>
						</div>
				</div>
				</div>

			</div>
	</div>

	<div class="tour-display col-md-12">

		<div class="toptours-posts">
			<div class="slider-container lsx-to-widget-items lsx-to-archive-template-grid">
				<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>" class="lsx-to-slider">
					<div class="lsx-to-slider-wrap">
						<div class="lsx-to-slider-inner" data-slick='{ "slidesToShow": 4, "slidesToScroll": 4 }'>
			<?php
			$the_query = new WP_Query( array(
    'post_type' => 'tour',
		'facetwp' => true,
    'tax_query' => array(
        array (
            'taxonomy' => 'who',
            'field' => 'slug',
            'terms' => 'honeymooners',
        )
    ),
) );

		while ( $the_query->have_posts() ) :
			$the_query->the_post();?>
			<article <?php post_class( 'filterDiv facet-box' ); ?>>

				<?php lsx_widget_entry_top(); ?>


					<div class="lsx-to-widget-thumb">

			<a href="<?php echo esc_url( $permalink ); ?>">
							<?php lsx_thumbnail( 'lsx-thumbnail-wide' ); ?>

			</a>
					</div>


				<div class="lsx-to-widget-content">

					<?php lsx_widget_entry_content_top(); ?>

					<h4 class="lsx-to-widget-title text-center">

			<a href="<?php echo esc_url( $permalink ); ?>">
							<?php the_title(); ?>

			</a>
					</h4>

					<?php
					ob_start();
					lsx_to_widget_entry_content_top();
					the_excerpt();

					$excerpt = ob_get_clean();

						echo wp_kses_post( $excerpt );
					?>
						<div class="lsx-to-widget-meta-data">
							<?php
							$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

							lsx_to_price( '<span class="' . $meta_class . 'price"><span class="lsx-to-meta-data-key">' . esc_html__( 'from', 'tour-operator' ) . ':</span> ', '</span>' );
							lsx_to_duration( '<span class="' . $meta_class . 'duration"><span class="lsx-to-meta-data-key">' . esc_html__( 'Duration', 'tour-operator' ) . ':</span> ', '</span>' );
							the_terms( get_the_ID(), 'travel-style', '<span class="' . $meta_class . 'style"><span class="lsx-to-meta-data-key">' . esc_html__( 'Travel Style', 'tour-operator' ) . ':</span> ', ', ', '</span>' );
							lsx_to_connected_countries( '<span class="' . $meta_class . 'destinations"><span class="lsx-to-meta-data-key">' . esc_html__( 'Destinations', 'tour-operator' ) . ':</span> ', '</span>' );

							if ( function_exists( 'lsx_to_connected_activities' ) ) {
								lsx_to_connected_activities( '<span class="' . $meta_class . 'activities"><span class="lsx-to-meta-data-key">' . esc_html__( 'Activities', 'tour-operator' ) . ':</span> ', '</span>' );
							}
							?>
							<p class="moretag-wrapper tourslink"><a href="<?php echo esc_url( $permalink ); ?>" class="moretag"><?php esc_html_e( 'VIEW TRIP', 'tour-operator' ); ?></a></p>
						</div>



					<?php lsx_widget_entry_content_bottom(); ?>
				</div>

				<?php lsx_widget_entry_bottom(); ?>

			</article>


							<?php endwhile; ?>
							<?php	wp_reset_query(); ?>
							</div>
							</div>
							</div>
							</div>
							</div>
						</div>

	</main><!-- #main -->

	<?php lsx_content_after(); ?>

	<?php
	if ( comments_open() ) {
		comments_template();
	}
	?>

</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php get_sidebar(); ?>

<script type="text/javascript">
$(document).ready(function () {
    $("#wizard").lsxWizard();
});

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
				'min-height': globalMinHeight + 'px'
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
			minHeight: 560,
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

})( jQuery, window, document );
</script>
<script>
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

// Show filtered elements
function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide elements that are not selected
function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current control button (highlight it)
var btnContainer = document.getElementsByClassName("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn-check");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>
<?php
get_footer();
