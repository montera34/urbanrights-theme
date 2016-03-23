<?php
/**
 * Template Name: Sessions
 *
 * @package Urban_Rights
 */

get_header(); ?>

<div id="primary" class="row">
	<main id="main" class="col-sm-12" role="main">

			<?php // header
			while ( have_posts() ) : the_post();
				$page_desc = get_the_excerpt();
				$page_content = get_the_content();
				$page_title = get_the_title();
			endwhile;
			wp_reset_postdata(); ?>

		<div class="ur-2cols section-space">
			<?php echo apply_filters('the_content',$page_desc); ?>
		</div>
		<div class="row main-space">
			<div class="col-md-6">
				<header class="section-space">
					<h1 class="archive-tit"><?php echo $page_title ?></h1>
					<div class="archive-tit">Dienstags / Tuesday 19h00</div>
				</header>
				<div class="media-list">
			<?php /* Archive Loop */
			$pt = "sessions";
			$args = array(
				'post_type' => $pt,
				'nopaging' => 'true',
				'meta_key' => 'session-date',
				'order' => 'ASC',
				'orderby' => 'menu_order_num'
			);
			$archive = new WP_Query( $args );

			if ( $archive->have_posts() ) : ?>
				<?php //$count = 0;
				//$tablet_count = 0;
				while ( $archive->have_posts() ) {
				 	$archive->the_post();
					get_template_part( 'template-parts/content', $pt );
				}
				wp_reset_postdata(); ?>
			<?php endif; ?>
				</div><!-- .media-list -->
			</div><!-- .col-md-6 -->
			<div class="col-md-6 page-content">
				<?php echo apply_filters('the_content',$page_content); ?>
			</div><!-- .col-md-6 -->
		</div><!-- .row -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
