<?php
/**
 * Template part for displaying editions list
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Urban_Rights
 */

$classes = array('edition-list');
$perma = get_permalink();

// featured img
$img_out = ( has_post_thumbnail($post->ID ) )  ? '<figure><img src="'.get_the_post_thumbnail_url($post->ID,'small').'"></figure>' : '';

// EDITION CARD
$card_out = '';
$card_items = array();
// taxonomies
$txs = array(
	array(
		'l' => __('Year','urbanrights'),
		'n' => 'date'
	),
	array(
		'l' => __('Type','urbanrights'),
		'n' => 'ed_type'
	),
	array(
		'l' => __('Status','urbanrights'),
		'n' => 'status'
	),
);
foreach ( $txs as $tx ) {

	$terms_out = array();
	$terms = get_the_terms($post->ID,$tx['n']);
	if ( !is_wp_error($terms) && $terms != false ) {
	$terms_list = array();
	foreach ( $terms as $t ) 
		$terms_list[] = '<a href="'.get_term_link($t,$tx['n']).'">'.$t->name.'</a>';
	$terms_out = implode(', ',$terms_list);
	}
	if ( !empty($terms_out) )
		$card_items[] = array(
			'l' => $tx['l'],
			'v' => $terms_out
		);
}
// location
$location_out = array();
$cities = get_the_terms($post->ID,'city');
$countries = get_the_terms($post->ID,'country');
if ( !is_wp_error($cities) && $cities != false ) {
	$cities_list = array();
	foreach ( $cities as $c ) 
		$cities_list[] = '<a href="'.get_term_link($c,'city').'">'.$c->name.'</a>';
	$location_out[] = implode(', ',$cities_list);
}
if ( !is_wp_error($countries) && $countries != false ) {
	$countries_list = array();
	foreach ( $countries as $c ) 
		$countries_list[] = '<a href="'.get_term_link($c,'city').'">'.$c->name.'</a>';
	$location_out[] = implode(', ',$countries_list);
}
if ( !empty($location_out) )
	$card_items[] = array(
		'l' => __('Location','urbanrights'),
		'v' => implode('<br>',$location_out)
	);

if ( ! empty($card_items) ) {
	$card_out = '<dl class="single-card session-card">';
	foreach ( $card_items as $ci ) {
		$card_out .= '<dt>'.$ci['l'].'</dt><dd>'.$ci['v'].'</dd>';
	}
	$card_out .= '</dl>';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<header class="archive-header session-header">
		<?php the_title( '<h2><a href="'.$perma.'">', '</a></h2>' ); ?>
	</header>
	<?php echo $img_out; ?>
	<?php echo $card_out; ?>
	<div class="archive-content session-content">
		<?php the_excerpt(); ?>
	</div><!-- .post-content -->

</article><!-- #post-## -->
