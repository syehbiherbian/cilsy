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

function deleteCart(id) {
	var carts = JSON.parse(localStorage.getItem('cart'));
	if (carts) {
		$.each(carts, function(k,v) {
			if (id == v.id) {
				carts.splice(k, 1);
				localStorage.setItem('cart', JSON.stringify(carts));
				// $('#cart-'+id).remove();
				window.location.href = '/cart';
			}
		});
	}
}

function formatMoney(c, d, t) {
    var n = this, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? "." : d, 
    t = t == undefined ? "," : t, 
    s = n < 0 ? "-" : "", 
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };