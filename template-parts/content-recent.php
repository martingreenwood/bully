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
			<li class="active"><a href="<?php echo home_url( '/recent' ); ?>">My Diary</a></li>
			<li><a href="<?php echo home_url( '/programme' ); ?>">My Programme</a></li>
			<!-- <li><a href="<?php echo home_url( '/messages' ); ?>">Messages</a></li> -->
			<li><a href="<?php echo home_url( '/settings' ); ?>">Settings</a></li>
			<?php if( current_user_can('manage_options') ): ?>
			<li><a href="<?php echo home_url( '/admin-view' ); ?>">Admin View</a></li>
			<?php endif; ?>
			<li class="right"><a href="<?php echo home_url( '/?a=logout' ); ?>">Logout</a></li>
		</ul>

		<div class="tab-content row">

			<div class="span8 tab">

				<h2>My Diary</h2>
				<div class="update_links">
					<a class="update update_wod" href="#add_pb">Add Stats</a>
					<a class="update update_wod" href="#add_wod">Add Workout Summary</a>
				</div>

				<div id="add_pb">
					<a class="close" href="#"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
					<div class="table"><div class="cell middle">
						<div class="box">
							<?php echo do_shortcode('[gravityform id="4" title="false" description="false" ajax="false"]'); ?>
						</div>
					</div></div>
				</div>

				<div id="add_wod">
					<a class="close" href="#"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
					<div class="table"><div class="cell middle">
						<div class="box">
							<?php echo do_shortcode( '[gravityform id="1" title="false" description="false" ajax="false"]' ); ?>
						</div>
					</div></div>
				</div>

				
				<?php
					$args = array( 'post_type' => array('user_updates', 'pb_charts'), 'author' => $userID, 'posts_per_page' => -1 );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
					?>
					<div class="update ajaxie" id="post-<?php echo get_the_id(); ?>">
						<h6 class="date"><?php the_author(); ?>: <small style="color: #999; font-weight: 300;"><?php echo get_the_time( ); ?>, <?php echo get_the_date(); ?><?php if (user_can( $userID, 'edit_posts' )): edit_post_link( ' | edit' ); endif; ?></small></h6>
						<?php the_content(); ?>

						<?php if ( get_post_type() == 'pb_charts' ): ?>
						<h3>PB CHART UPDATE</h3>

						<div class="pb_charts">
							
							<div class="base pb_chart weight">
							<h2>WEIGHTLIFTING (KG)</h2>
							<dl>
								<dt>DEADLIFT</dt>
								<dd>
									<?php 
										if (get_field( 'deadlift' )) {
											echo get_field( 'deadlift' );
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>BACK SQUAT</dt>
								<dd>
									<?php 
										if (get_field( 'back_squat' )) {
											echo get_field( 'back_squat' );
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>STRICT PRESS</dt>
								<dd>
									<?php 
										if (get_field( 'strict_press' )) {
											echo get_field( 'strict_press' );
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>BENCH PRESS</dt>
								<dd>
									<?php 
										if (get_field( 'bench_press' )) {
											echo get_field( 'bench_press' );
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>PUSH PRESS</dt>
								<dd>
									<?php 
										if (get_field( 'push_press' )) {
											echo get_field( 'push_press' );
										} else {
											echo '--';
										}
									?>									
								</dd>
							</dl>
							<dl>
								<dt>OHS</dt>
								<dd>
									<?php 
										if (get_field( 'ohs' )) {
											echo get_field( 'ohs' );
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>FRONT SQUAT</dt>
								<dd>
									<?php 
										if (get_field( 'front_squat' )) {
											echo get_field( 'front_squat' );
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>SNATCH</dt>
								<dd>
									<?php 
										if (get_field( 'snatch' )) {
											echo get_field( 'snatch' );
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>CLEAN &amp; JERK</dt>
								<dd>
									<?php 
										if (get_field( 'clean_jerk' )) {
											echo get_field( 'clean_jerk' );
										} else {
											echo '--';
										}
									?>
								</dd>

								<dt>CLEAN</dt>
								<dd>
									<?php 
										if (get_field( 'clean' )) {
											echo get_field( 'clean' );
										} else {
											echo '--';
										}
									?>
								</dd>
							</dl>
							<dl>
								<dt>JERK</dt>
								<dd>
									<?php 
										if (get_field( 'jerk' )) {
											echo get_field( 'jerk' );
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>P. SNATCH</dt>
								<dd>
									<?php 
										if (get_field( 'p_snatch' )) {
											echo get_field( 'p_snatch' );
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>P. CLEAN</dt>
								<dd>
									<?php 
										if (get_field( 'p_clean' )) {
											echo get_field( 'p_clean' );
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>P. JERK</dt>
								<dd>
									<?php 
										if (get_field( 'p_jerk' )) {
											echo get_field( 'p_jerk' );
										} else {
											echo '--';
										}
									?>
								</dd>
							</dl>
							</div>

							<div class="base pb_chart bench">
								<h2>BENCHMARKS (MM:SS)</h2>
								<dl>
									<dt>FRAN</dt>
									<dd>
										<?php 
											if (get_field( 'fran' )) {
												echo get_field( 'fran' );
											} else {
												echo '--';
											}
										?>
									</dd>
									<dt>GRACE</dt>
									<dd>
										<?php 
											if (get_field( 'grace' )) {
												echo get_field( 'grace' );
											} else {
												echo '--';
											}
										?>
									</dd>
								</dl>
								<dl>
									<dt>ELIZABETH</dt>
									<dd>
										<?php 
											if (get_field( 'elizabeth' )) {
												echo get_field( 'elizabeth' );
											} else {
												echo '--';
											}
										?>
									</dd>
									<dt>KAREN</dt>
									<dd>
										<?php 
											if (get_field( 'karen' )) {
												echo get_field( 'karen' );
											} else {
												echo '--';
											}
										?>
									</dd>
								</dl>
							</div>

							<div class="base pb_chart cond">
								<h2>CONDITIONING (MM:SS)</h2>
								<dl>
									<dt>Row 500m</dt>
									<dd>
										<?php 
											if (get_field( 'row500' )) {
												echo get_field( 'row500' );
											} else {
												echo '--';
											}
										?>
									</dd>
									<dt>Row 2000m</dt>
									<dd>
										<?php 
											if (get_field( 'row2000' )) {
												echo get_field( 'row2000' );
											} else {
												echo '--';
											}
										?>
									</dd>
									<dt>Row 5000m</dt>
									<dd>
										<?php 
											if (get_field( 'row5000' )) {
												echo get_field( 'row5000' );
											} else {
												echo '--';
											}
										?>
									</dd>
								</dl>
							</div>
							
							<div class="base pb_chart gym">
								<h2>GYMNASTIC</h2>
								<dl>
									<dt>max pull ups</dt>
									<dd>
										<?php 
											if (get_field( 'maxpullups' )) {
												echo get_field( 'maxpullups' );
											} else {
												echo '--';
											}
										?>
									</dd>
									<dt>max handstand push ups</dt>
									<dd>
										<?php 
											if (get_field( 'maxhandstandpushups' )) {
												echo get_field( 'maxhandstandpushups' );
											} else {
												echo '--';
											}
										?>
									</dd>
									<dt>max toes to bar</dt>
									<dd>
										<?php 
											if (get_field( 'maxtoestobar' )) {
												echo get_field( 'maxtoestobar' );
											} else {
												echo '--';
											}
										?>
									</dd>
								</dl>
								<dl>
									<dt>max ring muscle ups</dt>
									<dd>
										<?php 
											if (get_field( 'maxringmuscleups' )) {
												echo get_field( 'maxringmuscleups' );
											} else {
												echo '--';
											}
										?>
									</dd>
									<dt>max bar muscle ups</dt>
									<dd>
										<?php 
											if (get_field( 'maxbarmuscleups' )) {
												echo get_field( 'maxbarmuscleups' );
											} else {
												echo '--';
											}
										?>
									</dd>
								</dl>
							</div>

							<div class="clear"></div>
						</div>
						<?php endif; ?>

						<div class="cmts">
							<div class="meta">
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
					wp_reset_query(); wp_reset_postdata();
				?>

			</div>

			<?php get_template_part( 'template-parts/partials/partial', 'side' ); ?>

		</div>


	</div>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

</article>
