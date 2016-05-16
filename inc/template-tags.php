<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Urban_Rights
 */

if ( ! function_exists( 'urbanrights_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function urbanrights_posted_on() {
	$time_string = '<time class="published updated" datetime="%1$s">%2$s</time>';
//	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
//		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
//	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	echo '<div class="entry-date"><span class="glyphicon glyphicon-certificate"></span>' . $posted_on . '</div><div class="entry-author"><span class="glyphicon glyphicon-user"></span> ' . $byline . '</div>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'urbanrights_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function urbanrights_entry_footer() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		$categories_list = get_the_category_list( ', ' );
		if ( $categories_list && urbanrights_categorized_blog() ) {
			echo '<div class="cat-links"><span class="glyphicon glyphicon-folder-open"></span>'.$categories_list.'</div>';
		}

		$tags_list = get_the_tag_list( ', ' );
		if ( $tags_list ) {
			echo '<div class="tags-links"><span class="glyphicon glyphicon-tags"></span>'.$tags_list.'</div>';
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<div class="entry-comments-link"><span class="glyphicon glyphicon-comment"></span>';
		comments_popup_link( esc_html__( 'Leave a comment', 'urbanrights' ), esc_html__( '1 Comment', 'urbanrights' ), esc_html__( '% Comments', 'urbanrights' ) );
		 echo '</div>';
	}

//	edit_post_link(
//		sprintf(
//			/* translators: %s: Name of current post */
//			esc_html__( 'Edit %s', 'urbanrights' ),
//			the_title( '<span class="screen-reader-text">"', '"</span>', false )
//		),
//		'<span class="edit-link">',
//		'</span>'
//	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function urbanrights_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'urbanrights_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'urbanrights_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so urbanrights_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so urbanrights_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in urbanrights_categorized_blog.
 */
function urbanrights_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'urbanrights_categories' );
}
add_action( 'edit_category', 'urbanrights_category_transient_flusher' );
add_action( 'save_post',     'urbanrights_category_transient_flusher' );
