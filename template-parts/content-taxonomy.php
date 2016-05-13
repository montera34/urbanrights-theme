<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Urban_Rights
 */
$tax_slug = get_query_var( 'taxonomy' );
$tax = get_taxonomy($tax_slug);
$tax_name = $tax->labels->name;
$current_t = get_query_var( 'term' );
$terms = get_terms( array(
	'taxonomy' => $tax_slug,
	'hide_empty' => true,
	'orderby' => 'name',
) );
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
	$terms_out = "<ul class='archive-tags list-inline'>";
	foreach ( $terms as $t ) {
		if ( $current_t == $t->slug ) {
			$terms_out .= "<li class='current-term'>". $t->name ."</li>";
		} else {
			$term_link = get_term_link($t,$tax_slug);
			$terms_out .= "<li". $class_out ."><a href='".$term_link."'>". $t->name ."</a></li>";
		}
	}
	$terms_out .= "</ul>";
}
?>

	<header class="archive-header section-space">
		<?php the_title( '<h1 class="hidden">', '</h1>' ); ?>
		<div><strong><?php echo $tax_name ; ?></strong></div>
		<div class="ur-2cols"><?php echo $terms_out; ?></div>
	</header><!-- .entry-header -->


