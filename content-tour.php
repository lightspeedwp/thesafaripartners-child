<?php
/**
 * Tour Content Part
 *
 * @package  tour-operator
 * @category tour
 */

global $lsx_to_archive, $post;

if ( 1 !== $lsx_to_archive ) {
	$lsx_to_archive = false;
}
?>

<?php lsx_entry_before(); ?>

<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container filterDiv' ); ?>>
	<?php lsx_entry_top(); ?>

	<?php if ( is_single() && false === $lsx_to_archive ) { ?>
        <h1 class="lsx-to-summary-title"><?php the_title(); ?></h1>
        <div class="tsp-tour-overview">
            <div class="tsp-tour-content">

                <?php lsx_to_price( '<p class="lsx-to-meta-data lsx-to-meta-data-big lsx-to-meta-data-price"><span class="lsx-to-meta-data-key">' . esc_html__( 'From price', 'tour-operator' ) . ':</span> ', '</p>' ); ?>
                <?php the_content(); ?>
            </div>
            <div class="tsp-tour-fast-facts">
                <?php tsp_tour_fast_facts(); ?>
                <?php tsp_best_time_to_visit( '<h3 class="tsp-title">' . esc_html__( 'Best Months For Travel', 'tour-operator' ) . '</h3>' ); ?>

                <a class="tsp-button text-center popup-inquire" href="#">Request more information <i class="icon-see-more"></i></a>
            </div>
        </div>
	<?php } elseif ( is_search() || empty( tour_operator()->options[ get_post_type() ]['disable_entry_text'] ) ) { ?>

		<div <?php lsx_to_entry_class( 'entry-content' ); ?>>
		<?php
			lsx_to_entry_content_top();
			the_excerpt();
			lsx_to_entry_content_bottom();
		?>
		</div>

	<?php } ?>


</article>

<?php
lsx_entry_after();
