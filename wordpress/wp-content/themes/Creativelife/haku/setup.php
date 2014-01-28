<?php 
/*
 *  Haku Framework
 *  Handcrafted by Stefano Giliberti
 *  stefanogiliberti@me.com
 */

/********************/
/*   Main configs   */
$haku = array(
	
	'$' => '3.3',
	'.' => TEMPLATEPATH . '/haku',
	'includes' => TEMPLATEPATH . '/haku/includes',
	'includes_uri' => get_template_directory_uri() . '/haku/includes',
	'panel' => TEMPLATEPATH . '/haku/panel',
	'panel_uri' => get_template_directory_uri() . '/haku/panel',
	'panel_includes_uri' => get_template_directory_uri() . '/haku/panel/includes',
	
	'panel_docs_uri' => get_stylesheet_directory_uri() . '/docs/Help.html',
	'panel_shortcodes_uri' => get_stylesheet_directory_uri() . '/docs/Help.html#shortcodesList',
	'panel_support_uri' => 'http://help.opendept.net',
	
	'str_error' => __("Sorry, there was an unxpected error - try again. \n\nIf this error keeps annoying you, please, contact the theme's developer Stefano at stefanogiliberti@me.com. Thanks! \n\nError code: %s", 'haku')

);

$haku = array_merge( $theme_config, $haku );

/***************************/
/*   Framework functions   */
require_once( $haku['includes'] . '/helper.php' );

/***************************/
/*   Theme options panel   */
require_once( $haku['panel'] . '/setup.php' );

/********************************/
/*   WP Alchemy metabox class   */
require_once( $haku['includes'] . '/metabox.php' );

/****************************/
/*   Metaboxes appearance   */
function haku_metaboxes_styles() {
	wp_register_style( 'haku_metabox_css', get_haku_var('includes_uri') . '/metabox/metabox.css', '', get_haku_var('$') );
	wp_enqueue_style( 'haku_metabox_css' );
}

function haku_metaboxes_javascript() {
	wp_register_script( 'haku_metabox_js', get_haku_var('includes_uri') . '/metabox/metabox.js', '', get_haku_var('$') );
	wp_register_script( 'theme_metabox_js', get_includes_dir('uri') . '/metabox/includes/metabox.js', '', get_theme_version() );
	wp_enqueue_script( 'haku_metabox_js' );
	wp_enqueue_script( 'theme_metabox_js' );
}

if ( is_wp_edit() ) {
	add_action( 'admin_print_styles', 'haku_metaboxes_styles' );
	add_action( 'admin_enqueue_scripts', 'haku_metaboxes_javascript' );
}

?>