$(document).ready(function() {
	$('#formulario').submit(function() {
		$('#listado').html($('<img>').attr('src', WEBROOT + 'img/load.gif').attr('class', 'load'));
		$.post(WEBROOT + "admin/clientes/get_buscados", $('#formulario').serialize(), function(data) {
			$('#listado').html(data);
		});
		return false;
	});
});
