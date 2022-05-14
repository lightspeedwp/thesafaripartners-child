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

		<div class="entry">
			<div class="lsx-container-content">

	<div class="tab">
				<?php
				$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'ASC' ) );

					foreach( $mypages as $page ) {
    			$content = $page->post_content;
    			if ( ! $content ) // Check for empty page
        	continue;
    			$content = apply_filters( 'the_content', $content );?>

							<button class="tablinks" id="<?php echo $post->ID; ?>" onclick="openCity(event, '<?php echo $page->post_title; ?>')"><?php echo $page->post_title; ?></button>
								<?php } ?>
								<?php	wp_reset_query(); ?>
		</div>
		<?php
			$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'ASC' ) );

				foreach( $mypages as $page ) {
					$content = $page->post_content;
					if ( ! $content ) // Check for empty page
					continue;

					$content = apply_filters( 'the_content', $content );?>

			<div id="<?php echo $page->post_title; ?>" class="tabcontent">
				<div class="col-md-6 lsx-contact-module">
			  <?php echo $content; ?>

			</div>
			<div class="col-md-6 lsx-contact-module-image">
				<?php echo get_the_post_thumbnail($page->ID,'full'); ?>
			</div>

		</div>


			<?php } ?>
	</div></div>

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
<script>
// Get the element with id="defaultOpen" and click on it
document.getElementById("1454").click();
</script>
<?php
get_footer();
