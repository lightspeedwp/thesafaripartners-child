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
			<div class="col-xs-12 col-sm-12 col-md-6">
				<h2>The Shaman Says...</h2>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
			<p> <?php /*  Search Count */ $allsearch = &new  WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1);  $count = $allsearch->post_count; _e(''); _e('<span  class="search-terms">'); echo $key; _e('</span>'); _e(' —  '); echo $count . ' '; _e('articles'); wp_reset_query(); ?> trips found</p>
			</div>

			<div class="post-wrapper <?php echo esc_attr( lsx_post_wrapper_class() ); ?>">
				<?php
				while ( have_posts() ) :
					the_post();
					lsx_get_template_part();
				endwhile;
				?>
			</div>

			<?php lsx_paging_nav(); ?>

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
