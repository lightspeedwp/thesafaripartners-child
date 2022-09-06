<?php
/**
 * Tour Single Template
 *
 * @package     tour-operator
 * @category    tour
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area wizard-landing <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

		
						<div class="col-md-12 outer-container">
							<div class="tab">
								<button class="tablinks tours-wizard" id="tours-wizard" onclick="openCity(event, 'Overview')">Overview</button>
								<button class="tablinks" id="page-1" onclick="openCity(event, 'Day')">Day by Day</button>
								<button class="tablinks" id="page-3" onclick="openCity(event, 'Accommodation')">Accommodation</button>
								<button class="tablinks" id="page-4" onclick="openCity(event, 'Price')">Dates & Prices</button>
								<button class="tablinks" id="page-5" onclick="openCity(event, 'Maps')">Maps & More</button>
							</div>
						</div>

						<?php get_template_part( 'partials/tour-wizard', 'overview' ); ?>

						<?php get_template_part( 'partials/tour-wizard', 'day' ); ?>

						<?php get_template_part( 'partials/tour-wizard', 'accommodation' ); ?>

						<?php get_template_part( 'partials/tour-wizard', 'price' ); ?>

						<?php get_template_part( 'partials/tour-wizard', 'maps' ); ?>
										

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_footer('new');
