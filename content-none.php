<?php $sidebar = get_option('intro_show_sidebar'); ?>

<article <?php post_class('post'); ?> itemscope itemtype="http://schema.org/Article">

	<header class="entry-header" >
			
		<h1 class="entry-title" itemprop="headline">
			
			<?php the_title(); ?>
				
		</h1><!--END .entry-title-->
		
	</header><!--END .entry-header-->
	
	<div class="entry-content" itemprop="articleBody">
		
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		
			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'intro' ), admin_url( 'post-new.php' ) ); ?></p>
		
		<?php elseif ( is_search() ) : ?>
			
			<p><?php _e('Sorry but no post match what you are looking for. Try some new keywords below :','intro'); ?></p>
			<?php get_search_form(); ?>
		
		<?php else: ?>
		
			<p><?php printf( __('Sorry but no post match what you are looking for. You should <a href="%1$s">go back to the homepage</a> and start again.','intro'), home_url()); ?></p>
			
		<?php endif; ?>

	</div><!--END .entry-content-->
	
</article>