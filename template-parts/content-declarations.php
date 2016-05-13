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
$tablet_count++;
$video_url = get_post_meta($post->ID,'declaration-video-url',true);
if ( $post->menu_order == '0' ) {
	$count = 0;
	$tablet_count = 0;
	$declaration_classes = array('col-md-12 declaration-featured');
} else {
	$declaration_classes = array('col-md-3 col-sm-4');
}
// tags
$taxs = array(
	array("protect","To protect"),
	array("eradicate","To eradicate"),
	array("initiate","To initiate")
);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($declaration_classes); ?>>
	<?php echo apply_filters('the_content',$video_url); ?>
	<dl class="declaration-tags">
		<?php foreach ( $taxs as $t ) { the_terms( $post->ID, $t[0], "<dt>".$t[1]."</dt><dd>",", ","</dd>" ); } ?>

	</dl>
</article><!-- #post-## -->
<?php
if ( $count == 4 || $count == 0 ) {
	echo "<div class='clearfix visible-md-block visible-lg-block'></div>";
	$count = 0;
}
if ( $tablet_count == 3 || $tablet_count == 0 ) {
	echo "<div class='clearfix visible-sm-block'></div>";
	$tablet_count = 0;
}
?>
