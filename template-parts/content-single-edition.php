<?php
/**
 * Template part for displaying editions
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Urban_Rights
 */

$classes = array('main-space');
//$subtitle = get_post_meta($post->ID,'session-subtitle',true);
$perma = get_permalink();

// SESSION CARD
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

// Sessions
$sessions = get_post_meta($post->ID,'_ed_session');
$sessions_out = '';
if ( !empty($sessions) ) {
	$sessions_out = '<aside><h2>'.__('Sessions in this edition','urbanrights').'</h2>';
	foreach ( $sessions as $s ) {
		$s_perma = get_permalink($s['ID']);
		$s_img_out = ( has_post_thumbnail($s['ID'] ) )  ? '<figure><img src="'.get_the_post_thumbnail_url($s['ID'],'small').'"></figure>' : '';
		$s_name = $s['post_title'];

		$sessions_out .= '<div class="rel-session">
			'.$s_img_out.'
			<div class="rel-session-name"><a href="'.$s_perma.'">'.$s_name.'</a></div>
		</div>';
	}
	$sessions_out .= '</aside>';
}

// Urban beings
$beings_roles = get_post_meta($post->ID,'_ed_rel_rol_bei');
$beings_roles_out = '';
if ( !empty($beings_roles) ) {
	$beings_roles_out = '<aside><h2>'.__('UR_NET. Urban beings in this edition','urbanrights').'</h2>';
	foreach ( $beings_roles as $br ) {
		$b = get_post_meta($br['ID'],'_rrb_being',true);
		$b_perma = get_permalink($b['ID']);
		$b_img_out = ( has_post_thumbnail($b['ID'] ) )  ? '<figure><img src="'.get_the_post_thumbnail_url($b['ID'],'small').'"></figure>' : '';
		$b_fname = get_post_meta($b['ID'],'_ur_firstname',true);
		$b_lname = get_post_meta($b['ID'],'_ur_lastame',true);
		$b_name = ( !empty($b_fname) || !empty($lname) ) ? $b_fname.' '.$b_lname : $b['post_title'];
		$roles = get_the_terms($br['ID'],'role');
		$roles_list = array();
		foreach( $roles as $r ) {
			$roles_list[] = $r->name;
		}
		$roles_out = ( !empty($roles_list) ) ? implode(', ', $roles_list) : '';

		$beings_roles_out .= '<div class="rel-being">
			'.$b_img_out.'
			<div class="rel-being-name"><a href="'.$b_perma.'">'.$b_name.'</a></div>
			<div class="rel-being-role">'.$roles_out.'</div>
		</div>';
	}
	$beings_roles_out .= '</aside>';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<header class="single-header session-header">
		<?php the_title( '<h1>', '</h1>' ); ?>
	</header>
	<?php echo $card_out; ?>
	<div class="single-content session-content">
		<?php the_content(); ?>
	</div><!-- .post-content -->
	<?php echo $sessions_out; ?>
	<?php echo $beings_roles_out; ?>

</article><!-- #post-## -->
