<?php

	if (is_single() || is_page()){
	
		the_content();
	}
	else if(is_category() || is_tax()){
	
		echo intro_excerpt(25);
		
		if (!intro_is_masonry()){ ?>
		
		<p class="readmore">
			<a href="<?php the_permalink(); ?>" class="button" title="<?php the_title(); ?>"><?php _e('Read more','intro'); ?></a>
		</p>
		
	<?php
		}
	 
	}else if(is_tag()|| is_search()){
	
		echo intro_excerpt(0); // == No excerpt
		
	} else if (intro_is_masonry()){
	
		echo intro_excerpt(20);
		
	}else{
	
		echo intro_excerpt(40);
		
		if (!intro_is_masonry()){ ?>
		
		<p class="readmore">
			<a href="<?php the_permalink(); ?>" class="button" title="<?php the_title(); ?>"><?php _e('Read more','intro'); ?></a>
		</p>
		
	<?php } ?>
	
<?php } ?>