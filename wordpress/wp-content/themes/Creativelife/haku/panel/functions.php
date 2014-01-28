<?php
/*
 *  Haku Framework
 *  Handcrafted by Stefano Giliberti
 *  stefanogiliberti@me.com
 */

/***********************/
/*   Panel functions   */
function haku_selected( $option_name, $key, $raw = false ) {
	$option = ( $raw !== false ? $raw : get_theme_option( $option_name ) );
	echo ( $option == $key ? 'selected="selected"' : '' );
}

function haku_checked( $option_name, $raw = false ) {
	$option = ( $raw !== false ? $raw : get_theme_option( $option_name ) );
	echo ( $option == $option_name ? 'checked="checked"' : '' );
}

function haku_multiple_selected( $option_name, $key, $raw = false ) {
	$option = ( $raw !== false ? $raw : get_theme_option( $option_name, false ) );
	echo ( is_array( $option ) && in_array( $key, $option ) ? 'selected="selected"' : '' );
}

function array_equal( $a, $b ) {
	// http://bit.ly/nimCxX
    if ( count( $a ) !== count( $b ) ) {
        return false;
    }
    foreach ( $a as $val ) {
        $key = array_search( $val, $b );
        if ( $key === false ) {
            return false;
        }
        unset( $b[ $key ] );
    }
    return true;
}

function array_reorder( &$array, $key ) {
	// http://bit.ly/nyxZ76
    $sorter_array = array();
    $sorted_array = array();
    reset( $array );
    foreach ( $array as $w => $b ) {
        $sorter_array[ $w ] = $b[ $key ];
    }
    asort( $sorter_array );
    foreach ( $sorter_array as $w => $b ) {
        $sorted_array[ $w ] = $array[ $w ];
    }
    $array = $sorted_array;
}

?>