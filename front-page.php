<?php
/**
 * The front page template file
 *
 * @package bully
 */

get_header(); ?>

	<section id="topimage">
		<?php the_post_thumbnail( ); ?>
		<div class="caption">
			<div class="table"><div class="cell middle">
				<div class="container">
					<div class="copy">
						<h3>Are You A</h3>
						<h3>Competitor</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
						<a href="<?php echo home_url( '/register' ); ?>">Sign Up Today</a>
					</div>
				</div>
			</div></div>
		</div>
	</section>

	<div id="primary" class="content-area">
		<main id="main" class="site-main container" role="main">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'home' );

			endwhile;
		endif; ?>

		</main>
	</div>

<?php
get_footer();
