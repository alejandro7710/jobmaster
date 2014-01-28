<?php
/*
 *	Plugin Name: Latest Articles
 *	Version: 1.0
 *	Author: Stefano Giliberti
 *	Author URI: stefanogiliberti@me.com
 */

/*
 *	Add function to widgets_init that'll load the widget
 */
add_action('widgets_init', 'haku_widget_latests');

/*
 *	Widget registering
 */
function haku_widget_latests() {
	register_widget('haku_latests');
}

/*
 *	Widget class
 */
class haku_latests extends WP_Widget {

	/*
	 *	Widget setup
	 */
	function haku_latests() {
	
		$widget_ops = array('classname' => 'latest-articles', 'description' => '');
		
		$control_ops = array('width' => '', 'height' => '');

		$this->WP_Widget('haku_widget_latests', '(' . get_haku_var('theme_name') . ') '.__('Latest Articles', 'haku'), $widget_ops, $control_ops);
		
	}
	
	/*
	 *	Widget update
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$total_posts = wp_count_posts();
				
		$instance['number'] = ( intval( $new_instance['number'] ) ? ( $new_instance['number'] > $total_posts->publish ? $total_posts->publish : $new_instance['number'] ) : $instance['number'] );
		
		$instance['orderby'] = $new_instance['orderby'];
		$instance['order'] = $new_instance['order'];
		
		return $instance;
	}
	
	/*
	 *	Displays the widget settings
	 */
	function form($instance) {

		/*
			Default settings
		*/
		$defaults = array('title' => __('Recent [color]Articles[/color]', 'haku'), 'picture' => 'on', 'number' => 5, 'orderby' => 'date', 'order' => 'DESC');
		
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<!-- Widget Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'haku'); ?></label><br />
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" style="width: 217px" />
		</p>
			
		<!-- Widget Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number:', 'haku'); ?></label><br />
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" class="widefat" style="width: 217px" />
		</p>
		
		<!-- Widget Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order by:', 'haku'); ?></label><br />
			<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" class="widefat" style="width: 217px">
				<option <?php selected( $instance['orderby'], 'ID' ); ?> value="id">ID</option>
				<option <?php selected( $instance['orderby'], 'title' ); ?> value="title"><?php _e('Title', 'haku'); ?></option>
				<option <?php selected( $instance['orderby'], 'date' ); ?> value="date"><?php _e('Date', 'haku'); ?></option>
				<option <?php selected( $instance['orderby'], 'rand' ); ?> value="rand"><?php _e('Random', 'haku'); ?></option>
				<option <?php selected( $instance['orderby'], 'comment_count' ); ?> value="comment_count"><?php _e('Popular', 'haku'); ?></option>
			</select>
		</p>
		
		<!-- Widget Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order:', 'haku'); ?></label><br />
			<select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>" class="widefat" style="width: 217px">
				<option <?php selected( $instance['order'], 'ASC' ); ?> value="ASC"><?php _e('Ascending', 'haku'); ?></option>
				<option <?php selected( $instance['order'], 'DESC' ); ?> value="DESC"><?php _e('Descending', 'haku'); ?></option>
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
		$number = $instance['number'];
		$orderby = $instance['orderby'];
		$order = $instance['order'];
		
		$cl_latests_config = array(
			'posts_per_page' => $number,
			'orderby' => $orderby,
			'order' => $order,
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1
		);
		
		$cl_latests = new WP_Query( $cl_latests_config );
		
		/*
			Before widget
		*/
		echo $before_widget;
		
		if ( $title ) {
			echo $before_title . do_shortcode( $title ) . $after_title;
		}
		?>
		
		<!-- Post list -->
		<ul>
			
			<?php if ( $cl_latests->have_posts() ) : while ( $cl_latests->have_posts() ) : $cl_latests->the_post(); ?>
						
			<!-- Post -->
			<li>
				<a title="<?php esc_attr_e('Read the full blog post', 'haku'); ?>" href="<?php the_permalink(); ?>" rel="bookmark">
					<time datetime="<?php echo get_the_time( DATE_W3C, get_the_ID() ); ?>"><?php echo date_i18n( 'F j, Y', get_the_time( 'U', get_the_ID() ) ); ?></time>
					<h5><?php the_title(); ?></h5>
				</a>
			</li>
			<!-- end: Post -->
			
			<?php endwhile; endif; wp_reset_postdata();  ?>
						
		</ul>
		<!-- end: Post list -->
		
		<!-- Blog link -->
		<a href="<?php echo get_permalink( get_option('page_for_posts') ); ?>" class="jump"><?php _e('Read all articles &rarr;', 'haku'); ?></a>
		
		<?php
		/*
			After widget
		*/
		echo $after_widget;
		
	}
	
}

?>