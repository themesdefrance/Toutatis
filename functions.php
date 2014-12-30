<?php

define('INTRO_STORE_URL', 'https://www.themesdefrance.fr');
define('INTRO_THEME_NAME', 'Intro');
define('INTRO_THEME_VERSION', '0.0.1');
define('INTRO_LICENSE_KEY', 'intro_license_edd');

if(!class_exists('EDD_SL_Theme_Updater'))
	include(dirname( __FILE__ ).'/admin/EDD_SL_Theme_Updater.php');

define('INTRO_COCORICO_PREFIX', 'intro_');
if(is_admin())
	require_once 'admin/Cocorico/Cocorico.php';

// Widgets
require_once 'admin/widgets/social.php';
require_once 'admin/widgets/calltoaction.php';
require_once 'admin/widgets/video.php';

// Themes functions
require_once 'admin/functions/intro-functions.php';

//////////////////
// Bootstraping //
//////////////////
if (!function_exists('intro_activation')){
	function intro_activation(){
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}
}
add_action('after_switch_theme', 'intro_activation');

//Register menus, sidebars and image sizes
if (!function_exists('intro_setup')){
	function intro_setup(){

		// Load language
		load_theme_textdomain('intro', get_template_directory().'/languages');

		// Register menus
		register_nav_menus( array(
			'primary'   => __('Main menu', 'intro'),
			'footer' => __('Footer menu', 'intro'),
		) );

		//Register sidebars
		register_sidebar(array(
			'name'          => __('Sidebar', 'intro'),
			'id'            => 'blog',
			'description'   => __('Add widgets in the sidebar.', 'intro'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		));

		register_sidebar(array(
			'name'          => __('Footer', 'intro'),
			'id'            => 'footer',
			'description'   => __('Add widgets in the footer.', 'intro'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		));

		// Enable thumbnails
		add_theme_support('post-thumbnails');

		// Enable custom title tag for 4.1
		add_theme_support( 'title-tag' );

		// Set images sizes
		add_image_size('intro-post-thumbnail', 720, 445, true);
		add_image_size('intro-post-thumbnail-full', 1140, 605, true);

		// Add Meta boxes for post formats
		require_once 'admin/metaboxes/post-formats.php';

	}
}
add_action('after_setup_theme', 'intro_setup');

//add custom image size to native dailogs
if (!function_exists('intro_image_size_names_choose')){
	function intro_image_size_names_choose($sizes) {
		$added = array('intro-post-thumbnail'=>__('Post width', 'intro'));
		$added = array('intro-post-thumbnail-full'=>__('Fullpage width', 'intro'));
		$newsizes = array_merge($sizes, $added);
		return $newsizes;
	}
}
add_filter('image_size_names_choose', 'intro_image_size_names_choose');

//register supported post formats
if(!function_exists('intro_custom_format')){
	function intro_custom_format() {
		$cpts = array('post' => array('video', 'link', 'quote'));
		$current_post_type = $GLOBALS['typenow'];
		if ($current_post_type == 'post') add_theme_support('post-formats', $cpts[$GLOBALS['typenow']]);
	}
}
add_action( 'load-post.php', 'intro_custom_format' );
add_action( 'load-post-new.php', 'intro_custom_format' );

//enqueue styles & scripts
if (!function_exists('intro_enqueue')){
	function intro_enqueue(){

		$theme = wp_get_theme();

		wp_register_script('fitvids', get_template_directory_uri().'/js/min/jquery.fitvids.min.js', array('jquery'), false, true);

		wp_register_script('intro', get_template_directory_uri().'/js/min/intro.min.js', array('jquery'), false, true);

		wp_enqueue_style( 'intro-fonts', '//fonts.googleapis.com/css?family=Quicksand:400,700&subset=latin,latin-ext');

		//main stylesheet
		wp_enqueue_style('stylesheet', get_stylesheet_directory_uri().'/style.css', array(), false);

		//icons
		wp_enqueue_style('icons', get_template_directory_uri().'/fonts/typicons.min.css', array(), false);

		wp_enqueue_script('fitvids');

		wp_enqueue_script('intro');
	}
}
add_action('wp_enqueue_scripts', 'intro_enqueue');

/////////////////////////
////  Admin stuff   /////
/////////////////////////

// Add admin menu
if (!function_exists('intro_admin_menu')){
	function intro_admin_menu(){
		add_theme_page(__('Intro Settings', 'intro'),__('Intro Settings', 'intro'), 'edit_theme_options', 'intro_options', 'intro_options');
	}
}
add_action('admin_menu', 'intro_admin_menu');

if (!function_exists('intro_options')){
	function intro_options(){
		if (!current_user_can('edit_theme_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}

       	include 'admin/index.php';
    }
}

// Custom CSS loading
if(!function_exists('intro_custom_styles')){
	function intro_custom_styles(){
		if (get_option("intro_custom_css")){
			echo '<style type="text/css">';
			echo strip_tags(stripslashes(get_option("intro_custom_css")));
			echo '</style>';
		}
	}
}
add_action('wp_head', 'intro_custom_styles', 99);

// Main intro color
if(!function_exists('intro_user_styles')){
	function intro_user_styles(){
		if (get_option('intro_color')){

			$color = apply_filters('intro_color', get_option('intro_color'));

			require_once 'admin/functions/color-functions.php';
			$hsl = intro_RGBToHSL(intro_HTMLToRGB($color));
			if ($hsl->lightness > 180){
				$contrast = apply_filters('intro_color_contrast', '#333');
			}
			else{
				$contrast = apply_filters('intro_color_contrast', '#fff');
			}

			$hsl->lightness -= 30;
			$complement = apply_filters('intro_color_complement', intro_HSLToHTML($hsl->hue, $hsl->saturation, $hsl->lightness));
		}
		else{ // Default color
			$color = '#ff625b';
			$complement = '#D14949';
			$contrast = '#fff';
		}
		?>
			<style type="text/css">
			.button,
			.comment-form input[type="submit"],
			html a.button,
			input[type='submit'],
			input[type='button'],
			.widget_calendar #next a,
			.widget_calendar #prev a,
			.search-form .submit-btn,
			.entry-content th,
			.entry-thumbnail:hover,
			.entry-pagination,
			.pagination,
			.site-header .sub-menu a:hover,
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
			.search-form .submit-btn:hover,
			.entry-content th:hover,
			.entry-pagination:hover,
			.back-to-top:hover{
				background: <?php echo $complement; ?>;
				color: <?php echo $contrast; ?>;
			}

			.site-header .sub-menu a,
			.entry-header-meta a,
			.entry-content a,
			.footer a,
			.post-header-title a:hover,
			.post-header-meta a,
			.entry-content ul > li:before,
			.entry-content ol > li:before,
			.entry-content a,
			.post-footer-meta a,
			.comment-author a,
			.comment-reply-link,
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
			.comment-author a:hover,
			.comment-reply-link:hover,
			.widget a:hover,
			.comment-form .logged-in-as a:hover{
				color: <?php echo $complement; ?>;
			}

			.entry-thumbnail a.entry-permalink:hover,
			.entry-thumbnail a.entry-permalink:hover:before{
				color:<?php echo $contrast; ?>
			}


			</style>
		<?php }
}
add_action('wp_head','intro_user_styles', 98);


////////////////////////////////////
// License activation
////////////////////////////////////

if(!function_exists('intro_edd')){
	function intro_edd(){
		$license = trim(get_option(INTRO_LICENSE_KEY));
		$status = get_option('intro_license_status');

		if (!$status){
			//valider la license
			$api_params = array(
				'edd_action'=>'activate_license',
				'license'=>$license,
				'item_name'=>urlencode(INTRO_THEME_NAME)
			);

			$response = wp_remote_get(add_query_arg($api_params, INTRO_STORE_URL), array('timeout'=>15, 'sslverify'=>false));

			if (!is_wp_error($response)){
				$license_data = json_decode(wp_remote_retrieve_body($response));
				if ($license_data->license === 'valid') update_option('intro_license_status', true);
			}
		}

		$edd_updater = new EDD_SL_Theme_Updater(array(
				'remote_api_url'=> INTRO_STORE_URL,
				'version' 	=> INTRO_THEME_VERSION,
				'license' 	=> $license,
				'item_name' => INTRO_THEME_NAME,
				'author'	=> __('Themes de France','intro')
			)
		);
	}
}
add_action('admin_init', 'intro_edd');

////////////////////////////////////
// Etendard notifications
////////////////////////////////////

if(!function_exists('intro_admin_notice')){
	function intro_admin_notice(){
		global $current_user;
        $user_id = $current_user->ID;

		if(!get_option('intro_license_status')){
			echo '<div class="error"><p>';
			_e("In order to get updates, please enter your licence that you received by email.", 'intro');
			echo '</p></div>';
		}
	}
}
add_action('admin_notices', 'intro_admin_notice');