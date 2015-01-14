<?php
/**
 * The template for displaying the main content or excerpt
 *
 * @package Toutatis
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php do_action('toutatis_before_content'); ?>

<div class="entry-content" itemprop="articleBody">

	<?php do_action('toutatis_top_content'); ?>

	<?php if (is_single()):
	
			the_content();
	
		elseif(is_category() || is_tax() || is_search()):
	
			echo toutatis_excerpt(25);
	
			?>
	
			<p class="readmore">
	
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e('Read more','toutatis'); ?></a>
	
			</p>
	
		<?php
	
		elseif(is_tag()):
			// No excerpt for tags archives
			echo toutatis_excerpt(0);
	
		else:
	
			echo toutatis_excerpt(40);
	
			?>
	
			<p class="readmore">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e('Read more','toutatis'); ?></a>
			</p>
	
			<?php
	
		endif; ?>

	<?php do_action('toutatis_bottom_content'); ?>

</div><!--END .entry-content -->

<?php do_action('toutatis_after_content'); ?>