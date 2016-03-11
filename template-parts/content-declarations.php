<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Urban_Rights
 */
global $count;
$count++;
$video_url = get_post_meta($post->ID,'declaration-video-url',true);
$declaration_classes = array('col-md-3');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($declaration_classes); ?>>
	<?php echo apply_filters('the_content',$video_url); ?>
</article><!-- #post-## -->
<?php if ( $count == 4 ) {
	echo "<div class='clearfix visible-md-block visible-lg-block'></div>";
	$count = 0;
} ?>
