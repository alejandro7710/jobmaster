<?php
/*
 *  Theme functions
 *  Be extremely careful when editing these files! You've been warned!
 */

/**********************/
/*   Haku framework   */
require( TEMPLATEPATH . '/haku/config.php' );

/**************************/
/*   Wordpress features   */
if ( ! isset( $content_width ) ) {
	$content_width = 430;
}

/*********************/
/*   Theme metabox   */
if ( is_admin() ) {
	require( get_includes_dir() . '/metabox/metabox.php' );
}

/******************/
/*   Shortcodes   */
require( get_includes_dir() . '/shortcodes.php' );

/*******************/
/*   Theme setup   */
if ( ! function_exists('theme_setup') ) {
	
	function theme_setup() {
				
		/*****************************************/
		/*   Load current language translation   */
		load_theme_textdomain( 'haku', TEMPLATEPATH . '/languages' );
		
		$locale_file = TEMPLATEPATH . '/languages/' . get_locale() . '.php'; 	
		
		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
		
		/***************************************/
		/*   WordPress features registration   */
		register_nav_menu( 'primary', __('Primary Menu', 'haku') );
		
		register_nav_menu( 'footer', __('Footer Menu', 'haku') );
		
		add_theme_support('automatic-feed-links');
		
		add_theme_support('post-thumbnails');
		
		add_theme_support('post-formats', array( 'gallery', 'video', 'audio' ) );
		
		/*******************************/
		/*   Default thumbnail sizes   */
		set_post_thumbnail_size( 230, 155, true );
		
		add_image_size( 'cl_article', 470, 340, true );
		
		add_image_size( 'cl_hero', 710, 300, true );
		
		add_image_size( 'cl_hero_full', 950, 300, true );
				
		add_image_size( 'cl_portfolio', 950, 340, true );
		
		add_image_size( 'cl_portfolio_2', 470, 260, true );
		
		add_image_size( 'cl_portfolio_3', 310, 220, true );
		
		add_image_size( 'cl_portfolio_4', 230, 155, true );
		
		add_image_size( 'cl_portfolio_5', 182, 182, true );
				
		/***************/
		/*   Widgets   */
		haku_include_widget('latests,twitter,flickr,maps,text,video,works,featured');
		
		/***********************************/
		/*   Portfolio custom post types   */
		$portfolio_pages = get_pages('meta_key=_wp_page_template&meta_value=portfolio.php');
		
		foreach ( $portfolio_pages as $page ) {
			
			$meta = get_post_meta( $page->ID, '_cl_portfolio_settings', true );
			$layout = meta_get('layout', $meta, 3);
			$no_tools = meta_get('tools', $meta);
			$has_custom_height = ( intval( meta_get('height', $meta) ) ? true : false );
			
			$labels = array(
				'name' => $page->post_title . ': ' . __('Items', 'haku'),
				'add_new' => __('Add New Item', 'haku'),
				'add_new_item' => __('New Item', 'haku'),
				'edit_item' => __('Edit Item', 'haku'),
				'all_items' => __('Browse', 'haku'),
				'view_item' => '',
				'search_items' => __('Search Items', 'haku'),
				'menu_name' => $page->post_title
			);
							
			$args = array(
				'labels' => $labels,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'show_in_menu' => true,
				'exclude_from_search' => true,
				'menu_position' => 10,
				'query_var' => true,
				'capability_type' => 'page',
				'hierarchical' => true,
				'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'tags', 'post-formats', 'comments'),
				'rewrite' => array('slug' => $page->post_name ),
				'taxonomies' => array('post_tag'),
				'menu_icon' => get_includes_dir('uri') . '/images/dashboard/portfolio_ui_icon.png',
			);
		  	
		  	/************************/
		  	/*   Custom post type   */
			register_post_type( 'portfolio_'. $page->ID, $args );
			
			/***********************************************************/
			/*   Filtering tags are not needed in "normal" Showcases   */
			if ( ! $no_tools ) {
			
				$labels = array(
					'name' => __('Filter Tags', 'haku'),
					'search_items' => __('Search Filters', 'haku'),
					'popular_items' => __('Most Used Filters', 'haku'),
					'edit_item' => __('Edit Filter', 'haku'),
					'update_item' => __('Update Filter', 'haku'),
					'add_new_item' => __('Add New Filter', 'haku'),
					'separate_items_with_commas' => __('Separate filters with commas (e.g. red, blue, green)', 'haku'),
					'add_or_remove_items' => __('Add or remove filters', 'haku'),
					'choose_from_most_used' => __('Choose from the most used filters', 'haku')
				);
				
				/****************************/
				/*   Custom post type tags  */
				register_taxonomy( 'portfolio_filter_' . $page->ID, 'portfolio_'. $page->ID, array(
					'labels' => $labels,
					'hierarchical' => false,
					'show_ui' => true,
					'query_var' => true
				) );
			
			}
			
			/***************************/
			/*   Custom images height  */
			if ( $has_custom_height ) {
							
				$user_custom_size = array( '_' . $page->post_name, 0, $meta['height'] );
				
				switch ( $layout ) {
					case '2':
						$user_custom_size[1] = 470;
					break;
					case '3':
						$user_custom_size[1] = 310;
					break;
					case '4':
						$user_custom_size[1] = 230;
					break;
					case '5':
						$user_custom_size[1] = 182;
					break;
				}
												
				add_image_size( $user_custom_size[0], $user_custom_size[1], $user_custom_size[2], true );
			
			}

		}

	}

}

