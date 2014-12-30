<?php $sidebar = get_option('intro_show_sidebar'); ?>

<?php get_header(); ?>

<section class="content">

	<div class="wrapper<?php if ($sidebar) echo ' grid'; ?>">	
		
		<main class="main-content<?php if ($sidebar) echo ' col-2-3'; ?>" role="main" itemprop="mainContentOfPage">
				
			<?php 
				
				if(have_posts()) :
			
					while (have_posts()) : the_post();
							
						get_template_part('content', 'page');
					
					endwhile;
				
				endif;
			?>
			
			<?php intro_posts_nav(false, '', '<div class="pagination">', '</div>'); ?>
			
		</main>
		
		<?php if ($sidebar){ ?>
		
			<aside class="sidebar col-1-3" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			
				<?php dynamic_sidebar('blog'); ?>
				
			</aside> <!-- END .sidebar .col-1-3 -->
		
		<?php } ?>
		
	</div> <!-- END .wrapper -->

</section> <!-- END .content -->

<?php get_footer(); ?>