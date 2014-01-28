/*
 *	Metabox javascript
 */

jQuery( document ).ready( function( $ ) {
	
	$("[id^='_cl_format_']").hide();
	
	if ( $("#post-formats-select #post-format-video").is(":checked") ) {
		$("#_cl_format_video_metabox").show();
	}
	else if ( $("#post-formats-select #post-format-audio").is(":checked") ) {
		$("#_cl_format_audio_metabox").show();
	}
	else if ( $("#post-formats-select #post-format-gallery").is(":checked") ) {
		$("#_cl_format_gallery_metabox").show();
	}

	$("#post-formats-select input").click( function() {
		
		$("[id^='_cl_format_']").hide();
		
		if ( $( this ).val() == "gallery" ) {
			$("#_cl_format_gallery_metabox").show();
		}
		else if ( $( this ).val() == "video" ) {
			$("#_cl_format_video_metabox").show();
		}
		else if ( $( this ).val() == "audio" ) {
			$("#_cl_format_audio_metabox").show();
		}
		
	} );
	
	if ( $("[name='_cl_portfolio_item_settings[lightbox]']").is(":checked") ) {
		$("#postdivrich, #formatdiv, #_cl_layout_metabox").hide();
	}
	
	$("[name='_cl_portfolio_item_settings[lightbox]']").click( function() {
				
		if ( $( this ).is(":checked") ) {
			$("#postdivrich, #formatdiv, #_cl_layout_metabox").slideUp( 300 );
		}
		else {
			$("#postdivrich, #formatdiv, #_cl_layout_metabox").slideDown( 300 );
		}
	
	} );
	
} );