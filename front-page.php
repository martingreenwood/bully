<?php
/**
 * The front page template file
 *
 * @package bully
 */

if (is_user_logged_in()):
	header("Location: " . home_url( '/profile/' ) );
endif;

get_header(); ?>

	<section id="topimage">
		<?php the_post_thumbnail( ); ?>
		<div class="caption">
			<div class="table"><div class="cell middle">
				<div class="container">
					<div class="copy">
						<h3>Are You A</h3>
						<h3>Competitor</h3>
						<p>We offer programming for all levels of athletes, from beginners who want to get their first pull up, to elite athletes aspiring to get to the CrossFit Games.</p>
						<a href="<?php echo home_url( '/programmes' ); ?>">Sign Up Today</a>
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
