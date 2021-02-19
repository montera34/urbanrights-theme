<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Urban_Rights
 */

get_header();

$pt = get_post_type();
?>

	<div id="primary" class="row">
		<main id="main" class="col-sm-12" role="main">

		<?php
		while ( have_posts() ) : the_post();

			if ( $pt == 'post')
				get_template_part( 'template-parts/content', get_post_format() );
			else
				get_template_part( 'template-parts/content-single', $pt );


			//the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
