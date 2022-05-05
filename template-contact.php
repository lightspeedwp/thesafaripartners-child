<?php
/**
 * Template Name: Con
 *
 * @package lsx
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">

	<?php lsx_content_before(); ?>

	<main id="main" class="site-main" role="main">

		<?php lsx_content_top(); ?>



			<?php
$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );

foreach( $mypages as $page ) {
    $content = $page->post_content;
    if ( ! $content ) // Check for empty page
        continue;

    $content = apply_filters( 'the_content', $content );
?>
<div class="tab">
<button class="tablinks" onclick="openCity(event, '<?php echo $page->post_title; ?>')"><?php echo $page->post_title; ?></button>
</div>

    <div class="entry">
			<div id="<?php echo $page->post_title; ?>" class="tabcontent">
			  <h3><?php echo $page->post_title; ?></h3>
			  <?php echo $content; ?>
			</div>
			</div>
<?php
    }
?>

				<?php get_template_part( 'partials/content', 'page' ); ?>


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
<script>
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
</script>
<?php
get_footer();
