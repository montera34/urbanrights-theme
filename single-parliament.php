<?php
/**
 * The template for displaying single session.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Urban_Rights
 */

get_header();
$pt = "parliament";
?>

<div id="primary" class="row">
	<main id="main" class="col-sm-12" role="main">
		<div class="section-space">
		</div>

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content-single', $pt );

			//the_post_navigation();

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