add_action( 'after_setup_theme', 'theme_setup' );

/*********************/
/*   Theme sidebars  */
function theme_register_sidebars() {
	
	$sidebar = array(
		'name' => __('Main Sidebar', 'haku'),
		'id' => 'cl_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	);
	
	register_sidebar( $sidebar );
	
	/***********************/
	/*   Homepage sidebar  */
	$home_page = get_home_pages();
	
	if ( $home_page ) {
		
		$sidebar = array(
			'name' => __('Homepage', 'haku') . ' (' . $home_page[0]->post_title . ')',
			'id' => 'cl_home',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h5 class="box-title">',
			'after_title' => '</h5><div class="widget-content">',
		);
		
		register_sidebar( $sidebar );
		
	}
	
	/********************************/
	/*   Custom generated sidebars  */
	haku_register_sidebars( get_theme_slides('theme_sidebars') );
	
}

add_action( 'widgets_init', 'theme_register_sidebars' );

/***********************/
/*   Theme javascript  */
function theme_register_javascript() {

	wp_deregister_script('jquery');
	wp_register_script('jquery', get_jquery_dir(), '', get_theme_version(), 1);
	wp_register_script('cl_js_plugins', get_stylesheet_directory_uri() . '/js/jquery.plugins.js', '', get_theme_version(), 1);
	wp_register_script('cl_js_jcycle', get_stylesheet_directory_uri() . '/js/jquery.cycle.js', '', get_theme_version(), 1);
	wp_register_script('cl_js_audio', get_stylesheet_directory_uri() . '/js/audio.min.js', '', get_theme_version(), 1);
	wp_register_script('cl_js_masonry', get_stylesheet_directory_uri() . '/js/jquery.masonry.js', '', get_theme_version(), 1);
	wp_register_script('cl_js_init', get_stylesheet_directory_uri() . '/js/creativelife.js', '', get_theme_version(), 1);
	wp_register_script('cl_js_portfolio', get_stylesheet_directory_uri() . '/js/creativelife.portfolio.js', '', get_theme_version(), 1);

}

if ( ! is_admin() ) {
	add_action( 'init', 'theme_register_javascript' );
}

function theme_print_javascript() {
	
	global $cl_enqueue_jcycle, $cl_enqueue_audio, $cl_enqueue_masonry, $cl_enqueue_portfolio_js;
	
	wp_print_scripts('jquery');
	wp_print_scripts('cl_js_plugins');
	
	if ( $cl_enqueue_jcycle ) wp_print_scripts('cl_js_jcycle');
	if ( $cl_enqueue_audio ) wp_print_scripts('cl_js_audio');
	if ( $cl_enqueue_masonry ) wp_print_scripts('cl_js_masonry');
	
	wp_print_scripts('cl_js_init');
	
	if ( $cl_enqueue_portfolio_js ) wp_print_scripts('cl_js_portfolio');

}

add_action( 'wp_footer', 'theme_print_javascript' );

/****************************/
/*   Google Analytics code  */
function user_analytics_code() {
	theme_option('analytics_code');
}

if ( get_theme_option('analytics_code') ) {
	add_action( 'wp_footer', 'user_analytics_code' );
}

/***************************/
/*   jQuery load location  */
function get_jquery_dir() {
	return ( get_theme_option('jquery_local') ? get_stylesheet_directory_uri() . '/js/jquery.js' : 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js' );
}

/***************************/
/*   Categories exclusion  */
function cl_exclude_category( $query ) {
	if ( $query->is_home || $query->is_search || $query->is_date ) {
		$query->set( 'cat', haku_format_exclude_categories('exclude_category') );
		return $query;
	}
}

function cl_exclude_getarchives( $where ) {
	$category = haku_format_exclude_categories('exclude_category', '');
	$query = haku_filter_get_archives( $where, $category );
	return $query;
}

if ( get_theme_option('exclude_category', false) ) {
	add_filter( 'pre_get_posts', 'cl_exclude_category' );
	add_filter( 'getarchives_where', 'cl_exclude_getarchives', 10, 2 );
}

/**************/
/*   Sidebar  */
function cl_get_sidebar( $post_id, $posts_page = false ) {
	$post_id = ( $posts_page ? get_option('page_for_posts') : $post_id );
	$custom_sidebar = ( $post_id ? meta_obtain( 'sidebar', '_cl_layout', $post_id ) : false );
	$sidebar = ( $custom_sidebar ? $custom_sidebar : 'cl_sidebar' );
	return $sidebar;
}

/********************/
/*   Content class  */
function cl_content_class( $post_id, $posts_page = false ) {
	$post_id = ( $posts_page ? get_option('page_for_posts') : $post_id );
	$custom_align = meta_obtain('sidebar_invert', '_cl_layout', $post_id );
	$no_sidebar = meta_obtain('no_sidebar', '_cl_layout', $post_id );
	$class = ( $no_sidebar ? 'full-width' : ( $custom_align ? ( get_theme_option('default_layout') == 'right' ? 'left' : 'right' ) : get_theme_option('default_layout') ) );
	echo $class;
}

/*******************************************************/
/*   Enables shortcodes in excerpts and widget titles  */
add_filter('the_excerpt', 'do_shortcode');
add_filter('widget_title', 'do_shortcode');

/**********************/
/*   Custom Gravatar  */
function theme_gravatar( $avatar_defaults ) {
    $avatar_defaults[ get_theme_option('wp_gravatar') ] = get_bloginfo('name');
    return $avatar_defaults;
}

add_filter('avatar_defaults', 'theme_gravatar');

/************************/
/*   Custom Login Logo  */
function theme_login_logo() {
    echo '<style type="text/css"> .login h1 a { background-image: url(' . get_theme_option('wp_login_logo') . '); background-size: auto; background-position: center; } </style>';
}

add_action('login_head', 'theme_login_logo');

/***************************/
/*   Updates notifier   */
if ( get_theme_option('theme_update') ) {
	haku_updater();
}

/************************/
/*   Adds "left" class  */
function previous_link_class() {
	return 'class="left"';
}

add_filter('previous_comments_link_attributes', 'previous_link_class');
add_filter('next_posts_link_attributes', 'previous_link_class');

/*************************/
/*   Adds "right" class  */
function next_link_class() {
	return 'class="right"';
}

add_filter('previous_posts_link_attributes', 'next_link_class');
add_filter('next_comments_link_attributes', 'next_link_class');

/*******************************/
/*   Creativelife custom menu  */
class creativelife_walker extends Walker_Nav_Menu {

	function start_el( &$output, $item, $depth, $args ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		$output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
		$icon = esc_attr( $item->attr_title );
		if ( intval( $icon ) ) {
			$icon = get_stylesheet_directory_uri() . '/images/symbols/' . $icon . '.png';
		}
		elseif ( $icon ) {
			$icon = esc_url( $icon );
		}
		else {
			$icon = get_stylesheet_directory_uri() . '/images/symbols/' . rand( 1, 30 ) . '.png';
		}
		$attributes  = ' style="background-image: url(' . $icon . ');"';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$description  = ! empty( $item->description ) ? '<span>' . esc_attr( $item->description ) . '</span>' : '';
		if ( $depth != 0 ) $description = $append = $prepend = '';
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $description . $args->link_after;
		$item_output .= '</a>';
		$item_output .= '<span></span>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

}

/************************************************/
/*   Creativelife custom menu admin javascript  */
function cl_navmenus_javascript() {
	wp_register_script( 'cl_navmenus_js', get_includes_dir('uri') . '/dashboard/nav-menus.js', '', get_theme_version() );
	wp_enqueue_script( 'cl_navmenus_js' );
	wp_localize_script( 'cl_navmenus_js', 'cl_icon', array( esc_attr( __('Icon', 'haku') ), esc_attr( __('1-30 or http://', 'haku') ), get_stylesheet_directory_uri() . '/docs/Help.html#menuIconsList' ) );
}

if ( is_admin() && $pagenow == 'nav-menus.php' ) {
	add_action( 'admin_enqueue_scripts', 'cl_navmenus_javascript' );
}

/****************************************/
/*   Portfolio current menu item class  */
function add_theme_post_type_current_class( $classes, $item ) {
	if ( is_theme_post_type() ) {
		if ( get_page_id_by_theme_post_type() == $item->object_id ) {
			$classes[] = 'current-menu-item current_page_item';
		}
		else {
			$classes = str_replace( 'current_page_parent', '', $classes );
		}
	}
	return $classes;
}

add_filter( 'nav_menu_css_class', 'add_theme_post_type_current_class', 10, 2 );

/*****************************/
/*   Theme custom functions  */
function is_theme_post_type( $post_id = false ) { 
	if ( strpos( get_post_type( $post_id ), 'portfolio_' ) !== false ) return true;
}

function get_page_id_by_theme_post_type( $auto = true, $post_type = false ) {
	$id = ( $auto ? get_post_type() : $post_type );
	$id = str_replace( 'portfolio_', '', $id );
	return $id;
}

function get_page_title_by_theme_post_type() {
	$title = get_page_id_by_theme_post_type();
	$title = get_the_title( $title );
	return $title;
}

function get_theme_post_type_posts( $post_id ) {
	$number = 'portfolio_' . $post_id;
	$number = new WP_Query("post_type=$number&status=publish");
	wp_reset_query();
	$number = $number->found_posts;
	return $number;
}

function get_theme_portfolio_pages( $portfolios = array() ) {
	$pages = get_pages('meta_key=_wp_page_template&meta_value=portfolio.php');
	foreach ( $pages as $page ) {
		$portfolios[] = 'portfolio_' . $page->ID;
	}
	return $portfolios;
}

function get_rgb_value( $hex, $rgb = '' ) {
	// http://bit.ly/ItNf4H
	$hex = str_replace( '#', '', $hex );
	$rgb .= hexdec( substr( $hex, 0, 2 ) );
	$rgb .= ', ' . hexdec( substr( $hex, 2, 2 ) );
	$rgb .= ', ' . hexdec( substr( $hex, 4, 2 ) );
	return $rgb;
}

function get_home_pages() {
	return get_pages('meta_key=_wp_page_template&meta_value=homepage.php');
}

/********************/
/*   Post comments  */
if ( ! function_exists('theme_comments') ) {

	function theme_comments( $comment, $args, $depth ) {
	
		$GLOBALS['comment'] = $comment;
		
		$awaiting = ( $comment->comment_approved == '0' ? 'awaiting' : false );
		?>
		
		<!-- Comment -->
		<li <?php comment_class( $awaiting ); ?> id="comment-<?php comment_ID(); ?>">
			
			<!-- Comment meta -->
			<div class="comment-author clearfix vcard">
				
				<!-- Author picture -->
				<?php echo get_avatar( $comment, 60 ); ?>
				
				<!-- Comment date -->
				<div>
					
					<!-- Author name -->
					<cite class="emph"><?php echo get_comment_author_link(); ?></cite>
					
					<!-- Date -->
					<time datetime="<?php echo get_comment_date( DATE_W3C ); ?>"><?php echo get_comment_date('F j, Y'); ?> - <?php echo get_comment_time('g:i'); ?></time>
					
					<?php edit_comment_link( __('(Edit)', 'haku') ); ?>
				
				</div>
				<!-- end: Comment date -->
								
				<?php if ( $depth < $args['max_depth'] ) : ?>
				
				<!-- Reply link -->
				<span class="comment-reply emph">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('Reply', 'haku' ), 'depth' => $depth, 'max_depth' => $args['max_depth']) ) ); ?>
					<div></div>
				</span>
				<!-- end: Reply link -->
				
				<?php endif; ?>
				
			</div>
			<!-- end: Comment meta -->
			
			<!-- Comment bubble -->
			<div class="comment-content clearfix">
				
				<?php if ( $awaiting ) : ?>
					
					<p><mark><?php _e( 'Your comment is awaiting moderation.', 'haku' ); ?></mark></p>
					
				<?php else: ?>
					
					<?php comment_text(); ?>
					
				<?php endif; ?>
											
			</div>
			<!-- end: Comment bubble -->
		
		</li>
		<!-- end: Comment -->
			
		<?php
	
	}

}

/*****************/
/*   Post pings  */
if ( ! function_exists('theme_pings') ) {

	function theme_pings( $comment, $args, $depth ) {
	
		$GLOBALS['comment'] = $comment;
		
		?>
		
		<!-- Pingback -->
		<li class="post pingback"><?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'haku' ), '<span class="edit-link">', '</span>' ); ?>
			
		<?php
	
	}

}

?>