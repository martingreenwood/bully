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
			<li class="active"><a href="<?php echo home_url( '/profile' ); ?>">My Profile</a></li>
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

			<div class="span8 tab">

				<div class="profile">

					<h2>My Profile</h2>
					<p><?php echo do_shortcode( '[wpmem_field description]' ); ?></p>

					<dl>
						<dt>Hometown</dt>
						<dd><p><?php echo do_shortcode( '[wpmem_field city]' ); ?></p></dd>
						<dt>DoB</dt>
						<dd><p><?php echo do_shortcode( '[wpmem_field dob]' ); ?></p></dd>
						<dt>Interests</dt>
						<dd><p><?php echo do_shortcode( '[wpmem_field interests]' ); ?></p></dd>
						<dt>Goals</dt>
						<dd><p><?php echo do_shortcode( '[wpmem_field goals]' ); ?></p></dd>
						<dt>Status</dt>
						<dd><p><?php echo do_shortcode( '[wpmem_field status]' ); ?></p></dd>
					</dl>
				
					<div class="clear"></div>
				</div>


				<div class="pb_charts" style="margin-top: 40px;">

					<h2>PB CHART</h2>
					<p>To update these details please visit your <a href="<?php echo home_url( '/recent '); ?>">diary</a> page and submit your recent stats. All of your stats will be stored and posted on your diary page each time you add a workout summary, including any stats. Your highest stats will show as your PBs on this page.</p>
					<br><br>

					<?php
					$args = array( 'post_type' => array('pb_charts'), 'author' => $userID, 'posts_per_page' => -1 );
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
						
						$fran = array();
						$grace = array();
						$elizabeth = array();
						$karen = array();
						$diane = array();
						
						$row500 = array();
						$row2000 = array();
						$row5000 = array();
						
						$maxpullups = array();
						$maxhandstandpushups = array();
						$maxtoestobar = array();
						$maxringmuscleups = array();
						$maxbarmuscleups = array();

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

						$fran = get_field( 'fran' );
						$grace = get_field( 'grace' );
						$elizabeth = get_field( 'elizabeth' );
						$karen = get_field( 'karen' );
						$diane = get_field( 'diane' );
						
						$row500 = get_field( 'row500' );
						$row2000 = get_field( 'row2000' );
						$row5000 = get_field( 'row5000' );
						
						$maxpullups = get_field( 'maxpullups' );
						$maxhandstandpushups = get_field( 'maxhandstandpushups' );
						$maxtoestobar = get_field( 'maxtoestobar' );
						$maxringmuscleups = get_field( 'maxringmuscleups' );
						$maxbarmuscleups = get_field( 'maxbarmuscleups' );

					endwhile;
					wp_reset_query(); wp_reset_postdata();
					?>

					<div class="base pb_chart weight">
						<h2>WEIGHTLIGTING (KG)</h2>
						<dl>
							<dt>DEADLIFT</dt>
							<dd>
								<?php 
									if (!empty($deadlift)) {
										echo max($deadlift);
									} else {
										echo '--';
									}
								?>
							</dd>
							
							<dt>BACK SQUAT</dt>
							<dd>
								<?php 
									if (!empty($back_squat)) {
										echo max($back_squat);
									} else {
										echo '--';
									}
								?>
							</dd>
							
							<dt>STRICT PRESS</dt>
							<dd>
								<?php 
									if (!empty($strict_press)) {
										echo max($strict_press);
									} else {
										echo '--';
									}
								?>
							</dd>
							
							<dt>BENCH PRESS</dt>
							<dd>
								<?php 
									if (!empty($bench_press)) {
										echo max($bench_press);
									} else {
										echo '--';
									}
								?>
							</dd>
							
							<dt>PUSH PRESS</dt>
							<dd>
								<?php 
									if (!empty($push_press)) {
										echo max($push_press);
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
										echo max($ohs);
									} else {
										echo '--';
									}
								?>
							</dd>
							
							<dt>FRONT SQUAT</dt>
							<dd>
								<?php 
									if (!empty($front_squat)) {
										echo max($front_squat);
									} else {
										echo '--';
									}
								?>
							</dd>
							
							<dt>SNATCH</dt>
							<dd>
								<?php 
									if (!empty($snatch)) {
										echo max($snatch);
									} else {
										echo '--';
									}
								?>
							</dd>
							
							<dt>CLEAN &amp; JERK</dt>
							<dd>
								<?php 
									if (!empty($clean_jerk)) {
										echo max($clean_jerk);
									} else {
										echo '--';
									}
								?>
							</dd>
							
							<dt>CLEAN</dt>
							<dd>
								<?php 
									if (!empty($clean)) {
										echo max($clean);
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
										echo max($jerk);
									} else {
										echo '--';
									}
								?>
							</dd>
							
							<dt>P. SNATCH</dt>
							<dd>
								<?php 
									if (!empty($p_snatch)) {
										echo max($p_snatch);
									} else {
										echo '--';
									}
								?>
							</dd>
							
							<dt>P. CLEAMN</dt>
							<dd>
								<?php 
									if (!empty($p_clean)) {
										echo max($p_clean);
									} else {
										echo '--';
									}
								?>
							</dd>
							
							<dt>P. JERK</dt>
							<dd>
								<?php 
									if (!empty($p_jerk)) {
										echo max($p_jerk);
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
									if (!empty($fran)) {
										echo max($fran);
									} else {
										echo '--';
									}
								?>
							</dd>
							<dt>GRACE</dt>
							<dd>
								<?php 
									if (!empty($grace)) {
										echo max($grace);
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
									if (!empty($elizabeth)) {
										echo max($elizabeth);
									} else {
										echo '--';
									}
								?>
							</dd>
							<dt>KAREN</dt>
							<dd>
								<?php 
									if (!empty($karen)) {
										echo max($karen);
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
									if (!empty($row500)) {
										echo max($row500);
									} else {
										echo '--';
									}
								?>
							</dd>
							<dt>Row 2000m</dt>
							<dd>
								<?php 
									if (!empty($row2000)) {
										echo max($row2000);
									} else {
										echo '--';
									}
								?>
							</dd>
							<dt>Row 5000m</dt>
							<dd>
								<?php 
									if (!empty($row5000)) {
										echo max($row5000);
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
									if (!empty($maxpullups)) {
										echo max($maxpullups);
									} else {
										echo '--';
									}
								?>
							</dd>
							<dt>max handstand push ups</dt>
							<dd>
								<?php 
									if (!empty($maxhandstandpushups)) {
										echo max($maxhandstandpushups);
									} else {
										echo '--';
									}
								?>
							</dd>
							<dt>max toes to bar</dt>
							<dd>
								<?php 
									if (!empty($maxtoestobar)) {
										echo max($maxtoestobar);
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
									if (!empty($maxringmuscleups)) {
										echo max($maxringmuscleups);
									} else {
										echo '--';
									}
								?>
							</dd>
							<dt>max bar muscle ups</dt>
							<dd>
								<?php 
									if (!empty($maxbarmuscleups)) {
										echo max($maxbarmuscleups);
									} else {
										echo '--';
									}
								?>
							</dd>
						</dl>
					</div>
					<div class="clear"></div>
				</div>

				<div class="other_acc_links">
					<ul>
						<li>
							<a href="<?php echo home_url( '/settings' ); ?>?a=edit">Edit Profile</a>
						<li>
						<li>
							<a href="<?php echo home_url( '/settings' ); ?>?a=pwdchange">Change Password</a>
						<li>
					</ul>
				</div>

			</div>

			<?php get_template_part( 'template-parts/partials/partial', 'side' ); ?>

		</div>

	</div>

</article>
