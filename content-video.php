<?php $video_link = get_post_meta($post->ID, '_intro_video_meta', true); ?>

<article <?php post_class('post'); ?> itemscope itemtype="http://schema.org/Article">

	<header class="entry-header">
	
		<div class="entry-video">
									
			<?php echo wp_oembed_get( $video_link); ?>
			
		</div><!--END .entry-video-->
		
		<?php if (is_single()): ?>
			
			<h1 class="entry-title"><?php the_title(); ?></h1>
			
		<?php else: ?>
		
			<h2 class="entry-title">
				
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					
					<?php the_title(); ?>
					
				</a>
			
			</h2><!--END .entry-title-->
			
		<?php endif; ?>
		
		<?php get_template_part('content', 'header'); ?>
		
	</header>
	
	<div class="entry-content">
		
		<?php get_template_part( 'content', 'body' ); ?>	

	</div><!--END .entry-content-->
	
	<footer class="entry-footer">
	
		<?php get_template_part( 'content', 'footer' ); ?>
		
	</footer><!--END .entry-footer-->
	
</article>