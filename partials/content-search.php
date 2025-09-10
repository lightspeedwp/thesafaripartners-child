<?php
/**
 * Template used to display post content.
 *
 * @package lsx
 */

?>

<?php lsx_entry_before(); ?>

<?php
global $post;
setup_postdata( $post );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'search-result' ); ?>>
	<div class="search-result-content">
        <div class="search-result-thumb" href="<?php the_permalink(); ?>">
            <?php lsx_thumbnail( 'lsx-block-post-grid-landscape' ); ?>
        </div>

        <h4 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h4>
        <div class="tsp-related-tour-meta">
            <?php
            $meta_class = 'tsp-meta tsp-meta-data-';

            lsx_to_duration('<div class="tsp-meta tsp-duration"><i class="tsp-icon tsp-icon-clock"></i><span><span class="' . $meta_class . '"></span><span> ',  esc_html__(' Days', 'tour-operator') . '</span></span></div>');
            echo '<div class="tsp-meta tsp-countries">';
            lsx_to_connected_countries('<i class="tsp-icon tsp-icon-africa"></i><span><span class="' . $meta_class . '"></span><span> ', '</span></span>');
            echo '</div>';
            the_terms( get_the_ID(), 'travel-style', '<div class="' . $meta_class . 'style"><i class="tsp-icon tsp-icon-location"></i><span> ', ', ', '</span></div>' );
            ?>
        </div>

        <div class="search-tour-excerpt"><?php
            the_excerpt();
            ?>
        </div>

        <a href="<?php echo esc_url( $permalink ); ?>" class="tsp-tour-button"><?php esc_html_e( 'VIEW TRIP', 'tour-operator' ); ?></a>

		<span class="tax-title"><?php $terms = get_the_terms( $post->ID, 'tour-type' );
		foreach ( $terms as $term ) {
			if ( in_array( $term->name, array( 'Mobile-train', 'Mobile-boat' ) ) ) { continue; }
			echo $term->name;
		}
        ?></span>
	</div>
</article>

<?php
lsx_entry_after();
