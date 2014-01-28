<?php
/*
 *  Haku Framework
 *  Handcrafted by Stefano Giliberti
 *  stefanogiliberti@me.com
 */

/****************************/
/*   Options form opening   */
function haku_panel_options() {
	?>
	
	<!-- Form -->
	<form id="haku_options_form">
	
	<?php
}

/****************************/
/*   Options form closing   */
function haku_panel_options_close() {
	?>
	
	</form>
	<!-- end: Form -->
	
	<?php
}

/***************************/
/*   Options tab opening   */
function haku_panel_tab( $tab_name = null, $classes = array( 'section', 'haku_options' ) ) {
	?>
	
	<!-- Tab -->
	<div class="<?php esc_attr_e( implode( ' ', $classes ) ); ?>" data-tab="<?php esc_attr_e( $tab_name ); ?>">
	
	<?php
}

/***************************/
/*   Options tab closing   */
function haku_panel_tab_close() {
	?>

	</div>
	<!-- end: Tab -->
	
	<?php
}

/*****************************/
/*   Options group opening   */
function haku_panel_group( $father = false, $child = false, $classes = array( 'haku_optgroup', 'clearfix' ), $raw = false ) {
	if ( $child ) $option = ( $raw !== false ? $raw : get_theme_option( $child, false ) );
	if ( $child && ! $option ) $classes[] = 'hidden';
	?>
	
	<!-- Option group -->
	<div class="<?php esc_attr_e( implode( ' ', $classes ) ); ?>" <?php if ( $father ) echo 'data-father="' . $father . '"'; ?> <?php if ( $child ) echo 'data-child="' . $child . '"'; ?>>
	
	<?php
}

/*****************************/
/*   Options group closing   */
function haku_panel_group_close() {
	?>

		</div>
		<!-- end: Option -->
							
	</div>
	<!-- end: Option group -->
	
	<?php
}

/***************************/
/*   Options group label   */
function haku_panel_label( $text ) {
	?>
	
	<!-- Option info -->
	<div class="aside">
	
		<!-- Label -->
		<label><?php echo $text; ?></label>
		
	</div>
	<!-- end: Option info -->
	
	<?php
}

/********************/
/*   Media option   */
function haku_panel_media( $option_name, $placeholder = 'http://', $classes = array( 'haku_image_upload_field' ), $raw = false ) {
	$option = ( $raw !== false ? $raw : get_theme_option( $option_name ) );
	if ( ! $option ) $classes[] = 'hidden';
	?>
	
	<!-- Option -->
	<div>
		
		<!-- Button -->						
		<button class="haku_image_upload"><?php _e('Open Media Library', 'haku') ?></button>
		
		<!-- Toggle input -->
		<a href="#" class="haku_toggle_input"></a>
		
		<!-- Real input -->
		<input type="text" placeholder="<?php esc_attr_e( $placeholder ); ?>" class="<?php esc_attr_e( implode( ' ', $classes ) ); ?>" name="<?php esc_attr_e( $option_name ); ?>" value="<?php echo esc_url( $option ); ?>" />
	
	<?php
}

/***********************/
/*   Checkbox option   */
function haku_panel_checkbox( $option_name, $classes = array( 'haku_checkbox' ), $raw = false ) {
	?>
	
	<!-- Option -->
	<div>
		
		<!-- Checkbox -->
		<a href="#" class="<?php esc_attr_e( implode( ' ', $classes ) ); ?>"></a>
		
		<!-- Real input -->
		<input <?php haku_checked( $option_name, $raw ); ?> name="<?php esc_attr_e( $option_name ); ?>" type="checkbox" value="<?php esc_attr_e( $option_name ); ?>" />
	
	<?php
}

/*************************/
/*   Input text option   */
function haku_panel_text( $option_name, $placeholder = null, $raw = false ) {
	$option = ( $raw !== false ? $raw : get_theme_option( $option_name ) );
	?>
	
	<!-- Option -->
	<div>
		
		<!-- Text input -->
		<input type="text" placeholder="<?php esc_attr_e( $placeholder ); ?>" name="<?php esc_attr_e( $option_name ); ?>" value="<?php esc_attr_e( $option ); ?>" />
	
	<?php
}

