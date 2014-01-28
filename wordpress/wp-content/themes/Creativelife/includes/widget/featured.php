<?php
/*
 *	Plugin Name: Featured Article	
 *	Version: 1.0
 *	Author: The Open Dept.
 *	Author URI: http://www.opendept.net
 */

/*
 *	Add function to widgets_init that'll load the widget
 */
add_action('widgets_init', 'haku_widget_featured');

/*
 *	Widget registering
 */
function haku_widget_featured() {
	register_widget('haku_featured');
}

/*
 *	Widget class
 */
class haku_featured extends WP_Widget {

	/*
	 *	Widget setup
	 */
	function haku_featured() {
	
		$widget_ops = array('classname' => 'featured-article', 'description' => '');
		
		$control_ops = array('width' => '', 'height' => '');

		$this->WP_Widget('haku_widget_featured', '(' . get_haku_var('theme_name') . ') '.__('Featured Article', 'haku'), $widget_ops, $control_ops);
		
	}
	
	/*
	 *	Widget update
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
				
		$instance['article'] = $new_instance['article'];
		
		return $instance;
	}
	
	/*
	 *	Displays the widget settings
	 */
	function form($instance) {

		/*
			Default settings
		*/
		$defaults = array('title' => __('Featured [color]Article[/color]', 'haku'), 'article' => 1);
		
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<!-- Widget Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'haku'); ?></label><br />
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" style="width: 217px" />
		</p>
		
		<!-- Widget Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id('article'); ?>"><?php _e('Article:', 'haku'); ?></label><br />
			<select id="<?php echo $this->get_field_id('article'); ?>" name="<?php echo $this->get_field_name('article'); ?>" class="widefat" style="width: 217px">
								
				<?php foreach ( wp_get_recent_posts("numberposts=25&post_status=publish") as $article ) : ?>
								
				<option <?php selected( $instance['article'], $article['ID'] ); ?> value="<?php echo $article['ID']; ?>"><?php echo $article['post_title']; ?></option>
				
				<?php endforeach; ?>
				
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
		$article = $instance['article'];
		$article = get_post( $article );
				
		/*
			Before widget
		*/
		echo $before_widget;
		
		if ( $title ) {
			echo $before_title . do_shortcode( $title ) . $after_title;
		}
		?>
		
		<?php if ( has_post_thumbnail( $article->ID ) ) : ?>
		
		<!-- Image -->
		<a href="<?php echo get_permalink( $article->ID ); ?>"><?php echo get_the_post_thumbnail( $article->ID, 'post-thumbnail', array( 'title' => '' ) ); ?></a>
		
		<?php endif; ?>
		
		<!-- Content -->
		<div>
		
			<!-- Time -->
			<time datetime="<?php echo get_the_time( DATE_W3C, $article->ID ); ?>"><?php echo date_i18n( 'F j, Y', get_the_time( 'U', $article->ID ) ); ?></time>
					
			<!-- Title -->
			<h5 class="post-title"><a href="<?php echo get_permalink( $article->ID ); ?>"><?php echo $article->post_title; ?></a></h5>

			<!-- Excerpt -->
			<p><?php echo do_shortcode( has_excerpt( $article->ID ) ? haku_shorten( $article->post_excerpt, 20 ) : haku_shorten( $article->post_content, 20 ) ); ?></p>
		
		</div>
		<!-- end: Content -->
		
		<!-- Bottom-right label -->
		<a href="<?php echo get_permalink( $article->ID ); ?>" class="box-label link"><div><div></div></div></a>
		
		<?php
		/*
			After widget
		*/
		echo $after_widget;
		
	}
	
}

?>