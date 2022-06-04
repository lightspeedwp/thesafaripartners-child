<?php
/**
 * Tour Single Template
 *
 * @package     tour-operator
 * @category    tour
 */

get_header(); ?>
<script type="text/javascript">
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
}
// Get the element with id="defaultOpen" and click on it
document.getElementByClassName("tours-wizard").click();
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area wizard-landing col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

					<div id="collapse-summary" class="collapse in">
						<div class="collapse-inner">
							<div class="row">


								<div class="col-md-12 outer-container">
									<div class="tab">

												<button class="tablinks tours-wizard" id="tours-wizard" onclick="openCity(event, 'Overview')">Overview</button>
												<button class="tablinks" id="page-1" onclick="openCity(event, 'Day')">Day by Day</button>
												<button class="tablinks" id="page-3" onclick="openCity(event, 'Accommodation')">Accommodation</button>
												<button class="tablinks" id="page-4" onclick="openCity(event, 'Price')">Dates & Prices</button>
												<button class="tablinks" id="page-5" onclick="openCity(event, 'Maps')">Maps & More</button>

										</div>
									</div>

												<div id="Overview" class="tabcontent">
													<div class="col-md-12 col-sm-12">
														<div class="lsx-tour-module">
															<?php if ( have_posts() ) : ?>

																<?php
																while ( have_posts() ) :
																	the_post();
																?>

																<?php lsx_entry_before(); ?>
																<div class="col-md-6 lsx-tour-module-image">
																	<div class="lsx-banner-image-wrap">
																		<picture>
																			<?php echo get_the_post_thumbnail($page->ID,'full'); ?>
																			<picture>
																			</div>

																		</div>


																<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-single' ); ?>>
																	<?php lsx_entry_top(); ?>


																		<div class="entry-content col-xs-12 col-sm-12 col-md-6">
																			<div class="lsx-to-tour-content">
																			<div class="lsx-to-summary">
																				<h2 class="lsx-to-summary-title"><?php the_title(); ?></h2>

																			</div>

																			<?php lsx_to_price( '<p class="lsx-to-meta-data lsx-to-meta-data-big lsx-to-meta-data-price"><span class="lsx-to-meta-data-key">' . esc_html__( 'From price', 'tour-operator' ) . ':</span> ', '</p>' ); ?>
																			<?php the_content(); ?>

																		</div>
