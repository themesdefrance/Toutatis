<?php
/**
 * Toutatis functions and definitions
 *
 * @package Toutatis
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Define theme constants (relative to licensing)
define('TOUTATIS_STORE_URL', 'https://www.themesdefrance.fr');
define('TOUTATIS_THEME_NAME', 'Toutatis');
define('TOUTATIS_THEME_VERSION', '1.0.1');
define('TOUTATIS_LICENSE_KEY', 'toutatis_license_edd');

// Include theme updater (relative to licensing)
if(!class_exists('EDD_SL_Theme_Updater'))
	include(dirname( __FILE__ ).'/admin/EDD_SL_Theme_Updater.php');

// Define framework constant then load the Cocorico Framework
define('TOUTATIS_COCORICO_PREFIX', 'toutatis_');
if(is_admin())
	require_once 'admin/Cocorico/Cocorico.php';

// Load the widgets
require 'admin/widgets/social.php';
require 'admin/widgets/calltoaction.php';
require 'admin/widgets/video.php';

// Load other theme functions
require 'admin/functions/toutatis-functions.php';


//Refresh the permalink structure
add_action('after_switch_theme', 'flush_rewrite_rules');

//Remove accents in uploaded files
add_filter( 'sanitize_file_name', 'remove_accents' );

//Remove extra stuff from header
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since 1.0
 * @return void
 */
