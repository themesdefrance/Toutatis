<?php 

/////////////////////////
// Utility functions   //
/////////////////////////

if (!function_exists('intro_excerpt')){
	function intro_excerpt($length){
		global $post;
		
		// No excerpt needed
		if($length==0)
			return '';
		
		// Do we have an excerpt ?
		if(has_excerpt())
			return '<p>' . get_the_excerpt() . '</p>';
		
		// Do we have a read more tag ?
		if(strpos( $post->post_content, '<!--more-->' )){
			$content_arr = get_extended($post->post_content);
			return '<p>' . $content_arr['main'] . '</p>';
		}
		
		// Create a custom excerpt without shortcodes, images and iframes
		$content = strip_shortcodes(strip_tags(get_the_content(), '<img><iframe>'));
		
		return '<p>' . wp_trim_words( $content , $length ) . '</p>';
	}
}

// Thanks to https://gist.github.com/tommcfarlin/f2310bfad60b60ae00bf#file-is-paginated-post-php
if (!function_exists('intro_is_paginated_post')){
	function intro_is_paginated_post() {
		global $multipage;
		return 0 !== $multipage;
	}
}

// Function to call if no primary menu
if (!function_exists('intro_nomenu')){
	function intro_nomenu(){
		echo '<ul class="top-level-menu"><li><a href="'.admin_url('nav-menus.php').'">'.__('Set up the main menu', 'intro').'</a></li></ul>';
	}
}

//customized pagination links
if (!function_exists('intro_posts_nav')){
	//derived from http://www.wpbeginner.com/wp-themes/how-to-add-numeric-pagination-in-your-wordpress-theme/
	/*
	 @param $extremes : display or not previous & next links
	 @param $separator : string to insert between each page
	*/
	
	function intro_posts_nav($extremes=true, $separator='|', $before = '', $after){
		if (is_singular()) return;
	
		global $wp_query;
		$output = '';
		
		// Stop execution if there's only 1 page
		if($wp_query->max_num_pages <= 1) return;
	
		$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
		$max = intval($wp_query->max_num_pages);
	
		// Add current page to the array
		if ($paged >= 1) $links[] = $paged;
	
		// Add the pages around the current page to the array
		if ($paged >= 3){
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}
	
		if (($paged + 2 ) <= $max){
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}
		
		$current = apply_filters('intro_post_nav_current', '<span class="current">%s</span>');
		$linkTemplate = apply_filters('intro_post_nav_link', '<a href="%s">%s</a>');
		
		$output .= $before;
		
		// Previous Post Link
		if ($extremes && get_previous_posts_link()) previous_posts_link();
	
		// Link to first page, plus ellipses if necessary */
		if (!in_array(1, $links)){
			if ($paged == 1)
				$output .= sprintf($current, '1');
			else
				$output .= sprintf($linkTemplate, esc_url(get_pagenum_link(1)), '1');
			
			echo $separator;
			if (!in_array(2, $links)) $output .= '…'.$separator;
		}
	
		// Link to current page, plus 2 pages in either direction if necessary
		sort($links);
		foreach ((array) $links as $link){
			if ($paged == $link)
				$output .= sprintf($current, $link);
			else
				$output .= sprintf($linkTemplate, esc_url(get_pagenum_link($link)), $link);
				
			if ($link < $max) $output .= $separator;
		}
	
		// Link to last page, plus ellipses if necessary
		if (!in_array($max, $links)){
			if (!in_array($max-1, $links)) $output .= '…'.$separator;
	
			if ($paged == $max)
				$output .= sprintf($current, $link);
			else
				$output .= sprintf($linkTemplate, esc_url(get_pagenum_link($max)), $max);
		}
		
		$output .= $after;
		
		echo apply_filters('intro_post_nav', $output);
	
		// Next Post Link
		if ($extremes && get_next_posts_link()) next_posts_link();
	}
}

// Borrowed from http://themeshaper.com/2012/11/04/the-wordpress-theme-comments-template/
if (!function_exists('intro_comment')){
	function intro_comment($comment, $args, $depth){
		$GLOBALS['comment'] = $comment;
		switch ($comment->comment_type) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p>
				<?php echo apply_filters('intro_pingback', __('Pingback:', 'intro')); ?>
				<?php comment_author_link(); ?>
			</p>
		<?php
			break;
		default :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<aside class="comment-aside">
					<?php if ($comment->comment_approved == '0') : ?>
						<em><?php echo apply_filters('intro_comment_waiting_moderation', __('Your comment is waiting for moderation.', 'intro')); ?></em>
					<?php endif; ?>
					<?php echo get_avatar($comment, 80); ?>
				</aside>
				
				<div class="comment-main">
					<header class="comment-header">
						<div class="comment-author vcard">
							<?php echo apply_filters('intro_comment_author', sprintf(__('%s', 'intro'), sprintf(__('<cite class="fn">%s</cite>', 'intro'), get_comment_author_link()))); ?>
						</div>
					</header>
		 
					<div class="post-content">
						<?php comment_text(); ?>
					</div>
					
					<footer class="comment-footer">
						<div class="comment-date">
							<?php echo apply_filters('intro_comment_date', sprintf(__('Published on %s at %s', 'intro'),get_comment_date(),get_comment_time('H:i'))); ?>
						</div>
						<div class="reply">
							<?php 
							comment_reply_link(array_merge($args, 
								array(	'depth'=>$depth, 
										'max_depth'=>$args['max_depth'],
										'reply_text'=>apply_filters('intro_comment_reply', __('Reply', 'intro'))))); 
							?>
						</div>
					<footer>
				</div>
			</article>
		<?php
			break;
		endswitch;
	}
}

