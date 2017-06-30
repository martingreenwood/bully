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
			<li class="active"><a href="<?php echo home_url( '/profile' ); ?>">My Profile</a></li>
			<li><a href="<?php echo home_url( '/recent' ); ?>">WOD Diary</a></li>
			<li><a href="<?php echo home_url( '/programme' ); ?>">My Programme</a></li>
			<!-- <li><a href="<?php echo home_url( '/messages' ); ?>">Messages</a></li> -->
			<li><a href="<?php echo home_url( '/settings' ); ?>">Settings</a></li>
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
					<p>To update these details please visit the <a href="<?php echo home_url( '/recent '); ?>">WOD Diary</a> and submit a workout summary.</p>
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
