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
	var	portfolio = $(".portfolio"),
		portfolio_ipp = parseInt( cl_portfolio.ipp ),
		portfolio_nav = portfolio.find(".pagination .right, .pagination .left"),
		portfolio_filters = $(".portfolio header li"),
		portfolio_reset_filter = portfolio_filters.filter("[data-tag='#']"),
		portfolio_reset_filter_str_orig = portfolio_reset_filter.text(),
		portfolio_reset_filter_str_all = portfolio_reset_filter.attr("data-str"),
		portfolio_items = $(".portfolio .portfolio-item"),
		portfolio_items_num = portfolio_items.length,
		portfolio_cols = portfolio_items.filter(":first").attr("class").split(" ")[ 2 ],
		portfolio_col,
		portfolio_paged = 1,
		portfolio_paged_start,
		portfolio_paged_end,
		portfolio_hash = window.location.hash;
			
	if ( ! cl_portfolio.no_hash && portfolio_hash ) {
	
		portfolio_hash = portfolio_hash.substring( 1 ).toLowerCase();
		
	}
				
	switch ( portfolio_cols ) {
		case "half": portfolio_col = 2; break;
		case "one-third": portfolio_col = 3; break;
		case "one-fourth": portfolio_col = 4; break;
		case "one-fifth": portfolio_col = 5; break;
	}
	
	portfolio_filters.click( function() {
		
		$this = $(this),
		filter = $this.attr("data-tag");
		
		if ( filter == "#" ) {
						
			reset_portfolio();
			
			unlock_filters();
			
			if ( ! cl_portfolio.no_hash ) {
			
				window.location.hash = "#";
				
			}
			
		}
		else if ( ! $this.hasClass("active") ) {
			
			$this.addClass("active").siblings().not("[data-tag='#']").removeClass();
						
			portfolio_filter( filter );
			
		}
		
	} );
	
	/*
		Pagination
	*/
	if ( portfolio_items_num > portfolio_ipp ) {

		portfolio_nav.filter(".left").click( function( e ) {
			
			e.preventDefault();
			
			portfolio_paged++;
			
			portfolio_paginate();

		} );
		
		portfolio_nav.filter(".right").click( function( e ) {			
			
			e.preventDefault();
			
			portfolio_paged--;
			
			portfolio_paginate();
			
		} );
				
		portfolio_paginate();
					
	}
	else {
		
		portfolio_nav.parent().hide();
	
	}
	
	/*
		Hash navigation
	*/
	if ( portfolio_hash && portfolio_filters.filter("[data-tag='" + portfolio_hash + "']").length ) {
		
		portfolio_filters.filter("[data-tag='" + portfolio_hash + "']").addClass("active").siblings().not("[data-tag='#']").removeClass();
		
		portfolio_filter( portfolio_hash );
				
	}
	
	/*
		Filter
	*/
	function portfolio_filter( data_tag ) {
						
		if ( portfolio.hasClass("altered") ) {
			
			reset_portfolio();

		}
		
		portfolio_reset_filter.text( portfolio_reset_filter_str_all );
					
		portfolio_items.hide().filter("[data-tag*='" + data_tag + "']").show();
		
		portfolio_reodd();

		flag_portfolio();
		
		if ( ! cl_portfolio.no_hash ) {
		
			window.location.hash = "#" + data_tag;
			
		}
		
	}
	
	function reset_portfolio() {
		
		portfolio_items.removeClass("no-margin margin").css("opacity", 1).show();
				
		portfolio.removeClass("altered");
		
		portfolio_paged = 1;
		
		portfolio_paginate();
		
	}
	
	function unlock_filters() {
		
		if ( portfolio_filters.hasClass("active") ) {
		
			portfolio_filters.removeClass("active");
		
			portfolio_reset_filter.text( portfolio_reset_filter_str_orig );
			
		}
		
	}
	
	function flag_portfolio() {
				
		portfolio.addClass("altered");
		
		portfolio_nav.hide();
		
	}
	
	function portfolio_reodd() {
				
		portfolio_items.filter(":visible").each( function( i ) {
		
			z = ( i + 1 ) % portfolio_col,
			$this = $( this );
						
			$this.removeClass("no-margin margin")
			
			if ( z === 0 ) {
				$this.addClass("no-margin");
			}
			else {
				$this.addClass("margin");
			}
			
		} );
			
	}
	
	function portfolio_paginate() {
				
		portfolio_paged_start = ( ( portfolio_paged - 1 ) * portfolio_ipp ),
		portfolio_paged_end = portfolio_paged_start + portfolio_ipp;
				
		portfolio_items.each( function( items ) {
		
			var $this = $(this);
			
			if ( items >= portfolio_paged_start && items < portfolio_paged_end ) {
				
				$this.show();
			
			}
			else {
				
				$this.hide();
				
			}
			
			if ( portfolio_paged_end >= portfolio_items_num ) {
			
				portfolio_nav.filter(".left").hide();
				
			}
			else {
			
				portfolio_nav.filter(".left").show();
				
			}
			
			if ( portfolio_paged_start >= 1 ) {
				
				portfolio_nav.filter(".right").show();
			
			}
			else {
				
				portfolio_nav.filter(".right").hide();
			
			}
			
			if ( items == portfolio_items_num - 1 ) {
			
				portfolio_reodd();
				
			
			}
			
		} );	
	
	}
	
} );