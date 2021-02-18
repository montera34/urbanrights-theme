<?php
/**
 * Template Name: Home
 *
 * @package Urban_Rights
 */

get_header(); ?>

	<div id="primary" class="row">
		<main id="main" class="col-12" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.

			// EDITIONS MAP
			echo urp_get_map();

			// EUROPEAN PARLIAMENT SESSIONS
			$args = array(
				'post_type' => 'parliament',
				'nopaging' => 'true',
				'orderby' => 'meta_value',
				'order' => 'ASC',
				'meta_key' => '_ps_date',
				'meta_type' => 'DATE',
				'meta_query' => array(
					array(
						'key' => '_ps_edition',
						'value' => '70',
						'compare' => '='
					)
				),
			);
			$pss = get_posts($args);
			$pss_out = '<section id="#eupe"><header><h2 class="sec-tit">'.__('The European Parliament of Urban Rights Edition','urbanrights').'</h2></header><div class="row mosac">';
			foreach ( $pss as $ps ) {
				$tit = get_the_title($ps->ID);
				$date = get_post_meta($ps->ID,'_ps_date',true);
				$date_out = ( $date != '' ) ? '<div class="ps-meta">'.$date.'</div>' : '';

				$cities = get_the_terms($ps->ID,'city');
				$city = array();
				if ( $cities != '')
					$city = wp_list_pluck($cities,'name');
				$countries = get_the_terms($ps->ID,'country');
				$country = array();
				if ( $countries != '')
					$country = wp_list_pluck($countries,'name');
				$loc = array_merge($city,$country);
				$loc_out = ( !empty($loc) ) ? '<div class="ps-meta">'.implode(', ',$loc).'</div>' : '';
				
				$pss_out .= '<div class="mosac-item col-lg-2 col-md-3 col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1">
						<div class="ps-desc">
							<h4 class="ps-tit">'.$tit.'</h4>'
							.$date_out
							.$loc_out
						.'</div>
				</div>';
			}
			$pss_out .= "</div></section>";

			echo $pss_out;

			// JOIN
			$join_form = apply_filters('the_content','[newsletter_form]');
			$join_out = '<section id="#join"><header><h2 class="sec-tit">'.__('Subscribe to our newsletter','urbanrights').'</h2></header>'.$join_form.'</section>';
			echo $join_out;

			// WHO IS BEHIND
			$args = array(
				'post_type' => 'being',
				'post__in' => array(93,97,99),
				'orderby' => 'none'
			);
			$ubs = get_posts($args);
			$ubs_out = '<section id="#who"><header><h2 class="sec-tit">'.__('Who is behind','urbanrights').'</h2></header><div class="row">';
			foreach ( $ubs as $ub ) {
				$tit = get_the_title($ub->ID);
				$desc = apply_filters('the_content',$ub->post_content);
				$img = get_the_post_thumbnail($ub->ID,'bigicon');
				$img_out = ( has_post_thumbnail($ub->ID) ) ? '<div class="ub-img">'.$img.'</div>' : '';
				$site = get_post_meta($ub->ID,'_b_website',true);
				$figure_out = ( $site != '' ) ? '<a href="'.$site.'">'.$img_out.'</a>' : $img_out;
				$ubs_out .= '<div class="col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1">
						'.$figure_out.'
						<div class="ub-desc">
							<h4 class="ub-tit">'.$tit.'</h4>
							'.$desc.'
						</div>
				</div>';
			}
			$ubs_out .= "</div></section>";

			echo $ubs_out;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
