$(document).ready(function() {
	$('#recibida').keyup(function() {
		$('#total').val(Number($('#stock').val()) + Number($('#recibida').val()));
	});
});
