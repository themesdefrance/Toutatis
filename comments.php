<?php
/**
 * The template for displaying comments
 *
 * @package Toutatis
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php if (post_password_required()) return; ?>

<?php do_action('toutatis_before_comments'); ?>

<div id="comments" class="entry-comments">
	
	<?php do_action('toutatis_top_comments'); ?>
	
	<?php if (have_comments()): ?>
	
		<h2 class="comments-title">
			<?php
               printf(_n(apply_filters('toutatis_one_comment', '1 comment was added, add yours.'), apply_filters('toutatis_several_comments', '%1$s comments were added, add yours.'), get_comments_number(), 'toutatis'), number_format_i18n(get_comments_number())); 
            ?>
		</h2><!-- END .comments-title -->
		
		<?php do_action('toutatis_before_comment_form'); ?>
		
		<?php comment_form(toutatis_comment_form_args()); ?>
		
		<?php do_action('toutatis_after_comment_form'); ?>
		
		<?php do_action('toutatis_before_comment_list'); ?>
		
		<ol class="comment-list">
			<?php wp_list_comments(array('callback'=>'toutatis_comment')); ?>
		</ol>
		
		<?php do_action('toutatis_after_comment_list'); ?>
 
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')){ ?>
        
		<nav role="navigation" id="comment-nav-below" class="comment-navigation">
			
			<div class="nav-previous">
            	<?php previous_comments_link(__('Previous comments', 'toutatis')); ?>
            </div>
            
            <div class="nav-next">
            	<?php next_comments_link(__('Next comments', 'toutatis')); ?>
            </div>
            
        </nav><!-- END #comment-nav-below -->
        
        <?php } // check for comment navigation ?>
 
	<?php else:  ?>
	
		<h2 class="comments-title">
			<?php echo apply_filters('toutatis_first_comment', __('Be the first to post a comment.', 'toutatis')); ?>
		</h2>
		
		<?php do_action('toutatis_before_comment_form'); ?>
		
		<?php comment_form(toutatis_comment_form_args()); ?>
		
		<?php do_action('toutatis_after_comment_form'); ?>
			
	<?php endif; ?>
	
    <?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')): ?>
    	
    	<?php do_action('toutatis_before_comment_list'); ?>
    	
		<p class="nocomments">
			<?php echo apply_filters('toutatis_comments_closed', __('Comments are closed.', 'toutatis')); ?>
		</p>
		
		<?php do_action('toutatis_after_comment_list'); ?>
		
	<?php endif; ?>
	
	<?php do_action('toutatis_bottom_comments'); ?>
	
</div><!-- END #comments -->

<?php do_action('toutatis_after_comments'); ?>