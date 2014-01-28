<!-- Metabox container -->
<div class="haku_metabox">

	<!-- Metabox group title -->
	<h4><?php _e('General settings', 'haku'); ?></h4>
	
	<!-- Select box metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Layout:', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('layout'); ?>

			<select name="<?php $mb->the_name(); ?>">
				<option value=""><?php _e('Choose an option', 'haku'); ?></option>
				<option value="2" <?php $mb->the_select_state('2'); ?>><?php _e('2 Columns', 'haku'); ?></option>
				<option value="3" <?php $mb->the_select_state('3'); ?>><?php _e('3 Columns', 'haku'); ?></option>
				<option value="4" <?php $mb->the_select_state('4'); ?>><?php _e('4 Columns', 'haku'); ?></option>
				<option value="5" <?php $mb->the_select_state('5'); ?>><?php _e('5 Columns', 'haku'); ?></option>
			</select>

		</div>
		<!-- end: Input column -->
		
		<!-- Local usage -->
		<?php $current_layout = ( $mb->get_the_value() ? $mb->get_the_value() : 3 ); ?>
		
	</div>
	<!-- end: Select box metabox -->
		
	<!-- Input text metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Items per page:', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('ipp'); ?>

			<input type="text" name="<?php $mb->the_name(); ?>" placeholder="9" value="<?php $mb->the_value(); ?>"/>

			<span><?php _e('The number of items to show in each page.', 'haku'); ?> (Default: 9, <strong><?php _e('Total items:', 'haku'); ?> <?php echo get_theme_post_type_posts( $_GET['post'] ); ?></strong>)</span>

		</div>
		<!-- end: Input column -->
		
	</div>
	<!-- end: Input text metabox -->
	
	<!-- Input text metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Images height:', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('height'); ?>

			<?php 
			switch ( $current_layout ) {
				case '2':
					$height = 260;
				break;
				case '3':
					$height = 220;
				break;
				case '4':
					$height = 155;
				break;
				case '5':
					$height = 182;
				break;
			}
			?>

			<input type="text" name="<?php $mb->the_name(); ?>" placeholder="<?php echo $height; ?>" value="<?php $mb->the_value(); ?>"/>

			<span><?php _e('After changing this value you must rebuild the WordPress Thumbnails using an external WordPress plugin.', 'haku'); ?> (<a href="<?php echo get_stylesheet_directory_uri(); ?>/docs/Help.html#thumbnails" target="_blank">?</a>)</span>

		</div>
		<!-- end: Input column -->
		
	</div>
	<!-- end: Input text metabox -->
	
	<hr />
	
	<!-- Checkbox metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Disable Tools', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('no_tools'); ?>

			<input type="checkbox" name="<?php $mb->the_name(); ?>" value="no_tools" <?php $mb->the_checkbox_state('no_tools'); ?>/>
			<span><?php _e('Disable Filtering and Instant Pagination.', 'haku'); ?></span>

		</div>
		<!-- end: Input column -->

		<!-- Local usage -->
		<?php $current_tools_are_off = $mb->get_the_value(); ?>
		
	</div>
	<!-- end: Checkbox metabox -->
	
	<?php if ( ! $current_tools_are_off ) : ?>
	
	<!-- Metabox group title -->
	<h4><?php _e('Tools', 'haku'); ?></h4>
	
	<!-- Checkbox metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Disable Url Change', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('no_hash'); ?>

			<input type="checkbox" name="<?php $mb->the_name(); ?>" value="no_hash" <?php $mb->the_checkbox_state('no_hash'); ?>/>

		</div>
		<!-- end: Input column -->
		
	</div>
	<!-- end: Checkbox metabox -->
	
	<?php endif; ?>
		
	<!-- Metabox group title -->
	<h4><?php _e('Ordering', 'haku'); ?></h4>
	
	<!-- Select box metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Order items by', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('orderby'); ?>

			<select name="<?php $mb->the_name(); ?>">
				<option value="date" <?php $mb->the_select_state('date'); ?>><?php _e('Date', 'haku'); ?></option>
				<option value="ID" <?php $mb->the_select_state('ID'); ?>>ID</option>
				<option value="title" <?php $mb->the_select_state('title'); ?>><?php _e('Title', 'haku'); ?></option>
				<option value="rand" <?php $mb->the_select_state('rand'); ?>><?php _e('Random', 'haku'); ?></option>
				<option value="modified" <?php $mb->the_select_state('modified'); ?>><?php _e('Last modified date', 'haku'); ?></option>
			</select>

		</div>
		<!-- end: Input column -->

		<!-- Local usage -->
		<?php $is_current_order_random = ( $mb->get_the_value() == 'rand' ? true : false ); ?>
	
	</div>
	<!-- end: Select box metabox -->
	
	<?php if ( ! $is_current_order_random ) : ?>
	
	<!-- Select box metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Items order:', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('order'); ?>

			<select name="<?php $mb->the_name(); ?>">
				<option value="DESC" <?php $mb->the_select_state('DESC'); ?>><?php _e('Descending', 'haku'); ?></option>
				<option value="ASC" <?php $mb->the_select_state('ASC'); ?>><?php _e('Ascending', 'haku'); ?></option>
			</select>

		</div>
		<!-- end: Input column -->
	
	</div>
	<!-- end: Select box metabox -->
	
	<?php endif; ?>
	
</div>
<!-- end: Metabox container -->