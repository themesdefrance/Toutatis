<?php
/**
 * The template for displaying post footer meta content
 *
 * @package Toutatis
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<footer class="entry-footer">
	
	<?php do_action('toutatis_top_footer_post'); ?>

	<?php if(apply_filters('toutatis_display_post_tags', true)){ ?>
	
		<?php if(has_tag() && is_single()){ ?>
		
			<span class="entry-footer-meta" itemscope="keywords">
			
				<?php echo get_the_tag_list(apply_filters('toutatis_before_post_tags', ''),' | ',apply_filters('toutatis_after_post_tags', '')); ?>
			
			</span>
			
		<?php } ?>
	
	<?php } ?>
	
	<?php if(toutatis_is_paginated_post()){ ?>
	
		<nav>
		
			<?php wp_link_pages(array(
				'before'=>'<div class="post-pagination"><span class="page-links-title">'.__('Pages:', 'toutatis').'</span>', 
				'after'=>'</div>'
			)); ?>
		
		</nav>
		
	<?php } ?>
	
	<?php do_action('toutatis_bottom_footer_post'); ?>
	
</footer><!--END .entry-footer-->