if (!function_exists('toutatis_setup')){
	function toutatis_setup(){

		// Load translation
		load_theme_textdomain('toutatis', get_template_directory().'/languages');

		// Register menus
		register_nav_menus( array(
			'primary'   => __('Main menu', 'toutatis'),
			'footer' => __('Footer menu', 'toutatis'),
		) );

		// Register sidebars
		register_sidebar(array(
			'name'          => __('Sidebar', 'toutatis'),
			'id'            => 'blog',
			'description'   => __('Add widgets in the sidebar.', 'toutatis'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		));

		register_sidebar(array(
			'name'          => __('Footer', 'toutatis'),
			'id'            => 'footer',
			'description'   => __('Add widgets in the footer.', 'toutatis'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		));

		// Enable thumbnails
		add_theme_support('post-thumbnails');

		// Enable custom title tag for 4.1
		add_theme_support( 'title-tag' );
		
		// Enable Feed Links
		add_theme_support( 'automatic-feed-links' );

		// Set images sizes
		set_post_thumbnail_size('toutatis-post-thumbnail', 720, 445, true);
		add_image_size('toutatis-post-thumbnail-full', 1140, 605, true);

		// Add Meta boxes for post formats
		require 'admin/metaboxes/post-formats.php';

	}
}
add_action('after_setup_theme', 'toutatis_setup');

/**
 * Add custom image sizes in the WordPress Media Library
 *
 * @since 1.0
 * @param array $sizes The current image sizes list
 * @return array
 */
if (!function_exists('toutatis_image_size_names_choose')){
	function toutatis_image_size_names_choose($sizes) {
		$added = array('toutatis-post-thumbnail'=>__('Post width', 'toutatis'));
		$added = array('toutatis-post-thumbnail-full'=>__('Fullpage width', 'toutatis'));
		$newsizes = array_merge($sizes, $added);
		return $newsizes;
	}
}
add_filter('image_size_names_choose', 'toutatis_image_size_names_choose');

/**
 * Register supported post formats
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('toutatis_custom_format')){
	function toutatis_custom_format() {
		if ( 'post' == $GLOBALS['typenow'] ) {
                add_theme_support( 'post-formats', array( 'video', 'link', 'quote' ) );
        }
	}
}
add_action( 'load-post.php', 'toutatis_custom_format' );
add_action( 'load-post-new.php', 'toutatis_custom_format' );

/**
 * Enqueue styles & scripts
 *
 * @since 1.0
 * @return void
 */
if (!function_exists('toutatis_enqueue')){
	function toutatis_enqueue(){

		wp_register_script('fitvids', get_template_directory_uri().'/js/min/jquery.fitvids.min.js', array('jquery'), false, true);

		wp_register_script('toutatis', get_template_directory_uri().'/js/min/toutatis.min.js', array('jquery'), false, true);

		wp_enqueue_style( 'toutatis-fonts', '//fonts.googleapis.com/css?family=Quicksand:400,700&subset=latin,latin-ext');

		//main stylesheet
		wp_enqueue_style('stylesheet', get_stylesheet_directory_uri().'/style.css', array(), false);

		//icons
		wp_enqueue_style('icons', get_template_directory_uri().'/fonts/typicons.min.css', array(), false);

		wp_enqueue_script('fitvids');

		wp_enqueue_script('toutatis');
		
		if ( is_singular() ){
			wp_enqueue_script( "comment-reply" );
		}
	}
}
add_action('wp_enqueue_scripts', 'toutatis_enqueue');

/**
 * Register the theme options page in the administration
 *
 * @since 1.0
 * @return void
 */
if (!function_exists('toutatis_admin_menu')){
	function toutatis_admin_menu(){
		add_theme_page(__('Toutatis Settings', 'toutatis'),__('Toutatis Settings', 'toutatis'), 'edit_theme_options', 'toutatis_options', 'toutatis_options');
	}
}
add_action('admin_menu', 'toutatis_admin_menu');

/**
 * Loads the theme options page
 *
 * @since 1.0
 * @return void
 */
if (!function_exists('toutatis_options')){
	function toutatis_options(){
       	include 'admin/index.php';
    }
}

/**
 * Custom CSS loading
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('toutatis_custom_styles')){
	function toutatis_custom_styles(){
		if (get_option("toutatis_custom_css")){
			echo '<style type="text/css">';
			echo strip_tags(stripslashes(get_option("toutatis_custom_css")));
			echo '</style>';
		}
	}
}
add_action('wp_head', 'toutatis_custom_styles', 99);

/**
 * Applying the theme main color
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('toutatis_user_styles')){
	function toutatis_user_styles(){

		// Get the main color defined by the user
		if (get_option('toutatis_color')){

			$color = apply_filters('toutatis_color', get_option('toutatis_color'));

			// Load color functions
			require_once 'admin/functions/color-functions.php';

			$hsl = toutatis_RGBToHSL(toutatis_HTMLToRGB($color));
			if ($hsl->lightness > 180){
				$contrast = apply_filters('toutatis_color_contrast', '#333');
			}
			else{
				$contrast = apply_filters('toutatis_color_contrast', '#fff');
			}

			$hsl->lightness -= 30;
			$complement = apply_filters('toutatis_color_complement', toutatis_HSLToHTML($hsl->hue, $hsl->saturation, $hsl->lightness));
		}
		else{
			// If not, use the default colors
			$color = '#ff625b';
			$complement = '#D14949';
			$contrast = '#fff';
		}
		?>
			<style type="text/css">

			.site-header .main-menu li:hover > a,
			.site-header .main-menu li.current-menu-item a,
			.site-header a.logo-text:hover,
			#site-breadcrumbs a,
			.entry-meta a,
			.entry-content a,
			.entry-navigation a,
			.footer a,
			.footer-wrapper .footer-bar a:hover,
			.widget_toutatissocial ul li a,
			.post-header-title a:hover,
			.post-header-meta a,
			.entry-content a,
			.entry-footer-meta a,
			#respond a,
			.comment-author a,
			.comment-reply-link,
			.comment-navigation a,
			.widget a,
			.comment-form .logged-in-as a,
			.post-header-title:before,
			.widget > h3:before{
				color: <?php echo $color; ?>;
			}

			.content a:hover,
			.footer a:hover,
			.post-header-meta a:hover,
			.entry-content a:hover,
			.post-footer-meta a:hover,
			.entry-navigation a:hover,
			.comment-author a:hover,
			.comment-reply-link:hover,
			.comment-navigation a:hover,
			.widget a:hover,
			.widget_toutatissocial ul li a:hover,
			.comment-form .logged-in-as a:hover{
				color: <?php echo $complement; ?>;
			}

			.entry-thumbnail a.entry-permalink:hover,
			.entry-thumbnail a.entry-permalink:hover:before,
			.entry-quote,
			.entry-quote-author,
			.entry-quote a:hover,
			.entry-link,
			.entry-link a:hover,
			.pagination a:hover,
			.footer-bar .widget_toutatissocial ul li a{
				color:<?php echo $contrast; ?>;
			}

			.button,
			.comment-form input[type="submit"],
			html a.button,
			input[type='submit'],
			input[type='button'],
			.widget_tag_cloud a:hover,
			.widget_calendar #next a,
			.widget_calendar #prev a,
			.widget_toutatiscalltoaction a.button,
			.search-form .submit-btn,
			.entry-quote:hover,
			.entry-link:hover,
			.entry-thumbnail:hover,
			.entry-pagination,
			.pagination span,
			.pagination a.current,
			.pagination a:hover,
			.back-to-top{
				background: <?php echo $color; ?>;
				color: <?php echo $contrast; ?>;
			}
			.button:hover,
			.comment-form input[type="submit"]:hover,
			html a.button:hover,
			input[type='submit']:hover,
			input[type='button']:hover,
			.widget_calendar #next a:hover,
			.widget_calendar #prev a:hover,
			.widget_toutatiscalltoaction a.button:hover,
			.search-form .submit-btn:hover,
			.entry-pagination:hover,
			.back-to-top:hover{
				background: <?php echo $complement; ?>;
				color: <?php echo $contrast; ?>;
			}

			.widget_tag_cloud a:hover,
			input[type='text']:focus,
			input[type='email']:focus,
			input[type='url']:focus,
			input[type='tel']:focus,
			input[type='number']:focus,
			input[type='date']:focus,
			textarea:focus,
			select:focus{
				border-color:<?php echo $color; ?> !important;
				box-shadow: 0 0 5px <?php echo $color; ?> !important;
			}

			.site-header .main-menu > ul > li.current-menu-item a,
			.site-header .main-menu > ul > li:hover > a{
				box-shadow: -10px -13px 0px -10px <?php echo $color; ?> inset;
			}

			</style>
		<?php }
}
add_action('wp_head','toutatis_user_styles', 98);


/**
 * License activation stuff (from Easy Digital Downloads Software Licensing Addon)
 * This function will activate the theme licence on Themes de France
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('toutatis_edd')){
	function toutatis_edd(){
		$license = trim(get_option(TOUTATIS_LICENSE_KEY));
		$status = get_option('toutatis_license_status');

		// No license is activated yet
		if (!$status){

			// Activate the license
			$api_params = array(
				'edd_action'=>'activate_license',
				'license'=>$license,
				'item_name'=>urlencode(TOUTATIS_THEME_NAME)
			);

			$response = wp_remote_get(add_query_arg($api_params, TOUTATIS_STORE_URL), array('timeout'=>15, 'sslverify'=>false));

			if (!is_wp_error($response)){
				$license_data = json_decode(wp_remote_retrieve_body($response));
				if ($license_data->license === 'valid') update_option('toutatis_license_status', true);
			}
		}

		$edd_updater = new EDD_SL_Theme_Updater(array(
				'remote_api_url'=> TOUTATIS_STORE_URL,
				'version' 	=> TOUTATIS_THEME_VERSION,
				'license' 	=> $license,
				'item_name' => TOUTATIS_THEME_NAME,
				'author'	=> __('Themes de France','toutatis')
			)
		);
	}
}
add_action('admin_init', 'toutatis_edd');

/**
 * Display an admin notice if the licence isn't activated
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('toutatis_admin_notice')){
	function toutatis_admin_notice(){
		global $current_user;
        $user_id = $current_user->ID;

		if(current_user_can('edit_theme_options')){

			if(!get_option('toutatis_license_status')){

				if ( ! get_user_meta($user_id, 'ignore_purchasetoutatis_notice') ) {
					echo '<div class="error"><p>';

						printf(__("To get Toutatis support and automatic updates, <a href='%s' target='__blank'>purchase a licence key on Themes de France</a> | <a href='%s'>I'm not interested</a>", 'toutatis'), 'https://www.themesdefrance.fr/themes/toutatis/#acheter?utm_source=theme&utm_medium=noticelink&utm_campaign=toutatis', '?ignore_notice=purchasetoutatis');

					echo '</p></div>';
				}
			}
		}
	}
}
add_action('admin_notices', 'toutatis_admin_notice');