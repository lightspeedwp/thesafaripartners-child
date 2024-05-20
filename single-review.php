<?php
/**
 * Review Single Template
 *
 * @package 	tour-operator
 * @category	review
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<div class="entry-content">
			<!-- wp:cover {"dimRatio":100,"customOverlayColor":"#f7f3f1","isUserOverlayColor":true,"minHeight":317,"minHeightUnit":"px","isDark":false,"style":{"elements":{"link":{"color":{"text":"var:preset|color|primary-color"}}}},"textColor":"primary-color","layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull is-light has-primary-color-color has-text-color has-link-color" style="min-height:317px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim" style="background-color:#f7f3f1"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size"><?php the_title(); ?></p>
<!-- /wp:paragraph -->


<!-- wp:image {"id":253283,"sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full"><img src="https://thesafaripartners.lightspeedwp.dev/wp-content/uploads/2024/03/image-3.png" alt="" class="wp-image-253283"/></figure>
<!-- /wp:image -->

<!-- wp:image {"id":253275,"sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full"><img src="https://thesafaripartners.lightspeedwp.dev/wp-content/uploads/2024/03/Frame-8.svg" alt="" class="wp-image-253275"/></figure>
<!-- /wp:image --></div></div>
<!-- /wp:cover -->
</div>

	<div id="primary" class="content-area col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

		

		
							<div class="row">
							<?php
/**
 * Review Content Part
 *
 * @package  tour-operator
 * @category review
 */

global $lsx_to_archive, $post;

if ( 1 !== $lsx_to_archive ) {
	$lsx_to_archive = false;
}
?>

<?php lsx_entry_before(); ?>

<article id="review-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>


<blockquote class="lsx-to-widget-blockquote">
		<?php
						$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

						lsx_to_review_rating( '<span class="' . $meta_class . 'rating"> </span>' );
?>
		<p class="lsx-review">
<?php the_content(); ?></p>
	<?php $reviewer_name = get_post_meta( get_the_ID(), 'reviewer_name', true ); ?>
				<p class="lsx-review-author"><?php echo esc_html( $reviewer_name ); ?></p>


				<span class="tours-link"><a href="https://thesafaripartners.lightspeedwp.dev/independent-reviews/">View All Reviews</a></span>
		</blockquote>


	<?php lsx_entry_bottom(); ?>

</article>

<?php lsx_entry_after();?>
<div class="wp-block-tour-operator-block-post-types toptours-posts">
                            <h2 class="lsx-title"><small></small></h2>
                            <div class="lsx-testimonial-body">
                            <?php  echo do_shortcode( '[lsx_to_post_type_widget post_type="tour" columns="4" limit="20" disable_placeholder="0" disable_text="0" order="ASC" orderby="none" carousel="1" include=""]' )?>
                            </div>
                        
                        
                          


                </div>

							</div>
						
				

			<?php endwhile; ?>

			<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php //get_sidebar(); ?>
<?php //get_sidebar( 'alt' ); ?>

<?php get_footer();
