			<div class="span4 side">

				<div class="notmap">
					<h2>CONTACT INFO</h2>
					<div class="phone box">
						<dl>
							<dt>GENERL ENQUIRIES</dt>
							<dd><?php the_field( 'phone_number', 'option' ); ?></dd>
							<dt>EMAIL ENQUIRIOES</dt>
							<dd><?php the_field( 'email', 'option' ); ?></dd>
						</dl>
					</div>

					<h2>OPENING TIMES</h2>
					<div class="times box">
						<dl>
						<?php 
						if(have_rows('Opening_Times', 'option')) {
							while(have_rows('Opening_Times', 'option')) : the_row();
							?>
								<dt><?php the_sub_field( 'Days', 'option' ); ?></dt>
								<dd><?php the_sub_field( 'Time', 'option' ); ?></dd>
							<?php
							endwhile;
						} 
						?>
						</dl>
					</div>
				</div>

				<div class="location box">
					<?php 
					$location = get_field('location','option');
					if( !empty($location) ):
					?>
					<div class="map">
						<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
					</div>
					<?php endif; ?>
				</div>
				
				
			</div>