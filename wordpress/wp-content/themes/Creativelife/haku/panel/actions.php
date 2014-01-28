<?php
/*
 *  Haku Framework
 *  Handcrafted by Stefano Giliberti
 *  stefanogiliberti@me.com
 */

/***************************/
/*   Save options action   */
function haku_save_options_action() {
	
	/*
		Security check
	*/
	check_ajax_referer('haku_nonce', 'haku_referer');
	
	/*
		Processing
	*/
	$form_contents = $_POST;

	unset( $form_contents['action'], $form_contents['haku_referer'] );
	
	$current_options = get_option( get_haku_var('theme') );
	
	if ( is_array( $current_options ) ) {
		
		if ( array_equal( $current_options, $form_contents ) ) {
			$response = ':)';
		}
		else {
			$response = ( update_option( get_haku_var('theme'), $form_contents ) ? ':)' : haku_error( 1 ) );
		}
	
	}
	else {
		
		$response = ( update_option( get_haku_var('theme'), $form_contents ) ? ':)' : haku_error( 2 ) );
		
	}
		
	/*
		Response
	*/
	die( $response );

}

add_action( 'wp_ajax_haku_save_options', 'haku_save_options_action' );

/****************************/
/*   Reset options action   */
function haku_options_reset_action() {
	
	/*
		Security check
	*/
	check_ajax_referer('haku_nonce', 'haku_referer');
	
	/*
		Processing
	*/
	$current_options = get_option( get_haku_var('theme') );

	if ( is_array( $current_options ) ) {
		$response = ( delete_option( get_haku_var('theme') ) ? ':)' : haku_error( 3 ) );
	}
	else {
		$response = ':)';
	}
	
	/*
		Response
	*/
	die( $response );

}

add_action( 'wp_ajax_haku_options_reset', 'haku_options_reset_action' );

/***************************/
/*   Slides fetch action   */
function haku_load_slides_action() {
	
	/*
		Security check
	*/
	check_ajax_referer('haku_nonce', 'haku_referer');
	
	/*
		Processing
	*/	
	if ( get_theme_slides('theme_slides') ) : ?>

	<!-- Haku sortable -->
	<ul class="haku_sortable">
	
		<?php foreach ( get_theme_slides('theme_slides') as $slide_id => $slide ) : ?>
	
		<li id="haku_el_<?php esc_attr_e( $slide_id ); ?>">
			
			<!-- Form -->
			<form action="/" class="haku_element_update">
				
				<!-- Slide order/id keeper -->
				<input type="text" name="order" class="hidden" value="<?php esc_attr_e( $slide['order'] ); ?>" />
				
				<!-- Element -->
				<div class="haku_element" data-id="<?php esc_attr_e( $slide_id ); ?>">
					
					<!-- Slide template -->
					<?php haku_panel_slide( $slide ); ?>
					
					<!-- Grabbing spot -->
					<div class="haku_grab"></div>
					
					<!-- Delete button -->
					<a href="#" class="haku_drop"></a>
					
				</div>
				<!-- end: Element -->
			
			</form>
			<!-- end: Form -->

		</li>
	
		<?php endforeach; ?>
	
	</ul>
	<!-- end: Haku sortable -->

	<?php

	endif;
	
	/*
		Response
	*/
	die();
	
}

add_action( 'wp_ajax_haku_load_slides', 'haku_load_slides_action' );

/*************************/
/*   Add slides action   */
function haku_add_slide_action() {

	/*
		Security check
	*/
	check_ajax_referer('haku_nonce', 'haku_referer');
	
	/*
		Processing
	*/
	$current_slides = get_option( get_haku_var('theme_slides') );
	
	$current_id = 0;
	
	if ( $current_slides ) {
		$latest_id = array_keys( $current_slides );
		$latest_id = end( $latest_id );
		$current_id = $latest_id;
		$current_id++;
	}
		
	$default_data = haku_panel_slide_data();
	
	$default_data['order'] = $current_id;
			
	$to_update = array();
	
	if ( $current_slides ) {
		$current_values = $current_slides;
		$current_values[] = $default_data;
		$to_update = $current_values;
	}
	else {
		$final_values = $default_data;
		$to_update[] = $final_values;
	}

	if ( update_option( get_haku_var('theme_slides') , $to_update ) ) {

		$response = ':)';
		
	}
	else {
	
		$response = haku_error( 4 );
		
	}
	
	/*
		Response
	*/
	die( $response );
	
}

