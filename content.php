<?php $sidebar = get_option('intro_show_sidebar'); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">

	<header class="entry-header" >
					
		<?php if (has_post_thumbnail() && !post_password_required()): ?>
		
			<div class="entry-thumbnail">
			
				<?php if (is_single()){ ?> <a href="<?php the_permalink(); ?>" title="<?php _e('Read more','intro'); ?>" class="post-permalink"><?php } ?>

					<?php
						if($sidebar)
							the_post_thumbnail('intro-post-thumbnail');
						else
							the_post_thumbnail('intro-post-thumbnail-full');
					?>
					
				<?php if (is_single()){ ?></a> <?php } ?>
					
			</div><!--END .entry-thumbnail-->
			
		<?php endif; ?>
		
		
		<?php if (is_single()): ?>
			
			<h1 class="entry-title" itemprop="headline">
				
				<?php the_title(); ?>
					
			</h1>
			
		<?php else: ?>
		
			<h2 class="entry-title" itemprop="headline">
				
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
					
					<?php the_title(); ?>
					
				</a>
				
			</h2>
		
		<?php endif; ?> 
		
		<?php get_template_part('content', 'header'); ?>
		
	</header>
	
	<div class="entry-content" itemprop="articleBody">
		
		<?php get_template_part('content', 'body'); ?>

	</div>
	
	<footer class="entry-footer">
	
		<?php get_template_part('content', 'footer'); ?>
		
	</footer>
	
</article>