<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bully
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		
		<header>
			<h4><?php the_field( 'intro_header_line_one' ); ?></h4>
			<h2><?php the_field( 'intro_header_line_two' ); ?></h2>
		</header>
		
		<?php
			the_content();
		?>

		<script
		src='http://m.goteamup.com/teamup.js'
		type='text/javascript'></script> <script
		type='text/javascript'>
		teamup.calendar({provider_id:120539,width:"100%",height:"600px",view:"month"});</script>

	</div>

</article>
