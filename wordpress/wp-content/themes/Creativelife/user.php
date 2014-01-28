<?php
/*
 *  User custom styles
 */

define( 'WP_USE_THEMES', false );
require_once('../../../wp-load.php');
header('Content-type: text/css');
?>
/*----------------------------------------------------------------------------
	BODY
----------------------------------------------------------------------------*/

body {
	font-family: <?php echo get_theme_option('font_family'); ?>;
	font-size: <?php echo get_theme_option('body_font_size'); ?>px;
	line-height: <?php echo get_theme_option('body_line_height'); ?>px;
	color: <?php echo get_theme_option('body_color'); ?>;
	background-color: <?php echo get_theme_option('body_background_color'); ?>;
	
	<?php if ( get_theme_option('body_background_image') && get_theme_option('body_background_url') && ! get_theme_option('body_background_stretch') || get_theme_option('body_background_image') && ! get_theme_option('body_background_url') ) : ?>
	
	background-image: url(<?php echo ( get_theme_option('body_background_url') ? esc_url( get_theme_option('body_background_url') ) : get_stylesheet_directory_uri() . '/images/patterns/' . get_theme_option('body_background_pattern') . '.png' ); ?>);
	
	<?php endif; ?>

}


/*----------------------------------------------------------------------------
	BACKGROUND COLOR
----------------------------------------------------------------------------*/

.header-bar,
.skills-table > div,
.hero-slider .info,
.hero-slider .slider .next,
.hero-slider .slider .prev,
.mini-slider .next,
.mini-slider .prev,
.mini-slider > span,
.box,
.box-title.invert,
.site-footer,
article > .one-fourth > .left,
article > .one-fourth > .right,
#respond form,
.commentlist .comment-author,
.sidebar .widget,
.homepage .widget-content,
.audiojs {
	background-color: <?php echo get_theme_option('background_color'); ?>;
	background-color: rgba( <?php echo get_rgb_value( get_theme_option('background_color') ); ?>, <?php echo get_theme_option('background_color_opacity'); ?> );
}

button:hover,
input[type="submit"]:hover,
.portfolio header ul li:first-child,
.project-view header a {
	background-color: <?php echo get_theme_option('background_color'); ?>;
}

.box-title,
.portfolio header ul li,
.latest-articles li a,
.sidebar .portfolio-feed > h5,
.sidebar .video-widget > h5,
.latest-articles .jump:hover,
button:active,
input[type="submit"]:active {
	color: <?php echo get_theme_option('background_color'); ?>;
}

.latest-articles li a {
	border-color: <?php echo get_theme_option('background_color'); ?>;
}


/*----------------------------------------------------------------------------
	KEY COLOR
----------------------------------------------------------------------------*/

a,
.color,
.box-title.invert,
.subscribe-box form input[type="submit"]:hover,
.site-footer a,
.portfolio header ul li:first-child,
.project-view header a:hover,
.commentlist .comment-reply:hover .comment-reply-link,
#respond input[type="submit"]:hover,
.latest-articles .jump {
	color: <?php echo get_theme_option('key_color'); ?>;
}

.social-bar .about-toggle:hover,
.social-bar .about-toggle.active,
.social-bar .mail-toggle:hover span,
.social-bar .mail-toggle.active span,
.contact-panel-form input[type="text"],
.contact-panel-form textarea,
.menu-bar ul .current-menu-item span,
.menu-bar ul .current_page_parent span,
.menu-bar ul .current-menu-ancestor span,
.menu-bar ul .current-page-ancestor span,
.menu-bar ul li:hover span,
.skills-table > h5 div,
.hero-slider nav .activeSlide,
.mini-slider nav .activeSlide,
.hero-slider .slider .next:hover,
.hero-slider .slider .prev:hover,
.mini-slider .next:hover,
.mini-slider .prev:hover,
.box-title,
.portfolio header,
.portfolio-item .meta,
.pagination,
article > .one-fourth .left span,
.commentlist .comment-reply,
#respond input[type="submit"],
.sidebar .portfolio-feed > h5,
.sidebar .video-widget > h5,
.latest-articles .widget-content,
blockquote,
.audiojs .scrubber .progress {
	background-color: <?php echo get_theme_option('key_color'); ?>;
}

