<?php
/**
 * Template Name: Import from UR v1
 *
 * @package Urban_Rights
 */

get_header(); ?>

	<div id="primary" class="row">
		<main id="main" class="col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1" role="main">

<?php

	// SET THE ARGUMENTS to query contents using WP Rest API

	// args for declarations
	$args = array(
		'per_page' => 100,
		'page' => 1,
		// 'offset' => 65,
	);

	// FETCH CONTENTS

	// uncomment next line to fetch declarations
	// $contents = urp_v1_get_declarations($args);

	// getting some feedback of the importation process
	echo $contents['feedback'];

	// MAKE INSERTS
	foreach ( $contents['data'] as $c ) {

		// uncomment next line to insert declarations
		//echo urp_insert_declaration($c);

	}


			while ( have_posts() ) : the_post();


			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
