<?php 
/*
Template Name: Fullwidth
*/
__('Fullwidth','intro');
?>

<?php get_header(); ?>

<section class="content">
	
	<div class="wrapper">	
				
		<main class="main-content col-1-1" role="main" itemprop="mainContentOfPage">
			
			<?php
				
				if(have_posts()) :
			
					while (have_posts()) : the_post();
	
						get_template_part('content');
				
						endwhile;
			
				else:
					
					get_template_part('content', 'none');
			
				endif;
			?>
			
		</main>
		
		<?php intro_posts_nav(false, '', '<div class="pagination">', '</div>'); ?>
		
	</div> <!-- END .wrapper -->

</section> <!-- END .content -->

<?php get_footer(); ?>