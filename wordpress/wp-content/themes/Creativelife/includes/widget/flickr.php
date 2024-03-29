<?php
/*
 *	Plugin Name: Flickr Feed
 *	Version: 1.0
 *	Author: Stefano Giliberti
 *	Author URI: stefanogiliberti@me.com
 */

/*
 *	Add function to widgets_init that'll load the widget
 */
add_action('widgets_init', 'haku_widget_flickr');

/*
 *	Widget registering
 */
function haku_widget_flickr() {
	register_widget('haku_flickr');
}

/*
 *	Widget class
 */
class haku_flickr extends WP_Widget {

	/*
	 *	Widget setup
	 */
	function haku_flickr() {
	
		$widget_ops = array('classname' => 'flickr-feed', 'description' => '');
		
		$control_ops = array('width' => '', 'height' => '');

		$this->WP_Widget('haku_widget_flickr', '(' . get_haku_var('theme_name') . ') Flickr', $widget_ops, $control_ops);
		
	}
	
	/*
	 *	Widget update
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['id'] = strip_tags( $new_instance['id'] );
		$instance['number'] = ( intval( $new_instance['number'] ) && $new_instance['number'] < 11 ? $new_instance['number'] : $instance['number'] );
		$instance['display'] = $new_instance['display'];
		
		return $instance;
	}
	
	/*
	 *	Displays the widget settings
	 */
	function form($instance) {

		/*
			Default settings
		*/
		$defaults = array('title' => __('Flickr [color]Feed[/color]', 'haku'), 'number' => 6, 'display' => 'random' );
		
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<!-- Widget Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'haku'); ?></label><br />
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" style="width: 217px" />
		</p>
		
		<!-- Widget Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('User ID:', 'haku'); ?></label><br />
			<input id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" value="<?php if ( isset( $instance['id'] ) ) echo $instance['id']; ?>" class="widefat" style="width: 217px" />
		</p>
		
		<!-- Description -->
		<p class="description"><?php _e('You can get your Flickr ID on:', 'haku'); ?> <a href="http://idgettr.com">idGettr.com</a></p>
		
		<!-- Widget Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number:', 'haku'); ?></label><br />
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" class="widefat" style="width: 217px" />
		</p>
		
		<!-- Widget Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Order:', 'haku'); ?></label><br />
			<select id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>" class="widefat" style="width: 217px">
				<option <?php selected( $instance['display'], 'random' ); ?> value="random"><?php _e('Random', 'haku'); ?></option>
				<option <?php selected( $instance['display'], 'latest' ); ?> value="latest"><?php _e('Latest', 'haku'); ?></option>
			</select>
		</p>

	<?php
	}
	
	/*
	 *	Widget display
	 */
	function widget($args, $instance) {
	
		extract($args);
		
		$title = $instance['title'];
		$id = $instance['id'];
		$number = $instance['number'];
		$display = $instance['display'];
				
		/*
			Before widget
		*/
		echo $before_widget;
		
		if ( $title ) {
			echo $before_title . do_shortcode( $title ) . $after_title;
		}
		?>
		
		<!-- Photos -->
		<div class="clearfix">
		
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=<?php echo $display; ?>&amp;size=m&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>
		
		</div>
		<!-- end: Photos -->
		
		<?php
		/*
			After widget
		*/
		echo $after_widget;
		
	}
	
}

?>