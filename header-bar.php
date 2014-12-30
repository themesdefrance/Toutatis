<section class="header-bar">
	
	<div class="wrapper">
		
		<?php if(is_single()){ ?>
		
			<h2 class="header-bar-title"><?php echo apply_filters('intro_headerbar_single', __('Blog', 'intro')); ?></h2>
			
		<?php }else if(is_page()){ ?>
		
			<h1 class="header-bar-title"><?php echo get_the_title(); ?></h1>
			
		<?php }else if(is_category()){ ?>
		
			<h1 class="header-bar-title">
				<?php single_cat_title(_e('Posts from ', 'intro')); ?>
			</h1>
		
		<?php }else if(is_tag()){ ?>
		
			<h1 class="header-bar-title">
				<?php single_tag_title(_e('Posts tagged by ', 'intro')); ?>
			</h1>
			
		<?php }else if(is_search()){ ?>
		
			<h1 class="header-bar-title">
				<?php printf( __( 'Search results for : %s', 'intro' ), get_search_query() ); ?>
			</h1>
		
		<?php }else if(is_author()){ ?>
	
			<?php $author = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
			
			<h1 class="header-bar-title">
				<?php printf( __( 'About %s', 'intro' ), $author->display_name ); ?>
			</h1>
		
		<?php }else if(is_archive()){ ?>
			<h1 class="header-bar-title">
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
		
		<?php }else{ ?>
			
			<h1 class="header-bar-title"><?php echo apply_filters('intro_headerbar_single', __('Blog', 'intro')); ?></h1>
			
		<?php } ?>
		
		<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<div id="site-breadcrumbs">','</div>');
				} ?>
		
	</div><!--END .wrapper-->

</section><!--END .header-bar-->