/*
 *	Theme Quicktags
 */

jQuery( window ).load( function() {
	jQuery("[id^='qt_content_tqt_']").addClass("qtq");
} );

/********************/
/*   [code][/code]  */
QTags.addButton(
	'tqt_code',
	'code',
	'[code]',
	'[/code]',
	''
);

/**********************/
/*   [quote][/quote]  */
QTags.addButton(
	'tqt_quote',
	'quote',
	'[quote cite="John Doe"]',
	'[/quote]',
	''
);

/********************************************/
/*   [skills-container][/skills-container]  */
QTags.addButton(
	'tqt_skills-container',
	'skills-container',
	'[skills-container]',
	'[/skills-container]',
	''
);

/**********************/
/*   [skill][/skill]  */
QTags.addButton(
	'tqt_skill',
	'skill',
	'[skill label="Awesomeness" val=100%]',
	'',
	''
);

/**********************/
/*   [color][/color]  */
QTags.addButton(
	'tqt_color',
	'color',
	'[color]',
	'[/color]',
	''
);

/****************/
/*   [youtube]  */
QTags.addButton(
	'tqt_youtube',
	'&nbsp;',
	'[youtube url=http://www.youtube.com/watch?v=clfAq1xSevc]',
	'',
	''
);

/**************/
/*   [vimeo]  */
QTags.addButton(
	'tqt_vimeo',
	'&nbsp;',
	'[vimeo url=http://vimeo.com/28043193]',
	'',
	''
);

/**********************************************/
/*   [columns-container][/columns-container]  */
QTags.addButton(
	'tqt_columns-container',
	'columns-container',
	'[columns-container]',
	'[/columns-container]',
	''
);

/************************/
/*   [column][/column]  */
QTags.addButton(
	'tqt_column',
	'column',
	'[column size=3 height=]',
	'[/column]',
	''
);

/*********************/
/*   [reset-floats]  */
QTags.addButton(
	'tqt_clear',
	'reset-floats',
	'[reset-floats]',
	'',
	''
);

/********************/
/*   [mark][/mark]  */
QTags.addButton(
	'tqt_mark',
	'&nbsp;',
	'[mark]',
	'[/mark]',
	''
);

/************/
/*   [map]  */
QTags.addButton(
	'tqt_map',
	'map',
	'[map center="New York, NY" zoom=12 size=480x250 type=roadmap]',
	'',
	''
);

/********************/
/*   [link][/link]  */
QTags.addButton(
	'tqt_link',
	'&nbsp;',
	'[link url=http://]',
	'[/link]',
	''
);

/************/
/*   [pic]  */
QTags.addButton(
	'tqt_pic',
	'&nbsp;',
	'[pic url=http:// align=left]',
	'',
	''
);

/****************/
/*   [sidebar]  */
QTags.addButton(
	'tqt_sidebar',
	'sidebar',
	'[sidebar id=custom_sidebar_id]',
	'',
	''
);

/******************/
/*   [raw][/raw]  */
QTags.addButton(
	'tqt_raw',
	'raw',
	'[raw]',
	'[/raw]',
	''
);