<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Urban_Rights
	 */

	?><!DOCTYPE html>
	<html <?php language_attributes(); ?>>
	<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

	<header id="masthead" class="site-header" role="banner">

		<nav id="top-navbar" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-navbar-collapse">
					<span class="sr-only">Show/hide menu</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' )); ?>"><img src="<?php echo URBANRIGHTS_BLOGTHEME; ?>/images/ur.png" alt="<?php echo URBANRIGHTS_BLOGNAME; ?>" /></a>
		</div>
		<div class="collapse navbar-collapse" id="top-navbar-collapse">
			<?php $location = "primary";
			if ( has_nav_menu( $location ) ) {
				$args = array(
					'theme_location'  => $location,
					'container' => false,
					'menu_id' => 'navbar-primary',
					'menu_class' => 'nav navbar-nav navbar-left'
				);
				wp_nav_menu( $args );
			} ?>
			<?php $location = "secondary";
			if ( has_nav_menu( $location ) ) {
				$args = array(
					'theme_location'  => $location,
					'container' => false,
					'menu_id' => 'navbar-secondary',
					'menu_class' => 'nav navbar-nav navbar-right'
				);
				wp_nav_menu( $args );
			}
			?>
		</div>
	</div>
	</nav>
	<h1 class='hide'></h1>
</header><!-- #masthead -->

<div id="content" <?php urbanrights_container_class(); ?>>
