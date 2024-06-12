<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @package lsx
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Please try again', 'lsx' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php echo __( 'Ready to publish your first post?', 'lsx' ); ?> <a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>"><?php esc_html_e( 'Get started here', 'lsx' ); ?></a></p>

		<?php elseif ( is_search() ) : ?>

			<p>
				<?php 
					$african_link = home_url() . '/contact/african-safari-planner/';
					echo __( sprintf( 'We\'re sorry, but we couldn\'t find any matches for your search. Please try different keywords<br /> or explore more in-depth tour planning by contacting us via the <a style="font-weight:bold;" href="%s">African Safari Planner</a>.', $african_link ), 'lsx' );
				?>
			</p>

			<form role="search" method="get" class="search-form form-inline" id="searchform" action="<?php echo home_url(); ?>">
				<div class="input-group">
					<input type="hidden" name="s" class="" placeholder="" />
					<input type="text" value="<?php echo $keyword; ?>" name="fwp_search" class="search-field form-control" placeholder="Search The Safari Partners" />
					<label for="fwp_search" class="hide">Search for:</label>

					<span class="input-group-btn">
						<button type="submit" class="search-submit btn btn-default"><span class="fa fa-search"></span></button>
					</span>
				</div>
			</form>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lsx' ); ?></p>
			<?php echo wp_kses_post( apply_filters( 'lsx_404_search_form', get_search_form() ) ); ?>

		<?php endif; ?>

	</div><!-- .page-content -->
</section><!-- .no-results -->
