<?php
/**
 * Template Name: Wizard
 *
 * @package lsx
 */

get_header(); ?>

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

				<div id="myWizard">
		            <ul class="nav nav-tabs" id="myTab" role="tablist">
		                <li class="nav-item">
		                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
		                       aria-selected="true">Get Started</a>
		                </li>
		                <li class="nav-item">
		                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
		                       aria-controls="profile" aria-selected="false">Step 2</a>
		                </li>
		                <li class="nav-item">
		                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
		                       aria-controls="contact" aria-selected="false">Step 3</a>
		                </li>
		            </ul>
		            <div class="tab-content" id="myTabContent">
		                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><p class="lead mt-3">A lightweight jQuery plugin that lets you quickly generate a step-by-step wizard interface using Bootstrap's Tabs component.</p></div>
		                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><p class="lead mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porta libero nunc, in laoreet turpis hendrerit tempor. In hac habitasse platea dictumst. Maecenas sed porta sapien. Morbi faucibus scelerisque ante. Aliquam vel leo ut diam gravida congue.</p></div>
		                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"><p class="lead mt-3">This is the last step.</p></div>
		            </div>
		            <hr/>
		            <div class="row">
		                <button class="btn btnTab1 btn-primary mr-1 d-none">Tab1</button>
		                <button class="btn btnTab2 btn-secondary mr-1 d-none">Tab2</button>
		                <button class="btn btnPrev btn-primary mr-1 ml-auto">Previous</button>
		                <button class="btn btnNext btn-primary">Next</button>
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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://thesafaripartners-upgraded.lightspeedwp.dev/wp-content/themes/thesafaripartners-child/assets/js/jquery-bootstrap-tab-wizard.min.js"></script>
<script>
  $('#myWizard').TabWizard({
        additionalButtons: [
            {
                tab: '#home',
                buttons: ['.btnTab1']
            },
            {
                tab: '#profile',
                buttons: ['.btnTab2', '.btnTab1']
            },
        ],
        nextButtonClass: '.btnNext',
        previousButtonClass: '.btnPrev',
        onFinish: function () {
            alert('Complete!');
        },
    });
  </script>
<?php
get_footer();
