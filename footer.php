<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bully
 */

?>

	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div class="container">
				<div class="row">
						<div class="span4">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo2.svg">
						</div>
						<nav class="main-navigation span8" role="navigation">
							<div class="table"><div class="cell middle">
								<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
							</div></div>
						</nav>
					</div>
				</div>	
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
