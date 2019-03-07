export default {
	init() {
		// JavaScript to be fired on the about us page
		$('.js-faq').click(function(){
			var active = $('.active');
			if($(this).closest('li').hasClass('active')) {
				$(this).closest('li').removeClass('active')
			} else {
				$(active).removeClass('active');
				$(this).closest('li').toggleClass('active');	
			}
			

		});

		console.log('faq');
},
};
