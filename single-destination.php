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
					
                <div class="content-area col-sm-12 col-sm-12">
                    <?php lsx_to_content( 'content', 'destination' ); ?>
                </div>

		        <?php tsp_destination_tour_search(); ?>

			<?php endwhile; ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php
get_footer();