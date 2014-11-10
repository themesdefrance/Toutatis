<?php if (post_password_required()) return; ?>

<div id="comments" class="post-comments">
	<?php if (have_comments()): ?>
		<h2 class="comments-title">
			<?php
                printf(_n(apply_filters('intro_one_comment', '1 comment was added, add yours.'), apply_filters('intro_several_comments', '%1$s comments were added, add yours.'), get_comments_number(), 'intro'), number_format_i18n(get_comments_number()));
            ?>
		</h2>
		
		<?php comment_form(intro_comment_form_args()); ?>
		
		<ol class="comment-list">
			<?php wp_list_comments(array('callback'=>'intro_comment')); ?>
		</ol>
 
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')){ ?>
		<nav role="navigation" id="comment-nav-below" class="comment-navigation">
			<div class="nav-previous">
            	<?php previous_comments_link(apply_filters('intro_previous_comments', __('Previous comments', 'intro'))); ?>
            </div>
            <div class="nav-next">
            	<?php next_comments_link(apply_filters('intro_next_comments', __('Next comments', 'intro'))); ?>
            </div>
        </nav>
        <?php } // check for comment navigation ?>
 
	<?php else:  ?>
		<h2 class="comments-title">
			<?php apply_filters('intro_first_comment', __('Be the first to post a comment.', 'intro')); ?>
		</h2>

		<?php comment_form(intro_comment_form_args()); 
	endif; ?>
    <?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')): ?>
		<p class="nocomments">
			<?php echo apply_filters('intro_comments_closed', __('Comments are closed.', 'intro')); ?>
		</p>
	<?php endif; ?>
</div>