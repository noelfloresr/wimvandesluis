jQuery(document).ready(function($){

	var currentTeam = $('#team-masonry .team-card');

	currentTeam.hover(function(){
		$(this).addClass('active');
		$(this).siblings('.team-card').removeClass('active');
	})

	// $('#team-masonry .team-card:first-child').hover(function() {
	// 	// console.log('kevin');
	// 	setTimeout(function() {
	// 		console.log('enter');
	// 		$(this).find('.active').css('display', 'block');
	// 	}, 1000);
		
	// 	// setTimeout(function() {
	// 	// 	// $(this).find('.active').css('display', 'block');
	// 	// 	$(this).find('.active').fadeIn();
	// 	// }, 1000);
	// }, function(){
		
	// });

});