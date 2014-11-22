<?php $sidebar = get_option('intro_show_sidebar'); ?>

<?php get_header(); ?>

<div class="content">

	<div class="wrapper<?php if ($sidebar) echo ' grid'; ?>">	
		
		<div class="<?php if ($sidebar) echo 'col-2-3'; ?>" role="main" itemprop="mainContentOfPage">
			
			<ul class="posts">
				
				<?php if(have_posts()) : ?>
				
					<?php while (have_posts()) : the_post(); ?>
					
						<li>
							
							<?php get_template_part('content', get_post_format()); ?>
	
						</li>
					
					<?php endwhile; ?>
				
				<?php else: ?>
						
						<li>
							<?php get_template_part('content', 'none'); ?>
						</li>
				
				<?php endif; ?>
				
			</ul> <!-- END .col-2-3 -->
			
			<?php intro_posts_nav(false, '', '<div class="pagination">', '</div>'); ?>
			
		</div> <!-- END .wrapper -->
		
		<?php if ($sidebar){ ?>
		
			<aside class="sidebar col-1-3" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			
				<?php dynamic_sidebar('blog'); ?>
				
			</aside> <!-- END .sidebar .col-1-3 -->
		
		<?php } ?>
		
	</div> <!-- END .wrapper -->

</div> <!-- END .content -->

<?php get_footer(); ?>