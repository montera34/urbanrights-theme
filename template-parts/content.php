<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Urban_Rights
 */

$classes = array('media');
if ( has_post_thumbnail() && !is_single() ) {
	$item_img = "
	<div class='media-left media-top'>"
		.get_the_post_thumbnail($post->ID,$item_img_size,array('class' => 'media-object')).
	"</div>";
} else { $item_img = ""; }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<?php echo $item_img ?>
	<div class="media-body">
		<header class="media-heading">
			<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

			if ( 'post' === get_post_type() ) : ?>
			<div class="media-meta">
				<?php urbanrights_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .media-heading -->

		<div class="media-content">
			<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'urbanrights' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'urbanrights' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .media-content -->

		<footer class="media-footer">
			<?php urbanrights_entry_footer(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .media-body -->
</article><!-- #post-## -->