</div>
																	<?php lsx_entry_bottom(); ?>

																</article>

																<?php
																lsx_entry_after(); ?>

																<?php endwhile; ?>

															<?php endif; ?>
															<?php	wp_reset_query(); ?>
													</div>
												</div>
												</div>


												<div id="Day" class="tabcontent">
													<div class="col-md-12 col-sm-12">
														<div class="lsx-tour-module">
															<?php if ( have_posts() ) : ?>

																<?php
																while ( have_posts() ) :
																	the_post();
																?>

																<?php lsx_entry_before(); ?>

																<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>
																	<?php lsx_entry_top(); ?>


																		<div class="entry-content col-xs-12 col-sm-12 col-md-12">

																		<div class="itenary">
																			<div id="wizard" class="lsx-wizard" style="display: none;">
																			  <?php 	if ( lsx_to_has_itinerary() ) {
																			$itinerary_count = 1;
																			?>
																			<div id="itinerary" class="<?php lsx_to_collapsible_class( 'tour', false ); ?>">

																			<div id="collapse-itinerary" class="collapse in">
																			<div class="collapse-inner">
																			<div class="row lsx-to-archive-items lsx-to-archive-template-list lsx-to-archive-template-image-<?php echo esc_attr( tour_operator()->archive_list_layout_image_style ); ?> itinerary-list">
																			<?php while ( lsx_to_itinerary_loop() ) { ?>
																			<?php
																			lsx_to_itinerary_loop_item();
																			$thumb = lsx_to_itinerary_thumbnail();
																			?>

																			    <div class="lsx-wizard-step">
																						<h4><?php lsx_to_itinerary_title(); ?></h4>
																			        <div class="step-content">
																			          <div id="day-<?php echo esc_attr( $itinerary_count ); ?>" <?php lsx_to_itinerary_class( 'lsx-to-archive-item itinerary-item col-xs-12' ); ?>>
																			            <div class="lsx-to-archive-container">

																										<div class="col-md-6 lsx-tour-module-image">
																											<div class="lsx-banner-image-wrap">

																			                <div class="lsx-to-thumb-slot" style="background-image: url('<?php echo esc_url( $thumb ); ?>');">
																			                  <?php echo wp_kses_post( '<img alt="thumbnail" class="attachment-responsive wp-post-image lsx-responsive" src="' . $thumb . '">' ); ?>
																			                </div>

																										</div>
																										</div>

																										<div class="col-xs-12 col-sm-12 col-md-6">
																			              <div class="lsx-to-archive-wrapper">
																			                <div class="lsx-to-tour-content">
																			                  <h3 class="lsx-to-archive-content-title"><?php lsx_to_itinerary_title(); ?></h3>
																			                  <p class="lsx-to-archive-content-tagline"><?php lsx_to_itinerary_tagline(); ?></p>

																			                  <div class="entry-content">
																			                    <?php lsx_to_itinerary_description(); ?>
																			                  </div>
																			                </div>

																			                <div class="lsx-to-archive-meta-data">
																			                  <?php
																			                    $meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

																			                    lsx_to_itinerary_destinations( '<span class="' . $meta_class . 'destinations"><span class="lsx-to-meta-data-key">' . esc_html__( 'Destination', 'tour-operator' ) . ':</span> ', '</span>' );
																			                    lsx_to_itinerary_accommodation( '<span class="' . $meta_class . 'accommodations"><span class="lsx-to-meta-data-key">' . esc_html__( 'Accommodation', 'tour-operator' ) . ':</span> ', '</span>' );
																			                    lsx_to_itinerary_activities( '<span class="' . $meta_class . 'activities"><span class="lsx-to-meta-data-key">' . esc_html__( 'Activities', 'tour-operator' ) . ':</span> ', '</span>' );
																			                    lsx_to_itinerary_includes( '<span class="' . $meta_class . 'day-includes"><span class="lsx-to-meta-data-key">' . esc_html__( 'Included', 'tour-operator' ) . ':</span> ', '</span>' );
																			                    lsx_to_itinerary_excludes( '<span class="' . $meta_class . 'day-excludes"><span class="lsx-to-meta-data-key">' . esc_html__( 'Excluded', 'tour-operator' ) . ':</span> ', '</span>' );
																			                  ?>
																			                </div>
																			              </div>
																			            </div>
																									</div>
																			          </div>
																			          <?php
																			          $itinerary_count++;
																			        }
																			        ?>
																			      </div>
																			    </div>
																			  </div>

																			  <?php lsx_to_itinerary_read_more(); ?>
																			</div>

																			<?php } ?>

																			        </div>
																			    </div>




																			</div>

																		</div>
																		</div>



																	<?php lsx_entry_bottom(); ?>

																</article>

																<?php
																lsx_entry_after(); ?>

																<?php endwhile; ?>

															<?php endif; ?>
															<?php	wp_reset_query(); ?>
													</div>
												</div>
												</div>


												<div id="Accommodation" class="tabcontent">
													<div class="col-md-12 col-sm-12">
														<div class="lsx-tour-module">
															<?php if ( have_posts() ) : ?>

																<?php
																while ( have_posts() ) :
																	the_post();
																?>

																<?php lsx_entry_before(); ?>

																<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>
																	<?php lsx_entry_top(); ?>
																	<div class="col-md-6 lsx-tour-module-image">
																		<div class="lsx-banner-image-wrap">

																		<div class="lsx-to-thumb-slot" >
																			<?php lsx_to_gallery(); ?>
																		</div>

																	</div>
																	</div>

																	<div class="col-xs-12 col-sm-12 col-md-6">
																	<div class="lsx-to-archive-wrapper">
																		<div class="lsx-to-tour-content">
																		<div class="entry-content col-xs-12 col-sm-12 col-md-12 lsx-to-tour-content">
																			<div class="lsx-to-summary">
																				<h2 class="lsx-to-summary-title">Accommodation</h2>

																			</div>

																			<?php lsx_to_included_block(); ?>

																		</div></div></div></div>
