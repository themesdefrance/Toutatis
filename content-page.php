<article id="page-<?php the_ID(); ?>" <?php post_class('page'); ?> itemscope itemtype="http://schema.org/Article">

	<header class="entry-header" >
					
		<?php if (has_post_thumbnail() && !post_password_required()): ?>
		
			<div class="entry-thumbnail">

				<?php intro_post_thumbnail(); ?>
					
			</div><!--END .entry-thumbnail-->
			
		<?php endif; ?>
			
			<h1 class="entry-title" itemprop="headline">
				
				<?php the_title(); ?>
					
			</h1>
		
	</header> <!--END .entry-header-->
	
	<div class="entry-content" itemprop="articleBody">
		
		<?php the_content(); ?>

	</div> <!--END .entry-content-->
	
</article> <!--END article -->