<?php get_header(); ?>

<!-- Content container -->
<section class="content-wrap <?php cl_content_class( ( isset( $post ) ? $post->ID : null ) ); ?>">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						
	<?php get_template_part('loop'); ?>
		
	<?php endwhile; ?>
	
	<!-- Float clearer -->
	<div class="clear"></div>
	
	<!-- Pagination links -->
	<nav class="pagination emph clearfix">
		
		<?php previous_posts_link( __('Recent Posts', 'haku') ); ?>
		<?php next_posts_link( __('Previous Posts', 'haku') ); ?>
		
	</nav>
	<!-- end: Pagination links -->
	
	<?php else : ?>
		
	<?php get_template_part('not-found'); ?>
	
	<?php endif; ?>

</section>
<!-- end: Content container -->
	
<?php get_sidebar(); ?>
	
<?php get_footer(); ?>