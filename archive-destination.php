<?php
/**
 * Destination Archive
 *
 * @package  tour-operator
 * @category destination
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

			<?php
$loop = new WP_Query( array( 'post_type' => 'destination', 'posts_per_page' => 10 ) );

while ( $loop->have_posts() ) : $loop->the_post();
the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' ); 
?>

    <div class="entry-content">
			<article <?php post_class(); ?>>
				<div class="col-md-6">
					<h3 class="lsx-to-widget-title text-left">
						<?php
			            if ( ! empty( $title_link ) ) {
			?>
			<a href="<?php echo esc_url( $title_link ); ?>"><?php } ?>
							<?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>
						<?php
			            if ( ! empty( $title_link ) ) {
			?>
			</a><?php } ?>
			</h3>
				</div>

				<?php if ( empty( $disable_placeholder ) ) { ?>
					<div class="col-md-6">
						<h4 class="lsx-to-widget-title text-left">

				<a href="<?php echo esc_url( $title_link ); ?>"><?php } ?>
								<?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>

				</a>
			</h4>
					</div>
					<div class="lsx-to-widget-thumb">

			<a href="<?php echo esc_url( $permalink ); ?>"><?php } ?>
							<?php lsx_thumbnail( 'lsx-thumbnail-wide' ); ?>

			</a>
					</div>


				<div class="lsx-to-widget-content">
					<h4 class="lsx-to-widget-title text-center">

			<a href="<?php echo esc_url( $permalink ); ?>"><?php } ?>
							<?php the_title(); ?>

			</a>
					</h4>

					<?php
						// if ( empty( $disable_text ) ) {
						// 	lsx_to_tagline( '<p class="lsx-to-widget-tagline text-center">', '</p>' );
						// }
					?>


							<p class="moretag-wrapper"><a href="<?php echo esc_url( $permalink ); ?>" class="moretag"><?php esc_html_e( 'View more', 'tour-operator' ); ?></a></p>
							<?php
						}
					?>
				</div>
			</article>
    </div>

<?php endwhile; ?>

			<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php //get_sidebar(); ?>

<?php
get_footer();
