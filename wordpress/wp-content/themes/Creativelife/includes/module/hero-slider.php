<?php
/************************/
/*   Slider js output   */
global $cl_enqueue_jcycle;
$cl_enqueue_jcycle = true;

$js_opt = array(
	'speed' => get_theme_option('hero_speed'),
	'fx' => get_theme_option('hero_fx'),
	'easing' => get_theme_option('hero_easing'),
	'timeout' => get_theme_option('hero_timeout'),
	'pause' => ( get_theme_option('hero_pause') ? true : false )
);

wp_localize_script( 'cl_js_init', 'cl_hero', $js_opt );
?>

<!-- Hero slider -->
<section class="hero-slider clearfix">
	
	<!-- Info box -->
	<figcaption class="info">
		
		<!-- Content -->
		<div><h5><?php _e('Loading..', 'haku'); ?></h5></div>
		
		<!-- Bottom-right label -->
		<a href="#" class="box-label link"><div><div></div></div></a>
	
	</figcaption>
	<!-- end: Info box -->
	
	<!-- Slider -->
	<figure class="slider">
		
		<?php if ( get_theme_option('hero_pager') ) : ?>
		
		<!-- Pager -->
		<nav></nav>
		
		<?php endif; ?>
		
		<!-- Next link -->
		<a href="#" class="next"><span class="arrow pr"></span></a>
		
		<!-- Prev link -->
		<a href="#" class="prev"><span class="arrow pl"></span></a>
		
		<?php foreach ( get_theme_slides('theme_slides') as $slide_id => $slide ) : ?>
		
		<?php if ( isset( $slide['url'] ) && ! isset( $slide['linkto'] ) && haku_get_url_type( $slide['url'] ) == 'youtube' ) : $id = haku_get_video_id( $slide['url'] ); ?>
			
		<!-- Slide -->
		<div class="slide video">
		
			<!-- Youtube video -->
			<iframe width="950" height="300" src="http://www.youtube.com/embed/<?php echo $id; ?>?wmode=transparent" frameborder="0" allowfullscreen></iframe>
			
		</div>
		<!-- end: Slide -->
		
		<?php elseif ( isset( $slide['url'] ) && ! isset( $slide['linkto'] ) && haku_get_url_type( $slide['url'] ) == 'vimeo' ) : $id = haku_get_video_id( $slide['url'] ); ?>
			
		<!-- Slide -->
		<div class="slide video">
			
			<!-- Vimeo Video -->
			<iframe width="950" height="300" src="http://player.vimeo.com/video/<?php echo $id; ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0"></iframe>
			
		</div>
		<!-- end: Slide -->
					
		<?php else : ?>
		
		<?php if ( isset( $slide['url'] ) && $slide['url'] ) : ?>
		
		<!-- Slide link -->
		<a href="<?php echo esc_url( $slide['url'] ); ?>" class="<?php if ( haku_get_url_type( $slide['url'] ) == 'image' ) echo 'view'; ?>" rel="hero">
	
		<?php endif; ?>
		
		<!-- Slide -->
		<img src="<?php echo haku_get_custom_thumbnail( esc_url( $slide['picture'] ), ( $slide['content'] ? 'cl_hero' : 'cl_hero_full' ) ); ?>" data-info="#cap_<?php echo $slide_id; ?>" class="slide" alt="" />
		
		<?php if ( isset( $slide['url'] ) && $slide['url'] ) : ?>
	
		</a>
		<!-- end: Slide link -->
	
		<?php endif; ?>
		
		<?php endif; ?>
		
		<?php endforeach; ?>

	</figure>
	<!-- end: Slider -->
	
	<!-- Captions -->
	<div class="hidden">
		
		<?php foreach ( get_theme_slides('theme_slides') as $slide_id => $slide ) : ?>
		
		<?php if ( $slide['content'] ) : ?>
		
		<!-- Caption -->
		<div id="cap_<?php echo $slide_id; ?>"><?php echo apply_filters( 'haku_content', stripslashes( $slide['content'] ) ); ?></div>
		
		<?php endif; ?>
		
		<?php endforeach; ?>
		
	</div>
	<!-- end: Captions -->

</section>
<!-- end: Hero slider -->