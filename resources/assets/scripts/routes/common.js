import 'slick-carousel/slick/slick.min.js';
export default {
	init() {
	// JavaScript to be fired on all pages

	
	$('.js-nav-toggle').click(function(){
		$('body').toggleClass('show-nav');
	});

	$('.js-onboarding-slider').slick({
		arrows: false,
		dots: true,
		infinite: false,
		speed: 100,
		swipeToSlide: true,
		touchMove: true,
		appendDots: '.onboard__nav',
		focusOnSelect: false,
		customPaging: function() {
		return '<a><svg width="100%" height="100%" viewBox="0 0 16 16"><circle cx="8" cy="8" r="6.215"></circle></svg><span></span></a>';
		},
	});

	$('.js-navigation-slider').slick({
		arrows: false,
		dots: true,
		infinite: false,
		touchMove: true,
		focusOnSelect: false,
		appendDots: '.onboard__nav',
		customPaging: function() {
		return '<a><svg width="100%" height="100%" viewBox="0 0 16 16"><circle cx="8" cy="8" r="6.215"></circle></svg><span></span></a>';
		},

	});
	
},
finalize() {
	// JavaScript to be fired on all pages, after page specific JS is fired
	
	const elements = document.querySelectorAll('.inview');
	const promo = document.querySelectorAll('.promo-header');

	const observer = new IntersectionObserver(entries => {
		entries.forEach(entry => {
			
			
			if (entry.target.classList.contains('header__container')) {
				
				if (entry.intersectionRatio > 0) {
					$(promo).addClass('promo-header--hidden');
				} else {
					$(promo).removeClass('promo-header--hidden');
				}

			} else {
				if (entry.intersectionRatio > 0) {
					entry.target.classList.add('isInview');
					observer.unobserve(entry.target);
				} 	
			}
			
		});
	});

	elements.forEach(element => {
		observer.observe(element);
	});

	
	
},

};
