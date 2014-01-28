/*
 *	Menus javascript
 */

jQuery( document ).ready( function( $ ) {
	
	$("[for^='edit-menu-item-attr-title']").each( function() {
		
		title = $( this ),
		content = title.children();
		
		title
			.html( cl_icon[0] + ' (<a href="' + cl_icon[2] + '" target="_blank">?</a>)' )
			.css( { 
				"font-weight": "bold",
				"font-style": "normal"
			})
			.append( content )
			.children("[name^='menu-item-attr-title']")
			.attr( "placeholder", cl_icon[1] );
	
	} );
	
} );