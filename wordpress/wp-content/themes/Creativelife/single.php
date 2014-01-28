<?php get_header(); ?>

<?php if ( is_theme_post_type() ) : ?>

<?php while ( have_posts() ) the_post(); get_template_part( 'content', 'portfolio' ); ?>

<?php else : ?>

<!-- Content container -->
<section class="content-wrap <?php cl_content_class( $post->ID ); ?>">

	<?php while ( have_posts() ) : the_post(); ?>
					
	<?php get_template_part( 'content', 'single' ); ?>
		
	<?php endwhile; ?>

</section>
<!-- end: Content container -->

<?php get_sidebar(); ?>

<?php endif; ?>
	
<?php get_footer(); ?>