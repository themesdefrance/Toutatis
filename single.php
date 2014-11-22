<?php $sidebar = get_option('intro_show_sidebar'); ?>

<?php get_header(); ?>

<div class="content">

	<div class="wrapper<?php if ($sidebar) echo ' grid'; ?>">	
		
		<div class="<?php if ($sidebar) echo 'col-2-3'; ?>" role="main" itemprop="mainContentOfPage">
		
			<?php
				
				while ( have_posts() ) : the_post();
				
					get_template_part('content', get_post_format());
				
					comments_template();
					
					intro_posts_nav(false, '','<div class="pagination">','</div>');
				
				endwhile;
			?>

		</div><!-- END .col-2-3 -->
		
		<?php if ($sidebar){ ?>
		
			<aside class="sidebar col-1-3" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			
				<?php dynamic_sidebar('blog'); ?>
				
			</aside>
		
		<?php } ?>
			
	</div> <!-- END .wrapper -->

</div> <!-- END .content -->

<?php get_footer(); ?>