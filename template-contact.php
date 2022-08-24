<?php
/**
 * Template Name: Con
 *
 * @package lsx
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

<div id="primary" class="content-area wizard-landing <?php echo esc_attr( lsx_main_class() ); ?>">

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

							<button class="tablinks" id="page-<?php echo $page->ID; ?>" onclick="openCity(event, '<?php echo $page->post_title; ?>')"><?php echo $page->post_title; ?></button>
								<?php } ?>
								<?php	wp_reset_query(); ?>
							</div>

							<div class="dropdown">
  								<button class="dropbtn">Contact Menu</button>
  									<div class="dropdown-content">
									  <?php
					$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'ASC' ) );

						foreach( $mypages as $page ) {
    				$content = $page->post_content;
    				if ( ! $content ) // Check for empty page
        		continue;
    				$content = apply_filters( 'the_content', $content );?>
									  <a class="dropdownlinks" id="page-<?php echo $page->ID; ?>" onclick="openCity(event, '<?php echo $page->post_title; ?>')"><?php echo $page->post_title; ?></a>
									  <?php } ?>
								<?php	wp_reset_query(); ?>
  									</div>
							</div>

							<?php
							$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'ASC' ) );

								foreach( $mypages as $page ) {
									$content = $page->post_content;
									if ( ! $content ) // Check for empty page
									continue;

									$content = apply_filters( 'the_content', $content );?>

							<div id="<?php echo $page->post_title; ?>" class="contact-<?php echo $page->ID; ?> tabcontent">
								<div class="col-md-6">
									<div class="lsx-contact-module">
			  					<?php echo $content; ?>
								</div>
							</div>

				<div class="col-md-6 lsx-contact-module-image">
					<div class="lsx-banner-image-wrap">
						<picture>
						<?php echo get_the_post_thumbnail($page->ID,'large'); ?>
						<?php if ( get_the_post_thumbnail( get_the_ID() ) ) { 
                    the_post_thumbnail('large'); }
                else {
                    echo 
                    '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10414.115504121639!2d-123.1041657!3d49.266375!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd5702308706ebfe9!2sThe%20Safari%20Partners!5e0!3m2!1sen!2sza!4v1659440538085!5m2!1sen!2sza" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" ></iframe>'
                ; } ?>

							
</picture>
							</div>
						</div>

				</div>


			<?php } ?>


		<?php lsx_content_bottom(); ?>

	</div>
	</div>

	</main><!-- #main -->

	<?php lsx_content_after(); ?>

	<?php get_sidebar(); ?>


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
// Get the element with id="defaultOpen" and click on it
document.getElementById("page-133993").click();
</script>
<?php
get_footer('new');