.social-bar .about-toggle div,
.social-bar .mail-toggle div {
	border-top-color: <?php echo get_theme_option('key_color'); ?>;
}

.box-label > div {
	border-right-color: <?php echo get_theme_option('key_color'); ?>;
}

.project-view header .right:hover .pl,
.project-view header a:hover .pl {
	border-right-color: <?php echo get_theme_option('key_color'); ?>;
}

.project-view header .right:hover .pr,
.project-view header a:hover .pr {
	border-left-color: <?php echo get_theme_option('key_color'); ?>;
}

.commentlist .comment-reply div,
.commentlist .bypostauthor .comment-author img {
	border-right-color: <?php echo get_theme_option('key_color'); ?>;
}


/*----------------------------------------------------------------------------
	CONTRAST COLOR
----------------------------------------------------------------------------*/

.header-bar,
.header-bar a,
.contact-panel-form input[type="text"],
.contact-panel-form textarea,
.contact-panel-form input[type="submit"],
.skills-table > h5,
.skills-table > div,
.hero-slider .info,
.hero-slider .info a,
.mini-slider > span,
.box,
.box a,
.widget a,
.box-title a,
.box-title span,
.site-footer,
.site-footer a:hover,
.portfolio header ul .active,
.portfolio header ul li:hover,
.project-view header a,
.portfolio-item:hover,
.pagination a,
article > .one-fourth > .left,
article > .one-fourth > .right,
article > .one-fourth a,
.commentlist .comment-author,
.commentlist .comment-author a,
#respond form,
#respond a:hover,
#respond input[type="submit"],
.sidebar .widget,
.homepage .widget-content,
.sidebar .portfolio-feed > h5 span,
.sidebar .video-widget > h5 span,
.latest-articles li a:hover,
blockquote,
button:hover,
input[type="submit"]:hover,
.audiojs {
	color: <?php echo get_theme_option('contrast_color'); ?>;
}

.contact-panel-form ::-webkit-input-placeholder {
	color: <?php echo get_theme_option('contrast_color'); ?>;
}

.contact-panel-form :-moz-placeholder {
	color: <?php echo get_theme_option('contrast_color'); ?>;
}

.contact-panel-form .placeholder {
	color: <?php echo get_theme_option('contrast_color'); ?>;
}

.toggle-panel,
.hero-slider nav a,
.mini-slider nav a,
.content-wrap .content,
.commentlist .comment-content {
	background-color: <?php echo get_theme_option('contrast_color'); ?>;
	background-color: rgba( <?php echo get_rgb_value( get_theme_option('contrast_color') ); ?>, <?php echo get_theme_option('contrast_color_opacity'); ?> );
}

.project-view header a:hover,
#respond input[type="submit"]:hover,
.commentlist .comment-reply:hover,
input[type="submit"]:active,
input[type="text"],
input[type="password"],
textarea,
.latest-articles .jump,
button:active {
	background-color: <?php echo get_theme_option('contrast_color'); ?>;
}

.arrow.pl {
	border-right-color: <?php echo get_theme_option('contrast_color'); ?>;
}

.arrow.pr {
	border-left-color: <?php echo get_theme_option('contrast_color'); ?>;
}

.commentlist .comment-reply:hover div {
	border-right-color: <?php echo get_theme_option('contrast_color'); ?>;
}

.latest-articles li a:hover {
	border-color: <?php echo get_theme_option('contrast_color'); ?>;
}


/*----------------------------------------------------------------------------
	NEUTRAL COLOR
----------------------------------------------------------------------------*/

.toggle-panel h1 {
	color: <?php echo get_theme_option('neutral_color'); ?>;
}

.contact-panel-form input[type="submit"],
.skills-table > h5,
.hero-slider .slider,
.mini-slider,
button,
input[type="submit"],
.audiojs .scrubber .loaded {
	background-color: <?php echo get_theme_option('neutral_color'); ?>;
}

.box-label:hover > div {
	border-right-color: <?php echo get_theme_option('neutral_color'); ?>;
}

.site-footer ul li {
	border-color: <?php echo get_theme_option('neutral_color'); ?>;
}


/*----------------------------------------------------------------------------
	CUSTOM STYLES
----------------------------------------------------------------------------*/

<?php echo get_theme_option('css_code'); ?>
