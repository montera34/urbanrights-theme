<?php

// the_archive_title()
add_filter( 'get_the_archive_title', 'urbanrights_archive_title' );
function urbanrights_archive_title( $title ) {
	if ( is_post_type_archive() ) {
		$title = post_type_archive_title('',false);
	}
	elseif ( is_tax() ) {
		//$tx = get_queried_object()->taxonomy;
		//$tax = get_taxonomy( $tx );
		$title = single_term_title( '', false );
	}
	elseif ( is_author() ) {
		$title = sprintf( __( 'User: %s','urbanrights' ), '<span class="vcard">' . get_the_author() . '</span>' );
	}
	elseif ( is_home() ) {
		$title = __( 'Blog','xcol' );
	}
	else {
	}

	return $title;
}

// the_archive_description
//add_filter( 'get_the_archive_description', 'urbanrights_archive_description');
function urbanrights_archive_description( $description ) {
	if ( is_post_type_archive() || is_home() ) {
		$pt = ( is_home() ) ? 'post' : get_queried_object()->name;
		$args = array(
			'post_type' => XCOL_PT__TB,
			'meta_query' => array(
				array(
					'key' => '_block_pt',
					'value' => $pt,
					'compare' => '='
				)
			),
			'posts_per_page' => 1
		);
	$blocks = get_posts($args);
	return ( !empty($blocks) ) ? apply_filters('the_content',get_the_content(null,null,$blocks[0]->ID) ) : wp_strip_all_tags($description);
	}
	return wp_strip_all_tags($description);

}

function urbanrights_embed_html( $html ) {
    return '<div class="video-container">' . $html . '</div>';
}
 
add_filter( 'embed_oembed_html', 'urbanrights_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'urbanrights_embed_html' ); // Jetpack

// custom loops for each template
function urbanrights_custom_args_for_loops( $query ) {
	if ( !is_admin() && is_post_type_archive('declarations') && $query->is_main_query() ) { 
		$query->set( 'nopaging','true');
		$query->set( 'order','ASC');
		$query->set( 'orderby','menu_order');
	}
	elseif ( !is_admin() && is_post_type_archive('edition') && $query->is_main_query() ) { // editions
		$query->set( 'nopaging','true');
		$query->set( 'orderby','meta_value_num');
		$query->set( 'meta_key','_ed_date');
		$query->set( 'order','DESC');
	}
	return $query;
} // END custom args for loops
add_filter( 'pre_get_posts', 'urbanrights_custom_args_for_loops' );

add_action( 'save_post_edition', 'urbanrights_save_date_as_meta', 10 );
function urbanrights_save_date_as_meta ($post_id) {
	$years = get_the_terms($post_id,'date');

	if( empty($years) )
		return;
	$years_list = wp_list_pluck($years,'name');
	rsort($years_list);

	update_post_meta($post_id,'_ed_date',$years_list[0]);

	return;
}
?>
