(function($){
$(function(){

	 $(document).ready(function(){

		//menu toggle on mobile view
		$('.menu-toggle').click(function(){
			$('.content-wrapper').toggleClass('menu-open');
		});

		$('.post-video, .widget-video').fitVids();

		//back to top button
		var $toTop = $('#back-to-top');
		if ($(window).scrollTop() <= $(window).height()) $toTop.hide();

		$toTop.on('click', function(){
			$('html,body').animate({
				scrollTop: 0
			}, 400);
		});

		$(document).on('scroll', function(event){
			if ($(window).scrollTop() > $(window).height()) $toTop.fadeIn();
			else $toTop.fadeOut();
		});

		$(document).ready(function(){
		    $('.entry-video, .widget-video').fitVids();
		  });

		//things dependant on window size
		/*var resizeTimeout;

		function windowSizeChanged(){
			//usingflyout menu or not?
			var previousState = useJsMenu;
			useJsMenu = ($('.menu-wrapper .sub-menu').css('position') === 'absolute');

			if (previousState != useJsMenu){
				(useJsMenu) ? $('.menu-wrapper .sub-menu').hide() : $('.menu-wrapper .sub-menu').show();
			}

		}

		$(window).resize(function(){
			if (resizeTimeout) clearTimeout(resizeTimeout);
			resizeTimeout = setTimeout(windowSizeChanged, 100);
		});*/

	});
});
})(jQuery);