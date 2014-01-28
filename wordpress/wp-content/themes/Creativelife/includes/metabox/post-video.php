<!-- Metabox container -->
<div class="haku_metabox">
	
	<!-- Input text metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Video Url', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('url'); ?>

			<input type="text" placeholder="http://" name="<?php $mb->the_name(); ?>" value="<?php echo esc_url( $mb->get_the_value() ); ?>"/>
			
			<span><?php _e('Paste here your Youtube or Vimeo video url.', 'haku'); ?></span>
			
		</div>
		<!-- end: Input column -->

	</div>
	<!-- end: Input text metabox -->
	
	<!-- Input text metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Video Size', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('size'); ?>
			
			<?php $placeholder = ( isset( $_GET['post'] ) && is_theme_post_type( $_GET['post'] ) || isset( $_GET['post_type'] ) ? '950x513' : '470x269' ); ?>

			<input type="text" placeholder="<?php echo $placeholder; ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						
		</div>
		<!-- end: Input column -->

	</div>
	<!-- end: Input text metabox -->
	
</div>
<!-- end: Metabox container -->