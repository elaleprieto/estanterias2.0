/**
 * @author ale
 */

/**
 * orden_actualizar(orden_id): actualiza el estado y la cantidad de la orden que se pasa como parámetro.
 * @call: es llamada por preparar.ctp cuando se hace clic en el checkbox "Preparado"
 * o cuando se sale el foco (onblur) del textbox "Cantidad".
 */
function orden_actualizar(orden_id) {
	orden_actualizar_estado(orden_id);
	orden_actualizar_cantidad(orden_id);
}

/**
 * orden_actualizar_estado(orden_id): actualiza el estado de la orden que se pasa como parámetro.
 * @call: es llamada por orden_actualizar_estado(orden_id)
 */
function orden_actualizar_estado(orden_id) {
	var estado = $('es' + orden_id).checked;
	var url = WEBROOT + "ordenes/actualizar_estado/" + orden_id + "/" + estado;

	new Ajax.Request(url, {
		method: 'get',
	});
}

/**
 * orden_actualizar_cantidad(orden_id): actualiza la cantidad de la orden que se pasa como parámetro.
 * @call: es llamada por orden_actualizar_estado(orden_id)
 */
function orden_actualizar_cantidad(orden_id) {
	var cantidad = $("ca" + orden_id).value;
	var url = WEBROOT + "ordenes/set_cantidad/" + orden_id + "/" + cantidad;

	new Ajax.Request(url, {
		method: 'get',
	});
}
