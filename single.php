<?php $sidebar = get_option('intro_show_sidebar'); ?>

<?php get_header(); ?>

<section class="content">

	<div class="wrapper<?php if ($sidebar) echo ' grid'; ?>">	
		
		<main class="main-content<?php if ($sidebar) echo ' col-2-3'; ?>" role="main" itemprop="mainContentOfPage">
		
			<?php
				
				while ( have_posts() ) : the_post();
				
					get_template_part('content', get_post_format());
				
					comments_template();
					
					intro_posts_nav(false, '','<div class="pagination">','</div>');
				
				endwhile;
			?>

		</main>
		
		<?php if ($sidebar): ?>
		
			<aside class="sidebar col-1-3" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			
				<?php dynamic_sidebar('blog'); ?>
				
			</aside>
		
		<?php endif; ?>
			
	</div> <!-- END .wrapper -->

</section> <!-- END .content -->

<?php get_footer(); ?>