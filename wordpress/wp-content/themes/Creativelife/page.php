<?php get_header(); ?>

<!-- Content container -->
<section class="content-wrap <?php cl_content_class( $post->ID ); ?>">

	<?php while ( have_posts() ) : the_post(); ?>
					
	<?php get_template_part( 'content', 'page' ); ?>
		
	<?php endwhile; ?>

</section>
<!-- end: Content container -->
	
<?php get_sidebar(); ?>
	
<?php get_footer(); ?>