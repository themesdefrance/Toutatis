<?php
$form = new Cocorico(INTRO_COCORICO_PREFIX);

$form->startWrapper('titre');
$form->component('raw', __('Intro Settings', 'intro'));
$form->endWrapper('titre');

$form->groupHeader(array('general'=>__('General', 'intro'),
						 'appearance'=>__('Appearance', 'intro')));

//Tab general
$form->startWrapper('tab', 'general');

$form->startForm();

/*$form->setting(array('type'=>'text',
					 'name'=>substr(EDD_SL_LICENSE_KEY, strlen(GALOPIN_COCORICO_PREFIX)),
					 'label'=>__("License", 'intro'),
					 'description'=>__("Enter your licence key in order to receive Galopin updates. You'll find it in the confirmation email we sent you after your purchase.", 'intro')));*/
					 
$form->setting(array('type'=>'textarea',
					 'name'=>'footer_left',
					 'label'=>__("Footer", 'intro'),
					 'description'=>__('Left footer content. The following HTML tags are allowed : &lt;a href=&quot;LINK&quot;&gt;TEXT_LINK&lt;/a&gt;, &lt;strong&gt;BOLD_TEXT&lt;/strong&gt;, &lt;em&gt;ITALIC_TEXT&lt;/em&gt;, &lt;img src=&quot;IMAGE_URL&quot;&gt;.', 'intro'),
					 'options'=>array(
					 	'default'=>sprintf(__('<strong>%s</strong> - Galopin by <a href="https://www.themesdefrance.fr/" target="_blank">Themes de France</a>', 'intro'),date('Y'))
					 	)));


$form->endForm();
$form->endWrapper('tab');

$form->startWrapper('tab', 'appearance');

$form->startForm();

$form->setting(array('type'=>'color',
					 'name'=>'color',
					 'options'=>array(
					 	'default'=>'#E54C3C'
					 ),
					 'label'=>__("Main color", 'intro'),
					 'description'=>__('This color will be used across your website for buttons, links, etc.', 'intro')));

$form->setting(array('type'=>'boolean',
					 'name'=>'show_sidebar',
					 'options'=>array(
					 	'default'=>true
					 ),
					 'label'=>__("Sidebar", 'intro'),
					 'description'=>__('Display a sidebar on the content\'s right across your website in all no-masonry pages.', 'intro')));
					 
$form->setting(array('type'=>'textarea',
					 'name'=>'custom_css',
					 'label'=>__('Additionnal CSS', 'intro'),
					 'description'=>__('CSS rules added in this field will be added to your site. If you have too many updates, you should download and install the child theme from <a href="https://www.themesdefrance.fr/" target="_blank">your Themes de France account</a>.', 'intro')));

$form->endForm();

$form->endWrapper('tab');

$form->component('submit', 'submit', array('value'=>__('Save changes', 'intro')));

$form->render();

?>

<div style="margin-top:20px;">

	<?php _e('Any questions on Intro ? Go to the','intro'); ?> <a href="https://www.themesdefrance.fr/support/?utm_source=theme&utm_medium=supportlink&utm_campaign=intro" target="_blank"><?php _e('Themes de France support page.','intro'); ?></a> - <?php _e('If you like Intro, you should','intro'); ?>, <a href="https://www.facebook.com/ThemesDeFrance" target="_blank"><?php _e('follow us on Facebook','intro'); ?></a>.

</div>