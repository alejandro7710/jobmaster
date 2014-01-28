/*
 *
 *	Creativelife
 *	http://themes.opendept.net/creativelife
 *
 *	Handcrafted with by The Open Dept.
 *	http://opendept.net
 *
 */

jQuery( document ).ready( function( $ ) {
	
	/*
		Selectors caching
	*/
	var social_bar = $(".social-bar"),
		panel_togglers = social_bar.find(".about-toggle, .mail-toggle"),
		panels = $(".toggle-panel"),
		hold_on = false;
	
	/*
		Menu hover toggle
	*/
	$(".header-bar li:not(.mail-toggle)").hover( function() {
		
		hovel = $( this ),
		opening_width = hovel.children("a").text().length,
		hovel_is_menubar = hovel.parents(".header-bar").hasClass("menu-bar");
		
		if ( opening_width > 20 ) {
			opening_width = 280;
		} 
		else if ( opening_width > 15 ) {
			opening_width = 220;
		} 
		else if ( opening_width > 10 ) {
			opening_width = 180;
		} 
		else if ( opening_width > 5 ) {
			opening_width = 150;
		}
		else if ( opening_width > 1 ) {
			opening_width = 130;
		}
							
		hovel.animate( { width: ( hovel_is_menubar ? opening_width : opening_width - 25 ) }, { duration: 300, queue: false } );
		
	},
	function() {
		
		hovel = $( this ),
		hovel_is_menubar = hovel.parents(".header-bar").hasClass("menu-bar");
		
		hovel.animate( { width: ( hovel_is_menubar ? 60 : 40 ) }, { duration: 300, queue: false } );
	
	} );
	
	/*
		About panel toggle
	*/
	panel_togglers.click( function( e ) {
		
		e.preventDefault();
		
		if ( hold_on ) return;
		
		hold_on = true,
		toggler = $( this ),
		panel = ( toggler.hasClass("about-toggle") ? panels.filter(".about-panel") : panels.filter(".contact-panel") );
				
		if ( toggler.hasClass("active") ) {
			
			if ( $(".hero-slider").length ) {
				$(".hero-slider .slider").cycle("resume");
			}
			
			toggler.children("div").animate( { bottom: 0 }, { duration: 250, complete: function() { $( this ).css( "opacity", 0 ); toggler.removeClass("active"); } } );
		
		}
		else {
			
			if ( $(".hero-slider").length ) {
				$(".hero-slider .slider").cycle("pause");
			}
			
			if ( panels.filter(".open").length ) {
				
				open = social_bar.find(".active");
				
				open.children("div").animate( { bottom: 0 }, { duration: 250, complete: function() { $( this ).css( "opacity", 0 ); open.removeClass("active"); } } );				
				
				panels.removeClass("open").slideUp( 250, "easeInOutSine" );
				
			}
			
			toggler.addClass("active").children("div").animate( { opacity: 1, bottom: -8 }, 250 );
			
		}
							
		panel.toggleClass("open").slideToggle( 250, "easeInOutSine", function() { hold_on = false; } );
	
	} );
	
	/*
		Projects animations
	*/
	$(".portfolio-list .portfolio-item").hover( function() {
		$( this ).find("img").animate( { top: - $( this ).height() - 25 }, { duration: 800, queue: false, easing: "easeOutExpo" } );
	}, function() {
		$( this ).find("img").stop().animate( { top: 0 }, { duration: 1100, easing: "easeInExpo" } );
	} );
	
	/*
		Placeholders
	*/
	$("[placeholder]").placeholder();
	
	/*
		Dom additions
	*/
	$("nav.pagination a.left:not(:has(.arrow))").prepend('<span class="arrow pl">');
	$("nav.pagination a.right:not(:has(.arrow))").prepend('<span class="arrow pr">');
	
	/*
		Contact form
	*/
	$(".contact-panel-form").submit( function( e ) {
		
		var form = $( this ),
			action = form.attr("action"),
			contents = form.serialize(),
			submit = form.find(":submit"),
			fields = form.find("input[type='text'], textarea"),
			error = false,
			val;
			
		fields.each( function() {
			
			val = $.trim( this.value );
						
			if ( this.name == "name" && val.length < 1 || this.name == "message" && val.length < 1 ) {
				error = true;
				this.focus();
			}
			else if ( this.name == "email" && ! is_email( val ) ) {
				error = true;
				this.focus();
			}
									
		} );
		
		if ( ! error ) {
		
			form.fadeTo( 250, .5 );
			
			submit.attr("disabled", "disabled");
			
			$.post( action, contents, function( response ) {
					
					if ( response ) {
						
						submit.val( submit.attr("data-str") );
						
						form.fadeTo( 250, 1 );
											
					}
					
				}
			);
		
		}
		
		e.preventDefault();
		
	} );
	
	/*
		HTML5 Audio
	*/
	if ( $("audio").length ) {
					
		audiojs.events.ready( function() {
			audiojs.create( $("audio"), { css: '' } );
		} );
		
	}
	
	/*
		When the page is completely loaded
	*/
	$( window ).load( function() {
		
		/*
			Home widget masonry
		*/
		if ( $(".home-widgets .widget").length > 3 ) {
					
			$(".home-widgets").masonry( {
				itemSelector: ".widget",
				columnWidth: 10,
			} );
			
		}
		
		/*
			Hero slider
		*/
		if ( $(".hero-slider").length ) {
			
			hero = $(".hero-slider"),
			hero_info = hero.children(".info").children("div"),
			hero_info_boxlabel = hero.children(".info").find(".box-label"),
			hero_slider = hero.children(".slider"),
			hero_nav = hero_slider.find("nav"),
			hero_width = hero_slider.width();
						
			hero_slider
				.cycle( {
					fx: cl_hero.fx,
					speed: parseInt( cl_hero.speed ),
					timeout: parseInt( cl_hero.timeout ),
					pause: cl_hero.pause,
					easing: cl_hero.easing,
					slideExpr: ".slide",
					manualTrump: false,
					pager: hero_nav,
					next: hero_slider.find(".next"),
					prev: hero_slider.find(".prev"),
					pagerAnchorBuilder: function() {
						return '<a href="#"></a>';
					},
					before: function( current, next, opts ) {
						
						next = $( next ),
						current = $( current );
						
						if ( $( next.attr("data-info") ).length ) {
							hero_info.fadeOut( opts.speed / 2, function() {
								$( this ).html( $( next.attr("data-info") ).html() ).fadeIn( opts.speed / 2 );
							} );
							if ( hero_slider.hasClass("wide") ) {
								next.delay( opts.speed );
								hero_slider.removeClass("wide").animate( { width: hero_width }, opts.speed, cl_hero.easing );
								hero_info.parent().delay( opts.speed ).slideDown( opts.speed / 2 );
							}
						}
						else if ( ! hero_slider.hasClass("wide") ) {
							next.delay( opts.speed );
							hero_info.parent().slideUp( opts.speed / 2 );
							hero_slider.addClass("wide").delay( opts.speed ).animate( { width: 950 }, opts.speed, cl_hero.easing );
						}
						
						if ( next.parent().is("a") ) {
							hero_info_boxlabel.attr( "href", next.parent().attr("href") ).fadeIn( opts.speed / 2 );
						}
						else if ( hero_info_boxlabel.is(":visible") ) {
							hero_info_boxlabel.fadeOut( opts.speed / 2 );
						}
						
						if ( current.hasClass("video") ) {
							current.find("iframe").data( "src", current.find("iframe").attr("src") ).attr( "src", "" );
						}
						
						if ( next.hasClass("video") ) {
							hero_nav.hide().addClass("invisible");
							next.find("iframe").attr( "src", next.find("iframe").data("src") );
						}
						else if ( hero_nav.hasClass("invisible") ) {
							hero_nav.show().removeClass("invisible");
						}
												
					}
				} );
			
		}
		
		/*
			Items slider
		*/
		if ( $(".mini-slider").length ) {
							
			$(".mini-slider").each( function() {
				
				slider = $( this ),
				opt = window[ slider.attr("data-opt") ];
				
				slider
					.cycle( {
						fx: opt.fx,
						speed: parseInt( opt.speed ),
						timeout: parseInt( opt.timeout ),
						pause: opt.pause,
						easing: opt.easing,
						slideExpr: ".slide",
						manualTrump: false,
						pager: slider.find("nav"),
						next: slider.find(".next"),
						prev: slider.find(".prev"),
						pagerAnchorBuilder: function() {
							return '<a href="#"></a>';
						},
						before: function( current, next, opts ) {
							slider.children("span").fadeOut( opts.speed / 2, function() {
								if ( $( next ).attr("data-caption").length ) {
									$( this ).text( $( next ).attr("data-caption") ).slideDown( 250 );
								}
							} );
						}
					} );
				
			} );

		}
		
	} );
	
	/*
		Fine functions
	*/
	function is_email( address ) {
		return address.match( /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	}
	
} );