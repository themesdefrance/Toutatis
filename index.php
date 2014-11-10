<?php $sidebar = get_option('intro_show_sidebar'); ?>

<?php get_header(); ?>

<div class="wrapper">	

	<div class="<?php if ($sidebar) echo 'grid'; ?>">
	
		<div class="<?php if ($sidebar) echo 'col-2-3'; ?>">
			
			<?php get_template_part('header', 'bar'); } ?>
			
			
			<ul class="posts">
				
				<?php if(have_posts()) : ?>
				
					<?php while (have_posts()) : the_post(); ?>
					
						<li>
							
							<?php get_template_part('content', get_post_format()); ?>
	
						</li>
					
					<?php endwhile; ?>
				
				<?php else: ?>
				
					<p><?php echo apply_filters('intro_nopostfound', __('Sorry but no post match what you are looking for.','intro')); ?></p>
				
				<?php endif; ?>
				
			</ul>
			
			<?php intro_posts_nav(false, '', '<div class="pagination">', '</div>'); ?>
			
		</div>
		
		<?php if ($sidebar){ ?>
		
		<aside class="sidebar col-1-3">
		
			<?php dynamic_sidebar('blog'); ?>
			
		</aside>
		
		<?php } ?>
		
	</div>
	
</div>

<?php get_footer(); ?>