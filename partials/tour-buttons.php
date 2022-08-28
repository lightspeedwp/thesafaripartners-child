<div class="lsx-single-contact">

<div class="tours-nav">
    <div class="col-md-4">
        <button class="btn lsx-btn popup-inquire">Book It!</button>
    </div>
    <?php
        $file = get_field('download_itinerary');
        if( $file ): ?>
    <div class="col-md-4">
        <button href="<?php echo $file['url']; ?>" class="btn lsx-btn">DOWNLOAD ITINERY</button>
    </div>
    <?php endif; ?>
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