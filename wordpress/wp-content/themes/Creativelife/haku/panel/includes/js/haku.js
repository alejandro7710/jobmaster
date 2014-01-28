/*
 *  Haku Framework
 *  Handcrafted by Stefano Giliberti
 *  stefanogiliberti@me.com
 */

jQuery( document ).ready( function( $ ) {

	$("body").prepend('<div id="haku_overlay"></div>');

	var win = $( window ),
		body = $("body"),
		scrollpals = $("html, body"),
		wpbody = $("#wpbody-content"),
		haku = $("#haku"),
		haku_popup = $("#haku_popup"),
		haku_header = $("#haku > .header"),
		haku_title = haku_header.find("h1"),
		haku_menu = $("#haku > div > .aside ul"),
		haku_save = $("#haku_save"),
		haku_i = $("#haku_i"),
		haku_infolist = $("#haku_infolist"),
		haku_tabs = $("#haku_container > div"),
		haku_section = haku_tabs.find(".section"),
		haku_changes = 0,
		haku_stored_tab = haku_obtain("haku_tab"),
		haku_chosen_tab = ( haku_stored_tab ? haku_stored_tab : 0 ),
		haku_slides = $(".haku_slides"),
		haku_overlay = $("#haku_overlay"),
		haku_referer = haku.attr("data-referer"),
		haku_reset = $("#haku_infolist a[href='#reset-options']"),
		haku_options_form = $("#haku_options_form"),
		haku_image_field = null,
		haku_image_src = null,
		crunching = false,
		hold_on = false;
		
	wpbody.toggleClass("loading");
	
	win.load( function() {
		
		wpbody.toggleClass("loading");
		
		haku.fadeTo( 250, 1 );
	
	} );
	
	haku_overlay.height( $( document ).height() );
	
	haku_popup.css( "top",  win.height() / 2 - 170 );

	haku_section.each( function() {
		
		var $this = $( this ),
			tab_name = $this.attr("data-tab");
		
		if ( $this.index() != haku_chosen_tab ) {
			
			$this.hide();
			
			haku_menu.append("<li>" + tab_name + "</li>");
			
		}
		else {
			
			haku_menu.append('<li class="active">' + tab_name + '<span></span></li>');
			
			if ( $this.hasClass("haku_manager") ) {
				
				haku_save.css( "opacity", 0 );
				
			}
			
		}
		
	} );

	haku_menu.children("li").click( function() {
				
		if ( ! $( this ).hasClass("active") ) {
												
			haku_tab_switch( $( this ).index() );
			
			haku_chosen_tab = $( this ).index();
			
		}
		
	});
	
	function haku_tab_switch( index ) {
		
		var tab_to_show = haku_section.eq( index );
		
		if ( tab_to_show.hasClass("haku_selected_tab") ) return;
						
		tab_to_show.show().addClass("haku_selected_tab").siblings(".section").hide().removeClass("haku_selected_tab");
		
		haku_menu_toggle( index );
		
		haku_store( index, "haku_tab" );
		
		if ( tab_to_show.hasClass("haku_manager") ) {
			
			haku_save.animate( { opacity: 0 }, { duration: 150, queue: false } );
							
		}
		else if ( is_invisible( haku_save ) ) {
			
			haku_save.animate( { opacity: 1 }, { duration: 150, queue: false } );
		
		}
		
		if ( haku_slides.hasClass("open") ) {
			
			haku_slides.hide();
			
			haku_slides.toggleClass("open");
			
		}
				
	}
	
	function haku_menu_toggle( index ) {
		
		if ( ! haku_menu.find("li:eq(" + index + ")").hasClass() ) {
						
			haku_menu.find("li:eq(" + index + ")").addClass("active").append("<span></span>").siblings().removeClass().find("span").remove();
		
		}
		
	}
	
	$(".haku_slides_switch").click( function( e ) {
		
		if ( haku_slides.hasClass("open") ) {
			
			haku_save.animate( { opacity: 1 }, { duration: 150, queue: false } );
			
			haku_slides.hide();
			
			haku_section.eq( haku_chosen_tab ).show();
			
		}
		else {
			
			haku_save.animate( { opacity: 0 }, { duration: 150, queue: false } );
						
			haku_section.eq( haku_chosen_tab ).hide();
			
			haku_slides.show();
			
			haku_load_slides();
			
		}
		
		haku_slides.toggleClass("open");
		
		e.preventDefault();
		
	} );
		
	win.scroll( function() {
	
		scrolltop = $( this ).scrollTop();
		
		if ( scrolltop > 400 ) {
			
			if ( haku_header.hasClass("sticky") ) return;
			
			haku.css( "margin-top", 70 );
			
			haku_header.addClass("sticky");
		
		}
		else {
			
			haku.css( "margin-top", 25 );
			
			haku_header.removeClass("sticky");			
		}
	
	} );
	
	haku_title.click( function() {
		
		if ( haku_header.hasClass("sticky") ) {
			
			scrollpals.animate( { scrollTop: 0 } );
		
		}
	
	} );
	
	function haku_tiptips() {
	
		$("[data-tip]").tipTip( {
			attribute: "data-tip",
			delay: 100,
			defaultPosition: "top",
			maxWidth: "auto"
		} );
		
	}
	
	haku_tiptips();
	
	$(".haku_optgroup label").live( "click", function() {
	
		$( this ).parents(".haku_optgroup").find("input[type='text'], textarea").focus();
		
	} );
		
	$("a[href='#']").click(function( e ) {
	
		e.preventDefault();
		
	} );
	
	function haku_checkboxes_refresh() {

		$(".haku_checkbox").each( function() {
					
			var $this = $( this ),
				real_checkbox = $this.parent().find(":checkbox");
			
			if ( real_checkbox.is(":checked") ) {
				$this.addClass("checked");
			}
			else {
				$this.removeClass("checked");
			}
					
		} );

	}

	haku_checkboxes_refresh();
	
	function haku_radiopic_refresh() {
	
		$(".haku_radiopic_select").each( function() {
			
			var $this = $( this ),
				options = $this.find("option"),
				selector = $this.parent().find(".haku_radiopic_list"),
				index = $this.find(":selected").index();
						
			if ( ! selector.hasClass("has_radiopic") ) {
			
				options.each( function() {
								
					selector.append('<a href="#" class="haku_radiopic"><img src="' + $( this ).attr("data-radiopic") + '" alt="" /></a>');
				
				} );
					
				$this.parent().find(".haku_radiopic:eq(" + index + ")").addClass("active");
				
				selector.addClass("has_radiopic");
			
			}
			
		} );
	
	}
	
	haku_radiopic_refresh();
	
	function haku_select_refresh() {
	
		$(".chzn-select").chosen().change( function() {
			
			haku_spot_changes( $( this ) );
			
		} );
		
	}
	
	haku_select_refresh();
	
	$(".haku_checkbox").live( "click", function( e ) {
			
		var $this = $( this ),
			real_checkbox = $this.parent().find(":checkbox");
			
		if ( real_checkbox.is(":checked") ) {
			$this.removeClass("checked");
			real_checkbox.removeAttr("checked");
		}
		else {
			$this.addClass("checked");
			real_checkbox.attr("checked", "checked");
		}
		
		haku_spot_changes( real_checkbox );
		
		if ( $this.hasClass("trigger_change") ) {
			
			$this.parents(".haku_element").trigger("change");
		
		}
		
		e.preventDefault();
	
	} );
		
	$(".haku_picker").each( function() {
		
		var $this = $( this ),
			real_input = $this.parent().find(":text");
				
		$this.css( "backgroundColor", real_input.val() );
				
		$this.ColorPicker( {
			color: real_input.val(),
			onShow: function ( colpkr ) {
				$( colpkr ).fadeIn( 250 );
				return false;
			},
			onChange: function ( hsb, hex, rgb ) {
				$this.css( "backgroundColor", "#" + hex );
				real_input.val( "#" + hex )
				haku_spot_changes( real_input );
			}
		} );
		
	} );
	
	$(".haku_slider").each( function() {
	
		var $this = $( this ),
			real_input = $this.parent().find(":text"),
			input_tip = $this.parent().find("span"),
			input_tip_label = ( input_tip.attr("data-label") ? input_tip.attr("data-label") : "pixels" ),
			min = $this.attr("data-min"),
			max = $this.attr("data-max"),
			step = $this.attr("data-step");
				
		$this.slider( {
			min: parseFloat( min ),
			max: parseInt( max ),
			step: parseFloat( step ),
			value: real_input.val(),
			animate: true,
			slide: function ( event, ui ) {
				real_input.val( ui.value );
				input_tip.text( ui.value + " " + input_tip_label ).stop( true, true ).fadeTo( 250, 1 );
				haku_spot_changes( real_input );
			}
		} );
		
		$this.hover( function() {
			input_tip.stop( true, true ).fadeTo( 250, 1 );
		},
		function() {
			input_tip.delay( 2000 ).fadeTo( 250, 0 );
		} );
		
	});
	
	$(".haku_radiopic").live( "click", function( e ) {
		
		e.preventDefault();
		
		var $this = $( this ),
			index = $this.index(),
			real_input = $this.parent().parent().find("select");
		
		$this.addClass("active").siblings().removeClass("active");
		
		real_input.find("option:selected").removeAttr("selected");
				
		real_input.find("option:eq(" + index + ")").attr("selected", "selected");
				
		haku_spot_changes( real_input );
		
		if ( real_input.hasClass("trigger_change") ) {
			
			real_input.parents("form").trigger("change");
		
		}
	
	} );
	
	$(".haku_optgroup input, .haku_optgroup textarea").change( function() {
	
		haku_spot_changes( $( this ) );
	
	} );
	
	function haku_spot_changes( el ) {
			
		if ( ! el.hasClass("changed") ) {
		
			el.addClass("changed");
			
			haku_update_changes();
			
		}
	
	}
	
	function haku_update_changes() {
	
		haku_changes = $(".haku_options").find(".changed").length;
		
		if ( haku_changes ) {
		
			haku_save.children().text( haku_changes ).fadeIn(250);
		
		}
						
	}
	
	haku_i.click( function() {
		
		haku_overlay.show();
		
		$( this ).addClass("active");
		
		haku_infolist.stop( true, true ).fadeToggle( 200 );
		
	} );
	
	haku_infolist.find("a").click( function() {
		
		haku_infolist.fadeOut( 200 );
		
		haku_i.removeClass();
	
	} );
	
	haku_overlay.click( function() {
		
		if ( crunching ) return;
		
		$( this ).hide();
		
		if ( haku_infolist.is(":visible") ) {
			
			haku_infolist.fadeOut( 200 );
			
			haku_i.removeClass();
		
		}
		
		if ( haku_popup.is(":visible") ) {
			
			haku_popup.fadeOut(200);
					
		}
			
	} );
	
	$("[data-father] .haku_checkbox").click( function() {
	
		var parent = $( this ).parents(".haku_optgroup"),
			twin = parent.attr("data-father");
			
		parent.nextAll("[data-child='" + twin + "']").slideToggle( 200 );

	} );

	$(".haku_image_upload").live( "click", function( e ) {
		
		haku_image_field = $( this ).parent().find(":text");
		
		tb_show( "", "media-upload.php?type=image&amp;post_id=&amp;TB_iframe=true" );
		
		e.preventDefault();
	
	} );
	
	window.send_to_editor = function( html ) {
		
		haku_image_src = $( "img", html ).attr("src");

		tb_remove();

		haku_image_field.val( haku_image_src ).delay( 350 ).slideDown(200);

		haku_spot_changes( haku_image_field );
		
		if ( haku_image_field.hasClass("trigger_change") ) {
			
			haku_image_field.parents("form").trigger("change");
		
		}

	}
	
	$(".haku_toggle_input").live( "click", function( e ) {
		
		$( this ).parent().find(":text[value='']").toggle();
		
		e.preventDefault();
	
	} );

	$(".haku_element").live( {
		mouseenter: function(){
			$( this ).find(".haku_drop").fadeIn( 250 );
		},
		mouseleave: function(){
			$( this ).find(".haku_drop").stop( true, true ).hide();
		}
	} );

	haku_popup.children(".haku_drop").click( function( e ) {
		
		e.preventDefault();
		
		$( this ).parent().fadeOut( 200 );
		
		haku_overlay.hide();
	
	} );

	haku_save.mousedown( function( e ) {
				
		if ( hold_on ) return;
			
		haku_load();
		
		var $this = $( this ),
			form_action = "action=haku_save_options&haku_referer=" + haku_referer + "&",
			contents = haku_options_form.serialize();
		
		$this.css( "opacity", .5 );
		
		$.post( ajaxurl, form_action + contents, function( response ) {

				hold_on = true;
									
				if ( response == ':)' ) {
					
					haku_save.children("span").fadeOut( 150, function() {
						
						haku.find(":text.haku_image_upload_field[value='']").slideUp( 200 );
						
						haku.find(".changed").removeClass("changed");
						
						$( this ).addClass("saved").show().fadeTo( 1500, 1, function() {
							
							$( this ).fadeOut( 250, function() {
								
								$( this ).removeClass("saved");
								
								hold_on = false;
																	
							} );
							
						} );
					
					} );
				
				}
				else {
				
					alert( response );
					
				}
				
				$this.css( "opacity", 1 );
				
				haku_load();

			}
			
		);

		e.preventDefault();
	
	} );

	haku_reset.click( function( e ) {
				
		haku_popup.show();
		
		haku_popup.children("#haku_popup_confirm").click( function() {
			
			haku_load();
			
			var form_action = "action=haku_options_reset&haku_referer=" + haku_referer;
			
			$.post( ajaxurl, form_action, function( response ) {
					
					haku_load();
					
					haku_popup.fadeOut( 200, function() {
						
						window.location.href = window.location.href;
					
					} );

				}
				
			);
		
		} );
		
		e.preventDefault();
	
	} );

	$("#haku_add_slide").click( function() {
		
		haku_load();
		
		$.post( ajaxurl, { action: "haku_add_slide", haku_referer: haku_referer }, function( response ) {

				if ( response == ':)' ) {
					
					haku_load_slides();
				
				}
				else {
					
					alert( response );
				
				}
				
				haku_load();
				
			}
			
		);
	
	} );

	$("#haku_slides_container .haku_drop").live( "click", function( e ) {
		
		haku_load();
		
		var el = $( this ).parents(".haku_element"),
			el_id = el.attr("data-id");
		
		el.css( "opacity", .5 );
		
		$.post( ajaxurl, { action: "haku_delete_slide", haku_referer: haku_referer, id: el_id }, function( response ) {

				if ( response == ':)' ) {
					
					haku_load_slides();
				
				}
				else {
					
					alert( response );
				
				}
				
				haku_load();
				
			}
		);
		
		e.preventDefault();
	
	} );

	$("#haku_slides_container .haku_element_update").live( "change", function() {
		
		haku_load();
		
		var $this = $( this ),
			el_id = $this.children(".haku_element").attr("data-id"),
			form_action = "action=haku_update_slide&haku_referer=" + haku_referer + "&id=" + el_id + "&",
			contents = $this.serialize();
		
		$this.css( "opacity", .5 );
				
		$.post( ajaxurl, form_action + contents, function( response ) {

				if ( response == ':)' ) {

					haku_load_slides();
				
				}
				else {
					
					alert( response );
				
				}
								
				haku_load();

			}
			
		);
		
	} );
	
	function haku_load_slides() {
		
		haku_load();
				
		$.post( ajaxurl, { action: "haku_load_slides", haku_referer: haku_referer }, function( data ) {
				
				$("#haku_slides_container").html( data );
				
				haku_slides_sorting();
				
				haku_checkboxes_refresh();
				
				haku_radiopic_refresh();
				
				haku_select_refresh();
								
				haku_load();
												
			}
			
		);

	}

	function haku_slides_sorting() {
	
		$(".haku_sortable").sortable( {
			opacity: .9, 
			cursor: "move",
			axis: "y",
			handle: ".haku_grab",
			containment: "#haku",
			update: function() {
				
				haku_load();
				
				var serial = $( this ).sortable("serialize");

				$.post( ajaxurl, { action: "haku_order_slides", haku_referer: haku_referer, order: serial }, function( response ) {

						if ( response == ':)' ) {
		
							haku_load_slides();
						
						}
						else {
							
							alert( response );
						
						}
						
						haku_load();
						
					}
					
				);
					
			}
			
		} );
		
	}

	function haku_load_sidebars() {
		
		haku_load();
				
		$.post( ajaxurl, { action: "haku_load_sidebars", haku_referer: haku_referer }, function( data ) {
				
				$("#haku_sidebars_container").html( data );
				
				haku_tiptips();
				
				haku_load();
								
			}
			
		);

	}
	
	haku_load_sidebars();
		
	$("#haku_add_sidebar").click( function() {
		
		haku_load();
		
		$.post( ajaxurl, { action: "haku_add_sidebar", haku_referer: haku_referer }, function( response ) {

				if ( response == ':)' ) {
					
					haku_load_sidebars();
				
				}
				else {
					
					alert( response );
				
				}
				
				haku_load();
				
			}
			
		);
	
	} );

	$("#haku_sidebars_container .haku_drop").live( "click", function( e ) {
		
		haku_load();
		
		var el = $( this ).parents(".haku_element"),
			el_id = el.attr("data-id");
		
		el.css( "opacity", .5 );
		
		$.post( ajaxurl, { action: "haku_delete_sidebar", haku_referer: haku_referer, id: el_id }, function( response ) {

				if ( response == ':)' ) {
					
					haku_load_sidebars();
				
				}
				else {
					
					alert( response );
				
				}
				
				haku_load();
				
			}
			
		);
		
		e.preventDefault();
	
	} );

	$("#haku_sidebars_container .haku_element_update").live( "change", function() {
		
		haku_load();
		
		var $this = $( this ),
			el_id = $this.children(".haku_element").attr("data-id"),
			form_action = "action=haku_update_sidebar&haku_referer=" + haku_referer + "&id=" + el_id + "&",
			contents = $this.serialize();
		
		$this.css( "opacity", .5 );
		
		$.post( ajaxurl, form_action + contents, function( response ) {

				if ( response == ':)' ) {

					haku_load_sidebars();
									
				}
				else {
					
					alert( response );
				
				}
				
				haku_load();

			}
			
		);
		
	} );

	jQuery.expr[':'].Contains = function(a, i, m) { 
		return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0; 
	};
	
	function is_invisible( el ) {
		return ( el.css("opacity") == 0 ? true : false );
	}
	
	function haku_store( value, id ) {
        var date = new Date();
        date.setTime( date.getTime() + (3*24*60*60*1000) );
	    document.cookie = id + "=" + value + "; expires=" + date.toGMTString() + "; path=/";
	}
	
	function haku_obtain( name ) {
	    var nameEQ = name + "=",
	    	ca = document.cookie.split(";");
	    for ( var i = 0; i < ca.length; i++ ) {
	        var c = ca[i];
	        while ( c.charAt(0) == " ") c = c.substring(1, c.length);
	        if ( c.indexOf( nameEQ ) == 0 ) return c.substring(nameEQ.length, c.length);
	    }
	    return null;
	}
	
	function haku_load() {
		haku_title.toggleClass("crunching");
		haku_overlay.toggle();
		crunching = ( crunching ? false : true );
	}
	
} );