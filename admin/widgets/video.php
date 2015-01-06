<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php
class IntroVideo extends WP_Widget{
	
	private $error = false;
	private $novideo = false;
	
	public function __construct(){
		parent::__construct(
		
			'IntroVideo',
			__('Intro - Video', 'intro'),
			array('description'=>__('Add a video from Youtube, Dailymotion or Vimeo.', 'intro'))
		);
	}
	
	public function widget($args, $instance){
	
		echo $args['before_widget'];
		?>
				<?php if (isset($instance['title']) && !empty($instance['title'])){
						echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
				} ?>
				
				<?php if (isset($instance['video_link']) && $instance['video_link']!=""){ ?>
				
					<div class="widget-video">
						<?php echo wp_oembed_get($instance['video_link'], array('width'=>287)); ?>
					</div>
					
				<?php }else{ ?>
					
					<p><?php _e('To display a video, please add a Youtube, Dailymotion or Vimeo URL in the widget settings.', 'intro'); ?></p>
				
				<?php } ?>
			
		<?php
		echo $args['after_widget'];
	}
	
	public function form($instance){
		
		if ($this->error){
			echo '<div class="error">';
			_e('Please enter a valid url', 'intro');
			echo '</div>';
		}
		
		if ($this->novideo){
			echo '<div class="error">';
			_e('This video url doesn\'t seem to exist.', 'intro');
			echo '</div>';
		}
		
		$fields = array("title" => "", "video_link" => "");
		
		if ( isset( $instance[ 'title' ] ) ) {
			$fields['title'] = $instance[ 'title' ];
		}
	
		if ( isset( $instance[ 'video_link' ] ) ) {
			$fields['video_link'] = $instance[ 'video_link' ];
		}
		
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'intro' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $fields['title'] ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'video_link' ); ?>"><?php _e( 'Video URL (Youtube, Dailymotion or Vimeo):', 'intro' ); ?></label> 
			<input  class="widefat" id="<?php echo $this->get_field_id( 'video_link' ); ?>" name="<?php echo $this->get_field_name( 'video_link' ); ?>" type="url" value="<?php echo esc_attr( $fields['video_link'] ); ?>">
		</p>
		<?php
		
	}
	
	public function update($new_instance, $old_instance){
		
		$new_instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		
		// Check the video link
		if(isset($new_instance['video_link']) && !empty($new_instance['video_link']) && !filter_var($new_instance['video_link'], FILTER_VALIDATE_URL)){
		
			$new_instance['video_link'] = $old_instance['video_link'];
			$this->error = true;
			
		}else{
		
			if(!wp_oembed_get($new_instance['video_link'])){
				$new_instance['video_link'] = $old_instance['video_link'];
				$this->novideo = true;
			}else{
				$new_instance['video_link'] = ( ! empty( $new_instance['video_link'] ) ) ? strip_tags( $new_instance['video_link'] ) : '';
			}
			
		}
		
		return $new_instance;
		
	}
}

if (!function_exists('intro_video_widget_init')){

	function intro_video_widget_init(){
	
		register_widget('IntroVideo');
	}
}
add_action('widgets_init', 'intro_video_widget_init');
