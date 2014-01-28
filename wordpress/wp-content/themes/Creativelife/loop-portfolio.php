<?php
/***************************/
/*   portfolio item setup   */
global $portfolio;

/**************************/
/*   Getting item metas   */
$meta = get_post_meta( $post->ID, '_cl_portfolio_item_settings', true );

/****************************/
/*   Item main attributes   */
$item = array(
	'class' => array('box portfolio-item'),
	'style' => null,
	'excerpt_length' => 40,
	'filters' => get_the_terms( $post->ID, 'portfolio_filter_' . $portfolio['id'] ),
	'title_attr' => get_the_title(),
	'href' => get_permalink(),
	'has_lightbox' => meta_get('lightbox', $meta ),
	'lightbox_href' => meta_get('lightbox_href', $meta ),
	'lightbox_cap' => meta_get('lightbox_cap', $meta ),
	'lightbox_rel' => meta_get('lightbox_rel', $meta),
	'custom_link' => meta_get('link', $meta )
);

/*******************************/
/*   Setting main attributes   */
switch ( $portfolio['layout'] ) {
	case '2':
		$item['class'][] = 'half';
		$item['thumbnail'] = 'cl_portfolio_2';
		$item['excerpt_length'] = 100;
	break;
	case '3':
		$item['class'][] = 'one-third';
		$item['thumbnail'] = 'cl_portfolio_3';
	break;
	case '4':
		$item['class'][] = 'one-fourth';
		$item['thumbnail'] = 'cl_portfolio_4';
		$item['excerpt_length'] = 15;
	break;
	case '5':
		$item['class'][] = 'one-fifth';
		$item['thumbnail'] = 'cl_portfolio_5';
		$item['excerpt_length'] = 10;
	break;
	
};

/********************/
/*   Custom link    */
if ( $item['custom_link'] ) {
	$item['href'] = $item['custom_link'];
}

/*****************/
/*   Lightbox    */
if ( $item['has_lightbox'] ) {
	$item['title_attr'] = ( $item['lightbox_cap'] ? $item['lightbox_cap'] : $item['title_attr'] );
	$item['href'] = get_thumb_src( $post->ID, 'full' );
	$item['href'] = ( $item['lightbox_href'] ? $item['lightbox_href'] : $item['href'] );
	$item['class'][] = 'view';
}
else {
	$item['class'][] = get_post_format();
}

/********************************************/
/*   Converting classes to a nice string    */
$item['class'] = join( ' ', $item['class'] );

/****************************************/
/*   Getting user's custom thumbnail    */
if ( $portfolio['custom_height'] ) {
	$item['thumbnail'] = '_' . $portfolio['name'];
	$item['style'] = 'height: ' . $portfolio['custom_height'] . 'px;';
}
?>

<!-- Portfolio item -->
<a href="<?php echo esc_url( $item['href'] ); ?>" title="<?php esc_attr_e( $item['title_attr'] ); ?>" rel="<?php echo sanitize_title( $item['lightbox_rel'] ); ?>" class="<?php esc_attr_e( $item['class'] ); ?>" style="<?php esc_attr_e( $item['style'] ); ?>" data-tag="<?php esc_attr_e( haku_flatten_terms( $item['filters'] ) ); ?>">
	
	<!-- Image -->
	<?php if ( has_post_thumbnail() ) the_post_thumbnail( $item['thumbnail'], array( 'title' => '' ) ); ?>
	
	<!-- Content -->
	<div>
		
		<!-- Title -->
		<h5><?php the_title(); ?></h5>
		
		<!-- Excerpt -->
		<p><?php echo do_shortcode( has_excerpt() ? get_the_excerpt() : haku_shorten( get_the_content(), $item['excerpt_length'] ) ); ?></p>
	
	</div>
	<!-- end: Content -->
	
	<?php if ( $item['filters'] && ! $portfolio['no_tools'] ) : ?>
	
	<!-- Metas -->
	<span class="meta"><?php echo haku_flatten_terms( $item['filters'], false, ', ' ); ?></span>
	
	<?php endif; ?>
	
</a>
<!-- end: Portfolio item -->