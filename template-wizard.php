<?php
/**
 * Template Name: Wizard
 *
 * @package lsx
 */

get_header(); ?>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php lsx_content_wrap_before(); ?>

<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">

	<?php lsx_content_before(); ?>

	<main id="main" class="site-main" role="main">

		<?php lsx_content_top(); ?>

		<?php if ( have_posts() ) : ?>

			<?php
			while ( have_posts() ) :
				the_post();
			?>

				<?php get_template_part( 'partials/content', 'page' ); ?>
        <div class="row">
        <section>
        <div class="wizard">
        <div class="wizard-inner">
        <div class="active-line"></div>
        <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active stepactive1">
        <div class="connecting-line border-right"></div>
        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
        <span class="round-tab">
        1
        </span>
        <p>Create Account</p>
        </a>
        </li>
        <li role="presentation" class="disabled stepactive2">
        <div class="connecting-line border-right border-left"></div>
        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
        <span class="round-tab">
        2
        </span>
        <p> Login</p>
        </a>
        </li>
        <li role="presentation" class="disabled stepactive3">
        <div class="connecting-line border-right border-left"></div>
        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
        <span class="round-tab">
        3
        </span>
        <p>Payment</p>
        </a>
        </li>
        <li role="presentation" class="disabled stepactive4">
        <div class="connecting-line"></div>
        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
        <span class="round-tab">
        4
        </span>
        <p>Confirm</p>
        </a>
        </li>
        </ul>
        </div>
        <form role="form">
        <div class="tab-content">
        <div class="tab-pane active" role="tabpanel" id="step1">
        <h3>Create Account</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. </p>
        <ul class="list-inline">
        <li><button type="button" class="btn next-step">Save and Next&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button></li>
        </ul>
        </div>
        <div class="tab-pane" role="tabpanel" id="step2">
        <h3>Login</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. </p>
        <ul class="list-inline">
        <li><button type="button" class="btn prev-step"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Previous</button></li>
        <li><button type="button" class="btn next-step">Save and Next&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button></li>
        </ul>
        </div>
        <div class="tab-pane" role="tabpanel" id="step3">
        <h3>Payment</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. </p>
        <ul class="list-inline">
        <li><button type="button" class="btn prev-step"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Previous</button></li>
        <li><button type="button" class="btn btn-info-full next-step">Save and Next&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button></li>
        </ul>
        </div>
        <div class="tab-pane" role="tabpanel" id="complete">
        <h3>Confirm</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. </p>
        <ul class="list-inline">
        <li><button type="button" class="btn prev-step"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Previous</button></li>
        <li><button type="button" class="btn btn-info-full next-step">Save and Submit</button></li>
        </ul>
        </div>
        <div class="clearfix"></div>
        </div>
        </form>
        </div>
        </section>
        </div>
        </div>


			<?php endwhile; ?>

		<?php endif; ?>

		<?php lsx_content_bottom(); ?>

	</main><!-- #main -->

	<?php lsx_content_after(); ?>

	<?php
	if ( comments_open() ) {
		comments_template();
	}
	?>

</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php get_sidebar(); ?>
<script type="text/javascript">
$(document).ready(function () {
$('.nav-tabs > li a[title]').tooltip();
$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
var $target = $(e.target);
if ($target.parent().hasClass('disabled')) {
return false;
}
});
$(".next-step").click(function (e) {
var $active = $('.wizard .nav-tabs li.active');
$active.next().removeClass('disabled');
nextTab($active);
$('.wizard .nav-tabs li.active .connecting-line').css({"border-bottom-left-radius": 0, "border-top-left-radius": 0});
});
$(".prev-step").click(function (e) {
var $active = $('.wizard .nav-tabs li.active');
prevTab($active);
});
});
function nextTab(elem) {
$(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
$(elem).prev().find('a[data-toggle="tab"]').click();
}
</script>
<?php
get_footer();
