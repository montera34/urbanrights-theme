<?php
/**
 * The template for displaying SESSIONS POST TYPE archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Urban_Rights
 */

get_header(); ?>

	<div id="primary" class="row">
		<main id="main" class="col-sm-12" role="main">

		<?php
		if ( have_posts() ) : ?>

			<div class="row row-littlemargin">
			<?php
			/* Start the Loop */
			$count = 0;
			while ( have_posts() ) : the_post();
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
					get_template_part( 'template-parts/content', get_post_type() );

					endwhile; ?>
			</div>
			<?php the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
