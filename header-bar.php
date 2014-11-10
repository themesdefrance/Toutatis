<div class="headerbar">
	
	<?php if(is_category()){ ?>
	
			<h1 class="entry-title">
				<?php single_cat_title(__('Posts from ', 'intro')); ?>
			</h1>
			
	<?php }else if(is_tag()){ ?>
		
			<h1 class="entry-title">
				<?php single_tag_title(__('Posts tagged by ', 'intro')); ?>
			</h1>
			
	<?php }else if(is_search()){ ?>
		
			<h1 class="entry-title">
				<?php printf( __( 'Search results for : %s', 'intro' ), get_search_query() ); ?>
			</h1>
			
	<?php }else if(is_author()){ ?>
	
			<?php $author = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
			
			<h1 class="entry-title">
				<?php printf( __( 'Posts by %s', 'intro' ), $author->display_name ); ?>
			</h1>
		
	<?php }else if(is_archive()){ ?>
	
		<h1 class="entry-title">
			<?php if (is_day()) { 
					_e('Archives from ', 'intro');
					the_time(get_option('date_format'));
				}
				elseif(is_month()){
					_e('Archives for ', 'intro');
					the_time('F Y');
				}
				elseif(is_year()){
					_e('Archives for ', 'intro');
					the_time('Y');
				}
				else{
					_e('Archives', 'intro');
				}
				?>
		</h1>
	
	<?php }else if(is_home()){ ?>
		
		<h1 class="entry-title">
			<?php echo apply_filters('intro_home_header_title', __('Blog', 'intro')); ?>
		</h1>
		
	<?php }else{ ?>

		<h1 class="entry-title">
			<?php echo apply_filters('intro_default_header_title', __('Blog', 'intro')); ?>
		</h1>
		
	<?php } ?>
		
</div>