if (!function_exists('intro_comment_form_args')){
	function intro_comment_form_args(){
		
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		
		$comment_args = array(
			'comment_notes_before'=>'',
			'comment_notes_after'=>'',
			'title_reply'=>'',
			'title_reply_to'=>apply_filters('intro_comment_reply_to', __('Reply to %s', 'intro')),
			'label_submit'=>apply_filters('intro_comment_send', __('Post comment', 'intro')),
			'fields' => apply_filters( 'intro_comment_form_default_fields', array(
			    'author' =>
			      '<p class="comment-form-author">' .
			      '<label for="author"></label> ' .
			      '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			      '" size="30"' . $aria_req .
			      ' placeholder="' . __('Name','intro') . ( $req ? ' (' . __( 'required', 'intro' ) . ')' : '' ) .'"/></p>',
			
			    'email' =>
			      '<p class="comment-form-email">' .
			      '<label for="email"></label> ' .
			      '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			      '" size="30"' . $aria_req .
			      ' placeholder="' . __( 'Email', 'intro' ) . ( $req ? ' (' . __( 'required', 'intro' ) . ')' : '' ) .'"/></p>',
			
			    'url' =>
			      '<p class="comment-form-url"><label for="url"></label>' .
			      '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			      '" size="30"' .
			      ' placeholder="' . __( 'Website', 'intro' ) . '"/></p>'
			   )
			),
			'comment_field' =>  apply_filters( 'intro_comment_form_default_comment_field','<p class="comment-form-comment"><label for="comment"></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . __('Comment','intro' ) .'"></textarea></p>')
		);
		
		return $comment_args;
			
	}	
}

//relies on the Cocorico Social plugin : https://wordpress.org/plugins/cocorico-social/
if (!function_exists('intro_social')){
	function intro_social(){
		$export = '';
		
		if (function_exists('coco_social_share')){
			$networks =  get_option('cocosocial_networks_blocks');
			
			if (is_array($networks)){
			
				foreach ($networks as $network=>$enabled){
					if (!$enabled) continue;
					
					switch ($network){
						case 'twitter':
							if (trim(get_option('cocosocial_twitter_username')) !== ''){
								$export .= '<li><a href="https://twitter.com/'.get_option('cocosocial_twitter_username').'" class="typcn typcn-social-twitter-circular"></a></li>';
							}
							break;
						case 'email':
						case 'viadeo':
							//sorry, no viadeo support because wedon't have an icon for it
							//and email doesnt make too much sense here
							break;
						default:
							$url = get_option('cocosocial_'.$network.'_url');
							if (trim($url) !== ''){
								$icon = $network;
								if ($network == 'googleplus') $icon = 'google-plus';
	
								$export .= '<li><a href="'.esc_url($url).'" class="typcn typcn-social-'.$icon.'-circular"></a></li>';
							}
							break;
					}
				}
			}
		}
		
		return $export;
	}
}

// Based on the Compact Archives plugin https://wordpress.org/plugins/compact-archives/
if (!function_exists('intro_archives')){
	function intro_archives( $style='block', $before='<li>', $after='</li>' ) {
		global $wpdb;
		
		setlocale(LC_ALL,get_locale()); // set localization language
		
		$results = $wpdb->get_results("SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month FROM " . $wpdb->posts . " WHERE post_type='post' AND post_status='publish' AND post_password='' ORDER BY year DESC, month DESC");
		
		if (!$results) {
			return $before.__('There is no archives to display.', 'intro').$after;
		}
		$dates = array();
		foreach ($results as $result) {
			$dates[$result->year][$result->month] = 1;
		}
		unset($results);
		$result = '';
		foreach ($dates as $year => $months){
			$result .= $before.'<strong><a href="'.get_year_link($year).'">'.$year.'</a>: </strong> ';
			for ( $month = 1; $month <= 12; $month += 1) {
				$month_has_posts = (isset($months[$month]));
				$dummydate = strtotime("$month/01/2001");
				// get the month name; strftime() localizes
				$month_name = strftime("%B", $dummydate); 
				switch ($style) {
				case 'initial':
					$month_abbrev = $month_name[0]; // the inital of the month
					break;
				case 'block':
					$month_abbrev = strftime("%b", $dummydate); // get the short month name; strftime() localizes
					break;
				case 'numeric':
					$month_abbrev = strftime("%m", $dummydate); // get the month number, e.g., '04'
					break;
				default:
					$month_abbrev = $month_name[0]; // the inital of the month
				}
				if ($month_has_posts) {
					$result .= '<a href="'.get_month_link($year, $month).'" title="'.utf8_encode($month_name).' '.$year.'">'.utf8_encode($month_abbrev).'</a> ';
				} else {
					$result .= '<span class="emptymonth">'.utf8_encode($month_abbrev).'</span> ';
				}
			}
			$result .= $after."\n";
		}
		return $result;
	}
}