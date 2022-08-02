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

						<?php

							$banner_image = get_field('banner_image');
							$size = 'medium'; // (thumbnail, medium, large, full or custom size)

							if( $banner_image) {
								echo wp_get_attachment_image( $banner_image, $size );
							} else { ?>
								<img
									src="<?php echo home_url(); ?>/wp-content/uploads/2022/06/control-panel-banner-474x474.png"
									style="max-width: 300px; margin-right:90px;"
									alt="" class="wp-image-14890"
									decoding="async"
									sizes="389px"
									srcset="<?php echo home_url(); ?>/wp-content/uploads/2022/06/control-panel-banner-474x474.png 600w,
									<?php echo home_url(); ?>/wp-content/uploads/2022/06/control-panel-banner-474x474.png 300w,
									<?php echo home_url(); ?>/wp-content/uploads/2022/06/control-panel-banner-474x474.png 150w"
								><?php
							}
							?>

							
							<picture>
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
