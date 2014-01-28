<?php
/****************************/
/*   Post format: Gallery   */
$gallery_id = uniqid('cl_gallery_');

/*****************************/
/*   Getting gallery metas   */
$meta = get_post_meta( $post->ID, '_cl_format_gallery', true );

/*****************/
/*   Js output   */
global $cl_enqueue_jcycle;
$cl_enqueue_jcycle = true;
	
$js_opt = array(
	'speed' => get_theme_option('gallery_speed'),
	'fx' => meta_get('fx', $meta, get_theme_option('gallery_fx') ),
	'easing' => get_theme_option('gallery_easing'),
	'timeout' => get_theme_option('gallery_timeout'),
	'pause' => ( get_theme_option('gallery_pause') ? true : false )
);

wp_localize_script( 'cl_js_init', $gallery_id, $js_opt );

/****************/
/*   WP query   */
$query = array(
	'post_type' => 'attachment',
	'numberposts' => '-1',
	'post_parent' => $post->ID,
	'order' => meta_get('order', $meta, 'DESC'),
	'orderby' => meta_get('orderby', $meta, 'date')
);

$post_attachments = get_posts( $query );
?>

<?php if ( $post_attachments ) : ?>

<!-- Featured -->
<figure class="<?php echo ( is_theme_post_type() ? 'full-width' : 'half right' ); ?> mini-slider" id="mini-slider_<?php the_ID(); ?>" data-opt="<?php esc_attr_e( $gallery_id ); ?>">
	
	<?php if ( get_theme_option('gallery_pager') ) : ?>
	
	<!-- Pager -->
	<nav></nav>
	
	<?php endif; ?>
	
	<!-- Next link -->
	<a href="#" class="next"><span class="arrow pr"></span></a>
	
	<!-- Prev link -->
	<a href="#" class="prev"><span class="arrow pl"></span></a>
	
	<!-- Captions -->
	<span class="emph"></span>
	
	<?php foreach ( $post_attachments as $attachment ) : ?>
	
	<!-- Slide -->		
	<img src="<?php echo get_thumb_src( $attachment->ID, ( is_theme_post_type() ? 'cl_portfolio' : 'cl_article' ), false ); ?>" data-caption="<?php esc_attr_e( $attachment->post_excerpt ); ?>" class="slide" alt="" />
	
	<?php endforeach; ?>

</figure>
<!-- end: Featured -->

<?php endif; ?>