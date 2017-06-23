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
			<li class="active"><a href="<?php echo home_url( '/recent' ); ?>">WOD Diary</a></li>
			<li><a href="<?php echo home_url( '/groups' ); ?>">Groups</a></li>
			<li><a href="<?php echo home_url( '/messages' ); ?>">Messages</a></li>
			<li><a href="<?php echo home_url( '/settings' ); ?>">Settings</a></li>
		</ul>

		<div class="tab-content row">

			<div class="span8 tab">

				<h2>WOD Diary</h2>
				<div class="update_links">
					<a class="update update_wod" href="#add_pb">Add Workout Sumary</a>
					<a class="update update_wod" href="#add_wod">Update WOD</a>
				</div>

				
				<?php
					$args = array( 'post_type' => array('user_updates', 'pb_charts'), 'author' => $userID, 'posts_per_page' => -1 );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
					?>
					<div class="update">
						<h6 class="date"><?php the_author(); ?>: <small style="color: #999; font-weight: 300;"><?php echo get_the_time( ); ?>, <?php echo get_the_date(); ?><?php if (user_can( $userID, 'edit_posts' )): edit_post_link( ' | edit' ); endif; ?></small></h6>
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
											the_field( 'deadlift' ) .'KG';
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>BACK SQUAT</dt>
								<dd>
									<?php 
										if (get_field( 'back_squat' )) {
											the_field( 'back_squat' ) .'KG';
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>STRICT PRESS</dt>
								<dd>
									<?php 
										if (get_field( 'strict_press' )) {
											the_field( 'strict_press' ) .'KG';
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>BENCH PRESS</dt>
								<dd>
									<?php 
										if (get_field( 'bench_press' )) {
											the_field( 'bench_press' ) .'KG';
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>PUSH PRESS</dt>
								<dd>
									<?php 
										if (get_field( 'push_press' )) {
											the_field( 'push_press' ) .'KG';
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
											the_field( 'ohs' ) .'KG';
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>FRONT SQUAT</dt>
								<dd>
									<?php 
										if (get_field( 'front_squat' )) {
											the_field( 'front_squat' ) .'KG';
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>SNATCH</dt>
								<dd>
									<?php 
										if (get_field( 'snatch' )) {
											the_field( 'snatch' ) .'KG';
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>CLEAN &amp; JERK</dt>
								<dd>
									<?php 
										if (get_field( 'clean_jerk' )) {
											the_field( 'clean_jerk' ) .'KG';
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
											the_field( 'jerk' ) .'KG';
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>P. SNATCH</dt>
								<dd>
									<?php 
										if (get_field( 'p_snatch' )) {
											the_field( 'p_snatch' ) .'KG';
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>P. CLEAN</dt>
								<dd>
									<?php 
										if (get_field( 'p_clean' )) {
											the_field( 'p_clean' ) .'KG';
										} else {
											echo '--';
										}
									?>
								</dd>
								
								<dt>P. JERK</dt>
								<dd>
									<?php 
										if (get_field( 'p_jerk' )) {
											the_field( 'p_jerk' ) .'KG';
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

						<?php $num_comments = get_comments_number(); ?>
						<?php //if ( comments_open() || $num_comments > 0 ) : ?>
						<div class="meta">
							<small><?php comments_number( 'no comments', '1 comment', '% comments' ); ?></small>
							<div class="comment_form">
								<?php //comments_template(); ?>
							
								<a class="comments-load" onclick="loadDisqus(jQuery(this), '<?php the_title(); ?>', '<?php the_permalink() ?>', '<?php the_id(); ?>');">
									<span class="button">Show comments</span>
								</a>

							</div>

						</div>
						<?php //endif; ?>
					</div>
					<?php
					endwhile;
					wp_reset_query(); wp_reset_postdata();
				?>

				<div id="add_pb">
					<a class="close" href="#"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
					<div class="table"><div class="cell middle">
						<div class="box">
							<?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="false"]'); ?>
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

			</div>

			<?php get_template_part( 'template-parts/partials/partial', 'side' ); ?>

		</div>


	</div>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

</article>
