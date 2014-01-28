<?php
/****************************/
/*   Post format: Audio     */
$url = meta_obtain( 'url', '_cl_format_audio', $post->ID );

// Javascript
global $cl_enqueue_audio;
$cl_enqueue_audio = true;
?>

<!-- Featured -->
<figure class="<?php echo ( is_theme_post_type() ? 'full-width' : 'half right' ); ?> audio">
	
	<!-- Featured image -->
	<?php if ( has_post_thumbnail() ) the_post_thumbnail( ( is_theme_post_type() ? 'cl_portfolio' : 'cl_article' ), array( 'title' => '' ) ); ?>
	
	<!-- HTML5 audio -->
	<audio src="<?php echo esc_url( $url ); ?>" preload="none" controls />

</figure>
<!-- end: Featured -->