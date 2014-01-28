<!-- Post -->
<article <?php post_class('clearfix'); ?> id="article_<?php the_ID(); ?>">
	
	<!-- Post info -->
	<aside class="one-fourth left clearfix">
		
		<?php if ( has_post_thumbnail() ) : ?>
		
		<!-- Featured image -->
		<a title="<?php esc_attr_e('Read the full blog post', 'haku'); ?>" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('post-thumbnail', array('title' => '') ); ?></a>
		
		<?php endif; ?>
		
		<!-- Date -->
		<div class="left emph">
			
			<!-- Day -->
			<span class="day"><?php the_time('d'); ?></span>
			
			<!-- Month -->
			<span class="month"><?php the_time('F'); ?></span>
			
			<!-- Year -->
			<span class="year"><?php the_time('Y'); ?></span>
			
		</div>
		<!-- end: Date -->
		
		<!-- Comments number -->
		<div class="right emph">
			
			<?php comments_popup_link( sprintf( __('%s Comments', 'haku'), '<span>0</span><br />' ) , sprintf( __('%s Comment', 'haku'), '<span>1</span><br />' ) , sprintf( __('%s Comments', 'haku'), '<span>%</span><br />' ) ); ?>
			
		</div>
		<!-- end: Comments number -->
	
	</aside>
	<!-- end: Post info -->
	
	<!-- Post content -->
	<section class="half right">
		
		<!-- Content -->
		<div class="content">
			
			<h3 class="post-title"><a title="<?php esc_attr_e('Read the full blog post', 'haku'); ?>" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			
			<!-- Excerpt -->
			<p><?php echo do_shortcode( has_excerpt() ? get_the_excerpt() : haku_shorten( get_the_content(), 70, '... <p><a href="' . get_permalink() .' ">Continue reading</a></p>' ) ); ?></p>
		
		</div>
		<!-- end: Content -->
		
		<!-- Bottom-right label -->
		<a title="<?php esc_attr_e('Read the full blog post', 'haku'); ?>" href="<?php the_permalink(); ?>" rel="bookmark" class="box-label link"><div><div></div></div></a>
	
	</section>
	<!-- end: Post content -->

</article>
<!-- end: Post -->