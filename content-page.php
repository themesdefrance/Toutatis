<?php 

$sidebar = get_option('intro_show_sidebar');

?>

<article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">

	<header class="entry-header" >
					
		<?php if (has_post_thumbnail() && !post_password_required()): ?>
		
			<div class="entry-thumbnail">

				<?php
					if($sidebar)
						the_post_thumbnail('intro-post-thumbnail');
					else
						the_post_thumbnail('intro-post-thumbnail-full');
				?>
					
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