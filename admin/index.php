<?php
/**
 * The template for displaying theme options using the Cocorico Framework
 *
 * @package Toutatis
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @link 		https://github.com/y-lohse/Cocorico
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; ?>

<h2 style="font-size: 23px;font-weight: 400;padding: 9px 15px 4px 0px;line-height: 29px;">
	<?php _e('Toutatis Settings', 'toutatis'); ?>
</h2>

<?php

// Create a new set of options
$form = new Cocorico(TOUTATIS_COCORICO_PREFIX);

// Registering tabs
$form->groupHeader(array('general'=>__('General', 'toutatis'),
						 'addons'=>__('Addons', 'toutatis')));

// General tab
$form->startWrapper('tab', 'general');

	$form->startForm();

		// Toutatis free
		$form->startWrapper('tr');

			$form->startWrapper('th');

				$form->component('raw', __('Toutatis Premium', 'toutatis'));

			$form->endWrapper('th');

			$form->startWrapper('td');

				$form->component('raw', __('Purchase a licence key in order to receive Toutatis updates and get access to support.', 'toutatis') . '<br><br>');

				$form->component('link',
									 'https://www.themesdefrance.fr/themes/toutatis/#acheter?utm_source=theme&utm_medium=licenselink&utm_campaign=toutatis',
									 __('Get Toutatis updates & support', 'toutatis'),
									 array(
										 'class'=>array('button', 'button-primary'),
										 'target'=>'_blank'
									 ));

			$form->endWrapper('td');

		$form->endWrapper('tr');

		// Toutatis premium
		/*$form->setting(array('type'=>'text',
					 'name'=>substr(TOUTATIS_LICENSE_KEY, strlen(TOUTATIS_COCORICO_PREFIX)),
					 'label'=>__("License", 'toutatis'),
					 'description'=>__("Enter your licence key in order to receive Toutatis updates. You'll find it in the confirmation email we sent you after your purchase.",'toutatis')));
					 */

		$form->setting(array('type'=>'color',
					 'name'=>'color',
					 'options'=>array(
					 	'default'=>'#ff625b'
					 ),
					 'label'=>__("Main color", 'toutatis'),
					 'description'=>__('This color will be used across your website for buttons, links, etc.', 'toutatis')));

		$form->setting(array('type'=>'upload',
					 'name'=>'logo',
					 'label'=>__('Logo', 'toutatis'),
					 'description'=>__("Upload a logo to display in the header (if you don't have a logo, the name of your website will be displayed instead).", 'toutatis')));

		$form->setting(array('type'=>'boolean',
					 'name'=>'show_sidebar',
					 'options'=>array(
					 	'default'=>true
					 ),
					 'label'=>__("Sidebar", 'toutatis'),
					 'description'=>__("Display a sidebar on the content's right across your website.", 'toutatis')));

		$form->setting(array('type'=>'textarea',
					 'name'=>'footer_left',
					 'label'=>__("Footer", 'toutatis'),
					 'description'=>__('Left footer content. The following HTML tags are allowed : &lt;a href=&quot;LINK&quot;&gt;TEXT_LINK&lt;/a&gt;, &lt;strong&gt;BOLD_TEXT&lt;/strong&gt;, &lt;em&gt;ITALIC_TEXT&lt;/em&gt;, &lt;img src=&quot;IMAGE_URL&quot;&gt;.', 'toutatis'),
					 'options'=>array(
					 	'default'=>sprintf(__('<strong>%s</strong> - Toutatis by <a href="https://www.themesdefrance.fr/" target="_blank">Themes de France</a>', 'toutatis'),date('Y'))
					 	)));

		$form->setting(array('type'=>'textarea',
					 'name'=>'custom_css',
					 'label'=>__('Additionnal CSS', 'toutatis'),
					 'description'=>__('CSS rules added in this field will be added to your site. If you have too many updates, you should download and install the Toutatis child theme from', 'toutatis') . ' <a href="https://www.themesdefrance.fr/" target="_blank">' . __('your Themes de France account', 'toutatis') . '</a>.'));

	$form->endForm();

$form->endWrapper('tab');

// Addons tab
$form->startWrapper('tab', 'addons');

	$form->startForm();

		$form->startWrapper('td');

			$form->component('raw', __('Do you know that Toutatis can be extended with addons ? Check the addons available below :', 'toutatis'));

		$form->endWrapper('td');

	$form->endForm();

	$form->startForm();

		// Action to hook from addons
		do_action('toutatis_addons_tab', $form);

	$form->endForm();

$form->endWrapper('tab');

$form->component('submit', 'submit', array('value'=>__('Save changes', 'toutatis')));

$form->render();

?>

<div style="margin-top:20px;">
	<?php $status = get_option('toutatis_license_status'); ?>

	<?php if($status):

			_e('Any questions on Toutatis ? Go to the','toutatis'); ?> <a href="https://www.themesdefrance.fr/support/?utm_source=theme&utm_medium=supportlink&utm_campaign=toutatis" target="_blank"><?php _e('Themes de France support page.','toutatis'); ?></a>

	<?php else:

			_e('In order to get support, you need to purchase','toutatis'); ?> <a href="https://www.themesdefrance.fr/themes/toutatis/#acheter?utm_source=theme&utm_medium=supportlink&utm_campaign=toutatis" target="_blank"><?php _e('the full version.','toutatis'); ?></a>

	<?php endif;

		 _e('If you like Toutatis, you should','toutatis'); ?>, <a href="https://www.facebook.com/ThemesDeFrance" target="_blank"><?php _e('follow us on Facebook','toutatis'); ?></a>.

</div>