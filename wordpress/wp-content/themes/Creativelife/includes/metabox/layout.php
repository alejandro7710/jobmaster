<!-- Metabox container -->
<div class="haku_metabox">
	
	<?php if ( ! isset( $_GET['post'] ) || isset( $_GET['post'] ) && ! meta_obtain( 'no_sidebar', '_cl_layout', $_GET['post'] ) ) : ?>
	
	<!-- Checkbox metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Invert Sidebar Position', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('sidebar_invert'); ?>

			<input type="checkbox" name="<?php $mb->the_name(); ?>" value="sidebar_invert" <?php $mb->the_checkbox_state('sidebar_invert'); ?>/>
	
		</div>
		<!-- end: Input column -->
		
	</div>
	<!-- end: Checkbox metabox -->
	
	<hr />
	
	<?php endif; ?>
		
	<?php if ( ! isset( $_GET['post'] ) || isset( $_GET['post'] ) && get_post_type( $_GET['post'] ) != 'post' ) : ?>
	
	<!-- Checkbox metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Hide Sidebar', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('no_sidebar'); ?>

			<input type="checkbox" name="<?php $mb->the_name(); ?>" value="no_sidebar" <?php $mb->the_checkbox_state('no_sidebar'); ?>/>

		</div>
		<!-- end: Input column -->
		
	</div>
	<!-- end: Checkbox metabox -->
	
	<?php endif; ?>
		
	<?php if ( ! isset( $_GET['post'] ) || isset( $_GET['post'] ) && ! meta_obtain( 'no_sidebar', '_cl_layout', $_GET['post'] ) ) : ?>
		
	<!-- Select box metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Sidebar:', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('sidebar'); ?>

			<select name="<?php $mb->the_name(); ?>">
			
				<?php foreach ( haku_list_sidebars() as $sidebar ) : ?>
				
					<option value="<?php echo $sidebar; ?>" <?php $mb->the_select_state( $sidebar ); ?>><?php echo $sidebar; ?></option>
					
				<?php endforeach; ?>
				
			</select>

		</div>
		<!-- end: Input column -->
		
	</div>
	<!-- end: Select box metabox -->
			
	<?php endif; ?>
	
</div>
<!-- end: Metabox container -->