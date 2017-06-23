<?php
/**
 * The template for displaying all pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
						<h3><?php the_field( 'heading_line_one' ); ?></h3>
						<h3><?php the_field( 'heading_line_two' ); ?></h3>
					</div>
				</div>
			</div></div>
		</div>
	</section>

	<div id="primary" class="content-area">
		<main id="main" class="site-main container" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', $pagename );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
