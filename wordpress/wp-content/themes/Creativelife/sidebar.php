<?php if ( ! isset( $post ) || isset( $post ) && ! meta_obtain('no_sidebar', '_cl_layout', ( $wp_query->is_posts_page ? get_option('page_for_posts') : $post->ID ) ) ) : ?>

<!-- One fourth column -->
<aside class="one-fourth right no-margin sidebar">
	
	<?php dynamic_sidebar( cl_get_sidebar( ( isset( $post ) ? $post->ID : false ), $wp_query->is_posts_page ) ); ?>
	
</aside>
<!-- end: One fourth column -->

<?php endif; ?>