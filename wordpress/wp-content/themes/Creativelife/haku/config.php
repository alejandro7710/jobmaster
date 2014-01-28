<?php 
/*
 *  Haku Framework
 *  Handcrafted by Stefano Giliberti
 *  stefanogiliberti@me.com
 */

/*********************/
/*   Theme configs   */
$theme_config = array(
	
	'theme_name' => 'Creativelife',
	'theme' => 'creativelife',
	'theme_slides' => 'cl_slides',
	'theme_sidebars' => 'cl_sidebars',
	'theme_includes' => TEMPLATEPATH . '/includes',
	'theme_includes_uri' => get_template_directory_uri() . '/includes',
	'theme_xml' => 'http://version.opendept.net/creativelife.xml'
	
);

/*****************************/
/*   Default theme options   */
$theme_defaults = array(

	'use_plain_logo' => true,
	'plain_logo_text' => 'Creative[color]life[/color]',
	'logo_image' => null,
	'favicon' =>  get_stylesheet_directory_uri() . '/images/etc/favicon.ico',
	'footer_info' => '&copy; 2012 Creativelife. Powered by WordPress<br />' . "\n" . '[link url=http://themes.opendept.net/creativelife]Creativelife Theme[/link] by [link url=http://opendept.net]The Open Dept.[/link]',
	'analytics_code' => null,
	
	'social_bar' => true,
	'social_about' => true,
	'social_about_label' => 'About Me',
	'social_about_col_1' => '<h1>I am [color]John Doe[/color].</h1>',
	'social_about_col_2' => '<h1>[color]Services[/color].</h1>' . "\n" . '<h5>Web Design</h5>',
	'social_about_col_3' => '<h1>[color]Skills[/color].</h1>' . "\n" . '[skills-container]' . "\n" . '[skill label="Awesomeness" val=100%]' . "\n" . '[/skills-container]',
	'social_twitter' => null,
	'social_facebook' => null,
	'social_google' => null,
	'social_pinterest' => null,
	'social_vimeo' => null,
	'social_flickr' => null,
	'social_dribbble' => null,
	'social_forrst' => null,
	'social_lastfm' => null,
	'social_tumblr' => null,
	'social_linkedin' => null,
	'social_behance' => null,
	'social_delicious' => null,
	'social_deviantart' => null,
	'social_skype' => null,
	'social_youtube' => null,
	'social_contact' => true,
	'social_contact_sendto' => null,
	'social_contact_sender' => null,
	'social_contact_col_1' => '<h1>Who are [color]you[/color]?</h1>',
	'social_contact_col_2' => '<h1>Please, [color]tell me[/color].</h1>',
	'social_contact_col_3' => '<h1>The [color]map[/color].</h1>',
	
	'hero' => true,
	'hero_fx' => 'scrollVert',
	'hero_speed' => 300,
	'hero_easing' => 'linear',
	'hero_timeout' => 0,
	'hero_pause' => true,
	'hero_pager' => true,
	'latest_work' => true,
	'latest_work_portfolio' => null,
	'latest_work_number' => 3,
	'latest_work_orderby' => 'date',
	'latest_work_title' => 'Latest [color]Works[/color]',
	
	'font_family' => '"HelveticaNeue", "Helvetica-Neue", "Helvetica Neue", Helvetica, Arial, sans-serif',
	'body_font_size' => 12,
	'body_line_height' => 17,
	'body_color' => '#101010',
	'key_color' => '#bf3228',
	'background_color' => '#101010',
	'background_color_opacity' => .9,
	'contrast_color' => '#ffffff',
	'contrast_color_opacity' => .9,
	'neutral_color' => '#999999',
	'body_background_color' => '#dbdbdb',
	'body_background_image' => false,
	'body_background_pattern' => 2,
	'body_background_url' => null,
	'body_background_stretch' => false,
	'css_code' => null,
	
	'default_layout' => 'left',
	'gallery_speed' => 250,
	'gallery_fx' => 'scrollVert',
	'gallery_easing' => 'linear',
	'gallery_timeout' => 5000,
	'gallery_pause' => true,
	'gallery_pager' => true,
	'page_responses' => false,
	'post_trackbacks' => false,
	'portfolio_similar' => true,
	'portfolio_responses' => false,
		
	'exclude_category' => null,
	'wp_login_logo' => get_stylesheet_directory_uri() . '/includes/images/dashboard/wp_login_logo.png',
	'wp_gravatar' => get_stylesheet_directory_uri() . '/images/etc/gravatar.png',
	'viewport' => 1100,
	'jquery_local' => false,
	'theme_update' => false
	
);

/***************************/
/*   Haku framework init   */
require_once( TEMPLATEPATH . '/haku/setup.php' );

/*********************/
/*   Theme options   */
require_once( get_haku_var('.') . '/options.php' );

?>