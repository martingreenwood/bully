<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bully
 */

$ft_image = do_shortcode( '[wpmem_field cover_image display=raw]' ); 
$userID = get_current_user_id();
$userData = get_userdata( $userID );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('profile'); ?>>

	<div class="header row">
		<div class="header-image">
			<?php echo wp_get_attachment_image( $ft_image, 'cover' ); ?>
		</div>

		<div class="name_info">
			<div class="avatar span3">
				<?php echo do_shortcode( '[wpmem_field profile_image]' ); ?>
			</div>
			<div class="meta span9">
				<div class="name">
					<h2><?php echo do_shortcode( '[wpmem_field first_name] [wpmem_field last_name]' ); ?></h2>
					<h3><?php echo do_shortcode( '[wpmem_field tag_line]' ); ?></h3>
				</div>

				<div class="badges">
					<?php get_template_part( 'template-parts/partials/partial', 'badges' ); ?>
				</div>
			</div>
		</div>
	</div>

	<div id="tabbed" class="row">

		<ul class="tab-links">
			<li><a href="<?php echo home_url( '/profile' ); ?>">My Profile</a></li>
			<li><a href="<?php echo home_url( '/recent' ); ?>">WOD Diary</a></li>
			<li><a href="<?php echo home_url( '/groups' ); ?>">Groups</a></li>
			<li><a href="<?php echo home_url( '/messages' ); ?>">Messages</a></li>
			<li class="active"><a href="<?php echo home_url( '/settings' ); ?>">Settings</a></li>
		</ul>

		<div class="tab-content row">

			<div class="span8 tab">

				<h2>Settings</h2>
				<?php the_content( ); ?>

				<div class="clear"></div>
			</div>

			<?php get_template_part( 'template-parts/partials/partial', 'side' ); ?>

		</div>

	</div>

</article>