add_action( 'wp_ajax_haku_add_slide', 'haku_add_slide_action' );

/****************************/
/*   Delete slides action   */
function haku_delete_slide_action() {
	
	/*
		Security check
	*/
	check_ajax_referer('haku_nonce', 'haku_referer');
	
	/*
		Processing
	*/
	$form_contents = $_POST;
	
	unset( $form_contents['action'], $form_contents['haku_referer'] );
	
	$slide_id = $form_contents['id'];
	
	$current_slides = get_option( get_haku_var('theme_slides') );
	
	unset( $current_slides[ $slide_id ] );
	
	if ( update_option(  get_haku_var('theme_slides') , $current_slides ) ) {
	
		$response = ':)';
		
	}
	else {
	
		$response = haku_error( 5 );
		
	}
	
	/*
		Response
	*/
	die( $response );
	
}

add_action( 'wp_ajax_haku_delete_slide', 'haku_delete_slide_action' );

/****************************/
/*   Update slides action   */
function haku_update_slide_action() {
	
	/*
		Security check
	*/
	check_ajax_referer('haku_nonce', 'haku_referer');
	
	/*
		Processing
	*/
	$form_contents = $_POST;
		
	$slide_id = $form_contents['id'];
	
	unset( $form_contents['action'], $form_contents['haku_referer'], $form_contents['id'] );
		
	$current_slides = get_option( get_haku_var('theme_slides') );
	
	$current_slides[ $slide_id ] = $form_contents;
		
	if ( update_option( get_haku_var('theme_slides') , $current_slides ) ) {
		
		$response = ':)';
		
	}
	else {
		
		$response = haku_error( 6 );
		
	}
	
	/*
		Response
	*/
	die( $response );

}

add_action( 'wp_ajax_haku_update_slide', 'haku_update_slide_action' );

/**************************/
/*   Sort slides action   */
function haku_order_slides_action() {
	
	/*
		Security check
	*/
	check_ajax_referer('haku_nonce', 'haku_referer');
	
	/*
		Processing
	*/
	$sort_data = $_POST['order'];
	
	parse_str( $sort_data );
			
	$current_slides = get_option( get_haku_var('theme_slides') );
	
	foreach ( $haku_el as $order => $id ) {
		$current_slides[ $id ]['order'] = $order;
	}
	
	array_reorder( $current_slides, 'order' );
		
	if ( update_option( get_haku_var('theme_slides') , $current_slides ) ) {
	
		$response = ':)';
		
	}
	else {
	
		$response = haku_error( 7 );
	
	}
	
	/*
		Response
	*/
	die( $response );
	
}

add_action( 'wp_ajax_haku_order_slides', 'haku_order_slides_action' );

/*****************************/
/*   Sidebars fetch action   */
function haku_load_sidebars_action() {
	
	/*
		Security check
	*/
	check_ajax_referer('haku_nonce', 'haku_referer');
	
	/*
		Processing
	*/	
	if ( get_theme_slides('theme_sidebars') ) : ?>

	<?php foreach ( get_theme_slides('theme_sidebars') as $sidebar_id => $sidebar ) : ?>
	
	<!-- Form -->
	<form action="/" class="haku_element_update">
		
		<!-- Sidebar id keeper -->
		<input type="text" name="slug" class="hidden" value="<?php esc_attr_e( $sidebar['slug'] ); ?>" />
		
		<!-- Element -->
		<div class="haku_element" data-id="<?php esc_attr_e( $sidebar_id ); ?>">
			
			<!-- Sidebar template -->
			<?php haku_panel_sidebar( $sidebar ); ?>
			
			<!-- Delete button -->
			<a href="#" class="haku_drop"></a>
			
		</div>
		<!-- end: Element -->
	
	</form>
	<!-- end: Form -->
	
	<?php endforeach; ?>

	<?php

	endif;
	
	/*
		Response
	*/
	die();
	
}

