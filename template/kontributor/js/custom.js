$(document).ready(function() {

	$('.menu-icon').click(function(event){
		$('#sidebar').toggleClass('sidebar-expand');
		console.log('clicked');

		event.preventDefault();
	});

	$('#sidebar ul li').click(function(event) {
		$('#sidebar ul li').removeClass('icon-active')
		$(this).addClass('icon-active')

		event.preventDefault();
	});


	$('.header-menu .has-dropdown').on('click', function(event) {
		var _this = $(this).children('.dropdown-container');

		if (_this.css('display').toLowerCase() !== 'block') {
			$('.header-menu .dropdown-container').hide()
			_this.show()
		} else {
			_this.hide()
		}
	
		event.preventDefault();
	});

	$(document).click(function(){
	  $('.dropdown-container').hide();
		$('#sidebar').removeClass('sidebar-expand');
	});

	$('.header-menu .has-dropdown, #sidebar').click(function(e){
	  e.stopPropagation();
	});

});

$(document).ready(function() {
	$('.tab-btn-container a').click(function(a) {
		var tab = $(this).attr('id'); 
		$('.tab-btn-container a').css({
			'background-color': '#ededed'
		})
		$(this).css({
			'background-color': '#f8f8f8'
		})

		$('.tab-content > div').css('display', 'none');
		$('#' + $(this).attr('id') + '-content').css('display', 'block');
	});

	$('.pro p').click(function() {
		$(this).css({
		    'color': '#FFF',
		    'background-color': '#2ecc71',
		    'border': 'none'
		})
		$('.premium p').css({
		    'color': '#339bd5',
		    'background-color': 'transparent',
		    'border': '2px solid #339bd5'
		})
		$('#pricing-table tbody tr td:nth-child(3)').css('background-color', 'transparent');
		$('#pricing-table tbody tr td:nth-child(2)').css('background-color', 'rgba(46, 204, 113,.1)');
	});

	$('.premium p').click(function() {
		$(this).css({
		    'color': '#FFF',
		    'background-color': '#2ecc71',
		    'border': 'none'
		})
		$('.pro p').css({
		    'color': '#339bd5',
		    'background-color': 'transparent',
		    'border': '2px solid #339bd5'
		})
		$('#pricing-table tbody tr td:nth-child(2)').css('background-color', 'transparent');
		$('#pricing-table tbody tr td:nth-child(3)').css('background-color', 'rgba(46, 204, 113,.1)');
	});
});