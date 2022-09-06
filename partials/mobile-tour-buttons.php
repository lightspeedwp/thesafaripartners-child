<div class="lsx-single-contact mobileonly">

<?php
        $file = get_field('download_itinerary');
        if( $file ): ?>

<div class="tours-nav">
    <div class="col-md-4">
        <button class="btn lsx-btn popup-inquire">Book It!</button>
    </div>

    <div class="col-md-4">
        <a href="<?php the_field('download_itinerary'); ?>" download="true" class="btn lsx-btn">DOWNLOAD ITINERY</a>
    </div>
  
    <div class="col-md-4 dropdown-share">
        <button class="btn lsx-btn -lsx-share-initiated">Share with a Friend</button>
        <div class="dropdown-content">
        <?php
if ( class_exists( 'LSX_Sharing' ) ) {
lsx_content_sharing();
} else {
if ( function_exists( 'sharing_display' ) ) {
sharing_display( '', true );
}
}
?>
 </div>
</div>
 <?php else : ?>
         

          <div class="tours-nav">
    <div class="col-md-6">
        <button class="btn lsx-btn popup-inquire">Book It!</button>
    </div>

    <div class="col-md-6 dropdown-share">
        <button class="btn lsx-btn -lsx-share-initiated">Share with a Friend</button>
        <div class="dropdown-content">
        <?php
if ( class_exists( 'LSX_Sharing' ) ) {
lsx_content_sharing();
} else {
if ( function_exists( 'sharing_display' ) ) {
sharing_display( '', true );
}
}
?>
          </div>
</div>
          <?php endif; ?>

          </div>



  <div class="custom-select" style="width:100%;">

<div class="select-selected select-arrow-active">Select</div>
<button class="tablinks tours-wizard select-items" id="tours-wizard" onclick="openCity(event, 'Overview')">Overview</button>
								<button class="tablinks select-items" id="page-1" onclick="openCity(event, 'Day')">Day by Day</button>
								<button class="tablinks select-items" id="page-3" onclick="openCity(event, 'Accommodation')">Accommodation</button>
								<button class="tablinks select-items" id="page-4" onclick="openCity(event, 'Price')">Dates & Prices</button>
								<button class="tablinks select-items" id="page-5" onclick="openCity(event, 'Maps')">Maps & More</button></div>
                        </div>