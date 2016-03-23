<?php
/**
 * Template Name: Declarations
 *
 * @package Urban_Rights
 */

get_header(); ?>

	<div id="primary" class="row">
		<main id="main" class="col-sm-12" role="main">

			<?php // header
			while ( have_posts() ) : the_post();
				$footer = get_the_content();
				get_template_part( 'template-parts/content', 'archive' );
endwhile;
wp_reset_postdata(); 

			/* Archive Loop */
			$pt = "declarations";
			$args = array(
				'post_type' => $pt,
				'nopaging' => 'true',
				'order' => 'ASC',
				'orderby' => 'menu_order'
			);
			$archive = new WP_Query( $args );

			if ( $archive->have_posts() ) : ?>
			<div class="row row-littlemargin">
				<?php $count = 0;
				$tablet_count = 0;
				while ( $archive->have_posts() ) {
				 	$archive->the_post();
					get_template_part( 'template-parts/content', $pt );
				}
				wp_reset_postdata(); ?>
			</div><!-- .row -->
			<?php endif;

			if ( $footer != '' )
				echo "<footer class='row'><div class='col-md-6'>".apply_filters('the_content',$footer)."</div></footer>";
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
