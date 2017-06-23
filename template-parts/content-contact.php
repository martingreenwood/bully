<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bully
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>

	<div class="entry-content span8">

		<header>
			<h4><?php the_field( 'intro_header_line_one' ); ?></h4>
			<h2><?php the_field( 'intro_header_line_two' ); ?></h2>
		</header>

		<?php
			echo do_shortcode( '[gravityform id="3" title="false" description="false" ajax="true"]' );
		?>

	</div>

	<?php get_template_part( 'template-parts/partials/partial', 'side-alt' ); ?>

</article>