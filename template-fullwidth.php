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
				
				<li>
					<?php get_template_part('content', 'none'); ?>
				</li>
		
		<?php endif; ?>
		
	</ul> <!-- END .posts -->
	
	<?php intro_posts_nav(false, '', '<div class="pagination">', '</div>'); ?>
	
</div> <!-- END .wrapper -->

<?php get_footer(); ?>