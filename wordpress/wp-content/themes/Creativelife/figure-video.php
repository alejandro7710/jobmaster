<?php
/****************************/
/*   Post format: Video     */
$url = meta_obtain( 'url', '_cl_format_video', $post->ID );
$default_size = ( is_theme_post_type() ? '950x513' : '470x269' );
$size = meta_obtain( 'size', '_cl_format_video', $post->ID );
$size = ( intval( $size ) ? $size : $default_size );
$size = explode( 'x', $size );
?>

<!-- Featured -->
<figure class="<?php echo ( is_theme_post_type() ? 'full-width' : 'half right' ); ?> video">
	
	<?php if ( haku_get_url_type( $url ) == 'youtube' ) : $id = haku_get_video_id( $url ); ?>
	
	<!-- Youtube video -->
	<iframe width="<?php echo $size[ 0 ]; ?>" height="<?php echo $size[ 1 ]; ?>" src="http://www.youtube.com/embed/<?php echo $id; ?>?wmode=transparent" frameborder="0" allowfullscreen></iframe>
	
	<?php elseif ( haku_get_url_type( $url ) == 'vimeo' ) : $id = haku_get_video_id( $url ); ?>
	
	<!-- Vimeo Video -->
	<iframe src="http://player.vimeo.com/video/<?php echo $id; ?>?title=0&amp;byline=0&amp;portrait=0" width="<?php echo $size[ 0 ]; ?>" height="<?php echo $size[ 1 ]; ?>" frameborder="0"></iframe>
	
	<?php endif; ?>

</figure>
<!-- end: Featured -->