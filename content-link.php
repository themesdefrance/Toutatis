<?php $link = get_post_meta($post->ID, '_intro_link_meta', true); ?>

<article <?php post_class('post'); ?> itemscope itemtype="http://schema.org/Article">

	<header class="entry-header">
	
		<div class="entry-link">
		
			<?php if (is_single()): ?>
				
				<h1 class="entry-title">
					
					<a href="<?php echo $link; ?>" title="<?php the_title(); ?>" rel="external">
						
						<?php the_title(); ?>
						
					</a>
					
				</h1>
				
			<?php else: ?>
			
				<h2 class="entry-title">
					
					<a href="<?php echo $link; ?>" title="<?php the_title(); ?>">
					
						<?php the_title(); ?>
						
					</a>
				
				</h2>
				
			<?php endif; ?>
		
		</div>
		
		<?php get_template_part('content', 'header'); ?>
		
	</header>
	
	<div class="post-content">
		
		<?php get_template_part( 'content', 'body' ); ?>	

	</div>
	
	<footer class="post-footer">
	
		<?php get_template_part( 'content', 'footer' ); ?>
		
	</footer>
	
</article>