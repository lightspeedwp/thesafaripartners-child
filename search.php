<?php
/**
 * The main template file.
 *
 * @package lsx
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">

	<?php lsx_content_before(); ?>

	<main id="main" class="site-main" role="main">

		<?php lsx_content_top(); ?>

		<?php if ( have_posts() ) : ?>

			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'filter-menu',
					)
				);
			?>
			<div class="search-header col-md-12">
			
				<p>Click above to change your answers and show different results</p>
				
				<div class="col-md-6">
					<h3>The Shaman Says...</h3>
				</div>
				<div class="col-md-6">
					<div class="right-align"><?php echo do_shortcode( '[facetwp facet="results_count"]' ); ?> </div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="post-wrapper facetwp-template col-md-12 <?php echo esc_attr( lsx_post_wrapper_class() ); ?>">
				<?php
				while ( have_posts() ) :
					the_post();
					lsx_get_template_part();
				endwhile;
				?>
			</div>

			<div class="lsx-pagination">
				<?php echo do_shortcode( '[facetwp facet="load_more"]' ); ?>
			</div>

		<?php else : ?>

			<?php get_template_part( 'partials/content', 'none' ); ?>

		<?php endif; ?>

		<?php lsx_content_bottom(); ?>

	</main><!-- #main -->

	<?php lsx_content_after(); ?>

</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php get_sidebar( 'sidebar' ); ?>

<?php
get_footer();
