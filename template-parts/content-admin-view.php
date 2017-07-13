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
			<li><a href="<?php echo home_url( '/programme' ); ?>">My Programme</a></li>
			<!-- <li><a href="<?php echo home_url( '/messages' ); ?>">Messages</a></li> -->
			<li><a href="<?php echo home_url( '/settings' ); ?>">Settings</a></li>
			<?php if( current_user_can('manage_options') ): ?>
			<li class="active"><a href="<?php echo home_url( '/admin-view' ); ?>">Admin View</a></li>
			<?php endif; ?>
			<li class="right"><a href="<?php echo home_url( '/?a=logout' ); ?>">Logout</a></li>
		</ul>

		<div class="tab-content row">

			<div class="span8 tab">

				<h2>All Programmes</h2>

				<div class="tabs">

					<div id="groups">

						<ul class="tab-links">
							<?php
							$args = array(
								'post_type' 		=> 'user_groups',
								'posts_per_page' 	=> 10,
							);
							$query = new WP_Query( $args );
							if ( $query->have_posts() ): 
								while ( $query->have_posts() ): $query->the_post();
								$programmetitle = get_the_title( );
								$programmetitle = str_replace("+", "", $programmetitle);
								?>	
								<li><a href="#<?php echo strtolower(str_replace(" ", "", $programmetitle)); ?>"><?php the_title( ); ?></a></li>
								<?php
								endwhile; 
								wp_reset_postdata(); 
							endif;
							?>
						</ul>

						<div class="tab-content">
							<?php
							$args = array(
								'post_type' 		=> 'user_groups',
								'posts_per_page' 	=> 10,
							);
							$TC = 0;
							$query = new WP_Query( $args );
							if ( $query->have_posts() ): 
								while ( $query->have_posts() ): $query->the_post();
								$programmetitle = get_the_title( );
								$programmetitle = str_replace("+", "", $programmetitle);
								?>
								<div id="<?php echo strtolower(str_replace(" ", "", $programmetitle)); ?>" class="tab <?php if ($TC++ == 0): ?>active<?php endif; ?>">
									<h2><?php the_title( ); ?> Programme</h2>

									<div class="row">
										
										<div class="group-posts">
										<?php
										$args = array(
											'post_type' 		=> 'post',
											'posts_per_page' 	=> -1,
											'meta_query' => array(
												array(
													'key'     => 'programme_select',
													'value'   => get_field( 'programme_select' ), // in da future
													'compare' => '=',
												),
											),

										);
										$postquery = new WP_Query( $args );
										if ( $postquery->have_posts() ): 
											while ( $postquery->have_posts() ): $postquery->the_post();
											?>
											<div class="group-post ajaxie" id="post-<?php echo get_the_id(); ?>" style="padding-top: 0;border-top: 0;">
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
										else:
										?>
											<div class="group-post">
												<h3>No Workouts Yet</h3>
											</div>
										<?php
										endif;
										?>

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

</article>
