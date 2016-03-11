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
	<div class="container-fluid">
		<div class="navbar-footer">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bottom-navbar-collapse">
				<span class="sr-only">Show/hide menu</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="http://urbanrights.org"><img src="<?php echo URBANRIGHTS_BLOGTHEME; ?>/images/ur.png" alt="The Universal Declaration of Urban Rights" /></a>
		</div>
		<div class="collapse navbar-collapse" id="bottom-navbar-collapse">
			Here credits and exhibition info.
		</div>
	</div>
</nav>

	</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
