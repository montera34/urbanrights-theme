<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Urban_Rights
 */

$classes = array('row');
if ( has_post_thumbnail() && !is_single() ) {
	$item_img = "
	<figure class='post-featured-img'>"
		.get_the_post_thumbnail($post->ID,'medium',array('class' => 'img-responsive')).
	"</figure>";
} else { $item_img = ""; } ?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>

	<header class=" col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-4">
		<?php if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		} ?>
	</header>

	<div class="post-content col-md-6 col-md-push-3 col-sm-8 col-sm-push-4">

		<?php the_content( sprintf(
			/* translators: %s: Name of current post. */
			wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'urbanrights' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'urbanrights' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .post-content -->

	<?php if ( 'post' === get_post_type() ) : ?>
		<footer class="post-meta col-md-3 col-md-pull-6 col-sm-4 col-sm-pull-8">
			<?php urbanrights_posted_on(); ?>
			<?php urbanrights_entry_footer(); ?>
			<?php echo $item_img ?>
		</footer><!-- .entry-meta -->
	<?php endif; ?>

</article><!-- #post-## -->