/***********************/
/*   Textarea option   */
function haku_panel_textarea( $option_name, $placeholder = null, $raw = false ) {
	$option = ( $raw !== false ? $raw : get_theme_option( $option_name ) );
	?>
	
	<!-- Option -->
	<div>
		
		<!-- Textarea -->
		<textarea placeholder="<?php esc_attr_e( $placeholder ); ?>" name="<?php esc_attr_e( $option_name ); ?>"><?php echo esc_textarea( $option ); ?></textarea>
	
	<?php
}

/*********************/
/*   Slider option   */
function haku_panel_slider( $option_name, $min = 1, $max = 5000, $step = 1, $value = 'pixels' ) {
	?>
	
	<!-- Option -->
	<div>
		
		<!-- Slider -->
		<div class="haku_slider" data-min="<?php esc_attr_e( $min ); ?>" data-max="<?php esc_attr_e( $max ); ?>" data-step="<?php esc_attr_e( $step ); ?>"></div>
		
		<!-- Slider's tip -->
		<span class="haku_slider_tip" data-label="<?php esc_attr_e( strtolower( $value ) ); ?>"><?php theme_option( $option_name ); ?> <?php echo strtolower( $value ); ?></span>
		
		<!-- Real input -->
		<input type="text" class="hidden" name="<?php esc_attr_e( $option_name ); ?>" value="<?php esc_attr_e( get_theme_option( $option_name ) ); ?>" />
	
	<?php
}

/*************************/
/*   Select box option   */
function haku_panel_select( $option_name, $option_list = array(), $classes = array( 'chzn-select' ), $raw = false ) {
	?>
	
	<!-- Option -->
	<div>
		
		<!-- Haku select box -->
		<select name="<?php esc_attr_e( $option_name ); ?>" class="<?php esc_attr_e( implode( ' ', $classes ) ); ?>">
			
			<?php foreach ( $option_list as $option_id => $option ) : ?>
						
			<option <?php haku_selected( $option_name, $option_id, $raw ); ?> value="<?php esc_attr_e( $option_id ); ?>"><?php echo $option; ?></option>
				
			<?php endforeach; ?>

		</select>
	
	<?php
}

/***************************/
/*   Color picker option   */
function haku_panel_picker( $option_name ) {
	?>
	
	<!-- Option -->
	<div>
		
		<!-- Picker -->
		<a href="#" class="haku_picker"></a>
		
		<!-- Real input -->
		<input type="text" name="<?php esc_attr_e( $option_name ) ?>" class="hidden" value="<?php esc_attr_e( get_theme_option( $option_name ) ); ?>" />
	
	<?php
}

/***********************/
/*   Radiopic option   */
function haku_panel_radiopic( $option_name, $option_list = array(), $classes = array( 'haku_radiopic_select', 'hidden' ), $raw = false ) {
	?>
	
	<!-- Option -->
	<div>
		
		<!-- Haku radio list -->
		<div class="haku_radiopic_list"></div>
		
		<!-- Real input -->
		<select name="<?php esc_attr_e( $option_name ); ?>" class="<?php esc_attr_e( implode( ' ', $classes ) ); ?>">
		
			<?php foreach ( $option_list as $option_id => $option_image_url ) : ?>
						
			<option <?php haku_selected( $option_name, $option_id, $raw ); ?> data-radiopic="<?php esc_attr_e( $option_image_url ); ?>" value="<?php esc_attr_e( $option_id ); ?>"></option>
			
			<?php endforeach; ?>

		</select>
	
	<?php
}

/******************************/
/*   Multiple select option   */
function haku_panel_multi_select( $option_name, $placeholder = null, $option_list = array() ) {
	?>
	
	<!-- Option -->
	<div>
		
		<!-- Haku multiple select box -->
		<select multiple data-placeholder="<?php esc_attr_e( $placeholder ); ?>" name="<?php esc_attr_e( $option_name ); ?>[]" class="chzn-select">
			
			<?php foreach ( $option_list as $option_id => $option ) : ?>
			
			<option <?php haku_multiple_selected( $option_name, $option_id ); ?> value="<?php esc_attr_e( $option_id ); ?>"><?php echo $option; ?></option>
			
			<?php endforeach; ?>
			
		</select>
	
	<?php
}

