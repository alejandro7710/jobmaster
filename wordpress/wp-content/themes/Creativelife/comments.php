<?php if ( post_password_required() ) : ?>
		
<!-- Notice message -->
<h5><em><?php _e('This post is protected by a password. Enter the password to view comments.', 'haku'); ?></em></h5>

<?php return; endif; ?>

<?php if ( have_comments() ) : ?>

<!-- Comments title -->
<h5 class="box-title"><span><?php _e('Comments', 'haku'); ?></span></h5>

<!-- Comments list -->
<ul class="commentlist">

	<?php wp_list_comments('type=comment&callback=theme_comments'); ?>
	
</ul>
<!-- end: Comments list -->

<?php if ( get_theme_option('post_trackbacks') ) : ?>

<!-- Pings list -->
<ul class="pinglist">

	<?php wp_list_comments('type=pings&callback=theme_pings'); ?>
	
</ul>
<!-- end: Pings list -->

<?php endif; ?>

<?php if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>

<!-- Float clearer -->
<div class="clear"></div>

<!-- Pagination links -->
<nav class="pagination emph clearfix">
	
	<?php previous_comments_link( __('Previous Comments', 'haku') ); ?>
	<?php next_comments_link( __('Next Comments', 'haku') ); ?>
	
</nav>
<!-- end: Pagination links -->

<?php endif; ?>
		
<?php endif; ?>
	
<!-- Comment form -->
<?php

/*******************/
/*   Comment form  */
$form = array(
	'title_reply' => '<h5 class="box-title">' . __('Leave a <span>Comment</span>', 'haku') . '</h5>',
	'title_reply_to' => '<h5 class="box-title">' . __('Leave a reply to %s', 'haku'),
	'cancel_reply_link' => __('Cancel reply', 'haku')  . '</h5>',
	'comment_notes_before' => '<div class="half left">',
	'comment_notes_after' => '</div><div class="clear"></div>',
	'fields' => apply_filters('comment_form_default_fields', array(
			'author' => '<h2>' . __('Who are <span class="color">you</span>?', 'haku') . '</h2><p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr( __('Your Name', 'haku') ) . ( $req ? ' *' : '' ) . '" /></p>',
			'email' => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr( __('Your E-Mail', 'haku') ) . ( $req ? ' *' : '' ) . '" /></p>',
			'url' => '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr( __('Your Website', 'haku') ) . ( $req ? ' *' : '' ) . '" /></p></div>',
		)
	),
	'comment_field' => '<div class="' . ( is_user_logged_in() ? 'full-width' : 'half right' ) . '"><h2>' . __('Your <span class="color">message</span>.', 'haku') . '</h2><p class="comment-form-comment"><textarea id="comment" name="comment" rows="12" placeholder="' . esc_attr( __('Be nice!', 'haku') ) . '"></textarea></p>',
);

comment_form( $form, $post->ID );

?>
<!-- end: Comment form -->