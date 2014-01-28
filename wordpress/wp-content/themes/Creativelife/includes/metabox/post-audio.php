<!-- Metabox container -->
<div class="haku_metabox">
	
	<!-- Input text metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Audio Url', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('url'); ?>

			<input type="text" placeholder="http://" name="<?php $mb->the_name(); ?>" value="<?php echo esc_url( $mb->get_the_value() ); ?>"/>
			
			<span><?php _e('Enter here the url to your .mp3 file.', 'haku'); ?></span>
				
		</div>
		<!-- end: Input column -->
		
		<!-- Local usage -->
		<?php $url = $mb->get_the_value(); ?>

	</div>
	<!-- end: Input text metabox -->
	
</div>
<!-- end: Metabox container -->