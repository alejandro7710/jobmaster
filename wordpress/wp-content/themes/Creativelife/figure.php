<?php if ( has_post_thumbnail() ) : ?>

<!-- Featured -->
<figure class="<?php echo ( is_theme_post_type() ? 'full-width' : 'half right' ); ?>">
	
	<!-- Featured image -->
	<?php the_post_thumbnail( ( is_theme_post_type() ? 'cl_portfolio' : 'cl_article' ), array( 'title' => '' ) ); ?>

</figure>
<!-- end: Featured -->

<?php endif; ?>