</div>


																	<?php lsx_entry_bottom(); ?>

																</article>

																<?php
																lsx_entry_after(); ?>

																<?php endwhile; ?>

															<?php endif; ?>
															<?php	wp_reset_query(); ?>
													</div>
												</div>

												<div id="Price" class="tabcontent">
													<div class="col-md-12 col-sm-12">
														<div class="lsx-tour-module">
															<?php if ( have_posts() ) : ?>

																<?php
																while ( have_posts() ) :
																	the_post();
																?>

																<?php lsx_entry_before(); ?>

																<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>
																	<?php lsx_entry_top(); ?>
																	<div class="col-md-6 lsx-tour-module-image">
																		<div class="lsx-banner-image-wrap">

																		<div class="lsx-to-thumb-slot" >
																			<picture>
																				<?php echo get_the_post_thumbnail($page->ID,'full'); ?>
																				<picture>
																		</div>

																	</div>
																	</div>

																	<div class="col-xs-12 col-sm-12 col-md-6">
																	<div class="lsx-to-archive-wrapper">
																		<div class="lsx-to-tour-content">
																		<div class="entry-content col-xs-12 col-sm-12 col-md-12 lsx-to-tour-content">
																			<div class="lsx-to-summary">
																				<h2 class="lsx-to-summary-title">Dates & Prices</h2>

																			</div>

																			<table class="table table-striped">


																							<thead>
																								<tr>
																									<th>Start Date:</th><th>End Date:</th><th>Price Sharing:</th><th>Single Add:</th><th></th>
																							  	</tr>
																							</thead>

																							<tbody>
																								<tr><td class="start-date" data-gform-date="04/01/2022">01 Apr 2022</td><td class="end-date" data-gform-date="06/30/2022">30 Jun 2022</td><td class="price-sharing"><span class="amount" data-currency="USD" data-original=" USD $4590" data-price="4590" title="Original price:4590">USD $<strong>4,590</strong></span></td><td class="single-add"><span class="amount" data-currency="USD" data-original=" USD $1090" data-price="1090" title="Original price:1090">USD $<strong>1,090</strong></span></td><td class="book-now-wrapper"><button data-toggle="modal" data-target="#tour-request-modal" data-title="Botswana Value Flying Safari" class="btn btn-default dates-prices-book-now">Book Now</button></td></tr><tr><td class="start-date" data-gform-date="07/01/2022">01 Jul 2022</td><td class="end-date" data-gform-date="10/31/2022">31 Oct 2022</td><td class="price-sharing"><span class="amount" data-currency="USD" data-original=" USD $5780" data-price="5780" title="Original price:5780">USD $<strong>5,780</strong></span></td><td class="single-add"><span class="amount" data-currency="USD" data-original=" USD $1445" data-price="1445" title="Original price:1445">USD $<strong>1,445</strong></span></td><td class="book-now-wrapper"><button data-toggle="modal" data-target="#tour-request-modal" data-title="Botswana Value Flying Safari" class="btn btn-default dates-prices-book-now">Book Now</button></td></tr><tr><td class="start-date" data-gform-date="11/01/2022">01 Nov 2022</td><td class="end-date" data-gform-date="11/30/2022">30 Nov 2022</td><td class="price-sharing"><span class="amount" data-currency="USD" data-original=" USD $4590" data-price="4590" title="Original price:4590">USD $<strong>4,590</strong></span></td><td class="single-add"><span class="amount" data-currency="USD" data-original=" USD $1090" data-price="1090" title="Original price:1090">USD $<strong>1,090</strong></span></td><td class="book-now-wrapper"><button data-toggle="modal" data-target="#tour-request-modal" data-title="Botswana Value Flying Safari" class="btn btn-default dates-prices-book-now">Book Now</button></td></tr><tr><td class="start-date" data-gform-date="12/01/2022">01 Dec 2022</td><td class="end-date" data-gform-date="03/31/2023">31 Mar 2023</td><td class="price-sharing"><span class="amount" data-currency="USD" data-original=" USD $3545" data-price="3545" title="Original price:3545">USD $<strong>3,545</strong></span></td><td class="single-add"><span class="amount" data-currency="USD" data-original=" USD $775" data-price="775" title="Original price:775">USD $<strong>775</strong></span></td><td class="book-now-wrapper"><button data-toggle="modal" data-target="#tour-request-modal" data-title="Botswana Value Flying Safari" class="btn btn-default dates-prices-book-now">Book Now</button></td></tr>				</tbody><tbody>
																						</tbody></table>
																			<?php lsx_to_included_block(); ?>

																		</div></div></div></div>
