<!-- Post -->
<article <?php post_class('clearfix'); ?> id="article_<?php the_ID(); ?>">
	
	<!-- Page content -->
	<div class="content">

		<!-- Page content -->
		<?php the_content(); ?>
		
		<?php wp_link_pages( array( 'before' => '<h5>' . esc_attr( __('Pages:', 'haku') ), 'after' => '</h5>' ) ); ?>
	
	</div>
	<!-- end: Page content -->

</article>
<!-- end: Post -->

<?php if ( get_theme_option('page_responses') ) : ?>

<!-- Post comments -->
<section id="comments" class="comments">

	<?php comments_template( '', true ); ?>
	
</section>
<!-- end: Post comments -->

<?php endif; ?>