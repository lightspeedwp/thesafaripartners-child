<?php
/**
 * Template Name: Contact
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
$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );

foreach( $mypages as $page ) {
    $content = $page->post_content;
    if ( ! $content ) // Check for empty page
        continue;

    $content = apply_filters( 'the_content', $content );
?>
    <h2><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a></h2>
    <div class="entry"><?php echo $content; ?></div>
<?php
    }
?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

			<?php endwhile; ?>

		<?php endif; ?>

		<?php lsx_content_bottom(); ?>

	</main><!-- #main -->

	<?php lsx_content_after(); ?>

	<?php
	if ( comments_open() ) {
		comments_template();
	}
	?>

	<?php get_sidebar(); ?>

	<?php if ( is_active_sidebar( 'why-us' ) ) : ?>
	<div class="home-widget" role="complementary">
		<?php dynamic_sidebar( 'why-us' ); ?>
	</div><!-- #primary-sidebar -->
	<?php endif; ?>

</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php
get_footer();
