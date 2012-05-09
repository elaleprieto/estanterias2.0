/**
 * @author ale
 */
$(document).ready(function() {
	$('#nombre').val($('#cliente option:selected').text());
	setCliente($('#cliente option:selected').val());
	$('#cliente').change(function() {
		$('#nombre').val($('#cliente option:selected').text());
		setCliente($('#cliente option:selected').val());
	});

	$('#formulario').submit(function() {
		if(!$('#bultos').val()) {
			alert('Verifique la cantidad de bultos.');
			return false;
		}
		return true;
	});

	$('#bultos').keyup(function() {
		$('#etiquetas').val($('#bultos').val());
	});
});
/****************************************************************************************************************
 * 											Definición de Funciones												*
 ************************************************************************************************************** */
/**
 * setCliente(cliente_id): setea los valores de dirección, localidad y provincia,
 * del cliente seleccionado en el combobox.
 */
function setCliente(cliente_id) {
	$('#direccionIMG,#localidadIMG,#provinciaIMG').toggleClass('IMG');

	$.getJSON(WEBROOT + "clientes/get_cliente/" + cliente_id, function(data) {
		$('#direccion').val(data.direccion);
		$('#localidad').val(data.localidad_nombre);
		$('#provincia').val(data.provincia_nombre);
		$('#direccionIMG,#localidadIMG,#provinciaIMG').toggleClass('IMG');
	});
}