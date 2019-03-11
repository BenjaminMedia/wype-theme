import 'slick-carousel/slick/slick.min.js';
export default {
  init() {
    // JavaScript to be fired on the home page
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS


	$('.top-slider__container').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: false,
		arrows: true,
		infinite: true,
		autoplay: true,
		appendArrows: '.top-slider__arrows-container',
		prevArrow: '<button type="button" class="top-slider__arrow top-slider__arrow--prev">&leftarrow;</button>',
		nextArrow: '<button type="button" class="top-slider__arrow top-slider__arrow--next">&rightarrow;</button>',
	});

	$('.bottom-slider__left').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		autoplay: true,
		dots: true,
		dotsClass: 'bottom-slider__dotscontainer',
		appendDots: '.bottom-slider__dots',
		infinite: true,
		asNavFor: '.bottom-slider__right',
	});

	$('.bottom-slider__right').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		fade: true,
		arrows: false,
		dots: false,
		asNavFor: '.bottom-slider__left',
	});

	
  },
};
