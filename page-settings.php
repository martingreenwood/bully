<?php
/**
 * The front page template file
 *
 * @package bully
 */

if (!is_user_logged_in()):
	header("Location: " . home_url( '/profile/' ) );
endif;

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main container" role="main">

		<?php
		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'settings' );

			endwhile;

		endif; ?>

		</main>
	</div>

<?php
get_footer();
