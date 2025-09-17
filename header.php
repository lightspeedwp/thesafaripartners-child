<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package lsx
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<?php lsx_head_top(); ?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1" >
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php lsx_head_bottom(); ?>
		<?php wp_head(); ?>
	</head>


	<?php
		if ( function_exists( 'lsx_geo_content' ) ) {
			$users_country = lsx_geo_get_user_meta( 'country_code' );
			$extra_class = 'country-'.$users_country;
		}
	?>

	<body <?php body_class( 'lsx' ); ?>>
		<?php wp_body_open(); ?>
		<?php lsx_body_top(); ?>
<div class="body-wrap">
		<div class="header-wrap">
			<div class="intro-wrap"><p>Chat to an expert, call us at 1.888.71SAFARI (72327)</p></div>
			<?php if ( wp_is_mobile() ) { wp_nav_menu( array('container_class' => 'primary-navbar', 'theme_location' => 'max_mega_menu_1') );} ?>
			<?php lsx_header_before(); ?>
			<header id="masthead" class="<?php lsx_header_classes(); ?>" role="banner">
				<?php lsx_header_top(); ?>
				<div class="container">
					<?php lsx_nav_before(); ?>
					<?php wp_nav_menu( array( 'container_class' => 'primary-navbar', 'theme_location' => 'primary' ) ); ?>

					<?php lsx_header_bottom(); ?>
				</div>
			</header>
			<?php lsx_header_after(); ?>
		</div>

		<?php lsx_header_wrap_after(); ?>

		<?php
		if ( is_search() ) : ?>
			<div id="lsx-banner" class="tsp-banner-search">
				<div class="page-banner-wrap">
					<div class="page-banner rotating" style="">
						<div class="page-banner-image" style="background-position: center center; background-image:url(https://thesafaripartners.lightspeedwp.dev/wp-content/uploads/2022/09/wildlife-safaris-holiday-style.jpg);"></div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="wrap container" role="document" tabindex="-1">
			<div class="content role row">

			<?php lsx_header_wrap_container_top(); ?>
