<?php
class IntroCalltoAction extends WP_Widget{
	
	private $error = false;
	
	public function __construct(){
		parent::__construct(
		
			'IntroCalltoAction',
			__('Intro - Call to action', 'intro'),
			array('description'=>__('Add a call to action in the sidebar.', 'intro'))
		);
	}
	
	public function widget($args, $instance){
	
		echo $args['before_widget'];
		?>
		
			<?php if (isset($instance['title']) && !empty($instance['title'])){
					echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
			} ?>
			
			<div class="cta-description">
				<?php if (isset($instance['description']) && $instance['description']!=""){ echo wpautop($instance['description']);} ?>
			</div>
			
			<a href="<?php if (isset($instance['link']) && $instance['link']!=""){ echo $instance['link'];}else{echo bloginfo('url');} ?>" class="button">
			<?php if (isset($instance['label']) && $instance['label']!=""){
					echo $instance['label'];
				}else{
					_e( 'Click here', 'intro');
				} ?>
			</a>
		<?php
		echo $args['after_widget'];
	}
	
	public function form($instance){
		
		$fields = array("title" => "", "link" => "", "description" => "", "label" => "");
		
		if ( isset( $instance[ 'title' ] ) ) {
			$fields['title'] = $instance[ 'title' ];
		}
	
		if ( isset( $instance[ 'link' ] ) ) {
			$fields['link'] = $instance[ 'link' ];
		}
		
		if ( isset( $instance[ 'description' ] ) ) {
			$fields['description'] = $instance[ 'description' ];
		}		
		if ( isset( $instance[ 'label' ] ) ) {
			$fields['label'] = $instance[ 'label' ];
		}
		
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'intro' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="url" value="<?php echo esc_attr( $fields['title'] ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Call to action incentive:', 'intro' ); ?></label> 
			<textarea  class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $fields['description'] ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Call to action destination (url):', 'intro' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="url" value="<?php echo esc_attr( $fields['link'] ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'label' ); ?>"><?php _e( 'Button\'s label:' , 'intro' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'label' ); ?>" name="<?php echo $this->get_field_name( 'label' ); ?>" type="text" value="<?php echo esc_attr( $fields['label'] ); ?>">
		</p>
		<?php
		
	}
	
	public function update($new_instance, $old_instance){
		
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'],'<p><strong><em><img>' ) : '';
		$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
		$instance['label'] = ( ! empty( $new_instance['label'] ) ) ? strip_tags( $new_instance['label'] ) : '';
		return $instance;
		
	}
}

if (!function_exists('intro_calltoaction_widget_init')){

	function intro_calltoaction_widget_init(){
	
		register_widget('IntroCalltoAction');
	}
}
add_action('widgets_init', 'intro_calltoaction_widget_init');
