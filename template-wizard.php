<?php
/**
 * Template Name: Wizard
 *
 * @package lsx
 */
get_header();

//<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
?>

<?php lsx_content_wrap_before(); ?>

<div id="primary" class="<?php echo esc_attr( lsx_main_class() ); ?>">

	<?php lsx_content_before(); ?>

	<main id="main" class="site-main" role="main">

		<?php lsx_content_top(); ?>

		<div class="row">
			<div class="outer-container">
				<form id="wizard" class="lsx-wizard insipre-wizard-form" action="<?php echo home_url('/'); ?>" method="GET" style="display: none;">
					<input type="hidden" name="s" value="" />
					<div class="lsx-wizard-step">
						<div class="step-content introslide">
							<?php if ( have_posts() ) : ?>
								<?php
								while ( have_posts() ) :
									the_post();
									?>

									<?php get_template_part( 'partials/content', 'page' ); ?>

								<?php endwhile; ?>

							<?php endif; ?>
							<?php wp_reset_query(); ?>
						</div>
					</div>

					<?php get_template_part( 'partials/wizard-step', '1' ); ?>

					<?php get_template_part( 'partials/wizard-step', '2' ); ?>

					<?php get_template_part( 'partials/wizard-step', '3' ); ?>

					<?php get_template_part( 'partials/wizard-step', '4' ); ?>

					<?php get_template_part( 'partials/wizard-step', '5' ); ?>

					<?php tsp_init_wizard(); ?>
				</form>
			</div>

		<?php lsx_content_bottom(); ?>

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

<?php
get_footer('new');
