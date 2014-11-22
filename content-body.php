<?php
	
	if (is_single()):
	
		the_content();

	elseif(is_category() || is_tax() || is_search()):
	
		echo intro_excerpt(25);
		
		?>
		
		<p class="readmore">
			
			<a href="<?php the_permalink(); ?>" class="button" title="<?php the_title(); ?>"><?php _e('Read more','intro'); ?></a>
			
		</p>
		
	<?php
	 
	elseif(is_tag()):
		// No excerpt for tags archives
		echo intro_excerpt(0);
		
	else:
	
		echo intro_excerpt(40);
		
		?>
		
		<p class="readmore">
			<a href="<?php the_permalink(); ?>" class="button" title="<?php the_title(); ?>"><?php _e('Read more','intro'); ?></a>
		</p>
	
<?php endif; ?>