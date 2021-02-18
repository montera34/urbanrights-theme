<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Urban_Rights
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
<nav id="bottom-navbar" class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
	<div class="container">
		<div class="navbar-footer">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bottom-navbar-collapse">
				<span class="sr-only">Show/hide menu</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="navbar-text navbar-left"><?php _e('A project by','urbanrights'); ?></div>
			<a class="navbar-brand" href="https://zuloark.com"><img src="<?php echo URBANRIGHTS_BLOGTHEME; ?>/images/zk.jpg" alt="Zuloark" /></a>
		</div>
		<div class="collapse navbar-collapse" id="bottom-navbar-collapse">
			
			<?php if ( is_active_sidebar( 'footer-widgets' ) ) {
				dynamic_sidebar( 'footer-widgets' );
			} ?>
			<?php $location = "lang";
			if ( has_nav_menu( $location ) ) {
				$args = array(
					'theme_location'  => $location,
					'container' => false,
					'menu_id' => 'navbar-language',
					'menu_class' => 'nav navbar-nav navbar-right'
				);
				wp_nav_menu( $args );
			} ?>
		</div>
	</div>
</nav>

	</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
