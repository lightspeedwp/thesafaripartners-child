<?php
/**
 * LSX Starter Child functions
 *
 * @package thesafaripartners-child
 */


function tsp_init_wizard() {
	wp_enqueue_script( 'thesafaripartners-child-wizard-bootstrap', get_stylesheet_directory_uri() . '/assets/js/wizard.js', array( 'jquery' ), TSP_CHILD_VER, true );
	wp_enqueue_script( 'thesafaripartners-child-wizard', get_stylesheet_directory_uri() . '/assets/js/wizard.js', array( 'jquery', 'thesafaripartners-child-wizard-bootstrap' ), TSP_CHILD_VER, true );
}


function tsp_mini_wizard( $panels = array() ) {
	if ( empty( $panels ) ) {
		return;
	}
	
	?>
	<form id="wizard" class="lsx-wizard insipre-wizard-form" action="<?php echo home_url('/'); ?>" method="GET" style="display: none;">
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
	<?php
}