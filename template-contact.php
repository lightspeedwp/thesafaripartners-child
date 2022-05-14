<?php
/**
 * Template Name: Con
 *
 * @package lsx
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">

	<?php lsx_content_before(); ?>

	<main id="main" class="site-main" role="main">

		<?php lsx_content_top(); ?>

<div class="entry">
<div id="tabs" class="tab">
			<?php
$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'ASC' ) );

foreach( $mypages as $page ) {
    $content = $page->post_content;
    if ( ! $content ) // Check for empty page
        continue;

    $content = apply_filters( 'the_content', $content );
?>

<button class="tablinks" id="<?php echo $post->ID; ?>" onclick="openCity(event, '<?php echo $page->post_title; ?>')"><?php echo $page->post_title; ?></button>
<?php
    }
?>
<?php	wp_reset_query(); ?>
</div>
<?php
$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'ASC' ) );

foreach( $mypages as $page ) {
$content = $page->post_content;
if ( ! $content ) // Check for empty page
	continue;

$content = apply_filters( 'the_content', $content );
?>

			<div id="<?php echo $page->post_title; ?>" class="tabcontent ui-tabs-panel">
			  <?php echo $content; ?>
			</div>

<?php
    }
?>
</div>
				<?php get_template_part( 'partials/content', 'page' ); ?>


		<?php lsx_content_bottom(); ?>

	</main><!-- #main -->

	<?php lsx_content_after(); ?>

	<?php
	if ( comments_open() ) {
		comments_template();
	}
	?>

	<?php get_sidebar(); ?>

	<?php if ( is_active_sidebar( 'why-us' ) ) : ?>
	<div class="home-widget" role="complementary">
		<?php dynamic_sidebar( 'why-us' ); ?>
	</div><!-- #primary-sidebar -->
	<?php endif; ?>

</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
<script>
// Get the element with id="defaultOpen" and click on it
document.getElementById("1454").click();
</script>
<script type="text/javascript">
$(function() {

	var $tabs = $('#tabs').tabs();

	$(".ui-tabs-panel").each(function(i){

		var totalSize = $(".ui-tabs-panel").size() - 1;

		if (i != totalSize) {
				next = i + 2;
				$(this).append("<a href='#' class='next-tab mover' rel='" + next + "'>Next Page &#187;</a>");
		}

		if (i != 0) {
				prev = i;
				$(this).append("<a href='#' class='prev-tab mover' rel='" + prev + "'>&#171; Prev Page</a>");
		}

	});

	$('.next-tab, .prev-tab').click(function() {
					 $tabs.tabs('select', $(this).attr("rel"));
					 return false;
			 });


});
</script>
<?php
get_footer();
