<?php
/*
 *	Plugin Name: Latest Work
 *	Version: 1.0
 *	Author: The Open Dept.
 *	Author URI: http://www.opendept.net
 */

/*
 *	Add function to widgets_init that'll load the widget
 */
add_action('widgets_init', 'cl_widget_work');

/*
 *	Widget registering
 */
function cl_widget_work() {
	register_widget('cl_work');
}

/*
 *	Widget class
 */
class cl_work extends WP_Widget {

	/*
	 *	Widget setup
	 */
	function cl_work() {
	
		$widget_ops = array('classname' => 'portfolio-feed', 'description' => '');
		
		$control_ops = array('width' => '', 'height' => '');

		$this->WP_Widget('cl_widget_work', '(' . get_haku_var('theme_name') . ') ' . __('Latest Works', 'haku'), $widget_ops, $control_ops);
		
	}
	
	/*
	 *	Widget update
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['portfolio'] = $new_instance['portfolio'];
		$instance['number'] = ( intval( $new_instance['number'] ) ? $new_instance['number'] : $instance['number'] );
		$instance['orderby'] = $new_instance['orderby'];
		
		return $instance;
	}
	
	/*
	 *	Displays the widget settings
	 */
	function form($instance) {

		/*
			Default settings
		*/
		$defaults = array('title' => __('Latest [color]Works[/color]', 'haku'), 'number' => 3, 'orderby' => 'date', 'portfolio' => '');
		
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<!-- Widget Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'haku'); ?></label><br />
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" style="width: 217px" />
		</p>
			
		<!-- Widget Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id('portfolio'); ?>"><?php _e('Portfolio:', 'haku'); ?></label><br />
			<select name="<?php echo $this->get_field_name('portfolio'); ?>" class="widefat" style="width: 217px">
			
				<?php foreach ( get_theme_portfolio_pages() as $portfolio ) : ?>
				
				<option id="<?php echo $this->get_field_id('portfolio'); ?>" <?php selected( $instance['portfolio'], $portfolio ); ?> value="<?php echo $portfolio; ?>"><?php echo get_the_title( get_page_id_by_theme_post_type( false, $portfolio ) ); ?></option>
				
				<?php endforeach; ?>
				
			</select>
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
		$post_type = $instance['portfolio'];
		$number = $instance['number'];
		$orderby = $instance['orderby'];
				
		$latest_work = wp_get_recent_posts("numberposts=$number&post_status=publish&post_type=$post_type&orderby=$orderby");
		
		/*
			Before widget
		*/
		echo $before_widget;
		
		if ( $title ) {
			echo $before_title . do_shortcode( $title ) . $after_title;
		}
		?>
		
		<!-- Projects -->
		<div class="clearfix">
		
			<?php foreach ( $latest_work as $work ) : ?>
			
			<?php
			/********************/
			/*   Post filters   */
			$terms = get_the_terms( $work['ID'], 'portfolio_filter_' . get_page_id_by_theme_post_type( false, $post_type ) );
				
			if ( $terms && ! is_wp_error( $terms ) ) {
				$item_tags = array();
				foreach ( $terms as $tag ) {
					$item_tags[] = $tag->name;
				}
			}
			?>
			
			<?php $has_lightbox = meta_obtain( 'lightbox', '_cl_portfolio_item_settings', $work['ID'] ); ?>
			
			<!-- Project -->
			<a href="<?php echo ( $has_lightbox ? get_thumb_src( $work['ID'], 'full' ) : get_permalink( $work['ID'] ) ); ?>" class="one-fourth box portfolio-item <?php if ( $has_lightbox ) echo 'view'; else echo get_post_format(); ?>" title="<?php esc_attr_e( get_the_title( $work['ID'] ) ); ?>">
			
				<!-- Image -->
				<?php if ( has_post_thumbnail( $work['ID'] ) ) echo get_the_post_thumbnail( $work['ID'], 'cl_portfolio_4', array( 'title' => '' ) ); ?>
				
				<!-- Container -->
				<div>
				
					<!-- Title -->
					<h5><?php echo get_the_title( $work['ID'] ); ?></h5>
					
					<!-- Excerpt -->
					<p><?php echo do_shortcode( has_excerpt( $work['ID'] ) ? haku_shorten( $work['post_excerpt'], 15 ) : haku_shorten( $work['post_content'], 15 ) ); ?></p>
								
				</div>
				<!-- end: Container -->
				
				<?php if ( isset( $item_tags ) ) : ?>
				
				<!-- Metas -->
				<span class="meta"><?php echo join( ', ', $item_tags ); ?></span>
				
				<?php endif; ?>
			
			</a>
			<!-- end: Project -->
			
			<?php endforeach; ?>
		
		</div>
		<!-- end: Projects -->
				
		<?php
		/*
			After widget
		*/
		echo $after_widget;
		
		wp_reset_query();
		
	}
	
}

?>