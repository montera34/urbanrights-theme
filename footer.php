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
			<div class="navbar-text navbar-left"><?php _e('A project by','urbanrights'); ?>: <a href="http://zuloark.com">Zuloark</a><br /><?php _e('Curator','urbanrights'); ?>: Julia Förster</div>
			<a class="navbar-brand" href="http://urbanrights.org"><img src="<?php echo URBANRIGHTS_BLOGTHEME; ?>/images/ur.png" alt="The Universal Declaration of Urban Rights" /></a>
		</div>
		<div class="collapse navbar-collapse" id="bottom-navbar-collapse">
			<div class="navbar-text navbar-left"><?php _e('Cooperations partners','urbanrights'); ?>:</div>
			<ul class="nav navbar-nav navbar-left">
				<li><a href="http://www.adk.de"><img src="<?php echo URBANRIGHTS_BLOGTHEME; ?>/images/colabora-adk.jpg" alt="Academie der Künste" /></a></li>
				<li><a href="http://berlin.cervantes.es"><img src="<?php echo URBANRIGHTS_BLOGTHEME; ?>/images/colabora-icervantes.jpg" alt="Instituto Cercantes" /></a></li>
				<li><a href="http://www.accioncultural.es/"><img src="<?php echo URBANRIGHTS_BLOGTHEME; ?>/images/colabora-ace.jpg" alt="Acción Cultural Española" /></a></li>
				<li><a href="http://www.beliusstiftung.org/"><img src="<?php echo URBANRIGHTS_BLOGTHEME; ?>/images/colabora-belius.jpg" alt="Belius Stiftung" /></a></li>
			</ul>
		</div>
	</div>
</nav>

	</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
