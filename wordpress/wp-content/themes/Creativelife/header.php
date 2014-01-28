<!doctype html>

<!-- Html -->
<!--[if IE 8 ]> <html class="ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if gte IE 9 ]> <html class="ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if !IE ]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<!-- Head -->
<head>
	
	<!-- Charset -->
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<!-- Page title -->
	<title><?php wp_title( '-', 1, 'right' ); ?> <?php bloginfo('name'); ?></title>
	
	<!-- Profile -->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	
	<!-- CSS -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?v=<?php echo get_theme_version(); ?>">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/user.php?v=<?php echo get_theme_version(); ?>">
	
	<!-- Favourites icon -->
	<link rel="shortcut icon" href="<?php echo esc_url( get_theme_option('favicon') ); ?>">
	
	<!-- Pingback -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<!--[if lt IE 9]>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/selectivizr.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	
	<!-- WP head -->
	<?php wp_head(); ?>
	
</head>
<!-- end: Head -->

<!-- Body -->
<body <?php body_class(); ?>>

	<!-- Main container -->
	<div class="container">
		
		<?php if ( get_theme_option('social_bar') ) get_template_part('includes/module/social-bar'); ?>
		
		<!-- Main menu bar -->
		<nav class="menu-bar header-bar">
			
			<!-- Logo -->
			<h1 class="logo"><a href="<?php echo home_url(); ?>"><?php echo ( get_theme_option('logo_image') ? '<img src="' . esc_url( get_theme_option('logo_image') ) . '" alt="Logo" />' : do_shortcode( get_theme_option('plain_logo_text') ) ); ?></a></h1>
			
			<!-- Menu -->			
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'menu_class' => 'nav', 'fallback_cb' => '', 'walker' => new creativelife_walker() ) ); ?>
		
		</nav>
		<!-- end: Main menu bar -->