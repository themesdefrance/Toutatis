<?php
	$post_header_date     = apply_filters('intro_post_header_date', true);
	$post_header_author   = apply_filters('intro_post_header_author', true);
	$post_header_category = apply_filters('intro_post_header_category', true);
	$post_header_comments = apply_filters('intro_post_header_comments', true);
?>

<?php if(!is_page() && !is_tag()): ?> 
		
	<span class="post-header-meta">
		
	<?php
		
		if($post_header_date || $post_header_author || $post_header_category){
			_e('Published ','intro');
		}
		if($post_header_date){ ?>
			
			<?php _e('on','intro'); ?>
			
			<time class="date updated">
				<?php the_time( get_option( 'date_format' ) ); ?>
			</time>
			
		<?php
		}
		if($post_header_author){ ?>
			
			<?php _e('by','intro'); ?>
			
			<span class="vcard author">
				<span class="fn">
					<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
						<?php the_author_meta('display_name'); ?>
					</a>
				</span>
			</span>
			
		<?php
		}
		if($post_header_category){
			printf(__('in','intro') . ' ' . get_the_category_list('/') . ' ');
		}
		if($post_header_date || $post_header_author || $post_header_category){
			echo '| ';
		}
		if($post_header_comments){
			comments_number(__('No Comment', 'intro'), __('One Comment', 'intro'), __('% Comments', 'intro'));
			echo ' | ';
		}
		
		edit_post_link(__('Edit', 'intro'));
	?>
		
	</span>

<?php endif; ?>