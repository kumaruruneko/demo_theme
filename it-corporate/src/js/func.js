(function ($) {

	//matchHeight.jsの使用
	$(window).on('load', function () {
		$('.matchbox_js').matchHeight();
		$('.matchcontents_js').matchHeight();
	});
	var timer = false;
	var winWidth = $(window).width();
	var winWidth_resized;
	$(window).on("resize", function () {
		if (timer !== false) {
			clearTimeout(timer);
		}
		timer = setTimeout(function () {
			winWidth_resized = $(window).width();
			if (winWidth != winWidth_resized) {
				$('.matchbox_js').matchHeight();
				$('.matchcontents_js').matchHeight();
				winWidth = $(window).width();
			}
		}, 200);
	});


	// ページ内スクロール
	$('.scroll_js').click(function () {
		var speed = 400;
		var href = $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top;
		$('body,html').animate({ scrollTop: position }, speed, 'swing');
		return false;
	});


	// drawer
	$(".drawer").drawer();
	myScroll = new IScroll('.drawer-nav', {
		mouseWheel: false,
		preventDefault: false
	});
	$('.drawer-menu > li > a').on('click', function () {
		$(".drawer").drawer('close');
	});

	// jQuery('.menu-item-type-custom').addClass('c_btn');
	$('.ul_nav li').each(function () {
		var contact = $(this).children('a').attr('href');
		if (contact.match(/contact/)) {
			$(this).addClass('c_btn');
		}
	})

	var mySwiper = new Swiper('.swiper-container', {
		loop: true,
		slidesPerView: 1,
		spaceBetween: 0,
		centeredSlides: true,
		breakpoints: {
			767: {
				slidesPerView: 1,
				spaceBetween: 0
			}
		},
		navigation: false,
		pagination: {
			el: '.swiper-pagination',
		},
	})


})(jQuery);