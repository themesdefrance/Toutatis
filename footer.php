			
			
			<div class="footer-wrapper">
					
				<div class="wrapper">
				
					<div class="footerbar">
		
						<div class="grid">
						
							<?php dynamic_sidebar('footer'); ?>
							
						</div> <!-- END .grid -->
			
					</div><!-- END .footerbar -->
					
				</div><!-- END .wrapper -->
				
				<footer class="footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
					
					<div class="wrapper">
					
						<div class="grid">
							
							<div class="footnote col-1-2">
								
								<?php
									if(get_option("intro_footer_left")):
									
										echo strip_tags(get_option("intro_footer_left"), '<strong><a><em><img>');
										
									else:
										printf(__('<strong>%s</strong> - Galopin by <a href="https://www.themesdefrance.fr/" target="_blank">Themes de France</a>', 'intro'),date('Y'));
									endif;
								 ?>
							</div><!-- END .footnote .col-1-2 -->
							
							<div class="menu col-1-2">
								<?php
									wp_nav_menu(array(
										'theme_location' => 'footer',
										'menu_class'     => 'top-level-menu',
										'container'      => false,
										'depth'          => 1,
										'fallback_cb'    => ''
									));
								?>
							</div><!-- END .menu .col-1-2 -->
							
						</div><!-- END .grid -->
					
					</div><!-- END .wrapper -->
					
				</footer>
				
				<button id="back-to-top" title="<?php _e('Back to the top', 'intro'); ?>" class="back-to-top typcn typcn-arrow-up-thick"></button>
			
			</div> <!-- END .footer-wrapper -->
			
		</div> 
		
	</div>
	
	<?php wp_footer(); ?>
	
</body>
</html>