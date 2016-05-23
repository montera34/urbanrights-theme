<?php
/**
 * The template for displaying single session.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Urban_Rights
 */

get_header();
$pt = "sessions";
?>

<div id="primary" class="row">
	<main id="main" class="col-sm-12" role="main">
		<div class="section-space">
			<?php echo ur_sessions_navlist($pt); ?>
		</div>

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', $pt );

			//the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			//if ( comments_open() || get_comments_number() ) :
			//	comments_template();
			//endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
