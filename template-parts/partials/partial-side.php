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

						if (get_field( 'Special_Offer', 'option' )): ?>
						<a href="<?php the_field( 'Special_Offer_Link', 'option' ); ?>">
							<?php $advert = get_field( 'Special_Offer', 'option' ); ?>
							<img src="<?php echo $advert['url']; ?>">
						</a>
						<?php endif;

				    endwhile;
				endif;
				?>				
			</div>