<?php
/**
 * Travel Style Widget Content Part
 *
 * @package     tour-operator
 * @category    travel-style
 * @subpackage  widget
 */

global $term, $taxonomy, $disable_placeholder, $disable_text, $disable_single_link;

if ( empty( $disable_single_link ) ) {
	$title_link = esc_url( get_term_link( $term, $taxonomy ) );
} else {
	$title_link = '';
}
?>

<div class="row">
			<div class="wp-block-tour-operator-block-post-types who-posts lsx-to-archive-template-image-<?php echo esc_attr( tour_operator()->archive_list_layout_image_style ); ?>">
				<div class="slider-container lsx-to-widget-items lsx-to-archive-template-grid">
					<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>" class="lsx-to-slider">
						<div class="lsx-to-slider-wrap">
							<div class="lsx-to-slider-inner" data-slick='{ "slidesToShow": 4, "slidesToScroll": 4 }'>

								<div class="lsx-to-widget-item-wrap lsx-travel-style slick-slide" ><article class="term-11095 travel-style type-travel-style status-publish hentry">
												<div class="lsx-to-widget-thumb">
										<a href="/who/romance-seekers/" tabindex="0">
											<img alt="thumbnail" class="attachment-responsive wp-post-image lsx-responsive" src="/wp-content/uploads/2022/07/romance-seekers-traveller-type-1024x576.jpg">
										</a>			</div>

							<div class="lsx-to-widget-content bottom">
								<h4 class="lsx-to-widget-title text-left">
									<a href="/who/romance-seekers/" tabindex="0">				Romance Seekers		</a></h4>

									</div>
						</article>
						</div>


						<div class="lsx-to-widget-item-wrap lsx-travel-style slick-slide" ><article class="term-11095 travel-style type-travel-style status-publish hentry">
										<div class="lsx-to-widget-thumb">
										<a href="/who/seasoned-travellers/" tabindex="0">
									<img alt="thumbnail" class="attachment-responsive wp-post-image lsx-responsive" src="/wp-content/uploads/2022/09/seasonded-travelers-new-e1664179916771.png">
									</a></div>

					<div class="lsx-to-widget-content bottom">
						<h4 class="lsx-to-widget-title text-left">
							<a href="/who/seasoned-travellers/" tabindex="0">	Seasoned Travellers		</a></h4>

							</div>
				</article>
				</div>

				<div class="lsx-to-widget-item-wrap lsx-travel-style slick-slide" ><article class="term-11095 travel-style type-travel-style status-publish hentry">
								<div class="lsx-to-widget-thumb">
								<a href="/who/family-experiences/" tabindex="0">	
							<img alt="thumbnail" class="attachment-responsive wp-post-image lsx-responsive" src="/wp-content/uploads/2022/07/family-experiences-traveller-type-1024x576.jpg">
							</a>	</div>

			<div class="lsx-to-widget-content bottom">
				<h4 class="lsx-to-widget-title text-left">
					<a href="/who/family-experiences/" tabindex="0">	Family Experiences	</a></h4>

					</div>
		</article>
		</div>

			<div class="lsx-to-widget-item-wrap lsx-travel-style slick-slide" ><article class="term-11095 travel-style type-travel-style status-publish hentry">
						<div class="lsx-to-widget-thumb">
						<a href="/who/group-of-friends/" tabindex="0">		
					<img alt="thumbnail" class="attachment-responsive wp-post-image lsx-responsive" src="/wp-content/uploads/2022/06/tsp-group-of-friends-1024x576.jpg">
					</a>	</div>

	<div class="lsx-to-widget-content bottom">
		<h4 class="lsx-to-widget-title text-left">
			<a href="/who/group-of-friends/" tabindex="0">	Group of Friends		</a></h4>

			</div>
</article>
</div>

<div class="lsx-to-widget-item-wrap lsx-travel-style slick-slide" ><article class="term-11095 travel-style type-travel-style status-publish hentry">
				<div class="lsx-to-widget-thumb">
				<a href="/who/solo-traveller/" tabindex="0"><img alt="thumbnail" class="attachment-responsive wp-post-image lsx-responsive" src="/wp-content/uploads/2022/06/tsp-solo-traveller.jpg">
				</a></div>

<div class="lsx-to-widget-content bottom">
<h4 class="lsx-to-widget-title text-left">
	<a href="/who/solo-traveller/" tabindex="0">	Solo Travellers		</a></h4>

	</div>
</article>
</div>


	</div>
	</div>
</div>
</div>
</div>
</div>
