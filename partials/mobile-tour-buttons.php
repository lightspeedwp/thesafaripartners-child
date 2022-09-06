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


          <nav role="navigation" class="mobile-tournav">
          <select> 
    <option value="" selected="selected">Select</option> 
    
    <option value="openCity(event, 'Overview')">Overview</option> 
    <option value="openCity(event, 'Day')">Day by Day</option> 
    <option value="openCity(event, 'Accommodation')">Accommodation</option> 
    <option value="openCity(event, 'Price')">Dates & Prices</option> 
    <option value="openCity(event, 'Maps')">Maps & More</option> 

  </select> 
						</nav>
                        </div>