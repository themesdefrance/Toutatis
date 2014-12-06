<?php $quote 		= "“" . get_post_meta($post->ID, '_intro_quote_meta', true) . "”"; ?>
<?php $author_quote = get_post_meta($post->ID, '_intro_quote_author_meta', true); ?>

<article <?php post_class('post'); ?> itemscope itemtype="http://schema.org/Article">

	<header class="entry-header">
		
		<div class="entry-quote">
		
			<?php if (is_single()): ?>
				
				<h1 class="entry-title" itemprop="name">
				
					<blockquote><?php echo $quote; ?></blockquote>
					
				</h1><!--END .entry-title-->
				
			<?php else: ?>
				
				<h2 class="entry-title" itemprop="name">
				
					<blockquote>
						
						<a href="<?php the_permalink(); ?>" title="<?php echo $quote; ?>">
						
							<?php echo $quote; ?>
							
						</a>
					
					</blockquote>
					
				</h2><!--END .entry-title-->
				
			<?php endif; ?>
			
			<span class="entry-quote-author"><?php echo $author_quote; ?></span>
			
		</div><!--END .entry-quote-->
		
		<?php get_template_part('content', 'header'); ?>
		
	</header><!--END .entry-header-->
		
	<div class="entry-content" itemprop="articleBody">
		
		<?php get_template_part('content', 'body'); ?>
		
	</div><!--END .entry-content-->
	
	<footer class="post-footer">
	
		<?php get_template_part('content', 'footer'); ?>
		
	</footer><!--END .entry-footer-->
	
</article>