</div>


																	<?php lsx_entry_bottom(); ?>

																</article>

																<?php
																lsx_entry_after(); ?>

																<?php endwhile; ?>

															<?php endif; ?>
															<?php	wp_reset_query(); ?>
													</div>
												</div>



												<div id="Maps" class="tabcontent">
													<div class="col-md-12 col-sm-12">
														<div class="lsx-tour-module">
															<?php if ( have_posts() ) : ?>

																<?php
																while ( have_posts() ) :
																	the_post();
																?>

																<?php lsx_entry_before(); ?>

																<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>
																	<?php lsx_entry_top(); ?>
																	<div class="col-md-6 lsx-tour-module-image">
																		<div class="lsx-banner-image-wrap">

																		<div class="lsx-to-thumb-slot" >
																			<picture>
																				<?php echo get_the_post_thumbnail($page->ID,'full'); ?>
																				<picture>
																		</div>

																	</div>
																	</div>

																	<div class="col-xs-12 col-sm-12 col-md-6">
																	<div class="lsx-to-archive-wrapper">
																		<div class="lsx-to-tour-content">
																		<div class="entry-content col-xs-12 col-sm-12 col-md-12 lsx-to-tour-content">
																			<div class="lsx-to-summary">
																				<h2 class="lsx-to-summary-title">Maps</h2>

																			</div>

																			<table class="table table-striped">


																							<thead>
																								<tr>
																									<th>Start Date:</th><th>End Date:</th><th>Price Sharing:</th><th>Single Add:</th><th></th>
																							  	</tr>
																							</thead>

																							<tbody>
																								<tr><td class="start-date" data-gform-date="04/01/2022">01 Apr 2022</td><td class="end-date" data-gform-date="06/30/2022">30 Jun 2022</td><td class="price-sharing"><span class="amount" data-currency="USD" data-original=" USD $4590" data-price="4590" title="Original price:4590">USD $<strong>4,590</strong></span></td><td class="single-add"><span class="amount" data-currency="USD" data-original=" USD $1090" data-price="1090" title="Original price:1090">USD $<strong>1,090</strong></span></td><td class="book-now-wrapper"><button data-toggle="modal" data-target="#tour-request-modal" data-title="Botswana Value Flying Safari" class="btn btn-default dates-prices-book-now">Book Now</button></td></tr><tr><td class="start-date" data-gform-date="07/01/2022">01 Jul 2022</td><td class="end-date" data-gform-date="10/31/2022">31 Oct 2022</td><td class="price-sharing"><span class="amount" data-currency="USD" data-original=" USD $5780" data-price="5780" title="Original price:5780">USD $<strong>5,780</strong></span></td><td class="single-add"><span class="amount" data-currency="USD" data-original=" USD $1445" data-price="1445" title="Original price:1445">USD $<strong>1,445</strong></span></td><td class="book-now-wrapper"><button data-toggle="modal" data-target="#tour-request-modal" data-title="Botswana Value Flying Safari" class="btn btn-default dates-prices-book-now">Book Now</button></td></tr><tr><td class="start-date" data-gform-date="11/01/2022">01 Nov 2022</td><td class="end-date" data-gform-date="11/30/2022">30 Nov 2022</td><td class="price-sharing"><span class="amount" data-currency="USD" data-original=" USD $4590" data-price="4590" title="Original price:4590">USD $<strong>4,590</strong></span></td><td class="single-add"><span class="amount" data-currency="USD" data-original=" USD $1090" data-price="1090" title="Original price:1090">USD $<strong>1,090</strong></span></td><td class="book-now-wrapper"><button data-toggle="modal" data-target="#tour-request-modal" data-title="Botswana Value Flying Safari" class="btn btn-default dates-prices-book-now">Book Now</button></td></tr><tr><td class="start-date" data-gform-date="12/01/2022">01 Dec 2022</td><td class="end-date" data-gform-date="03/31/2023">31 Mar 2023</td><td class="price-sharing"><span class="amount" data-currency="USD" data-original=" USD $3545" data-price="3545" title="Original price:3545">USD $<strong>3,545</strong></span></td><td class="single-add"><span class="amount" data-currency="USD" data-original=" USD $775" data-price="775" title="Original price:775">USD $<strong>775</strong></span></td><td class="book-now-wrapper"><button data-toggle="modal" data-target="#tour-request-modal" data-title="Botswana Value Flying Safari" class="btn btn-default dates-prices-book-now">Book Now</button></td></tr>				</tbody><tbody>
																						</tbody></table>
																			<?php lsx_to_included_block(); ?>

																		</div></div></div></div>
</div>


																	<?php lsx_entry_bottom(); ?>

																</article>

																<?php
																lsx_entry_after(); ?>

																<?php endwhile; ?>

															<?php endif; ?>
															<?php	wp_reset_query(); ?>
													</div>
												</div>



												<div class="tours-nav">
													<div class="col-md-4">
														<button class="btn lsx-btn">Book It!</button>
														</div>
														<div class="col-md-4">
															<button class="btn lsx-btn">Find out more</button>
															</div>
															<div class="col-md-4">
																<button class="btn lsx-btn">Share with a Friend</button>
																</div>
												</div>

</div></div></div>
			<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php //get_sidebar(); ?>
<?php //get_sidebar( 'alt' ); ?>
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

<?php
get_footer();
