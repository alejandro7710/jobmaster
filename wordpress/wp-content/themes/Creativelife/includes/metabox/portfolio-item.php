<!-- Metabox container -->
<div class="haku_metabox">
	
	<!-- Metabox group title -->
	<h4><?php _e('Lightbox', 'haku'); ?></h4>
	
	<!-- Checkbox metabox -->
	<div class="haku_metabox_group">
	
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Use Lightbox', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('lightbox'); ?>

			<input type="checkbox" name="<?php $mb->the_name(); ?>" value="lightbox" <?php $mb->the_checkbox_state('lightbox'); ?>/>

		</div>
		<!-- end: Input column -->
		
		<!-- Local usage -->
		<?php $has_lightbox = $mb->get_the_value(); ?>
		
	</div>
	<!-- end: Checkbox metabox -->
	
	<?php if ( $has_lightbox ) : ?>
	
	<!-- Metabox group title -->
	<h4><?php _e('Lightbox Settings', 'haku'); ?></h4>
	
	<!-- Input text metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Image Url:', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('lightbox_href'); ?>

			<?php $placeholder = ( has_post_thumbnail( $_GET['post'] ) ? get_thumb_src( $_GET['post'], 'full' ) : 'http://' ); ?>

			<input type="text" name="<?php $mb->the_name(); ?>" placeholder="<?php echo $placeholder; ?>" value="<?php echo esc_url( $mb->get_the_value() ); ?>"/>

		</div>
		<!-- end: Input column -->
		
	</div>
	<!-- end: Input text metabox -->
			
	<!-- Input text metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Caption:', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('lightbox_cap'); ?>

			<input type="text" name="<?php $mb->the_name(); ?>" placeholder="<?php echo get_the_title( $_GET['post'] ); ?>" value="<?php $mb->the_value(); ?>"/>

		</div>
		<!-- end: Input column -->
					
	</div>
	<!-- end: Input text metabox -->
	
	<!-- Input text metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Gallery:', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('lightbox_rel'); ?>

			<?php
			$placeholder = array('Venice 2011', 'Summer \'89', 'Project 01', 'John Doe Logo', 'Photographic Set 027', 'Gallery 01', 'Project A', 'Zombies', 'Kittens', 'Bacon', '19 August 2011', 'Gadgets', date_i18n('l'), get_bloginfo('name') );
			$placeholder = __('e.g.', 'haku') . ' ' . $placeholder[ rand( 0, count( $placeholder ) - 1 ) ];
			?>

			<input type="text" name="<?php $mb->the_name(); ?>" placeholder="<?php echo $placeholder; ?>" value="<?php $mb->the_value(); ?>"/>

			<span><?php _e('Use the exact same value on every item you want to group.', 'haku'); ?></span>

		</div>
		<!-- end: Input column -->

	</div>
	<!-- end: Input text metabox -->
		
	<?php endif; ?>
	
	<?php if ( ! $has_lightbox ) : ?>
	
	<!-- Metabox group title -->
	<h4><?php _e('Custom Link', 'haku'); ?></h4>
	
	<!-- Input text metabox -->
	<div class="haku_metabox_group last">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Link to:', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('link'); ?>
			
			<?php $placeholder = ( isset( $_GET['post'] ) ? get_permalink( $_GET['post'] ) : 'http://' ); ?>

			<input type="text" name="<?php $mb->the_name(); ?>" placeholder="<?php echo $placeholder; ?>" value="<?php echo esc_url( $mb->get_the_value() ); ?>"/>

		</div>
		<!-- end: Input column -->
		
	</div>
	<!-- end: Input text metabox -->
	
	<?php endif; ?>
	
</div>
<!-- end: Metabox container -->