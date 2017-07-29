// $(document).ready(function() {
//
// 	$('.menu-icon').click(function(event){
// 		$('#sidebar').toggleClass('sidebar-expand');
// 		console.log('clicked');
//
// 		event.preventDefault();
// 	});
//
// 	$('#sidebar ul li').click(function(event) {
// 		$('#sidebar ul li').removeClass('icon-active')
// 		$(this).addClass('icon-active')
//
// 		event.preventDefault();
// 	});
//
//
// 	$('.header-menu .has-dropdown').on('click', function(event) {
// 		var _this = $(this).children('.dropdown-container');
//
// 		if (_this.css('display').toLowerCase() !== 'block') {
// 			$('.header-menu .dropdown-container').hide()
// 			_this.show()
// 		} else {
// 			_this.hide()
// 		}
//
// 		event.preventDefault();
// 	});
//
// 	$(document).click(function(){
// 	  $('.dropdown-container').hide();
// 		$('#sidebar').removeClass('sidebar-expand');
// 	});
//
// 	$('.header-menu .has-dropdown, #sidebar').click(function(e){
// 	  e.stopPropagation();
// 	});
//
// });
