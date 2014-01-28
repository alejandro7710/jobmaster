<!-- Portfolio -->
<section class="portfolio project-view clearfix">

	<!-- Toolbar -->
	<header class="emph clearfix">
		
		<!-- Back link -->
		<a href="<?php echo get_permalink( get_page_id_by_theme_post_type() ); ?>" class="left"><?php echo get_page_title_by_theme_post_type(); ?><span class="arrow pl"></span></a>
		
		<?php if ( get_next_post() ) : ?>
		
		<!-- Next link -->
		<div class="right next"><?php next_post_link('%link'); ?> <span class="arrow pr"></span></div>
		
		<?php endif; ?>
		
		<?php if ( get_previous_post() ) : ?>
						
		<!-- Previous link -->		
		<div class="right"><?php previous_post_link('%link'); ?> <span class="arrow pl"></span></div>
		
		<?php endif; ?>
		
	</header>
	<!-- end: Toolbar -->
	
	<?php get_template_part( 'figure', get_post_format() ); ?>

	<!-- Content container -->
	<section class="content-wrap <?php cl_content_class( $post->ID ); ?>">
		
		<!-- Content column -->
		<div class="content">
		
			<!-- Title -->
			<h4><?php the_title(); ?></h4>
			
			<!-- Excerpt -->
			<p><?php the_content(); ?></p>
		
		</div>
		<!-- end: Content column -->
		
		<?php if ( get_theme_option('portfolio_responses') ) : ?>
		
		<!-- Post comments -->
		<section id="comments" class="comments">
		
			<?php comments_template( '', true ); ?>
			
		</section>
		<!-- end: Post comments -->
		
		<?php endif; ?>
	
	</section>
	<!-- end: Content container -->
	
	<?php get_sidebar(); ?>
	
</section>
<!-- end: Portfolio -->

<?php if ( get_theme_option('portfolio_similar') && get_terms( 'portfolio_filter_' . get_page_id_by_theme_post_type() ) ) get_template_part('includes/module/similar-work'); ?>