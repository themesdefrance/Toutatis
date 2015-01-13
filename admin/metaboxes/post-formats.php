<?php
/**
 * Toutatis post formats metaboxes registering
 *
 * @package Toutatis
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
	
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

/**
 * Register post formats metaboxes
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('toutatis_add_meta_boxes')){
	function toutatis_add_meta_boxes(){
		add_meta_box(
					'toutatis_link',
					__('Link', 'toutatis'),
					'toutatis_link_callback',
					 'post',
					 'normal',
					 'high'
					 );
					 
		add_meta_box(
					'toutatis_quote',
					__('Quote', 'toutatis'),
					'toutatis_quote_callback',
					 'post',
					 'normal',
					 'high'
					 );
		
		add_meta_box(
					'toutatis_video',
					__('Video', 'toutatis'),
					'toutatis_video_callback',
					 'post',
					 'normal',
					 'high'
					 );
	}
}
add_action('admin_init', 'toutatis_add_meta_boxes');


/**
 * Link format callback functtion using the Cocorico Framework
 *
 * @link 		https://github.com/y-lohse/Cocorico
 * @since 1.0
 * @return void
 */
if(!function_exists('toutatis_link_callback')){
	function toutatis_link_callback( $post ) {
	
		$form = new Cocorico(TOUTATIS_COCORICO_PREFIX, false);
		$form->startForm();
		
		$form->setting(array('type'=>'url',
						 'name'=>'_link_meta',
						 'label'=>__('Link to feature', 'toutatis'),
						 'description' => __('Add a link to feature for this post. You\'re free to talk about it in the post content.','toutatis')
						 )
					  );
		
		$form->endForm();
		$form->render();
	}
}

/**
 * Quote format callback functtion using the Cocorico Framework
 *
 * @link 		https://github.com/y-lohse/Cocorico
 * @since 1.0
 * @return void
 */
if(!function_exists('toutatis_quote_callback')){
	function toutatis_quote_callback( $post ) {
		
		$form = new Cocorico(TOUTATIS_COCORICO_PREFIX, false);
		$form->startForm();
		
		$form->setting(array('type'=>'text',
						 'name'=>'_quote_meta',
						 'label'=>__('Quote to feature', 'toutatis'),
						 'description' => __('Add some wise words and talk about it in the post content.','toutatis')
						 )
					  );
		
		$form->setting(array('type'=>'text',
						 'name'=>'_quote_author_meta',
						 'label'=>__('Quote author (optional)', 'toutatis'),
						 'description' => __('Be nice and don\'t forget to credit the quote author.','toutatis')
						 )
					  );
		
		$form->endForm();
		$form->render();
		
	}
}

/**
 * Video format callback functtion using the Cocorico Framework
 *
 * @link 		https://github.com/y-lohse/Cocorico
 * @since 1.0
 * @return void
 */
if(!function_exists('toutatis_video_callback')){
	function toutatis_video_callback( $post ) {
	
		$form = new Cocorico(TOUTATIS_COCORICO_PREFIX, false);
		$form->startForm();
		
		$form->setting(array('type'=>'url',
						 'name'=>'_video_meta',
						 'label'=>__('Video to feature', 'toutatis'),
						 'description' => __('Add a video link from Youtube, Dailymotion or Vimeo.','toutatis')
						 )
					  );
		
		$form->endForm();
		$form->render();
	}
}

/**
 * Show the right metabox for each post format
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('toutatis_display_metaboxes')){
	function toutatis_display_metaboxes() {
	
	    if ( get_post_type() == "post" ){ ?>
	    
	        <script>
	            jQuery(document).ready(function($) {
	            
		            // Set variables
		            var link_radio = $('#post-format-link'),
		            	quote_radio = $('#post-format-quote'),
		            	video_radio = $('#post-format-video'),
		            	link_metabox = $('#toutatis_link'),
		            	quote_metabox = $('#toutatis_quote'),
		            	video_metabox = $('#toutatis_video'),
		            	all_formats = $('#post-formats-select input');
			            
		            hideAllMetaBoxes();
		            
		            all_formats.change( function() {
					    
				        hideAllMetaBoxes();
				
				        if( $(this).val() == 'link' ) {
							link_metabox.show();
						}
						else if( $(this).val() == 'quote' ) {
						    quote_metabox.show();
						} 
						else if( $(this).val() == 'video' ) {
							video_metabox.show();
						} 
				
					});
				
				    if(link_radio.is(':checked'))
				        link_metabox.show();
				
				    if(quote_radio.is(':checked'))
				        quote_metabox.show();
				        
				    if(video_radio.is(':checked'))
						video_metabox.show();
		            
		            
		            function hideAllMetaBoxes(){
			            link_metabox.hide();
			            quote_metabox.hide();
			            video_metabox.hide();
		            }
	            });
	        </script>
	        
	<?php
		}
	}
}
// Add inline js in admin
add_action( 'admin_print_scripts', 'toutatis_display_metaboxes',1000);