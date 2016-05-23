<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Urban_Rights
 */

if ( is_single() ) {
	$header_classes = "col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-4";
	$content_classes = " col-md-6 col-md-push-3 col-sm-8 col-sm-push-4";
} else {
	$header_classes = "col-sm-12";
	$content_classes = " col-sm-12";
}
$classes = array('row main-space');
$subtitle = get_post_meta($post->ID,'session-subtitle',true);
$session_time = get_post_meta($post->ID,'session-date',true);
$date = date( 'Y\/m\/d',$session_time );
$date_human = date( 'd\/m\/Y',$session_time );
if ( $session_time < time() && !is_single() )
	$classes[] = "text-muted";
$item_perma = get_permalink();
if ( has_post_thumbnail() ) {
	$item_img = "
	<figure class='post-featured-img'>"
		.get_the_post_thumbnail($post->ID,$item_img_size,array('class' => 'img-responsive')).
	"</figure>";
} else { $item_img = ""; } ?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<header class="<?php echo $header_classes; ?>">
		<?php if ( is_single() ) { $head = "h1"; } else { $head = "h3"; } ?>
		<div class='session-meta'>
			<span class="session-subtitle"><?php echo $subtitle; ?></span> <time datetime="<?php echo $date ?>"><?php echo $date_human ?></time>
		</div>
		<?php if ( is_single() ) {
			the_title( '<h1 class="session-heading">', '</h1>' );
		} else {
			the_title( '<h3 class="session-heading"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} ?>
	</header>
	<div class="post-content<?php echo $content_classes; ?>">
		<?php the_content( __( 'Read conclusion of this session', 'urbanrights' ) ); ?>
	</div><!-- .post-content -->

	<?php if ( is_single() && $item_img != '' ) : ?>
		<footer class="post-meta col-md-3 col-md-pull-6 col-sm-4 col-sm-pull-8">
			<?php echo $item_img ?>
		</footer><!-- .entry-meta -->
	<?php endif; ?>

</article><!-- #post-## -->
