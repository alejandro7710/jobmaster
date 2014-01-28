<!-- Metabox container -->
<div class="haku_metabox">
	
	<!-- Input text metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Image Url:', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('url'); ?>

			<?php $placeholder = ( get_theme_option('body_background_url') ? esc_url( get_theme_option('body_background_url') ) : get_stylesheet_directory_uri() . '/images/patterns/' . get_theme_option('body_background_pattern') . '.png' ); ?>

			<input type="text" name="<?php $mb->the_name(); ?>" placeholder="<?php echo $placeholder; ?>" value="<?php echo esc_url( $mb->get_the_value() ); ?>"/>

		</div>
		<!-- end: Input column -->
		
	</div>
	<!-- end: Input text metabox -->
	
</div>
<!-- end: Metabox container -->