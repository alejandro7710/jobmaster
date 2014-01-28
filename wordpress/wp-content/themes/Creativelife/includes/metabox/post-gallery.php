<!-- Metabox container -->
<div class="haku_metabox">
	
	<!-- Select box metabox -->
	<div class="haku_metabox_group">
		
		<!-- Info column -->
		<div class="aside">

			<label><?php _e('Transition Effect', 'haku'); ?></label>

		</div>
		<!-- end: Info column -->
		
		<!-- Input column -->
		<div class="section">

			<?php $mb->the_field('fx'); ?>

			<select name="<?php $mb->the_name(); ?>">
				<option value=""><?php _e('Choose an option', 'haku'); ?></option>
				<option value="fade" <?php $mb->the_select_state('fade'); ?>><?php _e('Fade', 'haku'); ?></option>
				<option value="fadeout" <?php $mb->the_select_state('fadeout'); ?>><?php _e('Fade Out', 'haku'); ?></option>
				<option value="scrollVert" <?php $mb->the_select_state('scrollVert'); ?>><?php _e('Scroll Vertically', 'haku'); ?></option>
				<option value="scrollHorz" <?php $mb->the_select_state('scrollHorz'); ?>><?php _e('Scroll Horizontally', 'haku'); ?></option>
				<option value="zoom" <?php $mb->the_select_state('zoom'); ?>><?php _e('Zoom', 'haku'); ?></option>
				<option value="fadeZoom" <?php $mb->the_select_state('fadeZoom'); ?>><?php _e('Fade Zoom', 'haku'); ?></option>
				<option value="blindX" <?php $mb->the_select_state('blindX'); ?>><?php _e('Cover Horizontally', 'haku'); ?></option>
				<option value="blindY" <?php $mb->the_select_state('blindY'); ?>><?php _e('Cover Vertically', 'haku'); ?></option>
				<option value="blindZ" <?php $mb->the_select_state('blindZ'); ?>><?php _e('Cover Diagonally', 'haku'); ?></option>
				<option value="uncover" <?php $mb->the_select_state('uncover'); ?>><?php _e('Uncover', 'haku'); ?></option>
			</select>

		</div>
		<!-- end: Input column -->
	
	</div>
	<!-- end: Select box metabox -->
	
	<hr />
	
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
				<option value="menu_order" <?php $mb->the_select_state('menu_order'); ?>><?php _e('Menu order', 'haku'); ?></option>
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