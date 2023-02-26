



function numberedSliderMenu(){
	$('.numbered-slider-menu').slick({
	     slidesToShow: 3,
	     slidesToScroll: 3,
	     autoplay: false,
	     autoplaySpeed: 2000,
	     mobileFirst: true,
			 infinite: false,
	     responsive: [
	      {
	          breakpoint: 998,
	          settings: "unslick"
	      }
	  ]
	});
};

function numberedSlider(){
$('.numbered-slider').slick({
	dots: false,
	arrows: false,
	infinite: false,
	speed: 300,
	slidesToShow: 3,
	slidesToScroll: 3,
	autoplay: true,
	autoplaySpeed: 2000,
	asNavFor: '.numbered-slider-menu',
	responsive: [
		{
			breakpoint: 998,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			}
		}
	]
});
};



function displayWindowSize(){

	$('.responsive .slick-active').addClass('sep').removeClass('sep-no');
	$('.responsive .slick-active:last').addClass('sep-no');

	numberedSliderMenu();
	numberedSlider();
}





jQuery(document).ready(function($){




	$("#mmenu_toggle").click(function(){
	  $("#mmenu_nav").toggleClass("active");
		$("#mmenu_nav .nav-wrapper").toggleClass("active");
	});

	$("#mmenu_close").click(function(){
	  $("#mmenu_nav").toggleClass("active");
		$("#mmenu_nav .nav-wrapper").toggleClass("active");
	});

	// Calling the function for the first time
	displayWindowSize();

	// Attaching the event listener function to window's resize event
	window.addEventListener("resize", displayWindowSize);

	$('.responsive').slick({
		dots: false,
		arrows: false,
		infinite: true,
		speed: 300,
		slidesToShow: 3,
		slidesToScroll: 3,
		autoplay: true,
  	autoplaySpeed: 2000,
		responsive: [
			{
				breakpoint: 900,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		]
	});

	$('.nplate-slider').slick({
		dots: true,
		arrows: false,
		infinite: true,
		speed: 700,
		slidesToShow: 4,
		slidesToScroll: 4,
		autoplay: true,
		autoplaySpeed: 5000,
		responsive: [
			{
				breakpoint: 900,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		]
	});






		var slider = $.fn.fsvs({
				autoPlay            : false,
				speed               : 1000,
				bodyID              : 'fsvs-body',
				selector            : '> .msslide',
				mouseSwipeDisance   : 40,
				afterSlide          : function(){},
				beforeSlide         : function(){},
				endSlide 						: function(){},
				mouseWheelEvents    : true,
				mouseWheelDelay     : false,
				mouseDragEvents     : false,
				touchEvents         : true,
				arrowKeyEvents      : true,
				pagination          : true,
				nthClasses          : 2,
				detectHash          : false
		});

		$('.responsive .slick-active').addClass('sep').removeClass('sep-no');
		$('.responsive .slick-active:last').addClass('sep-no');


		$('#tabs li a:not(:first)').addClass('inactive');
	  $('.tab-container').hide();
	  $('.tab-container:first').show();

	  $('#tabs li a').click(function(){
	      var t = $(this).attr('id');
	      console.log(t);
	      if($(this).hasClass('inactive')){ //this is the start of our condition

	          $('#tabs li a').addClass('inactive');
	          $(this).removeClass('inactive');

	          $('.tab-container').hide();
	          $('#'+ t + 'C').fadeIn('slow');

	      }
	  });

		$('.toggle').click(function(e) {
  	e.preventDefault();

    var $this = $(this);

    $('.toggle').removeClass('active');

    if ($this.next().hasClass('show')) {

        $this.next().removeClass('show');
        $this.next().slideUp(350);
    } else {
        $this.addClass('active');
        $this.parent().parent().find('li .inner').removeClass('show');
        $this.parent().parent().find('li .inner').slideUp(350);
        $this.next().toggleClass('show');
        $this.next().slideToggle(350);
    }
		});


});
