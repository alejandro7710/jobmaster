<?php
/******************************/
/*   Similar projects query   */
$query = array(
	'post_type' => get_post_type(),
	'posts_per_page' => 4,
	'post__not_in' => array( $post->ID ),
	'tax_query' => array(
		array(
			'taxonomy' => 'portfolio_filter_' . get_page_id_by_theme_post_type(),
			'field' => 'id',
			'terms' => wp_get_object_terms( $post->ID, 'portfolio_filter_' . get_page_id_by_theme_post_type(), array( 'fields' => 'ids' ) )
		)
	)
);
?>

<?php query_posts( $query ); if ( have_posts() ) : ?>

<!-- Portfolio projects -->
<section class="portfolio-feed similar-work clearfix">
	
	<!-- Section heading -->
	<h5 class="box-title"><?php _e('Similar <span>Projects</span>', 'haku'); ?></h5>
	
	<!-- Projects container -->
	<div class="clearfix">
	
		<?php while ( have_posts() ) : the_post(); ?>
		
		<?php
		/********************/
		/*   Post filters   */
		$item_tags = array();
		foreach ( get_the_terms( $post->ID, 'portfolio_filter_' . get_page_id_by_theme_post_type() ) as $tag ) {
			$item_tags[] = $tag->name;
		}
		?>
		
		<?php $has_lightbox = meta_obtain( 'lightbox', '_cl_portfolio_item_settings', $post->ID ); ?>
		
		<!-- Project -->
		<a href="<?php echo ( $has_lightbox ? get_thumb_src( $post->ID, 'full' ) : get_permalink( $post->ID ) ); ?>" class="one-fourth box portfolio-item <?php if ( $has_lightbox ) echo 'view'; else echo get_post_format(); ?>" title="<?php esc_attr_e( get_the_title() ); ?>">
		
			<!-- Image -->
			<?php if ( has_post_thumbnail( $post->ID ) ) echo get_the_post_thumbnail( $post->ID, 'cl_portfolio_4', array( 'title' => '' ) ); ?>
			
			<!-- Container -->
			<div>
			
				<!-- Title -->
				<h5><?php the_title(); ?></h5>
				
				<!-- Excerpt -->
				<p><?php echo do_shortcode( has_excerpt( $post->ID ) ? haku_shorten( get_the_excerpt( $post->ID ), 15 ) : haku_shorten( get_the_content( $post->ID ), 15 ) ); ?></p>
			
			</div>
			<!-- end: Container -->
			
			<!-- Metas -->
			<span class="meta"><?php echo join( ', ', $item_tags ); ?></span>
		
		</a>
		<!-- end: Project -->
		
		<?php endwhile; ?>
	
	</div>
	<!-- end: Projects container -->

</section>
<!-- end: Portfolio projects -->

<?php endif; ?>

<?php wp_reset_query(); ?>