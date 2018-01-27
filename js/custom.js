(function ($) {
 "use strict";
$(document).ready(function(){
	  
		/*
		Mean Menu Responsive
		============================*/		
        jQuery('nav#main-menu').meanmenu();				
		/*
		Why Choose Us Crousel
		============================*/ 	
		  $(".why-choose-all-inner").owlCarousel({
			autoplay: true, 
			pagination:false,
			nav:true, 
			dots:false, 
			margin:20,
			items :3,
			navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				768:{
					items:2
				},				
				992:{
					items:3
				}
			}
		  }); 	
		/*
		Project Feed Back Crousel
		============================*/ 	
		  $(".project-feedback").owlCarousel({
			autoplay: true, 
			pagination:false,
			nav:false, 
			dots:false, 
			items :1,
			navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
			responsive:{
			
				0:{
					items:1
				},				
				600:{
					items:1
				},
				768:{
					items:1
				},				
				992:{
					items:1
				},				
				1000:{
					items:1
				}
			}
		  }); 		   			
		/*
		Testimonial Crousel
		============================*/ 	
		  $(".all-testimonial").owlCarousel({
			autoplay: true, 
			pagination:false,
			nav:false, 
			dots:true, 
			items :1,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				768:{
					items:1
				},				
				1000:{
					items:1
				}
			}			
		  }); 			
	
		/*
		Slider Crousel
		============================*/ 
		$(".all-slide").owlCarousel({
            items: 1,
            nav: true,
            dots: true,
            autoplay: true,
			autoplayTimeout:5000,
			autoplaySpeed:2000,
			
            loop: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            mouseDrag: false,
            touchDrag: false,
        });
        
        $(".all-slide").on("translate.owl.carousel", function(){
            $(".slider-text *").removeClass("animated fadeInUp").css("opacity", "0");
            $(".slider-text *").removeClass("animated fadeInDown").css("opacity", "0");
        });
        
        $(".all-slide").on("translated.owl.carousel", function(){
            $(".slider-text *").addClass("animated fadeInUp").css("opacity", "1");
            $(".slider-text *").addClass("animated fadeInDown").css("opacity", "1");
        });	
		

		/*
		scrollUp
		============================*/	
		$.scrollUp({
			scrollText: '<i class="fa fa-long-arrow-up"></i>',
			easingType: 'linear',
			scrollSpeed: 900,
			animation: 'fade'
		});	
		/*
		Counter Js
		============================*/ 
        $('.counter').counterUp({
            delay: 10,
            time: 1000			
        });
		/*
		Stikey Js
		============================*/ 
		(function () {
			var nav = $('.hd-sec');
			var scrolled = false;
			$(window).scroll(function () {
				if (120 < $(window).scrollTop() && !scrolled) {
					nav.addClass('sticky_menu animated fadeInDown').animate({ 'margin-top': '0px' });
					scrolled = true;
				}
				if (120 > $(window).scrollTop() && scrolled) {
					nav.removeClass('sticky_menu animated fadeInDown').css('margin-top', '0px');
					scrolled = false;
				}
			});
		}());		
		
		/*
		Magnific Popup
		============================*/ 		
        $('.gallery-photo').magnificPopup({
            type: 'image',
            gallery: {
              enabled: true
            },
        });	 

		/*
		Project Gallery Js
		============================*/	
		$(".gallery-container").isotope({
		itemSelector: '.filtr-item',
		layoutMode: 'fitRows',
		});
		$("ul.simplefilter li").on("click",function(){
		$("ul.simplefilter li").removeClass("active");
		$(this).addClass("active");
		 
		var selector = $(this).attr('data-filter');
		$(".gallery-container").isotope({
		filter: selector,
		animationOptions: {
		duration: 750,
		easing: 'linear',
		queue: false,
		}
		});
		return false;
		});
		
		/*
		Preeloader
		============================*/
		$(window).on("load", function() {
			$('#preloader').fadeOut();
			$('#preloader-status').delay(200).fadeOut('slow');
			$('body').delay(200).css({'overflow-x':'hidden'});
		});

		

		
		
	});	
})(jQuery);

