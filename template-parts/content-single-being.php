<?php
/**
 * Template part for displaying urban being.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Urban_Rights
 */

$classes = array('main-space');
$perma = get_permalink();

$img_out = ( has_post_thumbnail($post->ID ) )  ? '<figure><img src="'.get_the_post_thumbnail_url($post->ID,'small').'"></figure>' : '';
$fname = get_post_meta($post->ID,'_b_firstname',true);
$lname = get_post_meta($post->ID,'_b_lastname',true);
$name = ( !empty($fname) || !empty($lname) ) ? $fname.' '.$lname : get_the_title();

// CARD
$card_out = '';
$card_items = array();
// type
$types = get_the_terms($post->ID,'b_type');
if ( !is_wp_error($types) && $types != false ) {
	$types_list = array();
	foreach ( $types as $t ) 
		$types_list[] = '<a href="'.get_term_link($t,'b_type').'">'.$t->name.'</a>';
	$types_out[] = implode(', ',$types_list);
}
if ( !empty($types_out) )
	$card_items[] = array(
		'l' => __('Urban being type','urbanrights'),
		'v' => implode('<br>',$types_out)
	);
// website
$site = get_post_meta($post->ID,'_b_website',true);
$site_out = '';
if ( !empty($site) ) {
	$site_out = '<a href="'.$site.'">'.$site.'</a>';
}
if ( !empty($site_out) )
	$card_items[] = array(
		'l' => __('Website','urbanrights'),
		'v' => $site_out
	);
// organization
$orgs = get_post_meta($post->ID,'_b_org');
$orgs_out = '';
if ( !empty($orgs) ) {
	$orgs_list = array();
	foreach ( $orgs as $o ) {
		$o_perma = get_permalink($o['ID']);
		$o_fname = get_post_meta($o['ID'],'_b_firstname',true);
		$o_lname = get_post_meta($o['ID'],'_b_lastname',true);
		$o_name = ( !empty($o_fname) || !empty($o_lname) ) ? $o_fname.' '.$o_lname : $o['post_title'];
		$orgs_list[] = '<a href="'.$o_perma.'">'.$o_name.'</a>';
	}
}
if ( !empty($orgs_list) )
	$card_items[] = array(
		'l' => __('Organizations that the urban being takes part in','urbanrights'),
		'v' => implode(', ',$orgs_list)
	);
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

// sessions, editions, declarations
$args = array(
	'post_type' => URP_PT__RRB,
	'meta_query' => array(
		array(
			'key' => '_rrb_being',
			'value' => $post->ID,
		)
	),
	'nopaging' => 'true'
);
$beings_roles = get_posts($args);
$beings_roles_out = '';
if ( !empty($beings_roles) ) {
	$beings_roles_out = '<aside><h2>'.__('Participation in Urban Rights editions and parliament sessions','urbanrights').'</h2>';
	foreach ( $beings_roles as $br ) {
		$es_list = array();
		$pss = get_post_meta($br->ID,'_rrb_session');
		if ( !empty($pss) ) {
			foreach ( $pss as $ps ) {
				$ps_perma = get_permalink($ps['ID']);
				$es_list[] = '<a href="'.$ps_perma.'">'.$ps['post_title'].'</a>';
			}
		}
		$eds = get_post_meta($br->ID,'_rrb_edition');
		if ( !empty($eds) ) {
			foreach ( $eds as $ed ) {
				$ed_perma = get_permalink($ed['ID']);
				$es_list[] = '<a href="'.$ed_perma.'">'.$ed['post_title'].'</a>';
			}
		}
		$es_out = ( !empty($es_list) ) ? implode(', ', $es_list) : '';
		$roles = get_the_terms($br->ID,'role');
		$roles_list = array();
		foreach( $roles as $r ) {
			$roles_list[] = $r->name;
		}
		$roles_out = ( !empty($roles_list) ) ? implode(', ', $roles_list) : '';

		$beings_roles_out .= '<div class="rel-roles">
			<div class="rel-role">'.$roles_out.'</div>
			<div class="rel-events">'.$es_out.'</div>
		</div>';
	}
	$beings_roles_out .= '</aside>';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<header class="single-header session-header">
		<h1><?php echo $name; ?></h1>
	</header>
	<?php echo $img_out; ?>
	<?php echo $card_out; ?>
	<div class="single-content session-content">
		<?php the_content(); ?>
	</div><!-- .post-content -->
	<?php echo $beings_roles_out; ?>

</article><!-- #post-## -->
