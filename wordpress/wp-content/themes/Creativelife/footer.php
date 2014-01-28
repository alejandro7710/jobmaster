		<!-- Floats clearer -->
		<div class="clear"></div>
		
		<!-- Footer -->
		<footer class="site-footer clearfix">
		
			<!-- Text -->
			<span>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.<br />
                             Design by <a href="http://www.mafiashare.net" target="_blank">Creativelife.</a></span>
			
			<!-- Menu -->
			<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => '', 'menu_class' => 'nav', 'fallback_cb' => '' ) ); ?>
			
		</footer>
		<!-- end: Footer -->
		
	</div>
	<!-- end: Main container -->
		
	<?php if ( get_theme_option('body_background_image') && get_theme_option('body_background_url') && get_theme_option('body_background_stretch') || get_theme_option('body_background_image') && get_theme_option('body_background_stretch') && isset( $post ) && meta_obtain( 'url', '_cl_background', $post->ID ) ) get_template_part('includes/module/background'); ?>
	
	<?php wp_footer(); ?>

</body>
</html>