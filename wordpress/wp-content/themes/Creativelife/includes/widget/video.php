<?php
/*
 *	Plugin Name: Video
 *	Version: 1.0
 *	Author: Stefano Giliberti
 *	Author URI: stefanogiliberti@me.com
 */

/*
 *	Add function to widgets_init that'll load the widget
 */
add_action('widgets_init', 'haku_widget_video');

/*
 *	Widget registering
 */
function haku_widget_video() {
	register_widget('haku_video');
}

/*
 *	Widget class
 */
class haku_video extends WP_Widget {

	/*
	 *	Widget setup
	 */
	function haku_video() {
	
		$widget_ops = array('classname' => 'video-widget', 'description' => '');
		
		$control_ops = array('width' => '', 'height' => '');

		$this->WP_Widget('haku_widget_video', '(' . get_haku_var('theme_name') . ') Video', $widget_ops, $control_ops);
		
	}
	
	/*
	 *	Widget update
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['url'] = esc_url( $new_instance['url'] );
		$instance['size'] = ( intval( $new_instance['size'] ) ? $new_instance['size'] : $instance['size'] );
				
		return $instance;
	}
	
	/*
	 *	Displays the widget settings
	 */
	function form($instance) {

		/*
			Default settings
		*/
		$defaults = array('title' => __('Moving Pictures!', 'haku'), 'size' => '230x147' );
		
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<!-- Widget Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'haku'); ?></label><br />
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" style="width: 217px" />
		</p>
		
		<!-- Widget Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Url:', 'haku'); ?></label><br />
			<input id="<?php echo $this->get_field_id('url'); ?>" placeholder="http://" name="<?php echo $this->get_field_name('url'); ?>" value="<?php if ( isset( $instance['url'] ) ) echo esc_url( $instance['url'] ); ?>" class="widefat" style="width: 217px" />
		</p>
		
		<!-- Widget Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Size:', 'haku'); ?></label><br />
			<input id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" value="<?php if ( isset( $instance['size'] ) ) echo $instance['size']; ?>" class="widefat" style="width: 217px" />
		</p>
		
	<?php
	}
	
	/*
	 *	Widget display
	 */
	function widget($args, $instance) {
	
		extract($args);
		
		$title = $instance['title'];
		$url = $instance['url'];
		$size = esc_attr( $instance['size'] );
		$size = explode( 'x', $size );
		
		/*
			Before widget
		*/
		echo $before_widget;
		
		if ($title) {
			echo $before_title . do_shortcode( $title ) . $after_title;
		}
		
		if ( $url ) :
		?>
		
		<!-- Video -->
		<div class="video">
			
			<!-- Video container -->
			<figure>
			
				<?php if ( haku_get_url_type( $url ) == 'youtube' ) : $id = haku_get_video_id( $url ); ?>
				
				<!-- Youtube Video -->
				<iframe type="text/html" width="<?php echo $size[ 0 ]; ?>" height="<?php echo $size[ 1 ]; ?>" src="http://www.youtube.com/embed/<?php echo $id; ?>?wmode=transparent" frameborder="0" allowfullscreen></iframe>
			
				<?php elseif ( haku_get_url_type( $url ) == 'vimeo' ) : $id = haku_get_video_id( $url ); ?>
				
				<!-- Vimeo Video -->
				<iframe src="http://player.vimeo.com/video/<?php echo $id; ?>?title=0&amp;byline=0&amp;portrait=0" width="<?php echo $size[ 0 ]; ?>" height="<?php echo $size[ 1 ]; ?>" frameborder="0"></iframe>
				
				<?php endif; ?>
			
			</figure>
			<!-- end: Video container -->
			
		</div>
		<!-- end: Video -->
		
		<?php
		endif;
		
		/*
			After widget
		*/
		echo $after_widget;
		
	}
	
}

?>