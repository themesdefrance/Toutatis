<?php get_header(); ?>

<div class="content">

	<div class="wrapper">
		
		<div class="col-1-1" role="main" itemprop="mainContentOfPage">
		
			<ul class="posts">
				
				<li>
	
					<article <?php post_class('post'); ?> itemscope itemtype="http://schema.org/Article">
					
						<header class="entry-header">
							
							<h1 class="entry-title" itemprop="headline">
									
								<?php _e('Oops, there is nothing here...', 'intro'); ?>
										
							</h1>
							
							
						</header>
						
						<div class="entry-content" itemprop="articleBody">
							
							<p>
								<?php printf(__("The page you requested does not seem to exist. You can go back to <a href=\"%s\">the home page</a> or browse the archives :", 'intro'), home_url()); ?>
							</p>
							
							
							<ul class="intro-archives">
								<?php echo intro_archives(); ?>
							</ul>
							
						</div>
						
					</article>
					
				</li>
				
			</ul> <!-- END .posts -->
			
		</div> <!-- END .col-1-1 -->
		
	</div> <!-- END .wrapper -->

</div> <!-- END .content -->

<?php get_footer(); ?>