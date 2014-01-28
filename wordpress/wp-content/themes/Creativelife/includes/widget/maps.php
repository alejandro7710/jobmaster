<?php
/*
 *	Plugin Name: Google Maps
 *	Version: 1.0
 *	Author: Stefano Giliberti
 *	Author URI: stefanogiliberti@me.com
 */

/*
 *	Add function to widgets_init that'll load the widget
 */
add_action('widgets_init', 'haku_widget_maps');

/*
 *	Widget registering
 */
function haku_widget_maps() {
	register_widget('haku_maps');
}

/*
 *	Widget class
 */
class haku_maps extends WP_Widget {

	/*
	 *	Widget setup
	 */
	function haku_maps() {
	
		$widget_ops = array('classname' => 'maps-widget', 'description' => '');
		
		$control_ops = array('width' => '', 'height' => '');

		$this->WP_Widget('haku_widget_maps', '(' . get_haku_var('theme_name') . ') Google Maps', $widget_ops, $control_ops);
		
	}
	
	/*
	 *	Widget update
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['center'] = strip_tags( $new_instance['center'] );
		$instance['size'] = strip_tags( $new_instance['size'] );
		
		$instance['zoom'] = ( intval( $new_instance['zoom'] ) ? $new_instance['zoom'] : $instance['zoom'] );
		$instance['height'] = ( intval( $new_instance['height'] ) ? $new_instance['height'] : $instance['height'] );
		
		$instance['maptype'] = $new_instance['maptype'];
		$instance['link'] = esc_url( $new_instance['link'] );
		
		return $instance;
	}
	
	/*
	 *	Displays the widget settings
	 */
	function form($instance) {

		/*
			Default settings
		*/
		$defaults = array('title' => __('Google Maps', 'haku'), 'center' => 'New York, NY', 'zoom' => 12, 'size' => '230x250', 'maptype' => 'roadmap', 'link' => '');
		
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<!-- Widget Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'haku'); ?></label><br />
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" style="width: 217px" />
		</p>
		
		<!-- Widget Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('center'); ?>"><?php _e('Location:', 'haku'); ?></label><br />
			<input id="<?php echo $this->get_field_id('center'); ?>" name="<?php echo $this->get_field_name('center'); ?>" value="<?php if ( isset( $instance['center'] ) ) echo $instance['center']; ?>" class="widefat" style="width: 217px" />
		</p>
		
		<!-- Widget Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('zoom'); ?>"><?php _e('Zoom:', 'haku'); ?></label><br />
			<input id="<?php echo $this->get_field_id('zoom'); ?>" name="<?php echo $this->get_field_name('zoom'); ?>" value="<?php if ( isset( $instance['zoom'] ) ) echo $instance['zoom']; ?>" class="widefat" style="width: 217px" />
		</p>
		
		<!-- Widget Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Size:', 'haku'); ?></label><br />
			<input id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" value="<?php if ( isset( $instance['size'] ) ) echo $instance['size']; ?>" class="widefat" style="width: 217px" />
		</p>
		
		<!-- Widget Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id('maptype'); ?>"><?php _e('Map type:', 'haku'); ?></label><br />
			<select id="<?php echo $this->get_field_id('maptype'); ?>" name="<?php echo $this->get_field_name('maptype'); ?>" class="widefat" style="width: 217px">
				<option <?php selected( $instance['maptype'], 'roadmap' ); ?> value="roadmap"><?php _e('Roadmap', 'haku'); ?></option>
				<option <?php selected( $instance['maptype'], 'satellite' ); ?> value="satellite"><?php _e('Satellite', 'haku'); ?></option>
				<option <?php selected( $instance['maptype'], 'terrain' ); ?> value="terrain"><?php _e('Terrain', 'haku'); ?></option>
				<option <?php selected( $instance['maptype'], 'hybrid' ); ?> value="hybrid"><?php _e('Hybrid', 'haku'); ?></option>
			</select>
		</p>
		
		<!-- Widget Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link to:', 'haku'); ?></label><br />
			<input id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" value="<?php if ( isset( $instance['link'] ) ) echo $instance['link']; ?>" placeholder="http://" class="widefat" style="width: 217px" />
		</p>
		
	<?php
	}
	
	/*
	 *	Widget display
	 */
	function widget($args, $instance) {
	
		extract($args);
		
		$title = $instance['title'];
		$center = urlencode( $instance['center'] );
		$zoom = urlencode( $instance['zoom'] );
		$size = urlencode( $instance['size'] );
		$maptype = urlencode( $instance['maptype'] );
		$link = $instance['link'];
		
		$map = '<img src="http://maps.googleapis.com/maps/api/staticmap?center=' . $center . '&zoom=' . $zoom . '&size='. $size .'&maptype='. $maptype . '&sensor=false" alt="" />';
		
		/*
			Before widget
		*/
		echo $before_widget;
		
		if ($title) {
			echo $before_title . do_shortcode( $title ) . $after_title;
		}
		?>
		
		<?php if ( $link ) : ?>
		
		<!-- Link -->
		<a href="<?php echo esc_url( $link ); ?>" target="_blank">
		
		<?php endif; ?>
		
		<!-- Map -->
		<?php echo $map; ?>
		
		<?php if ( $link ) : ?>
		
		</a>
		<!-- end: Link -->
		
		<?php endif; ?>
				
		<?php
		/*
			After widget
		*/
		echo $after_widget;
		
	}
	
}

?>