<?php
/*
 *  TEMPLATE NAME: Portfolio
 */
?>
<?php get_header(); ?>

<?php
/***********************/
/*   Portfolio setup   */
global $post;

/*******************************/
/*   Getting portfolio metas   */
$meta = get_post_meta( $post->ID, '_cl_portfolio_settings', true );

/******************************/
/*   Portfolio main settings   */
$portfolio = array(
	'id' => $post->ID,
	'name' => $post->post_name,
	'layout' => meta_get( 'layout', $meta, 3 ),
	'terms' => get_terms( 'portfolio_filter_' . $post->ID ),
	'post_type' => 'portfolio_' . $post->ID,
	'ipp' => ( intval( meta_get('ipp', $meta) ) ? meta_get('ipp', $meta) : 9 ),
	'no_tools' => meta_get('no_tools', $meta),
	'custom_height' => ( intval( meta_get('height', $meta) ) ? meta_get('height', $meta) : false ),
	'order' => meta_get('order', $meta, 'DESC'),
	'orderby' => meta_get('orderby', $meta, 'date'),
	'no_hash' => meta_get('no_hash', $meta)
);

/*****************/
/*   Js output   */
if ( ! $portfolio['no_tools'] ) {
	
	// Javascript
	global $cl_enqueue_portfolio_js;
	$cl_enqueue_portfolio_js = true;
	
	$portfolio['js_opt'] = array( 'ipp' => $portfolio['ipp'], 'no_hash' => $portfolio['no_hash'] );
	wp_localize_script( 'cl_js_portfolio', 'cl_portfolio', $portfolio['js_opt'] );

}

/****************/
/*   WP query   */
$query = array(
	'post_type' => $portfolio['post_type'],
	'posts_per_page' => ( $portfolio['no_tools'] ? $portfolio['ipp'] : '-1' ),
	'order' => $portfolio['order'],
	'orderby' => $portfolio['orderby'],
	'paged' => ( get_query_var('paged') ? get_query_var('paged') : true )
);
?>

<!-- Portfolio -->
<section class="portfolio portfolio-list clearfix">
	
	<?php if ( ! $portfolio['no_tools'] ) : ?>
	
	<!-- Toolbar -->
	<header class="emph clearfix">
		
		<!-- Tags -->
		<ul>
		
			<li data-tag="#" data-str="<?php esc_attr_e( __('Show All', 'haku') ); ?>"><?php _e('Filter by', 'haku'); ?></li>
			
			<?php if ( is_array( $portfolio['terms'] ) ) : foreach ( $portfolio['terms'] as $filter ) : ?>
			
			<li data-tag="<?php esc_attr_e( $filter->slug ); ?>"><?php echo $filter->name; ?></li>
			
			<?php endforeach; endif; ?>
			
		</ul>
		<!-- end: Tags -->
		
	</header>
	<!-- end: Toolbar -->
	
	<?php endif; ?>
	
	<?php query_posts( $query ); if ( have_posts() ) : ?>
	
	<!-- Projects container -->
	<div class="clearfix">
	
		<?php while ( have_posts() ) : the_post(); ?>
			
		<?php get_template_part( 'loop', 'portfolio' ); ?>
		
		<?php endwhile; ?>
		
	</div>
	<!-- end: Projects container -->
		
	<?php if ( $portfolio['no_tools'] ) : ?>
	
	<!-- Pagination links -->
	<nav class="pagination emph clearfix">
		
		<?php previous_posts_link( __('Newer Projects', 'haku') ); ?>
		<?php next_posts_link( __('Older Projects', 'haku') ); ?>
		
	</nav>
	<!-- end: Pagination links -->
	
	<?php else : ?>
	
	<!-- Pagination links -->
	<nav class="pagination emph clearfix">
		
		<a href="#" class="left"><?php _e('Older Projects', 'haku'); ?> <span class="arrow pl"></span></a>
		<a href="#" class="right"><?php _e('Newer Projects', 'haku'); ?> <span class="arrow pr"></span></a>
		
	</nav>
	<!-- end: Pagination links -->
	
	<?php endif; ?>
	
	<?php endif; ?>

</section>
<!-- end: Portfolio -->

<?php wp_reset_query(); ?>

<?php get_footer(); ?>