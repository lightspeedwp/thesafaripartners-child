<?php
/**
 * Destination Single Template
 *
 * @package     tour-operator
 * @category    destination
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

			<?php
			while ( have_posts() ) :
				the_post();
				?>

				<section id="summary" class="lsx-to-section-new <?php lsx_to_collapsible_class( 'destination', false ); ?>">
					<h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title hidden-lg" <?php lsx_to_collapsible_attributes_not_post( 'collapse-summary' ); ?>><?php esc_html_e( 'Summary', 'tour-operator' ); ?></h2>

					<div id="collapse-summary" class="collapse in">
						<div class="collapse-inner">
							<div class="row">
								<?php lsx_to_content( 'content', 'destination' ); ?>
							</div>
						</div>
					</div>
				</section>


			<?php endwhile; ?>

		<section id="who-single" class="lsx-to-section-new">
			<div class="row">
			<div class="wp-block-tour-operator-block-taxonomy who-slide who-image-display">
				<h2 class="lsx-title left">Tell us what type of traveler are you?</h2>
						<?php
						$terms = get_terms('who');
						$post_tags = wp_get_post_terms($post->ID,'who',array('fields' => 'slugs'));
				?>
			<?php foreach( $terms as $term ): ?>
								<!-- post -->

						<div class="lsx-to-widget-item-wrap lsx-who col-xs-12 col-sm-2 term-<?php echo esc_attr( $term->term_id ); ?> <?php echo esc_attr( $taxonomy ); ?> type-<?php echo esc_attr( $taxonomy ); ?> status-publish hentry">
									<div class="checkbox-wrapper">
										<input type="checkbox" />
										<span aria-hidden="true"></span>
									</div>

						<?php lsx_to_content( 'content-widget', 'who' ); ?>
					</div>
			<?php endforeach; ?>

					<?php	wp_reset_query(); ?>
					</div></div>
			</section>

			<?php lsx_content_bottom(); ?>

			<div class="row travel-style-destinations">
						<div class="wp-block-tour-operator-block-post-types tours-posts lsx-to-archive-template-<?php echo esc_attr( tour_operator()->archive_layout ); ?> lsx-to-archive-template-image-<?php echo esc_attr( tour_operator()->archive_list_layout_image_style ); ?>">
							<div class="slider-container lsx-to-widget-items lsx-to-archive-template-grid">
								<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>" class="lsx-to-slider">
									<div class="lsx-to-slider-wrap">
										<div class="lsx-to-slider-inner" data-slick='{ "slidesToShow": 2, "slidesToScroll": 2 }'>

						<?php
				    $terms = get_terms('travel-style');
				    $post_tags = wp_get_post_terms($post->ID,'travel-style',array('fields' => 'slugs'));
				?>
			<?php foreach( $terms as $term ): ?>
						    <!-- post -->

						<article class="term-<?php echo esc_attr( $term->term_id ); ?> <?php echo esc_attr( $taxonomy ); ?> type-<?php echo esc_attr( $taxonomy ); ?> status-publish hentry">
									<div class="checkbox-wrapper">
	    							<input type="checkbox" />
    								<span aria-hidden="true"></span>
									</div>

								<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) : ?>
									<div class="lsx-to-widget-thumb">
										<?php
										if ( ! empty( $title_link ) ) {
											?>
						<a href="<?php echo esc_url( $title_link ); ?>"><?php } ?>
											<?php lsx_to_term_thumbnail( $term->term_id, 'lsx-thumbnail-wide' ); ?>

										<?php
										if ( ! empty( $title_link ) ) {
											?>
						</a><?php } ?>
									</div>
								<?php else : ?>
									<div class="lsx-to-widget-thumb">
										<?php
										if ( ! empty( $title_link ) ) {
											?>
						<a href="<?php echo esc_url( $title_link ); ?>"><?php } ?>
											<img alt="Placeholder" class="attachment-responsive wp-post-image lsx-responsive" src="<?php echo esc_url( lsx\legacy\Placeholders::placeholder_url( null, null, array( 750, 350 ) ) ); ?>">
										<?php
										if ( ! empty( $title_link ) ) {
											?>
						</a><?php } ?>
									</div>
								<?php endif; ?>


							<div class="lsx-to-widget-content bottom">
								<h4 class="lsx-to-widget-title text-left">

						<a href="<?php echo esc_url( $title_link ); ?>">
										<?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>

						</a>
						</h4>

							</div>
						</article>
			<?php endforeach; ?>

					<?php	wp_reset_query(); ?>
				</div>
				</div>
			</div>
			</div>
			</div>
			</div>

							<section id="wizard-template" class="lsx-to-section-new">
								<div class="row">
									<div class="wizard-text col-md-6 col-sm-12">

										<div class="header-headings vertical-center center" ><div class="lsx-banner-logo"></div><header class="page-header"><h2 class="lsx-banner-name" style="color:#32373c;font-size:26px">Let us inspire you!</h2></header><p class="lsx-banner-title" style="color:#32373c;font-size:calc(26px /1.5)">We would like to get to know you better. </p>
										<div style="text-align:center" class="lsx-block-button lsx-block-banner-button">
											<a target="_self" class="lsx-button lsx-button-shape-square lsx-button-size-medium lsx-button-flat lsx-button-border-btn" style="color: rgb(0, 0, 0); background-color: rgb(255, 255, 255); box-shadow: rgb(39, 99, 158) 2px 2px 0px 0px; border-color: rgb(255, 255, 255);" data-onhover="#797979" data-offhover="#ffffff" onmouseenter="this.style.backgroundColor=this.getAttribute('data-onhover');" onmouseleave="this.style.backgroundColor=this.getAttribute('data-offhover');" rel="noopener noreferrer">GET STARTED</a>
										</div></div>
									</div>
									<div class="wizard-cover col-md-6 col-sm-12">
										<div style="color:#32373c;background-color:#ffffff" class="wp-block-lsx-blocks-lsx-banner-box lsx-has-image center title-centered lsx-has-image lsx-font-size-40 lsx-block-banner lsx-banner-columns alignfull lsx-container-initial"><div class="lsx-banner-column" style="background-color:#ffffff">
											<div class="lsx-banner-image-wrap"><picture>
											<source data-srcset="https://thesafaripartners-upgraded.lightspeedwp.dev/wp-content/uploads/2022/04/Screen-Shot-2022-04-21-at-2.03.44-PM.png?crop=1.00xw:0.887xh;0,0.108xh&amp;resize=2048:*" media="(min-width: 100rem)" srcset="https://thesafaripartners-upgraded.lightspeedwp.dev/wp-content/uploads/2022/04/Screen-Shot-2022-04-21-at-2.03.44-PM.png?crop=1.00xw:0.887xh;0,0.108xh&amp;resize=2048:*"><source data-srcset="https://thesafaripartners-upgraded.lightspeedwp.dev/wp-content/uploads/2022/04/Screen-Shot-2022-04-21-at-2.03.44-PM.png?crop=1.00xw:0.887xh;0,0.108xh&amp;resize=1200:*" media="(min-width: 61.25rem)" srcset="https://thesafaripartners-upgraded.lightspeedwp.dev/wp-content/uploads/2022/04/Screen-Shot-2022-04-21-at-2.03.44-PM.png?crop=1.00xw:0.887xh;0,0.108xh&amp;resize=1200:*">
												<source data-srcset="https://thesafaripartners-upgraded.lightspeedwp.dev/wp-content/uploads/2022/04/Screen-Shot-2022-04-21-at-2.03.44-PM.png?crop=0.851xw:1.00xh;0.0753xw,0&amp;resize=768:*" media="(max-width: 400px)" srcset="https://thesafaripartners-upgraded.lightspeedwp.dev/wp-content/uploads/2022/04/Screen-Shot-2022-04-21-at-2.03.44-PM.png?crop=0.851xw:1.00xh;0.0753xw,0&amp;resize=768:*"><img id="bg-image" data-src="https://thesafaripartners-upgraded.lightspeedwp.dev/wp-content/uploads/2022/04/Screen-Shot-2022-04-21-at-2.03.44-PM.png?crop=0.851xw:1.00xh;0.0753xw,0&amp;resize=640:*" src="https://thesafaripartners-upgraded.lightspeedwp.dev/wp-content/uploads/2022/04/Screen-Shot-2022-04-21-at-2.03.44-PM.png"></picture></div></div><div class="lsx-banner-content-wrap"><div class="header-headings center" style="background-color:rgba(255, 255, 255, 0)"><div class="lsx-banner-logo">
												</div><header class="page-header"><h2 class="lsx-banner-name" style="color:#32373c;font-size:40px"></h2></header><p class="lsx-banner-title" style="color:#32373c;font-size:calc(40px /1.5)">Use the Inspiration Wizar to build your Dream Holiday</p>
												<div style="text-align:center" class="lsx-block-button lsx-block-banner-button"></div>
											</div></div></div>
									</div>
								</div>
							</section>
		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php // get_sidebar(); ?>
<?php // get_sidebar( 'alt' ); ?>
<?php
get_footer();
