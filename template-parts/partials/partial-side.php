			<div class="span4 side">
			
				<h2>BULLPEN OPENING TIMES</h2>
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
			
				<h2>SPECIAL OFFER</h2>
				<?php
				if( have_rows('special_offers', 'option') ):
				    while ( have_rows('special_offers', 'option') ) : the_row();

						?>
						<div style="width: 50%; float: left;">
						<a href="<?php the_sub_field( 'Special_Offer_Link', 'option' ); ?>">
							<?php $advert = get_sub_field( 'special_offer', 'option' ); ?>
							<img src="<?php echo $advert['url']; ?>">
						</a>
						</div>
						<?php

				    endwhile;
				endif;
				?>				
			</div>