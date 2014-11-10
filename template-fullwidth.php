<?php 
/*
Template Name: Fullwidth
*/
__('Fullwidth','intro');
?>

<?php get_header(); ?>

<div class="wrapper">	
			
	<ul class="posts">
		
		<?php if(have_posts()) : ?>
		
			<?php while (have_posts()) : the_post(); ?>
			
				<li>
					<?php get_template_part('content'); ?>
					
				</li>
			
			<?php endwhile; ?>
		
		<?php else: ?>
				
			<p><?php echo apply_filters('intro_nopostfound', __('Sorry but no post match what you are looking for.','intro')); ?></p>
		
		<?php endif; ?>
		
	</ul>
	
	<?php intro_posts_nav(false, '', '<div class="pagination">', '</div>'); ?>
	
</div>

<?php get_footer(); ?>