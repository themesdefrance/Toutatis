<?php 

$sidebar = get_option('intro_show_sidebar');
$postlink = ((is_single() || is_page()) ? false : true);

?>

<article <?php post_class('post'); ?> itemscope itemtype="http://schema.org/Article">

	<header class="post-header">
					
		<?php if (has_post_thumbnail() && !post_password_required()): ?>
		
			<div class="post-thumbnail">
			
				<?php if ($postlink){ ?> <a href="<?php the_permalink(); ?>" title="<?php _e('Read more','intro'); ?>" class="post-permalink"><?php } ?>

					<?php
						if($sidebar)
							the_post_thumbnail('intro-post-thumbnail');
						else
							the_post_thumbnail('intro-post-thumbnail-full');
					?>
					
				<?php if ($postlink){ ?></a> <?php } ?>
					
			</div><!--END .entry-thumbnail-->
			
		<?php endif; ?>
		
		
		<?php if (is_single() || is_page()): ?>
			
			<h1 class="entry-title" itemprop="name">
				
				<?php the_title(); ?>
					
			</h1>
			
		<?php elseif(!is_page()): ?>
		
			<h2 class="entry-title" itemprop="name">
				
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					
					<?php the_title(); ?>
					
				</a>
				
			</h2>
			
		
		<?php endif; ?> 
		
		<?php get_template_part('content', 'header-meta'); ?>
		
	</header>
	
	<div class="entry-content" itemprop="articleBody">
		
		<?php get_template_part('content', 'body'); ?>

	</div>
	
	<footer class="post-footer">
	
		<?php get_template_part('content', 'footer-meta'); ?>
		
	</footer>
	
</article>