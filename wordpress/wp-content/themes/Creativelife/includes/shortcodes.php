<?php
/*
 *  Theme shortcodes
 */

/**********************/
/*   Editor Buttons   */
function theme_quicktags_styles() {
	wp_register_style( 'theme_quicktags_style', get_includes_dir('uri') . '/quicktags/quicktags.css', '', get_theme_version() );
	wp_enqueue_style( 'theme_quicktags_style' );
}

function theme_quicktags() {
	wp_register_script( 'theme_quicktags', get_includes_dir('uri') . '/quicktags/quicktags.js', array('quicktags'), get_theme_version() );
	wp_enqueue_script( 'theme_quicktags' );
}

if ( is_wp_edit() ) {
	add_action( 'admin_print_styles', 'theme_quicktags_styles' );
	add_action( 'admin_enqueue_scripts', 'theme_quicktags' );
}

/********************/
/*   [code][/code]  */
function code_shortcode( $atts, $content = '' ) {
	
	// Shortcode
	$shortcode = '<pre><code>' . $content . '</code></pre>';
	
	$shortcode = apply_filters( 'autop_clear_filter', $shortcode );
		
	return $shortcode;
	
}

add_shortcode( 'code', 'code_shortcode' );

/**********************/
/*   [quote][/quote]  */
function quote_shortcode( $atts, $content = '' ) {
	
	// Attributes
	extract(
		shortcode_atts(
			array(
				'align' => 'none',
				'cite' => '',
			),
			$atts
		)
	);
	
	// Shortcode
	$shortcode = '<blockquote class="align' . $align . '">';
	$shortcode .= do_shortcode( $content );
	$shortcode .= ( $cite ? '<cite>' . $cite . '</cite>' : '' );
	$shortcode .= '</blockquote>';
	
	return $shortcode;
	
}

add_shortcode( 'quote', 'quote_shortcode' );

/**********************************************/
/*   [columns-container][/columns-container]  */
function columns_container_shortcode( $atts, $content = '' ) {
	
	// Shortcode
	$shortcode = '<div class="clearfix">' . do_shortcode( $content ) . '</div>';
	
	$shortcode = apply_filters( 'autop_clear_filter', $shortcode );	
	
	return $shortcode;
	
}
add_shortcode( 'columns-container', 'columns_container_shortcode' );

/************************/
/*   [column][/column]  */
function column_shortcode( $atts, $content = '' ) {
	
	// Attributes
	extract(
		shortcode_atts(
			array(
				'size' => '',
				'height' => '',
				'last' => ''
			),
			$atts
		)
	);
	
	$class = array();
	
	switch ( $size ) {
		case '1/2':
		case '2':
			$class[] = 'half';
		break;
		case '1/3':
		case '3':
			$class[] = 'one-third';
		break;
		case '1/4':
		case '4':
			$class[] = 'one-fourth';
		break;
		case '1/5':
		case '5':
			$class[] = 'one-fifth';
		break;
		case '2/3':
		case '2-3':
			$class[] = 'two-third';
		break;
		case '3/4':
		case '3-4':
			$class[] = 'three-fourth';
		break;
	}

	if ( $last ) {
		$class[] = 'no-margin';
	}
	
	$class = join( '', $class );
	
	// Shortcode
	$shortcode = '<div class="' . $class . '"';
	
	if ( intval( $height ) ) {
		$shortcode .= ' style="height: ' . $height . 'px"'; 
	}
	
	$shortcode .= '>';
	$shortcode .= do_shortcode( $content );
	$shortcode .= '</div>';
	
	$shortcode = apply_filters( 'autobr_clear_filter', $shortcode );
	
	return $shortcode;
	
}

add_shortcode( 'column', 'column_shortcode' );

/****************/
/*   [youtube]  */
function youtube_shortcode( $atts ) {
	
	// Attributes
	extract(
		shortcode_atts(
			array(
				'url' => '',
				'size' => '440x253',
			),
			$atts
		)
	);
		
	if ( intval( $size ) ) {
		$size = explode( 'x', $size );
		$size = array( $size[0], $size[1] );
	}
		
	$id = haku_get_video_id( esc_url( $url ) );
	
	// Shortcode
	$shortcode = '<figure class="video">';
	$shortcode .= '<iframe type="text/html" width="' . $size[ 0 ] . '" height="' . $size[ 1 ] . '" src="http://www.youtube.com/embed/' . $id . '?wmode=transparent" frameborder="0" allowfullscreen></iframe>';
	$shortcode .= '</figure>';
	
	return $shortcode;
	
}

add_shortcode( 'youtube', 'youtube_shortcode' );

/**************/
/*   [vimeo]  */
function vimeo_shortcode( $atts ) {
	
	// Attributes
	extract(
		shortcode_atts(
			array(
				'url' => '',
				'size' => '440x330',
			),
			$atts
		)
	);
		
	if ( intval( $size ) ) {
		$size = explode( 'x', $size );
		$size = array( $size[0], $size[1] );
	}
	
	$id = haku_get_video_id( esc_url( $url ) );
	
	// Shortcode
	$shortcode = '<figure class="video">';
	$shortcode .= '<iframe src="http://player.vimeo.com/video/' . $id . '?title=0&amp;byline=0&amp;portrait=0" width="' . $size[ 0 ] . '" height="' . $size[ 1 ] . '" frameborder="0"></iframe>';
	$shortcode .= '</figure>';
	
	return $shortcode;
	
}

