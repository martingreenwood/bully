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

		<div class="groups">
			<ul>
			<?php
			$args = array(
				'post_type' 		=> 'user_groups',
				'posts_per_page' 	=> 10,
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ): 
				while ( $query->have_posts() ): $query->the_post();
				?>
				<li>
					<div class="icon">
						<?php $icon = get_field( 'group_icon' ); ?>
						<img src="<?php echo $icon['url']; ?>">
						<h3><?php the_title(); ?></h3>
					</div>
					<div class="copy">
						<?php the_content(); ?>
					</div>
				</li>
				<?php
				endwhile; 
				wp_reset_postdata(); 
			endif;
			?>
			</ul>
			<div class="clear"></div>
		</div>

		<a class="signup" href="<?php echo home_url( '/signup' ); ?>">INTERESTED? SIGN UP TODAY!</a>

		<?php
			the_content();
		?>

	</div>

</article>
