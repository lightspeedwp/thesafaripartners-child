<?php $term = get_queried_object(); ?><?php $terms = get_terms( 'who' ); ?>
<?php
$size = 'full'; // (thumbnail, medium, large, full or custom size)
					$image_id = get_field('banner', $term, false); 

					$image = wp_get_attachment_image_src($image_id,$size);

		?>
<div class="wp-block-cover alignfull is-light is-style-lsx-cover-style" style="padding-top:25px;padding-right:25px;padding-bottom:25px;padding-left:25px;min-height:650px"><span aria-hidden="true" class="has-black-background-color has-background-dim-10 wp-block-cover__gradient-background has-background-dim"></span><img class="wp-block-cover__image-background wp-image-134438" alt="" src="<?php echo $image[0]; ?>" style="object-position:50% 69%" data-object-fit="cover" data-object-position="50% 69%"/><div class="wp-block-cover__inner-container">
<h1 class="has-text-align-center has-white-color has-text-color"><strong><?php echo $term->name; ?></strong></h1>
<?php echo do_shortcode( '[banner_navigation extra-top="500"]' );  ?>

</div></div>