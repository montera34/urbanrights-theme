<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Urban_Rights
 */

get_header(); ?>

	<div id="primary" class="row">
		<main id="main" class="col-md-6" role="main">

		<?php if ( have_posts() ) :
			$pt = "declarations";
			global $wp_post_types;
			if ( $wp_post_types[$pt]->description != '' )
				$page_desc = "<header><div class='ur-3cols'>" .$wp_post_types[$pt]->description. "</div></header>";
			else $page_desc = "";
			//echo $page_desc;?>

			<div class="media-list">
			<?php
			/* Start the Loop */
			$count = 0;
			while ( have_posts() ) : the_post();
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
					get_template_part( 'template-parts/content', get_post_format() );

					endwhile; ?>
			</div>
			<?php the_posts_navigation();

		else :

//			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
