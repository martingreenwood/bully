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
			<h4>Welcome To</h4>
			<h2><?php bloginfo( "name" ); ?></h2>
		</header>

		<?php
			the_content();
		?>

		<div class="groups">
			<h2>OUR COMPETITOR PROGRAMMES</h2>
			<a class="more" href="<?php echo home_url( '/programmes' ); ?>">View All PROGRAMMES</a>
			<ul>
			<?php
			$args = array(
				'post_type' 		=> 'user_groups',
				'posts_per_page' 	=> 4,
				'order'				=> 'ASC',
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ): 
				while ( $query->have_posts() ): $query->the_post();
				?>
				<li>
					<?php $icon = get_field( 'group_icon' ); ?>
					<img src="<?php echo $icon['url']; ?>">
					<h3><?php the_title( ); ?></h3>
					<?php the_excerpt(); ?>
				</li>
				<?php
				endwhile; 
				wp_reset_postdata(); 
			endif;
			?>
			</ul>
		</div>

	</div>

	<aside class="span4">
		<?php if (is_user_logged_in()): ?>
			<a class="myacc" href="<?php echo home_url( '/programmes' ); ?>">Go to My Account</a>
		<?php else: ?>
		<?php wp_login_form( ); ?>
		<?php endif; ?>
	</aside>


</article>