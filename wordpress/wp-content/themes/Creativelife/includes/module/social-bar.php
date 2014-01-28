<!-- Social bar -->
<nav class="social-bar header-bar">
	
	<?php if ( get_theme_option('social_about') ) : ?>
	
	<!-- About toggle -->
	<a href="#" class="about-toggle"><span><?php theme_option('social_about_label'); ?></span><div></div></a>
	
	<?php endif; ?>
	
	<!-- Social icons -->
	<ul>
		
		<?php if ( get_theme_option('social_twitter') ) : ?>
		
		<li class="twitter"><a href="http://twitter.com/<?php echo esc_attr( get_theme_option('social_twitter') ); ?>">Twitter</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_facebook') ) : ?>
		
		<li class="facebook"><a href="<?php echo esc_url( get_theme_option('social_facebook') ); ?>">Facebook</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_google') ) : ?>
		
		<li class="google"><a href="<?php echo esc_url( get_theme_option('social_google') ); ?>">Google</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_pinterest') ) : ?>
		
		<li class="pinterest"><a href="http://pinterest.com/<?php echo esc_attr( get_theme_option('social_pinterest') ); ?>">Pinterest</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_vimeo') ) : ?>
		
		<li class="vimeo"><a href="<?php echo esc_url( get_theme_option('social_vimeo') ); ?>">Vimeo</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_flickr') ) : ?>
		
		<li class="flickr"><a href="<?php echo esc_url( get_theme_option('social_flickr') ); ?>">Flickr</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_dribbble') ) : ?>
		
		<li class="dribbble"><a href="http://dribbble.com/<?php echo esc_attr( get_theme_option('social_dribbble') ); ?>">Dribbble</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_forrst') ) : ?>
		
		<li class="forrst"><a href="http://forrst.me/<?php echo esc_attr( get_theme_option('social_forrst') ); ?>">Forrst</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_lastfm') ) : ?>
		
		<li class="lastfm"><a href="http://www.last.fm/user/<?php echo esc_attr( get_theme_option('social_lastfm') ); ?>">Last.fm</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_tumblr') ) : ?>
		
		<li class="tumblr"><a href="<?php echo esc_url( get_theme_option('social_tumblr') ); ?>">Tumblr</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_linkedin') ) : ?>
		
		<li class="linkedin"><a href="<?php echo esc_url( get_theme_option('social_linkedin') ); ?>">LinkedIn</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_behance') ) : ?>
		
		<li class="behance"><a href="<?php echo esc_url( get_theme_option('social_behance') ); ?>">Behance</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_delicious') ) : ?>
		
		<li class="delicious"><a href="<?php echo esc_url( get_theme_option('social_delicious') ); ?>">Delicious</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_deviantart') ) : ?>
		
		<li class="deviantart"><a href="http://<?php echo esc_attr( get_theme_option('social_deviantart') ); ?>.deviantart.com">Deviantart</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_skype') ) : ?>
		
		<li class="skype"><a href="skype:<?php echo esc_attr( get_theme_option('social_skype') ); ?>?chat">Skype</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_youtube') ) : ?>
		
		<li class="youtube"><a href="<?php echo esc_url( get_theme_option('social_youtube') ); ?>">YouTube</a><span></span></li>
		
		<?php endif; ?>
		
		<?php if ( get_theme_option('social_contact') ) : ?>
		
		<li class="mail-toggle"><a href="#"></a><span></span><div></div></li>
		
		<?php endif; ?>
		
	</ul>
	<!-- end: Social icons -->
	
</nav>
<!-- end: Social bar -->

<?php if ( get_theme_option('social_about') ) : ?>

<?php
/*********************/
/*   Columns class   */
$class = 0;
if ( get_theme_option('social_about_col_1') ) $class++;
if ( get_theme_option('social_about_col_2') ) $class++;
if ( get_theme_option('social_about_col_3') ) $class++;
$class = ( $class == 3 ? 'one-third' : ( $class == 2 ? 'half' : 'full-width' ) );
?>

<!-- About section -->
<section class="about-panel toggle-panel clearfix">
	
	<?php if ( get_theme_option('social_about_col_1') ) : ?>
	
	<!-- Column -->
	<div class="<?php echo $class; ?>">
						
		<?php echo apply_filters( 'haku_content', get_theme_option('social_about_col_1') ); ?>
	
	</div>
	<!-- end: Column -->
	
	<?php endif; ?>
	
	<?php if ( get_theme_option('social_about_col_2') ) : ?>
	
	<!-- Column -->
	<div class="<?php echo $class; ?>">
		
		<?php echo apply_filters( 'haku_content', get_theme_option('social_about_col_2') ); ?>
	
	</div>
	<!-- end: Column -->
	
	<?php endif; ?>
	
	<?php if ( get_theme_option('social_about_col_3') ) : ?>
	
	<!-- Column -->
	<div class="<?php echo $class; ?>">
		
		<?php echo apply_filters( 'haku_content', get_theme_option('social_about_col_3') ); ?>
	
	</div>
	<!-- end: Column -->
	
	<?php endif; ?>
	
</section>
<!-- end: About section -->

<?php endif; ?>

<?php if ( get_theme_option('social_contact') ) : ?>

<!-- Contact panel -->
<section class="contact-panel toggle-panel clearfix">
		
	<!-- Contact form -->
	<form action="<?php echo get_includes_dir('uri'); ?>/mail.php" method="post" class="contact-panel-form two-third">
	
		<!-- One third column -->
		<div class="one-third">
			
			<?php echo do_shortcode( get_theme_option('social_contact_col_1') ); ?>
			
			<!-- Name -->
			<p><input type="text" placeholder="<?php esc_attr_e( __('Your Name', 'haku') ); ?>" name="name" value="" /></p>
			
			<!-- Email -->
			<p><input type="text" placeholder="<?php esc_attr_e( __('Your E-Mail', 'haku') ); ?>" name="email" value="" /></p>
			
			<!-- Website -->
			<p><input type="text" placeholder="<?php esc_attr_e( __('Your Website', 'haku') ); ?>" name="website" value="" /></p>
			
			<!-- Submit -->
			<p class="last"><input type="submit" name="submit" data-str="<?php esc_attr_e( __('Message sent! Thanks :)', 'haku') ); ?>" value="<?php esc_attr_e( __('Send Message', 'haku') ); ?>" /></p>
		
		</div>
		<!-- end: One third column -->
		
		<!-- One third column -->
		<div class="one-third no-margin">
			
			<?php echo do_shortcode( get_theme_option('social_contact_col_2') ); ?>
			
			<!-- Message -->
			<p class="last"><textarea name="message" placeholder="<?php esc_attr_e( __('Message', 'haku') ); ?>"></textarea></p>
		
		</div>
		<!-- end: One third column -->
	
	</form>
	<!-- end: Contact form -->
		
	<!-- One third column -->
	<div class="one-third no-margin">
		
		<?php echo apply_filters( 'haku_content', get_theme_option('social_contact_col_3') ); ?>
		
	</div>
	<!-- end: One third column -->
	
</section>
<!-- end: Contact panel -->

<?php endif; ?>