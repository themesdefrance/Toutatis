<?php
/**
 * The template for displaying pages without sidebar
 *
 * @package Toutatis
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php 
/*
Template Name: Fullwidth
*/
__('Fullwidth','toutatis');
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php get_header(); ?>

<?php do_action('toutatis_before_main'); ?>

<section class="content">
	
	<div class="wrapper">
		
		<?php do_action('toutatis_top_main'); ?>
				
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
		
		<?php toutatis_posts_nav(false, '', '<div class="pagination">', '</div>'); ?>
		
		<?php do_action('toutatis_bottom_main'); ?>
		
	</div> <!-- END .wrapper -->

</section> <!-- END .content -->

<?php do_action('toutatis_after_main'); ?>

<?php get_footer(); ?>