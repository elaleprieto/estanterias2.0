/**
 * @author ale
 */

/**
 * cambiar_estilo(fila_id, tilde): cambia el estilo de la fila y tilda el checkbox cuando se selecciona.
 * @call: es llamada por listar_desubicados.ctp cuando se hace clic en la fila.
 */
function cambiar_estilo(fila_id, tilde) {
	var columnas = ($(fila_id).childElements());
	
	if(columnas.length > 0) {
		if($(fila_id).getStyle('background-color') == 'rgb(255, 153, 0)') {
			$(tilde).writeAttribute('checked', false);
			$(fila_id).setStyle({backgroundColor: ''});
				columnas.each(function(columna) {
					$(columna).setStyle({backgroundColor: ''});
			});
		} else {
			$(fila_id).setStyle({backgroundColor: '#FF9900'});
			$(tilde).writeAttribute('checked', true);
			
			// recorro las columnas y les cambio el background
			columnas.each(function(columna) {
				$(columna).setStyle({backgroundColor: '#FF9900'});
			});
		}
	}
}