/**********************/
/*   Slides manager   */
function haku_panel_slides_manager( $name, $new_slide ) {
	?>
	
	<!-- Slides manager -->
	<div class="haku_slides">
		
		<!-- Slides container -->
		<div> 
		
			<!-- Options header -->
			<h1><?php echo $name; ?></h1>
			
			<!-- Slides container -->
			<div id="haku_slides_container"></div>
			
			<!-- Add button -->
			<a href="#" id="haku_add_slide" class="haku_button"><?php echo $new_slide; ?></a>
		
		<!-- end: Slides container -->
		</div>
		
		<!-- Back to options -->
		<?php haku_panel_slides_switch( __('&larr; Back', 'haku') ); ?>
		
	</div>
	<!-- end: Slides manager -->
	
	<?php
}

/*******************************/
/*   Slides manager switcher   */
function haku_panel_slides_switch( $label ) {
	?>
	
	<!-- Slides manager switch -->
	<a href="#" class="haku_slides_switch"><?php echo $label; ?></a>
	
	<?php
}

/************************************/
/*   Default slides configuration   */
function haku_panel_slide_data() {
	if ( function_exists('theme_slide_data') ) {
		return theme_slide_data();
	}
	else {
		return array(
			'picture' => null,
			'content' => null,
			'lightbox' => null
		);
	}
}

/*******************************/
/*   Default slides template   */
function haku_panel_slide( $slide ) {
	if ( function_exists('theme_slides_set') ) {
		theme_slides_set( $slide );
	}
	else {
	?>
		
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Picture', 'haku') ); ?>
		
		<!-- Media option -->
		<?php haku_panel_media( 'picture', 'http://', array( 'haku_image_upload_field', 'trigger_change' ), stripslashes( $slide['picture'] ) ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Content', 'haku') ); ?>
		
		<!-- Textarea option -->
		<?php haku_panel_textarea( 'content', '', $slide['content'] ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Lightbox', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'lightbox', array( 'haku_checkbox', 'trigger_change' ), ( isset( $slide['lightbox'] ) ? $slide['lightbox'] : null ) ); ?>
			
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
		
	<?php
	}
}

/*************************/
/*   Sidebar generator   */
function haku_panel_sidebar_generator( $name, $heading, $label ) {
	?>
	
	<!-- Tab -->
	<?php haku_panel_tab( $name, array( 'section', 'haku_sidebars', 'haku_manager' ) ); ?>
		
		<!-- Options header -->
		<h1><?php echo $heading; ?></h1>
		
		<!-- Slides container -->
		<div id="haku_sidebars_container"></div>
		
		<!-- Add button -->
		<a href="#" id="haku_add_sidebar" class="haku_button"><?php echo $label; ?></a>
		
	<?php haku_panel_tab_close(); ?>
	<!-- end: Tab -->
	
	<?php
}

/************************/
/*   Sidebars template   */
function haku_panel_sidebar( $sidebar ) {
	if ( function_exists('theme_sidebars_set') ) {
		theme_sidebars_set( $sidebar );
	}
	else {
	?>
	
	<!-- Sidebar header -->
	<div class="header">
		
		<!-- Title -->
		<input type="text" name="name" value="<?php esc_attr_e( stripslashes( $sidebar['name'] ) ); ?>" />
		
		<!-- Id -->
		<span data-tip="<?php esc_attr_e( sprintf( __('Usage: %s', 'haku'), '[sidebar id=' . $sidebar['slug'] . ']' ) ); ?>"><?php echo $sidebar['slug']; ?></span>
		
	</div>
	<!-- end: Sidebar header -->
	
	<!-- Sidebar description -->
	<input type="text" name="desc" value="<?php esc_attr_e( stripslashes( $sidebar['desc'] ) ); ?>" maxlength="85" />
	
	<?php
	}
}

?>