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

				<?php
				$contact_id = get_page_by_title( 'Contact' );
				if ( null !== $contact_id ) {
					?>
					<div class="tab">
						<?php
							$mypages = get_pages( array( 'child_of' => $contact_id->ID, 'sort_column' => 'post_date', 'sort_order' => 'ASC' ) );
							$counter = 0;

							foreach( $mypages as $page ) {
								$content = $page->post_content;
								if ( ! $content ) // Check for empty page
								continue;
								$content = apply_filters( 'the_content', $content );
								
								$active = '';
								if ( ( $page->ID === get_the_ID() && $contact_id->ID !== get_the_ID() ) ||
								( $contact_id->ID === get_the_ID() && 0 === $counter ) ) {
									$active = 'active';
								}
								?>
								<a class="tablinks <?php echo esc_attr( $active  ); ?>" id="page-<?php echo $page->ID; ?>" href="<?php echo get_permalink( $page->ID ); ?>"><?php echo $page->post_title; ?></a>
								<?php
								$counter++;
							}
							wp_reset_query();
						?>
					</div>
					<?php
					foreach( $mypages as $page ) {
						$content = $page->post_content;
						if ( ! $content ) // Check for empty page
						continue;

						$content = apply_filters( 'the_content', $content );
						$active = '';
						if ( ( $page->ID === get_the_ID() && $contact_id->ID !== get_the_ID() ) ||
						( $contact_id->ID === get_the_ID() && 0 === $counter ) ) {
							$active = 'active';
						}
						?>

						<div id="<?php echo $page->post_title; ?>" class="contact-<?php echo $page->ID; ?> tabcontent <?php echo esc_attr( $active  ); ?>">
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
						<?php
					}
				}
				?>
				<?php lsx_content_bottom(); ?>
			</div>
		</div>
	</main><!-- #main -->

	<?php lsx_content_after(); ?>

	<?php get_sidebar(); ?>


</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>
<?php
get_footer('new');
