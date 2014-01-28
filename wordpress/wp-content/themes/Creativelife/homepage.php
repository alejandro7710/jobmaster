<?php
/*
 *  TEMPLATE NAME: Homepage
 */
?>
<?php get_header(); ?>
<?php
/*******************************/
/*   Home widgets javascript   */
$sidebar_widgets = wp_get_sidebars_widgets();

if ( is_active_sidebar('cl_home') && count( $sidebar_widgets['cl_home'] ) > 3 ) {
	global $cl_enqueue_masonry;
	$cl_enqueue_masonry = true;
}
?>

<?php if ( get_theme_option('hero') ) get_template_part('includes/module/hero-slider'); ?>

<!-- Content container -->
<section class="content-wrap homepage <?php cl_content_class( $post->ID ); ?>">
	
	<?php if ( get_theme_option('latest_work') ) get_template_part('includes/module/latest-work'); ?>
	
	<?php while ( have_posts() ) : the_post(); if ( get_the_content() ) : ?>
					
	<!-- Page content -->
	<section class="content clearfix">
			
		<!-- Page content -->
		<?php the_content(); ?>
	
	</section>
	<!-- end: Page content -->
		
	<?php endif; endwhile; ?>
	
	<?php if ( is_active_sidebar('cl_home') ) : ?>
	
	<!-- Home widgets -->
	<section class="home-widgets clearfix">
	
		<!-- Home sidebar -->
		<?php dynamic_sidebar('cl_home'); ?>
		
	</section>
	<!-- end: Home widgets -->
	
	<?php endif; ?>

</section>
<!-- end: Content container -->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>