add_shortcode( 'vimeo', 'vimeo_shortcode' );

/*********************/
/*   [reset-floats]  */
function reset_floats_shortcode() {

	// Shortcode
	$shortcode = '<div class="clear"></clear>';
	
	return $shortcode;
	
}

add_shortcode( 'reset-floats', 'reset_floats_shortcode' );

/********************/
/*   [mark][/mark]  */
function mark_shortcode( $atts, $content = '' ) {

	// Shortcode
	$shortcode = '<mark>' . do_shortcode( $content ) . '</mark>';
	
	return $shortcode;
	
}

add_shortcode( 'mark', 'mark_shortcode' );

/************/
/*   [map]  */
function map_shortcode( $atts ) {

	// Attributes
	extract(
		shortcode_atts(
			array(
				'center' => 'New York, NY',
				'zoom' => 12,
				'size' => '400x250',
				'maptype' => 'roadmap',
			),
			$atts
		)
	);
	
	// Shortcode
	$shortcode = '<img src="http://maps.googleapis.com/maps/api/staticmap?center=' . $center . '&zoom=' . $zoom . '&size='. $size .'&maptype='. $maptype . '&sensor=false" alt="" />';
	
	return $shortcode;
	
}

add_shortcode( 'map', 'map_shortcode' );

/********************/
/*   [link][/link]  */
function link_shortcode( $atts, $content = '' ) {
	
	// Attributes
	extract(
		shortcode_atts(
			array(
				'url' => home_url(),
				'newtab' => ''
			),
			$atts
		)
	);
	
	// Shortcode
	$shortcode = '<a href="' . esc_url( $url ) . '"';
	
	if ( haku_get_url_type( $url ) == 'image' ) {
		$shortcode .= ' class="view"';
	}
	elseif ( $newtab ) {
		$shortcode .= ' target="_blank"';
	}
	
	$shortcode .= '>' . do_shortcode( $content ) . '</a>';
	
	return $shortcode;
	
}

add_shortcode( 'link', 'link_shortcode' );

/**********************/
/*   [color][/color]  */
function color_shortcode( $atts, $content = '' ) {
	
	// Attributes
	extract(
		shortcode_atts(
			array(
				'hex' => ''
			),
			$atts
		)
	);
	
	// Shortcode
	$shortcode = '<span ';
	$shortcode .= ( $hex ? 'style="color: ' . esc_attr( $hex ) . ';"' : 'class="color"' );
	$shortcode .= '>';
	$shortcode .= do_shortcode( $content ) . '</span>';
	
	return $shortcode;
	
}

add_shortcode( 'color', 'color_shortcode' );

/********************************************/
/*   [skills-container][/skills-container]  */
function skills_shortcode( $atts, $content = '' ) {
	
	// Shortcode
	$shortcode = '<div class="skills-table clearfix">' . do_shortcode( $content ) . '</div>';
	
	$shortcode = apply_filters( 'autop_clear_filter', $shortcode );
		
	return $shortcode;
	
}

add_shortcode( 'skills-container', 'skills_shortcode' );

/**************/
/*   [skill]  */
function skill_shortcode( $atts, $content = '' ) {
	
	// Attributes
	extract(
		shortcode_atts(
			array(
				'label' => 'Awesomeness',
				'val' => '100%'
			),
			$atts
		)
	);
	
	// Shortcode
	$shortcode = '<h5><span>' . esc_attr( $label ) . '</span><div style="width: ' . intval( $val ) . '%;"></div></h5>';
	$shortcode .= '<div class="emph">' . esc_attr( $val ) . '</div>';
	
	return $shortcode;
	
}

add_shortcode( 'skill', 'skill_shortcode' );

/************/
/*   [pic]  */
function pic_shortcode( $atts, $content = '' ) {
	
	// Attributes
	extract(
		shortcode_atts(
			array(
				'url' => get_theme_option('logo'),
				'align' => 'none'
			),
			$atts
		)
	);
	
	// Shortcode
	$shortcode = '<img src="' . esc_url( $url ) . '" ';
	
	if ( $align ) $shortcode .= 'class="align' . $align .'" ';
	
	$shortcode .= 'alt="" />';
	
	return $shortcode;
	
}

add_shortcode( 'pic', 'pic_shortcode' );

/****************/
/*   [sidebar]  */
function sidebar_shortcode( $atts, $content = '' ) {
	
	// Attributes
	extract(
		shortcode_atts(
			array(
				'id' => 'cl_sidebar'
			),
			$atts
		)
	);
	
	// Shortcode
	ob_start();

	dynamic_sidebar( $id );

	$shortcode = ob_get_contents();

	ob_end_clean();
	
	return $shortcode;

}

add_shortcode( 'sidebar', 'sidebar_shortcode' );

/******************/
/*   [raw][/raw]  */
function raw_shortcode( $atts, $content = '' ) {
	
	// Shortcode
	$shortcode = apply_filters( 'autop_clear_filter', do_shortcode( $content ) );
	
	return $shortcode;
	
}

add_shortcode( 'raw', 'raw_shortcode' );
?>