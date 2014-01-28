<?php
/*
 *  Haku Framework
 *  Handcrafted by Stefano Giliberti
 *  stefanogiliberti@me.com
 */

/***********************/
/*   Slides defaults   */
function theme_slide_data() {
	return array(
		'picture' => null,
		'content' => null,
		'url' => null,
		'linkto' => null
	);
}

/***********************/
/*   Slides defaults   */
function theme_slides_set( $slide ) {
	?>
		
	<?php if ( haku_get_url_type( $slide['url'] ) == 'youtube' || haku_get_url_type( $slide['url'] ) == 'vimeo' ) $video_slide = true; ?>
	
	<?php if ( ! isset( $video_slide ) || isset( $video_slide ) && isset( $slide['linkto'] ) ) : ?>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Picture', 'haku') ); ?>
		
		<!-- Media option -->
		<?php haku_panel_media( 'picture', 'http://', array( 'haku_image_upload_field', 'trigger_change' ), ( isset( $slide['picture'] ) ?  stripslashes( $slide['picture'] ) : null ) ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Content', 'haku') ); ?>
		
		<!-- Textarea option -->
		<?php haku_panel_textarea( 'content', '', ( isset( $slide['content'] ) ? stripslashes( $slide['content'] ) : null ) ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<?php endif; ?>
		
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( ( isset( $video_slide ) ? __('Video Url', 'haku') : __('Url', 'haku') ) ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'url', 'http://', $slide['url'] ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<?php if ( isset( $video_slide ) ) : ?>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Link To', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'linkto', array( 'haku_checkbox', 'trigger_change' ), ( isset( $slide['linkto'] ) ? $slide['linkto'] : null ) ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<?php endif; ?>
	
	<?php
}

/*********************/
/*   Theme options   */
function theme_options_set() {
	?>

<!-- Tab -->
<?php haku_panel_tab( __('General', 'haku') ); ?>
	
	<!-- Theme options -->
	<?php haku_panel_options(); ?>
	
	<!-- Options header -->
	<h1><?php _e('Logo', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Logo Image', 'haku') ); ?>
		
		<!-- Media option -->
		<?php haku_panel_media( 'logo_image' ); ?>
		
		<!-- Option desc -->
		<p><?php _e('Choose your image, then click "Insert into post" to apply it.', 'haku'); ?></p>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( 'use_plain_logo' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Use Plain Text Logo', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'use_plain_logo' ); ?>
			
		<!-- Option desc -->
		<p><?php _e('Check this to use a plain text logo rather than an image.', 'haku'); ?></p>
	
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'use_plain_logo' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Plain Logo Text', 'haku') ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'plain_logo_text', get_bloginfo('name') ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Favourites Icon', 'haku') ); ?>
		
		<!-- Media option -->
		<?php haku_panel_media( 'favicon' ); ?>
		
		<!-- Option desc -->
		<p><?php _e('Choose your icon, then click "Insert into post" to apply it.', 'haku'); ?></p>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Options header -->
	<h1><?php _e('Analytics', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Tracking Code', 'haku') ); ?>
		
		<!-- Textarea option -->
		<?php haku_panel_textarea( 'analytics_code', '&lt;script type=&quot;text/javascript&quot;&gt; ... &lt;/script&gt;' ); ?>
		
		<!-- Option desc -->
		<p><?php _e('The Tracking Code of your favorite Analytics Web Service.', 'haku'); ?></p>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
<?php haku_panel_tab_close(); ?>
<!-- end: Tab -->

<!-- Tab -->
<?php haku_panel_tab( __('Social Bar', 'haku') ); ?>

	<!-- Options header -->
	<h1><?php _e('Social Bar', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Show', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'social_bar' ); ?>
			
		<!-- Option desc -->
		<p><?php _e('Check this to show the "About Me" and Social Networks icons bar.', 'haku'); ?></p>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Options header -->
	<h1><?php _e('About Panel', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group( 'social_about' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Show Panel', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'social_about' ); ?>
			
		<!-- Option desc -->
		<p><?php _e('Check this to show the "About Me" panel.', 'haku'); ?></p>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'social_about' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Label', 'haku') ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_about_label' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'social_about' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Left Column', 'haku') ); ?>
		
		<!-- Textarea option -->
		<?php haku_panel_textarea( 'social_about_col_1' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'social_about' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Middle Column', 'haku') ); ?>
		
		<!-- Textarea option -->
		<?php haku_panel_textarea( 'social_about_col_2' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'social_about' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Right Column', 'haku') ); ?>
		
		<!-- Textarea option -->
		<?php haku_panel_textarea( 'social_about_col_3' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Options header -->
	<h1><?php _e('Social Networks', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'Twitter' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_twitter', 'Username' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'Facebook' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_facebook', 'http://' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'Google' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_google', 'http://' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'Pinterest' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_pinterest', 'Username' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'Vimeo' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_vimeo', 'http://' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'Flickr' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_flickr', 'http://' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'Dribbble' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_dribbble', 'Username' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'Forrst' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_forrst', 'Username' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'Last.fm' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_lastfm', 'Username' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'Tumblr' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_tumblr', 'http://' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'LinkedIn' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_linkedin', 'http://' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'Behance' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_behance', 'http://' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'Delicious' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_delicious', 'http://' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'Deviantart' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_deviantart', 'http://' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'Skype' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_skype', 'Username' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( 'YouTube' ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_youtube', 'http://' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Options header -->
	<h1><?php _e('Contact Panel', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group( 'social_contact' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Show Panel', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'social_contact' ); ?>
			
		<!-- Option desc -->
		<p><?php _e('Check this to show the contact panel.', 'haku'); ?></p>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'social_contact' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Send Mail To', 'haku') ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_contact_sendto', get_option('admin_email') ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'social_contact' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Mail Sender', 'haku') ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_contact_sender', get_bloginfo('name') ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'social_contact' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Left Column Label', 'haku') ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_contact_col_1' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'social_contact' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Middle Column Label', 'haku') ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'social_contact_col_2' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'social_contact' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Right Column', 'haku') ); ?>
		
		<!-- Textarea option -->
		<?php haku_panel_textarea( 'social_contact_col_3' ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->

<?php haku_panel_tab_close(); ?>
<!-- end: Tab -->

<!-- Tab -->
<?php haku_panel_tab( __('Homepage', 'haku') ); ?>
	
	<!-- Back to options -->
	<?php haku_panel_slides_switch( __('Slides &rarr;', 'haku') ); ?>
	
	<!-- Options header -->
	<h1><?php _e('Slider Setup', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Show Slider', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'hero' ); ?>
	
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Transition Speed', 'haku') ); ?>
		
		<!-- Slider option -->
		<?php haku_panel_slider( 'hero_speed', 50, 3000, 1, __('milliseconds', 'haku') ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Transition Effect', 'haku') ); ?>
		
		<!-- Select option -->
		<?php haku_panel_select( 'hero_fx', array(
			
			'fade' => __('Fade', 'haku'),
			'fadeout' => __('Fade Out', 'haku'),
			'scrollHorz' => __('Scroll Horizontally', 'haku'),
			'scrollVert' => __('Scroll Vertically', 'haku'),
			'zoom' => __('Zoom', 'haku'),
			'fadeZoom' => __('Fade Zoom', 'haku'),
			'blindX' => __('Cover Horizontally', 'haku'),
			'blindY' => __('Cover Vertically', 'haku'),
			'blindZ' => __('Cover Diagonally', 'haku'),
			'uncover' => __('Uncover', 'haku')
			
		) ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Animation Easing', 'haku') ); ?>
		
		<!-- Select option -->
		<?php haku_panel_select( 'hero_easing', array(
			
			'linear' => __('Linear', 'haku'),
			'easeInOutQuad' => __('Quad', 'haku'),
			'easeOutCubic' => __('Cubic', 'haku'),
			'easeInOutQuart' => __('Quart', 'haku'),
			'easeInOutQuint' => __('Quint', 'haku'),
			'easeInOutSine' => __('Sine', 'haku'),
			'easeInOutExpo' => __('Exposition', 'haku'),
			'easeInOutCirc' => __('Circular', 'haku'),
			'easeInOutElastic' => __('Elastic', 'haku'),
			'easeInOutBack' => __('Back', 'haku'),
			'easeInOutBounce' => __('Bounce', 'haku'),
			
		) ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Pause Time', 'haku') ); ?>
		
		<!-- Slider option -->
		<?php haku_panel_slider( 'hero_timeout', 0, 10000, 500, __('milliseconds', 'haku') ); ?>
		
		<!-- Option desc -->
		<p><?php _e('Slide left to 0 to disable auto-advance.', 'haku'); ?></p>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Pause On Hover', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'hero_pause' ); ?>
	
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Pager', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'hero_pager' ); ?>
	
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Options header -->
	<h1><?php _e('Latest Work', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group( 'latest_work' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Display Projects', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'latest_work' ); ?>
			
		<!-- Option desc -->
		<p><?php _e('Check this to show the latest Portfolio Items.', 'haku'); ?></p>
	
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'latest_work' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Pick From', 'haku') ); ?>
		
		<!-- Option -->
		<div>
			
			<!-- Haku select box -->
			<select name="latest_work_portfolio" class="chzn-select">
				<?php foreach ( get_theme_portfolio_pages() as $portfolio ) : ?>
				<option <?php haku_selected( 'latest_work_portfolio', $portfolio ); ?> value="<?php esc_attr_e( $portfolio ); ?>"><?php echo get_the_title( get_page_id_by_theme_post_type( false, $portfolio ) ); ?></option>
				<?php endforeach; ?>
			</select>
			
		<!-- Option desc -->
		<p><?php _e('The Portfolio containing the items you want to display.', 'haku'); ?></p>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'latest_work' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Layout', 'haku') ); ?>
		
		<!-- Radiopic option -->
		<?php haku_panel_radiopic( 'latest_work_number', array(
			
			3 => get_includes_dir('uri') . '/images/panel/layout_3.png',
			6 => get_includes_dir('uri') . '/images/panel/layout_4.png',
			4 => get_includes_dir('uri') . '/images/panel/layout_5.png',
			8 => get_includes_dir('uri') . '/images/panel/layout_6.png'
		
		) ); ?>
		
		<!-- Option desc -->
		<p><?php _e('The number of Portfolio Items to show. The four and eight columns layout is best displayed when hiding the Sidebar.', 'haku'); ?></p>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'latest_work' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Order By', 'haku') ); ?>
		
		<!-- Select option -->
		<?php haku_panel_select( 'latest_work_orderby', array(
			
			'ID' => 'ID',
			'title' => __('Title', 'haku'),
			'date' => __('Date', 'haku'),
			'rand' => __('Random', 'haku')
			
		) ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Heading', 'haku') ); ?>
		
		<!-- Text option -->
		<?php haku_panel_text( 'latest_work_title' ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<?php if ( ! get_home_pages() ) : ?>
	
	<!-- Option notice -->
	<span class="haku_notice"><?php printf( __('No Homepage has been found. Please, assign the "Homepage" Template to a page and set it as "Front page" in your WordPress Reading settings. You can find more info in the %sDocumentation%s.', 'haku'), '<a href="' . get_stylesheet_directory_uri() . '/docs/Help.html">', '</a>' ); ?></span>
		
	<?php endif; ?>
	
<?php haku_panel_tab_close(); ?>
<!-- end: Tab -->

<!-- Tab -->
<?php haku_panel_tab( __('Styling', 'haku') ); ?>
	
	<!-- Options header -->
	<h1><?php _e('Body', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Font Family', 'haku') ); ?>
		
		<!-- Select option -->
		<?php haku_panel_select( 'font_family', array(
			
			'"HelveticaNeue", "Helvetica-Neue", "Helvetica Neue", Helvetica, Arial, sans-serif' => 'Helvetica Neue',
			'Helvetica, Arial, sans-serif' => 'Helvetica',
			'Arial, Helvetica, sans-serif' => 'Arial',
			'Baskerville, "Times New Roman", Times, serif' => 'Baskerville',
			'Cambria, Georgia, Times, "Times New Roman", serif' => 'Cambria',
			'Consolas, "Lucida Console", Monaco, monospace' => 'Consolas',
			'"Copperplate Light", "Copperplate Gothic Light", serif' => 'Copperlate Light',
			'"Courier New", Courier, monospace' => 'Courier New',
			'Futura, "Century Gothic", AppleGothic, sans-serif' => 'Futura',
			'Geneva, "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", Verdana, sans-serif' => 'Geneva',
			'Georgia, Palatino, "Palatino Linotype", Times, "Times New Roman", serif' => 'Georgia',
			'"Gill Sans", Calibri, "Trebuchet MS", sans-serif' => 'Gill Sans',
			'Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif' => 'Impact',
			'"Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif' => 'Lucida Sans',
			'Palatino, "Palatino Linotype", Georgia, Times, "Times New Roman", serif' => 'Palatino',
			'Tahoma, Geneva, Verdana' => 'Tahoma',
			'Verdana, Geneva, Tahoma, sans-serif' => 'Verdana',
			'Times, "Times New Roman", Georgia, serif' => 'Times',
			'"Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif' => 'Trebuchet MS'
			
		) ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Font Size', 'haku') ); ?>
		
		<!-- Slider option -->
		<?php haku_panel_slider( 'body_font_size', 11, 16, 1 ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Line Height', 'haku') ); ?>
		
		<!-- Slider option -->
		<?php haku_panel_slider( 'body_line_height', 14, 20, 1 ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Text Color', 'haku') ); ?>
		
		<!-- Picker option -->
		<?php haku_panel_picker( 'body_color' ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Options header -->
	<h1><?php _e('Structure', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Key Color', 'haku') ); ?>
		
		<!-- Picker option -->
		<?php haku_panel_picker( 'key_color' ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Background Color', 'haku') ); ?>
		
		<!-- Picker option -->
		<?php haku_panel_picker( 'background_color' ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Slider option -->
		<?php haku_panel_slider( 'background_color_opacity', 0, 1, .1, __('opacity', 'haku') ); ?>
		
		<!-- Option desc -->
		<p><?php _e('The visibility amount of the color.', 'haku'); ?></p>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Contrast Color', 'haku') ); ?>
		
		<!-- Picker option -->
		<?php haku_panel_picker( 'contrast_color' ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Slider option -->
		<?php haku_panel_slider( 'contrast_color_opacity', 0, 1, .1, __('opacity', 'haku') ); ?>
		
		<!-- Option desc -->
		<p><?php _e('The visibility amount of the color.', 'haku'); ?></p>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Neutral Color', 'haku') ); ?>
		
		<!-- Picker option -->
		<?php haku_panel_picker( 'neutral_color' ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Options header -->
	<h1><?php _e('Background', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Background Color', 'haku') ); ?>
		
		<!-- Picker option -->
		<?php haku_panel_picker( 'body_background_color' ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( 'body_background_image' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Use Image', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'body_background_image' ); ?>
			
		<!-- Option desc -->
		<p><?php _e('Check this to set a background image as background for your site.', 'haku'); ?></p>
	
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'body_background_image' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Background Pattern', 'haku') ); ?>
		
		<!-- Radiopic option -->
		<?php haku_panel_radiopic( 'body_background_pattern', array(
			
			1 => get_includes_dir('uri') . '/images/panel/pattern_1.png',
			2 => get_includes_dir('uri') . '/images/panel/pattern_2.png',
			3 => get_includes_dir('uri') . '/images/panel/pattern_3.png',
			4 => get_includes_dir('uri') . '/images/panel/pattern_4.png',
			5 => get_includes_dir('uri') . '/images/panel/pattern_5.png',
			6 => get_includes_dir('uri') . '/images/panel/pattern_6.png',
			7 => get_includes_dir('uri') . '/images/panel/pattern_7.png',
			8 => get_includes_dir('uri') . '/images/panel/pattern_8.png',
			9 => get_includes_dir('uri') . '/images/panel/pattern_9.png',
			10 => get_includes_dir('uri') . '/images/panel/pattern_10.png',
			11 => get_includes_dir('uri') . '/images/panel/pattern_11.png',
			12 => get_includes_dir('uri') . '/images/panel/pattern_12.png',
			13 => get_includes_dir('uri') . '/images/panel/pattern_13.png',
			14 => get_includes_dir('uri') . '/images/panel/pattern_14.png',
			15 => get_includes_dir('uri') . '/images/panel/pattern_15.png',
			16 => get_includes_dir('uri') . '/images/panel/pattern_16.png',
			17 => get_includes_dir('uri') . '/images/panel/pattern_17.png',
			18 => get_includes_dir('uri') . '/images/panel/pattern_18.png',
			19 => get_includes_dir('uri') . '/images/panel/pattern_19.png',
			20 => get_includes_dir('uri') . '/images/panel/pattern_20.png',
			21 => get_includes_dir('uri') . '/images/panel/pattern_21.png',
			22 => get_includes_dir('uri') . '/images/panel/pattern_22.png',
			23 => get_includes_dir('uri') . '/images/panel/pattern_23.png',
			24 => get_includes_dir('uri') . '/images/panel/pattern_24.png',
			25 => get_includes_dir('uri') . '/images/panel/pattern_25.png',
			26 => get_includes_dir('uri') . '/images/panel/pattern_26.png',
			27 => get_includes_dir('uri') . '/images/panel/pattern_27.png',
			28 => get_includes_dir('uri') . '/images/panel/pattern_28.png',
			29 => get_includes_dir('uri') . '/images/panel/pattern_29.png',
			30 => get_includes_dir('uri') . '/images/panel/pattern_30.png',
			31 => get_includes_dir('uri') . '/images/panel/pattern_31.png',
			32 => get_includes_dir('uri') . '/images/panel/pattern_32.png',
			33 => get_includes_dir('uri') . '/images/panel/pattern_33.png',
			34 => get_includes_dir('uri') . '/images/panel/pattern_34.png',
			35 => get_includes_dir('uri') . '/images/panel/pattern_35.png',
			36 => get_includes_dir('uri') . '/images/panel/pattern_36.png',
			37 => get_includes_dir('uri') . '/images/panel/pattern_37.png',
		
		) ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'body_background_image' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Custom Background', 'haku') ); ?>
		
		<!-- Media option -->
		<?php haku_panel_media( 'body_background_url' ); ?>
			
		<!-- Option desc -->
		<p><?php _e('Choose your image, then click "Insert into post" to apply it.', 'haku'); ?></p>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group( false, 'body_background_image' ); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Stretch Image', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'body_background_stretch' ); ?>
			
		<!-- Option desc -->
		<p><?php _e('Check this to stretch the background image to fill the whole page width and height. You will also be able to set a different image for every page.', 'haku'); ?></p>
	
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Options header -->
	<h1><?php _e('Direct Styling', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('CSS Code', 'haku') ); ?>
		
		<!-- Textarea option -->
		<?php haku_panel_textarea( 'css_code', 'h1 { font-size: ' . rand( 1, 100 ) . 'px; }' ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
<?php haku_panel_tab_close(); ?>
<!-- end: Tab -->

<!-- Tab -->
<?php haku_panel_tab( __('Layout', 'haku') ); ?>
	
	<!-- Options header -->
	<h1><?php _e('Structure', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Pages Layout', 'haku') ); ?>
		
		<!-- Radiopic option -->
		<?php haku_panel_radiopic( 'default_layout', array(
			
			'right' => get_includes_dir('uri') . '/images/panel/layout_1.png',
			'left' => get_includes_dir('uri') . '/images/panel/layout_2.png'
		
		) ); ?>
		
		<!-- Option desc -->
		<p><?php _e('The default pages layout. You can customize each page settings in the edit mode.', 'haku'); ?></p>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Options header -->
	<h1><?php _e('Gallery Post Formats', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Transition Speed', 'haku') ); ?>
		
		<!-- Slider option -->
		<?php haku_panel_slider( 'gallery_speed', 50, 3000, 1, __('milliseconds', 'haku') ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Transition Effect', 'haku') ); ?>
		
		<!-- Select option -->
		<?php haku_panel_select( 'gallery_fx', array(
			
			'fade' => __('Fade', 'haku'),
			'fadeout' => __('Fade Out', 'haku'),
			'scrollHorz' => __('Scroll Horizontally', 'haku'),
			'scrollVert' => __('Scroll Vertically', 'haku'),
			'zoom' => __('Zoom', 'haku'),
			'fadeZoom' => __('Fade Zoom', 'haku'),
			'blindX' => __('Cover Horizontally', 'haku'),
			'blindY' => __('Cover Vertically', 'haku'),
			'blindZ' => __('Cover Diagonally', 'haku'),
			'uncover' => __('Uncover', 'haku')
			
		) ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Animation Easing', 'haku') ); ?>
		
		<!-- Select option -->
		<?php haku_panel_select( 'gallery_easing', array(
			
			'linear' => __('Linear', 'haku'),
			'easeInOutQuad' => __('Quad', 'haku'),
			'easeOutCubic' => __('Cubic', 'haku'),
			'easeInOutQuart' => __('Quart', 'haku'),
			'easeInOutQuint' => __('Quint', 'haku'),
			'easeInOutSine' => __('Sine', 'haku'),
			'easeInOutExpo' => __('Exposition', 'haku'),
			'easeInOutCirc' => __('Circular', 'haku'),
			'easeInOutElastic' => __('Elastic', 'haku'),
			'easeInOutBack' => __('Back', 'haku'),
			'easeInOutBounce' => __('Bounce', 'haku'),
			
		) ); ?>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Pause Time', 'haku') ); ?>
		
		<!-- Slider option -->
		<?php haku_panel_slider( 'gallery_timeout', 0, 10000, 500, __('milliseconds', 'haku') ); ?>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Pause On Hover', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'gallery_pause' ); ?>
	
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Pager', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'gallery_pager' ); ?>
	
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Options header -->
	<h1><?php _e('Responses', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Page Responses', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'page_responses' ); ?>
		
		<!-- Option desc -->
		<p><?php _e('Check this to enable comments and show trackbacks on pages.', 'haku'); ?></p>
	
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Post Trackbacks', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'post_trackbacks' ); ?>
		
		<!-- Option desc -->
		<p><?php _e('Check this to show trackbacks on posts.', 'haku'); ?></p>
	
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Options header -->
	<h1><?php _e('Portfolio', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Similar Projects', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'portfolio_similar' ); ?>
		
		<!-- Option desc -->
		<p><?php _e('Check this to show the similar projects when viewing a single Portfolio Item.', 'haku'); ?></p>
	
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Item Responses', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'portfolio_responses' ); ?>
		
		<!-- Option desc -->
		<p><?php _e('Check this to enable comments on Portfolio Items.', 'haku'); ?></p>
	
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
<?php haku_panel_tab_close(); ?>
<!-- end: Tab -->

<!-- Tab -->
<?php haku_panel_tab( __('Extras', 'haku') ); ?>
	
	<!-- Options header -->
	<h1><?php _e('Exclude Categories', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Exclude', 'haku') ); ?>
		
		<!-- Multiple select option -->
		<?php haku_panel_multi_select( 'exclude_category', __('Choose a category', 'haku'), haku_list_categories() ); ?>
		
		<!-- Option desc -->
		<p><?php printf( __('The selected categories will be excluded from every single section of your awesome website (%s).', 'haku'), get_bloginfo('name') ); ?></p>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Options header -->
	<h1><?php _e('WordPress', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Login Logo', 'haku') ); ?>
		
		<!-- Media option -->
		<?php haku_panel_media( 'wp_login_logo' ); ?>
			
		<!-- Option desc -->
		<p><?php _e('Choose your image, then click "Insert into post" to apply it.', 'haku'); ?> <strong><?php _e('Max width:', 'haku'); ?></strong> 300</p>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Gravatar', 'haku') ); ?>
		
		<!-- Media option -->
		<?php haku_panel_media( 'wp_gravatar' ); ?>
			
		<!-- Option desc -->
		<p><?php _e('Choose your image, then click "Insert into post" to apply it.', 'haku'); ?> <strong><?php _e('Max size:', 'haku'); ?></strong> 250x250</p>
			
		<!-- Option notice -->
		<span class="haku_notice"><?php _e('To apply your Gravatar image, go to Settings &rarr; Discussion, scroll to the bottom of the page and select it.', 'haku'); ?></span>
		
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Options header -->
	<h1><?php _e('Javascript', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Load jQuery Locally', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'jquery_local' ); ?>

		<!-- Option desc -->
		<p><?php _e('By default, the jQuery Library is loaded from the Google Servers to improve the overall loading performances.', 'haku'); ?> (<a href="http://encosia.com/3-reasons-why-you-should-let-google-host-jquery-for-you/" target="_blank">?</a>)</p>

	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<!-- Options header -->
	<h1><?php _e('Theme Updates', 'haku'); ?></h1>
	
	<!-- Option group -->
	<?php haku_panel_group(); ?>
		
		<!-- Label -->
		<?php haku_panel_label( __('Check for updates', 'haku') ); ?>
		
		<!-- Checkbox option -->
		<?php haku_panel_checkbox( 'theme_update' ); ?>
			
		<!-- Option desc -->
		<p><?php printf( __('Check this if you want to be notified when a new update for %s is available.', 'haku'), get_haku_var('theme_name') ); ?></p>
							
	<?php haku_panel_group_close(); ?>
	<!-- end: Option group -->
	
	<?php haku_panel_options_close(); ?>
	<!-- end: Theme options -->
	
<?php haku_panel_tab_close(); ?>
<!-- end: Tab -->

<!-- Sidebar generator -->
<?php haku_panel_sidebar_generator( __('Sidebars', 'haku'), __('Custom Sidebars', 'haku'), __('Add New Sidebar', 'haku') ); ?>

<!-- Slides manager -->
<?php haku_panel_slides_manager( __('Slides', 'haku'), __('Add New Slide', 'haku') ); ?>

	<?php
}
?>