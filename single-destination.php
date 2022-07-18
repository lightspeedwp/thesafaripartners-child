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


			

		<?php get_template_part( 'partials/shaman-intro', '1' ); ?>

<?php 
	if ( have_posts() ) {

		$panels = array(
			0 => array( 'who' ),
			1 => array( 'what' ),
			2 => array( 'when' ),
			3 => array( 'budget' ),
		);
		tsp_mini_wizard( $panels );

		?>
		<div class="facetwp-hidden-filters hidden">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'filter-menu',
					)
				);
			?>
		</div>

		
		<?php lsx_content_bottom(); ?>
		
		
			<section id="wizard-template" class="lsx-to-section-new">
				<div class="row">
				<?php	$id=134126;
$post = get_post($id);
$content = apply_filters('the_content', $post->post_content);
echo $content; ?>
			</section>
</main><!-- #main -->

		<?php
	} else {
		get_template_part( 'partials/content', 'none' );
	}
	?>
</main><!-- #main -->

<?php lsx_content_after(); ?>

</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php // get_sidebar(); ?>

<?php
get_footer();