<!-- Post -->
<article <?php post_class('clearfix'); ?> id="article_<?php the_ID(); ?>">
	
	<!-- Post info -->
	<aside class="one-fourth left clearfix">
		
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
		
		<!-- Flots clearer -->
		<div class="clear"></div>
		
		<!-- Metas -->
		<div class="box padding">
			
			<h5><?php _e('Author', 'haku'); ?></h5>
			
			<p><?php the_author_posts_link(); ?></p>
			
			<h5><?php _e('Category', 'haku'); ?></h5>
			
			<p><?php the_category(', '); ?></p>
			
			<?php if ( has_tag() ) : ?>
			
			<h5><?php _e('Tags', 'haku'); ?></h5>
			
			<p><?php the_tags(''); ?></p>
			
			<?php endif; ?>
			
		</div>
		<!-- end: Metas -->
	
	</aside>
	<!-- end: Post info -->
	
	<!-- Post title -->
	<section class="half right">
		
		<!-- Content -->
		<div class="content">
			
			<!-- Post title -->
			<h3 class="post-title"><a title="<?php esc_attr_e('Read the full blog post', 'haku'); ?>" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		
		</div>
		<!-- end: Content -->
	
	</section>
	<!-- end: Post title -->
	
	<?php get_template_part( 'figure', get_post_format() ); ?>
	
	<!-- Post content -->
	<section class="half right">
		
		<!-- Content -->
		<div class="content">
			
			<?php the_content(); ?>
		
		</div>
		<!-- end: Content -->
	
	</section>
	<!-- end: Post content -->

</article>
<!-- end: Post -->

<?php if ( get_next_post() || get_previous_post() ) : ?>

<!-- Float clearer -->
<div class="clear"></div>

<!-- Pagination links -->
<nav class="pagination emph clearfix">
	
	<?php if ( get_previous_post() ) : ?>
	
	<div class="left"><?php previous_post_link('%link'); ?> <span class="arrow pl"></span></div>
	
	<?php endif; ?>
	
	<?php if ( get_next_post() ) : ?>
	
	<div class="right"><?php next_post_link('%link'); ?> <span class="arrow pr"></span></div>
	
	<?php endif; ?>
	
</nav>
<!-- end: Pagination links -->

<?php endif; ?>

<!-- Post comments -->
<section id="comments" class="comments">

	<?php comments_template( '', true ); ?>
	
</section>
<!-- end: Post comments -->