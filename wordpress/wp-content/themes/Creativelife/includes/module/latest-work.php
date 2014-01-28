<?php
/*****************************/
/*   Latest projects query   */
$post_type = get_theme_option('latest_work_portfolio');
$numberposts = get_theme_option('latest_work_number');
$orderby = get_theme_option('latest_work_orderby');
$latest_work = wp_get_recent_posts("numberposts=$numberposts&post_status=publish&post_type=$post_type&orderby=$orderby");
?>

<!-- Portfolio projects -->
<section class="portfolio-feed clearfix">
	
	<!-- Section heading -->
	<h5 class="box-title"><?php echo do_shortcode( get_theme_option('latest_work_title') ); ?></h5>
	
	<!-- Projects container -->
	<div class="clearfix">
	
		<?php foreach ( $latest_work as $work ) : ?>
		
		<?php
		/********************/
		/*   Post filters   */
		$terms = get_the_terms( $work['ID'], 'portfolio_filter_' . get_page_id_by_theme_post_type( false, $post_type ) );
			
		if ( $terms && ! is_wp_error( $terms ) ) {
			$item_tags = array();
			foreach ( $terms as $tag ) {
				$item_tags[] = $tag->name;
			}
		}
		?>
		
		<?php $has_lightbox = meta_obtain( 'lightbox', '_cl_portfolio_item_settings', $work['ID'] ); ?>
		
		<!-- Project -->
		<a href="<?php echo ( $has_lightbox ? get_thumb_src( $work['ID'], 'full' ) : get_permalink( $work['ID'] ) ); ?>" class="one-fourth box portfolio-item <?php if ( $has_lightbox ) echo 'view'; else echo get_post_format(); ?>" title="<?php esc_attr_e( get_the_title( $work['ID'] ) ); ?>">
		
			<!-- Image -->
			<?php if ( has_post_thumbnail( $work['ID'] ) ) echo get_the_post_thumbnail( $work['ID'], 'cl_portfolio_4', array( 'title' => '' ) ); ?>
			
			<!-- Container -->
			<div>
			
				<!-- Title -->
				<h5><?php echo get_the_title( $work['ID'] ); ?></h5>
				
				<!-- Excerpt -->
				<p><?php echo do_shortcode( has_excerpt( $work['ID'] ) ? haku_shorten( $work['post_excerpt'], 15 ) : haku_shorten( $work['post_content'], 15 ) ); ?></p>
							
			</div>
			<!-- end: Container -->
			
			<?php if ( isset( $item_tags ) ) : ?>
			
			<!-- Metas -->
			<span class="meta"><?php echo join( ', ', $item_tags ); ?></span>
			
			<?php endif; ?>
		
		</a>
		<!-- end: Project -->
		
		<?php endforeach; ?>
	
	</div>
	<!-- end: Projects container -->

</section>
<!-- end: Portfolio projects -->

<?php wp_reset_query(); ?>