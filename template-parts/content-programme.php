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
					<h3><?php echo do_shortcode( '[wpmem_field tag_line]' ); ?> <?php if( current_user_can('manage_options') ): ?> - Site Admin <?php endif; ?></h3>
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
			<li><a href="<?php echo home_url( '/recent' ); ?>">My Diary</a></li>
			<li class="active"><a href="<?php echo home_url( '/programme' ); ?>">My Programme</a></li>
			<!-- <li><a href="<?php echo home_url( '/messages' ); ?>">Messages</a></li> -->
			<li><a href="<?php echo home_url( '/settings' ); ?>">Settings</a></li>
			<?php if( current_user_can('manage_options') ): ?>
			<li><a href="<?php echo home_url( '/admin-view' ); ?>">Admin View</a></li>
			<?php endif; ?>
			<li class="right"><a href="<?php echo home_url( '/?a=logout' ); ?>">Logout</a></li>
		</ul>

		<div class="tab-content row">

			<div class="span8">

				<div id="groups" class="tab">

				<?php
				$user_groups = wp_get_object_terms($userID, 'user-group', array('fields' => 'all_with_object_id'));  // Get user group detail
				foreach($user_groups as $user_gro)
				{
					$usergroupid = $user_gro->term_taxonomy_id; // Get current user group name
					$usergroupslug = $user_gro->slug; // Get current user group name
				}

				// echo '<pre>';
				// print_r($user_gro);
				// echo '</pre>';

				$args = array(
				'name'        => $usergroupslug,
				'post_type'   => 'user_groups',
				'post_status' => 'publish',
				'numberposts' => 1
				);
				$my_posts = get_posts($args);
				if( $my_posts ) :
				$my_post = current($my_posts);
				?>
				<div class="row programme-info">
					<header>
						<h1><?php echo $my_post->post_title; ?> Programme</h1>
					</header>
					<section>
						<div class="span4">
							<?php $icon = get_field( 'group_icon', $my_post->ID ); ?>
							<img src="<?php echo $icon['url']; ?>">
						</div>
						<div class="span8">
							<?php
							$content = $my_post->post_content;
							$content = apply_filters('the_content', $content);
							$content = str_replace(']]>', ']]&gt;', $content);
							echo $content;
							?>
						</div>
					</section>
				</div>
				<?php
				endif;
				?>

				<div class="row">
					
					<div class="group-posts">
					<?php
					$args = array(
						'post_type' 		=> 'post',
						'posts_per_page' 	=> 10,
						'meta_query' => array(
							array(
								'key'     => 'programme_select',
								'value'   => $usergroupid, // in da future
								'compare' => '=',
							),
						),

					);
					$query = new WP_Query( $args );
					if ( $query->have_posts() ): 
						while ( $query->have_posts() ): $query->the_post();
						?>
						<div class="group-post ajaxie" id="post-<?php echo get_the_id(); ?>">
							<header>
								<h1><?php the_title( ); ?></h1>
							</header>

							<?php the_content(); ?>

							<div class="cmts">

								<div class="meta">
									<small><?php comments_number( 'no comments', '1 comment', '% comments' ); ?></small>
									<div class="comment_form">
										
										<?php  
										// If comments are open or we have at least one comment, load up the comment template.
										if ( comments_open() || get_comments_number() ) :
											echo comments_template();
										endif;
										?>

									</div>
									<div class="clear"></div>
								</div>

							</div>
						</div>
						<?php
						endwhile; 
						wp_reset_postdata(); 
					endif;
					?>

					</div>
					
				</div>

				
					
				</div>

			</div>

			<?php get_template_part( 'template-parts/partials/partial', 'side' ); ?>

		</div>


	</div>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

</article>
