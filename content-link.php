<?php $link = get_post_meta($post->ID, '_intro_link_meta', true); ?>

<article <?php post_class('post'); ?> itemscope itemtype="http://schema.org/Article">

	<header class="entry-header">
	
		<div class="entry-link">
		
			<?php if (is_single()): ?>
				
				<h1 class="entry-title">
					
					<a href="<?php echo $link; ?>" title="<?php the_title(); ?>" rel="external">
						
						<?php the_title(); ?>
						
					</a>
					
				</h1><!--END .entry-title-->
				
			<?php else: ?>
			
				<h2 class="entry-title">
					
					<a href="<?php echo $link; ?>" title="<?php the_title(); ?>">
					
						<?php the_title(); ?>
						
					</a>
				
				</h2><!--END .entry-title-->
				
			<?php endif; ?>
		
		</div><!--END .entry-link-->
		
		<?php get_template_part('content', 'header'); ?>
		
	</header>
	
	<div class="entry-content">
		
		<?php get_template_part( 'content', 'body' ); ?>	

	</div><!--END .entry-content-->
	
	<footer class="entry-footer">
	
		<?php get_template_part( 'content', 'footer' ); ?>
		
	</footer><!--END .entry-footer-->
	
</article>