<?php if(apply_filters('intro_display_post_tags', true)){ ?>

	<?php if(has_tag() && is_single()){ ?>
	
		<span class="post-footer-meta" itemscope="keywords">
		
			<?php echo get_the_tag_list(apply_filters('intro_before_post_tags', ''),' | ',apply_filters('intro_after_post_tags', '')); ?>
		
		</span>
		
	<?php } ?>

<?php } ?>

<?php if(intro_is_paginated_post()){ ?>
	<nav>
	
	<?php wp_link_pages(array(
		'before'=>'<div class="post-pagination"><span class="page-links-title">'.__('Pages:', 'intro').'</span>', 
		'after'=>'</div>'
	)); ?>
	
	</nav>
<?php } ?>

<?php if (intro_is_masonry()){ ?>
	<div class="masonry-footer">
		<time class="date updated">
			<?php the_time(get_option('date_format')); ?>
		</time>
	</div>
<?php } ?>