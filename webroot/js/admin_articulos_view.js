$(document).ready(function() {
	$('.eliminar').click(function() {
		if(confirm('¿Está seguro que desea eliminar esta ubicación?')) {
			eliminar($(this));
		};
		return false;
	});
});
function eliminar(elemento) {
	$.get(WEBROOT + "admin/ubicados/delete/" + $(elemento).attr('value'), function(data) {
		console.info(data);
		$(elemento).closest('tr').fadeOut();
	});
}