add_action( 'wp_ajax_haku_load_sidebars', 'haku_load_sidebars_action' );

/**************************/
/*   Add sidebar action   */
function haku_add_sidebar_action() {

	/*
		Security check
	*/
	check_ajax_referer('haku_nonce', 'haku_referer');
	
	$current_sidebars = get_option( get_haku_var('theme_sidebars') );

	$current_id = 0;
	
	if ( $current_sidebars ) {
		$latest_id = array_keys( $current_sidebars );
		$latest_id = end( $latest_id );
		$current_id = $latest_id;
		$current_id++;
	}
	
	$default_data = array(
		'slug' => haku_get_user( true ) . '_sidebar_' . $current_id,
		'name' => sprintf( esc_attr( __('%s\'s Sidebar', 'haku') ), haku_get_user() ) . ' ' . $current_id,
		'desc' => sprintf( esc_attr( __('Sidebar generated by %s for "%s" using %s!', 'haku') ), haku_get_user(), get_bloginfo('name'), get_haku_var('theme_name') )
	);
		
	$to_update = array();
	
	if ( $current_sidebars ) {
		$current_values = $current_sidebars;
		$current_values[] = $default_data;
		$to_update = $current_values;
	}
	else {
		$final_values = $default_data;
		$to_update[] = $final_values;
	}

	if ( update_option( get_haku_var('theme_sidebars') , $to_update ) ) {

		$response = ':)';
		
	}
	else {
	
		$response = haku_error( 8 );
		
	}
	
	/*
		Response
	*/
	die( $response );
	
}

add_action( 'wp_ajax_haku_add_sidebar', 'haku_add_sidebar_action' );

/*****************************/
/*   Delete sidebar action   */
function haku_delete_sidebar_action() {
	
	/*
		Security check
	*/
	check_ajax_referer('haku_nonce', 'haku_referer');
	
	/*
		Processing
	*/
	$form_contents = $_POST;
	
	unset( $form_contents['action'], $form_contents['haku_referer'] );
	
	$sidebar_id = $form_contents['id'];
	
	$current_sidebars = get_option( get_haku_var('theme_sidebars') );
	
	unset( $current_sidebars[ $sidebar_id ] );
	
	if ( update_option(  get_haku_var('theme_sidebars') , $current_sidebars ) ) {
	
		$response = ':)';
		
	}
	else {
	
		$response = haku_error( 9 );
		
	}
	
	/*
		Response
	*/
	die( $response );
	
}

add_action('wp_ajax_haku_delete_sidebar', 'haku_delete_sidebar_action');

/*****************************/
/*   Update sidebar action   */
function haku_update_sidebar_action() {
	
	/*
		Security check
	*/
	check_ajax_referer('haku_nonce', 'haku_referer');
	
	/*
		Processing
	*/
	$form_contents = $_POST;
		
	$sidebar_id = $form_contents['id'];
	
	unset( $form_contents['action'], $form_contents['haku_referer'], $form_contents['id'] );
		
	$current_sidebars = get_option( get_haku_var('theme_sidebars') );
	
	$current_sidebars[ $sidebar_id ] = $form_contents;
		
	if ( update_option( get_haku_var('theme_sidebars') , $current_sidebars ) ) {
		
		$response = ':)';
		
	}
	else {
		
		$response = haku_error( 10 );
		
	}
	
	/*
		Response
	*/
	die( $response );

}

add_action( 'wp_ajax_haku_update_sidebar', 'haku_update_sidebar_action' );

?>