<?php get_header();
$pt = get_post_type();
?>

	<div id="primary" class="row">
		<main id="main" class="col-sm-12" role="main">

			<?php if ( have_posts() ) :
				// header
				get_template_part( 'template-parts/content', 'taxonomy' ); ?>
				<div class="row row-littlemargin">

					<?php $count = 0; $tablet_count = 0;
					while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', $pt );
					endwhile;
					the_posts_navigation();
				else :
					get_template_part( 'template-parts/content', 'none' ); ?>

				</div><!-- .row -->
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
