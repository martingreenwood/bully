<?php
/**
 * Template part for displaying each user profile
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
			<li><a href="<?php echo home_url( '/admin-view' ); ?>">Admin View</a></li>
			<?php endif; ?>
			<li class="right"><a href="<?php echo home_url( '/?a=logout' ); ?>">Logout</a></li>
		</ul>

		<div class="tab-content row">

			<?php 
			$memberID = $_GET['id'];
			$userData = get_userdata( $memberID );
			$userMeta = get_user_meta( $memberID );

			$username = $userData->user_login;
			$first_name = $userData->first_name;
			$last_name = $userData->last_name;
			$user_groups = wp_get_object_terms($memberID, 'user-group', array('fields' => 'all_with_object_id'));  // 
			?>

			<div class="span8 tab">

				<div class="profile">

					<div class="tabs">

						<div class="member_header">
							<?php echo get_avatar( $memberID, 96 ); ?>
							<div class="meta">											
								<h2><?php echo current($userMeta['first_name']) .' '. current($userMeta['last_name']); ?></h2>
								<p><span><?php if (current($userMeta['tag_line'])): echo current($userMeta['tag_line']) . ' | '; endif; ?></span><span><?php  foreach($user_groups as $user_gro): echo $user_gro->name; endforeach; ?></span>
								</p>
							</div>
							<div class="clear"></div>
						</div>

						<div id="groups">

							<ul class="tab-links">
								<li><a href="#memberprofile">Profile</a></li>
								<li><a href="#diary">Diary</a></li>
								<li><a href="<?php echo fep_query_url('newmessage', array('to' => $memberID ) ); ?>">Send Message</a></li>
							</ul>

							<div class="tab-content">
								
								<div id="memberprofile" class="tab active">
									
									<?php if(current($userMeta['description'])): ?>
										<p><?php echo current($userMeta['description']); ?></p>
									<?php endif; ?>

									<dl>

										<?php if(current($userMeta['city'])): ?>
											<dt>Hometown</dt>
											<dd><?php echo current($userMeta['city']); ?></dd>
										<?php endif; ?>

										<?php if(current($userMeta['dob'])): ?>
											<dt>DoB</dt>
											<dd><?php echo current($userMeta['dob']); ?></dd>
										<?php endif; ?>

										<?php if(current($userMeta['interests'])): ?>
											<dt>Interests</dt>
											<dd><?php echo current($userMeta['interests']); ?></dd>
										<?php endif; ?>

										<?php if(current($userMeta['goals'])): ?>
											<dt>Goals</dt>
											<dd><?php echo current($userMeta['goals']); ?></dd>
										<?php endif; ?>

										<?php if(current($userMeta['status'])): ?>
											<dt>Status</dt>
											<dd><?php echo current($userMeta['status']); ?></dd>
										<?php endif; ?>

									</dl>

									<div class="pb_charts" style="margin-top: 40px;">

									<h2>PB CHART</h2>
									<br>
									<?php
									$args = array( 'post_type' => array('pb_charts'), 'author' => $memberID, 'posts_per_page' => -1 );
									$loop = new WP_Query( $args );
										$deadlift = array();
										$back_squat = array();
										$strict_press = array();
										$bench_press = array();
										$push_press = array();
										$ohs = array();
										$front_squat = array();
										$snatch = array();
										$clean_jerk = array();
										$jerk = array();
										$p_snatch = array();
										$p_clean = array();
										$p_jerk = array();

									while ( $loop->have_posts() ) : $loop->the_post();

										$deadlift[] = get_field( 'deadlift' );
										$back_squat[] = get_field( 'back_squat' );
										$strict_press[] = get_field( 'strict_press' );
										$bench_press[] = get_field( 'bench_press' );
										$push_press[] = get_field( 'push_press' );
										$ohs[] = get_field( 'ohs' );
										$front_squat[] = get_field( 'front_squat' );
										$snatch[] = get_field( 'snatch' );
										$clean_jerk[] = get_field( 'clean_jerk' );
										$clean[] = get_field( 'clean' );
										$jerk[] = get_field( 'jerk' );
										$p_snatch[] = get_field( 'p_snatch' );
										$p_clean[] = get_field( 'p_clean' );
										$p_jerk[] = get_field( 'p_jerk' );

									endwhile;
									wp_reset_query(); wp_reset_postdata();
									?>

									<div class="base pb_chart">
										
										<dl>
											<dt>DEADLIFT</dt>
											<dd>
												<?php 
													if (!empty($deadlift)) {
														echo max($deadlift) .'KG';
													} else {
														echo '--';
													}
												?>
											</dd>
											
											<dt>BACK SQUAT</dt>
											<dd>
												<?php 
													if (!empty($back_squat)) {
														echo max($back_squat) .'KG';
													} else {
														echo '--';
													}
												?>
											</dd>
											
											<dt>STRICT PRESS</dt>
											<dd>
												<?php 
													if (!empty($strict_press)) {
														echo max($strict_press) .'KG';
													} else {
														echo '--';
													}
												?>
											</dd>
											
											<dt>BENCH PRESS</dt>
											<dd>
												<?php 
													if (!empty($bench_press)) {
														echo max($bench_press) .'KG';
													} else {
														echo '--';
													}
												?>
											</dd>
											
											<dt>PUSH PRESS</dt>
											<dd>
												<?php 
													if (!empty($push_press)) {
														echo max($push_press) .'KG';
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
													if (!empty($ohs)) {
														echo max($ohs) .'KG';
													} else {
														echo '--';
													}
												?>
											</dd>
											
											<dt>FRONT SQUAT</dt>
											<dd>
												<?php 
													if (!empty($front_squat)) {
														echo max($front_squat) .'KG';
													} else {
														echo '--';
													}
												?>
											</dd>
											
											<dt>SNATCH</dt>
											<dd>
												<?php 
													if (!empty($snatch)) {
														echo max($snatch) .'KG';
													} else {
														echo '--';
													}
												?>
											</dd>
											
											<dt>CLEAN &amp; JERK</dt>
											<dd>
												<?php 
													if (!empty($clean_jerk)) {
														echo max($clean_jerk) .'KG';
													} else {
														echo '--';
													}
												?>
											</dd>
											
											<dt>CLEAN</dt>
											<dd>
												<?php 
													if (!empty($clean)) {
														echo max($clean) .'KG';
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
													if (!empty($jerk)) {
														echo max($jerk) .'KG';
													} else {
														echo '--';
													}
												?>
											</dd>
											
											<dt>P. SNATCH</dt>
											<dd>
												<?php 
													if (!empty($p_snatch)) {
														echo max($p_snatch) .'KG';
													} else {
														echo '--';
													}
												?>
											</dd>
											
											<dt>P. CLEAMN</dt>
											<dd>
												<?php 
													if (!empty($p_clean)) {
														echo max($p_clean) .'KG';
													} else {
														echo '--';
													}
												?>
											</dd>
											
											<dt>P. JERK</dt>
											<dd>
												<?php 
													if (!empty($p_jerk)) {
														echo max($p_jerk) .'KG';
													} else {
														echo '--';
													}
												?>
											</dd>
										</dl>

										<div class="clear"></div>
									</div>

									</div>

								</div>

								<div id="diary" class="tab">

									<?php
									$args = array( 'post_type' => array('user_updates', 'pb_charts'), 'author' => $memberID, 'posts_per_page' => -1 );
									$loop = new WP_Query( $args );
									if ( $loop->have_posts() ) :
									while ( $loop->have_posts() ) : $loop->the_post();
									?>
									<div class="update ajaxie" id="post-<?php echo get_the_id(); ?>">
										<h6 class="date"><?php the_author(); ?>: <small style="color: #999; font-weight: 300;"><?php echo get_the_time( ); ?>, <?php echo get_the_date(); ?></small></h6>
										<?php the_content(); ?>

										<?php if ( get_post_type() == 'pb_charts' ): ?>
										<h3>PB CHART UPDATE</h3>

										<div class="pb_charts">
											
											<div class="base pb_chart">
											<dl>
												<dt>DEADLIFT</dt>
												<dd>
													<?php 
														if (get_field( 'deadlift' )) {
															echo get_field( 'deadlift' ) . 'KG';
														} else {
															echo '--';
														}
													?>
												</dd>
												
												<dt>BACK SQUAT</dt>
												<dd>
													<?php 
														if (get_field( 'back_squat' )) {
															echo get_field( 'back_squat' ) .'KG';
														} else {
															echo '--';
														}
													?>
												</dd>
												
												<dt>STRICT PRESS</dt>
												<dd>
													<?php 
														if (get_field( 'strict_press' )) {
															echo get_field( 'strict_press' ) .'KG';
														} else {
															echo '--';
														}
													?>
												</dd>
												
												<dt>BENCH PRESS</dt>
												<dd>
													<?php 
														if (get_field( 'bench_press' )) {
															echo get_field( 'bench_press' ) .'KG';
														} else {
															echo '--';
														}
													?>
												</dd>
												
												<dt>PUSH PRESS</dt>
												<dd>
													<?php 
														if (get_field( 'push_press' )) {
															echo get_field( 'push_press' ) .'KG';
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
															echo get_field( 'ohs' ) .'KG';
														} else {
															echo '--';
														}
													?>
												</dd>
												
												<dt>FRONT SQUAT</dt>
												<dd>
													<?php 
														if (get_field( 'front_squat' )) {
															echo get_field( 'front_squat' ) .'KG';
														} else {
															echo '--';
														}
													?>
												</dd>
												
												<dt>SNATCH</dt>
												<dd>
													<?php 
														if (get_field( 'snatch' )) {
															echo get_field( 'snatch' ) .'KG';
														} else {
															echo '--';
														}
													?>
												</dd>
												
												<dt>CLEAN &amp; JERK</dt>
												<dd>
													<?php 
														if (get_field( 'clean_jerk' )) {
															echo get_field( 'clean_jerk' ) .'KG';
														} else {
															echo '--';
														}
													?>
												</dd>

												<dt>CLEAN</dt>
												<dd>
													<?php 
														if (get_field( 'clean' )) {
															echo get_field( 'clean' ) .'KG';
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
															echo get_field( 'jerk' ) .'KG';
														} else {
															echo '--';
														}
													?>
												</dd>
												
												<dt>P. SNATCH</dt>
												<dd>
													<?php 
														if (get_field( 'p_snatch' )) {
															echo get_field( 'p_snatch' ) .'KG';
														} else {
															echo '--';
														}
													?>
												</dd>
												
												<dt>P. CLEAN</dt>
												<dd>
													<?php 
														if (get_field( 'p_clean' )) {
															echo get_field( 'p_clean' ) .'KG';
														} else {
															echo '--';
														}
													?>
												</dd>
												
												<dt>P. JERK</dt>
												<dd>
													<?php 
														if (get_field( 'p_jerk' )) {
															echo get_field( 'p_jerk' ) .'KG';
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
									else:
									?>
									<div class="update ajaxie">
										<h4>Sorry - no entires to show</h4>
									</div>
									<?php
									endif;
									wp_reset_query(); wp_reset_postdata();
									?>

								</div>
										
							</div>

						</div>

					</div>
				
				</div>

			</div>

			<?php get_template_part( 'template-parts/partials/partial', 'side' ); ?>

		</div>

	</div>

</article>
