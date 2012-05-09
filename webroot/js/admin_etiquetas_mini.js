/**
 * @author ale
 */
$(document).ready(function() {
	$('#detalle').val($('#articulo option:selected').html());
	$('#articulo').change(function() {
		$('#detalle').val($('#articulo option:selected').html());
	});
});