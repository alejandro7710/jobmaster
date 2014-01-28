<?php
/*****************************/
/*   Post format metaboxes   */
$format_support = get_theme_portfolio_pages();
array_push( $format_support, 'post' );

/*****************************/
/*   Gallery posts metabox   */
$cl_format_gallery = array(
	'id' => '_cl_format_gallery',
	'title' => esc_attr( __('Gallery Settings', 'haku') ),
	'types' => $format_support,
	'priority' => 'low',
	'template' => get_includes_dir() . '/metabox/post-gallery.php'
);

$cl_format_gallery = new WPAlchemy_MetaBox( $cl_format_gallery );

/***************************/
/*   Video posts metabox   */
$cl_format_video = array(
	'id' => '_cl_format_video',
	'title' => esc_attr( __('Video Settings', 'haku') ),
	'types' => $format_support,
	'priority' => 'low',
	'template' => get_includes_dir() . '/metabox/post-video.php'
);

$cl_format_video = new WPAlchemy_MetaBox( $cl_format_video );

/***************************/
/*   Audio posts metabox   */
$cl_format_audio = array(
	'id' => '_cl_format_audio',
	'title' => esc_attr( __('Audio Settings', 'haku') ),
	'types' => $format_support,
	'priority' => 'low',
	'template' => get_includes_dir() . '/metabox/post-audio.php'
);

$cl_format_audio = new WPAlchemy_MetaBox( $cl_format_audio );

/**********************/
/*   Layout metabox   */
$layout_support = $format_support;
array_push( $layout_support, 'page' );

$cl_layout = array(
	'id' => '_cl_layout',
	'title' => esc_attr( __('Layout Settings', 'haku') ),
	'types' => $layout_support,
	'priority' => 'low',
	'exclude_template' => 'portfolio.php',
	'template' => get_includes_dir() . '/metabox/layout.php'
);

$cl_layout = new WPAlchemy_MetaBox( $cl_layout );

/********************************/
/*   Background image metabox   */
if ( get_theme_option('body_background_image') && get_theme_option('body_background_stretch') ) {

	$cl_background = array(
		'id' => '_cl_background',
		'title' => esc_attr( __('Background Image', 'haku') ),
		'types' => $layout_support,
		'priority' => 'low',
		'template' => get_includes_dir() . '/metabox/background.php'
	);

	$cl_background = new WPAlchemy_MetaBox( $cl_background );
	
}

/*************************/
/*   Portfolio metabox   */
$cl_portfolio_settings = array(
	'id' => '_cl_portfolio_settings',
	'title' => __('Portfolio Settings', 'haku'),
	'types' => array('page'),
	'hide_editor' => true,
	'priority' => 'high',
	'include_template' => 'portfolio.php',
	'template' => get_includes_dir() . '/metabox/portfolio.php'
);

$cl_portfolio_settings = new WPAlchemy_MetaBox( $cl_portfolio_settings );

/******************************/
/*   Portfolio item metabox   */
$nasc_portfolio_item_settings = array(
	'id' => '_cl_portfolio_item_settings',
	'title' => __('Item Settings', 'haku'),
	'types' => get_theme_portfolio_pages(),
	'priority' => 'low',
	'template' => get_includes_dir() . '/metabox/portfolio-item.php'
);

$nasc_portfolio_item_settings = new WPAlchemy_MetaBox( $nasc_portfolio_item_settings );

?>