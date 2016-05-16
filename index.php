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

	<?php if ( have_posts() ) : ?>
		<main id="main" class="ur-list col-sm-12" role="main">
			<header class="archive-header section-space">
				<h1 class="hidden">News</h1>
			</header><!-- .entry-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile; ?>

			<?php // the_posts_navigation(); ?>
			<nav class="navigation posts-navigation row" role="navigation">
				<div class="nav-links col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-4">
					<div class="row">
					<div class="col-xs-6 nav-next nav-link">
						<?php next_posts_link( sprintf(__('%s Older posts','urbanrights'),'<span class="glyphicon glyphicon-menu-left"></span>' ) ); ?></div>
						<div class="col-xs-6 nav-prev nav-link text-right"><?php previous_posts_link( sprintf(__('Newer posts %s','urbanrights'),'<span class="glyphicon glyphicon-menu-right"></span>') ); ?></div>
					</div>
				</div>
			</nav>

		</main><!-- #main -->

	<?php else :
		get_template_part( 'template-parts/content', 'none' );

	endif; ?>

	</div><!-- #primary -->

<?php
get_footer();
