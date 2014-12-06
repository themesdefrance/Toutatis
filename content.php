<article <?php post_class('post'); ?> itemscope="itemscope" itemtype="http://schema.org/Article">

	<header class="entry-header" >
					
		<?php if (has_post_thumbnail() && !post_password_required()): ?>
		
			<div class="entry-thumbnail">
			
				<?php if (is_single()): ?> 

					<?php intro_post_thumbnail(); ?>
					
				<?php else: ?>
				
					<a class="entry-permalink" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						
						<?php intro_post_thumbnail(); ?>
						
					</a>
					
				<?php endif; ?>
					
			</div><!--END .entry-thumbnail-->
			
		<?php endif; ?>
		
		
		<?php if (is_single()): ?>
			
			<h1 class="entry-title" itemprop="headline">
				
				<?php the_title(); ?>
					
			</h1><!--END .entry-title-->
			
		<?php else: ?>
		
			<h2 class="entry-title" itemprop="headline">
				
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
					
					<?php the_title(); ?>
					
				</a>
				
			</h2><!--END .entry-title-->
		
		<?php endif; ?> 
		
		<?php get_template_part('content', 'header'); ?>
		
	</header><!--END .entry-header-->
	
	<div class="entry-content" itemprop="articleBody">
		
		<?php get_template_part('content', 'body'); ?>

	</div><!--END .entry-content-->
	
	<footer class="entry-footer">
	
		<?php get_template_part('content', 'footer'); ?>
		
	</footer><!--END .entry-footer-->
	
</article>