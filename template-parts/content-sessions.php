<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Urban_Rights
 */
//global $count;
//$count++;
$classes = array('media');
$subtitle = get_post_meta($post->ID,'session-subtitle',true);
$session_time = get_post_meta($post->ID,'session-date',true);
$date = date( 'Y\/m\/d',$session_time );
$date_human = date( 'd\/m\/Y',$session_time );
if ( $session_time < time() )
	$classes[] = "text-muted";
$item_perma = get_permalink();
if ( has_post_thumbnail() ) {
	$item_img = "
	<div class='media-right media-top'>"
		.get_the_post_thumbnail($post->ID,$item_img_size,array('class' => 'media-object')).
	"</div>";
} else { $item_img = ""; }
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<div class="media-body">
		<header>
			<div class='media-meta'>
				<span class="session-subtitle"><?php echo $subtitle; ?></span> <time datetime="<?php echo $date ?>"><?php echo $date_human ?></time>
			</div>
			<h3 class="media-heading"><?php the_title(); ?></h3>
		</header>
		<?php the_content(); ?>
	</div>
	<?php echo $item_img ?>
</article><!-- #post-## -->
<?php //if ( $count == 4 ) {
//	echo "<div class='clearfix visible-md-block visible-lg-block'></div>";
//	$count = 0;
//} ?>
