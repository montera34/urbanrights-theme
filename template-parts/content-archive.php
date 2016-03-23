<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Urban_Rights
 */

?>

	<header class="archive-header section-space">
		<?php the_title( '<h1 class="hidden">', '</h1>' ); ?>
		<div class="ur-2cols"><?php echo apply_filters('the_content',get_the_excerpt()); ?></div>
	</header><!-- .entry-header -->


