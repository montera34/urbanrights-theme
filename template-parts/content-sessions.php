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
$subtitle = get_post_meta($post->ID,'session-subtitle',true);
$date = date( 'Y\/m\/d',get_post_meta($post->ID,'session-date',true) );
$date_human = date( 'd\/m\/Y',get_post_meta($post->ID,'session-date',true) );
$classes = array('media');
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
		<h3 class="media-heading"><?php the_title(); ?></h3>
		<div class='media-meta'><strong><time datetime="<?php echo $date ?>"><?php echo $date_human ?></time></strong> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> <?php echo $subtitle; ?></div>
		<?php the_content(); ?>
	</div>
	<?php echo $item_img ?>
</article><!-- #post-## -->
<?php //if ( $count == 4 ) {
//	echo "<div class='clearfix visible-md-block visible-lg-block'></div>";
//	$count = 0;
//} ?>
