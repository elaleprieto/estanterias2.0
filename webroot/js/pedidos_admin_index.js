/**
 * @author ale
 */
$(document).ready(function() {
	/********************************************************************
	 *						Variables Globales							*
	 ********************************************************************/

	/********************************************************************
	 *					Inicialización de Objetos						*
	 ********************************************************************/

	// Recargar la página cada 5 minutos
	minutos = 5 * 60 * 1000;
	setTimeout("location.reload()", minutos);

	/********************************************************************
	 * 								Eventos								*
	 *
	 * 		Aquí se registran los eventos para los objetos de la vista	*
	 ********************************************************************/
	$('.arrow_down').click(function(e) {
		setOrdenDown(this);
	});
	$('.arrow_up').click(function(e) {
		setOrdenUp(this);
	});
});
/********************************************************************
 * 								Funciones							*
 *
 *				 		Aquí se escriben las funciones				*
 ********************************************************************/
function setOrdenDown(elemento) {
	// Fila del Pedido que se está modificando
	var filaPedido = $(elemento).parents('tr');
	// Nuevo Orden del Pedido que se está modificando
	var ordenNuevo = parseInt($(elemento).prevAll('label').text()) - 1;
	// Id del Pedido que se está modificando la orden
	var id = $(elemento).parents('tr').children('td.id').text();

	// Fila Posterior
	var filaPosterior = $(elemento).parents('tr').next('tr');
	// Orden del Pedido en la fila anterior
	var ordenPosterior = $(filaPosterior).find("td > label").text();

	// Imagen para avisar al usuario que se está llevando a cabo la actualización
	var imagen = $('<img>').attr('src', WEBROOT + 'img/load.gif').attr('class', 'load');
	$(elemento).prevAll('label').html(imagen);
	filaPedido.toggleClass('modificada', true);

	// Se persiste la orden del Pedido
	$.get(WEBROOT + "admin/pedidos/set_orden/" + id + "/" + ordenNuevo, function() {
		// Se escribe la Orden Actual en la pantalla
		$(elemento).prevAll('label').text(ordenNuevo);
		filaPedido.toggleClass('modificada', false);
	});
	
	// Si el orden del Pedido en la fila posterior es mayor que el nuevo,
	// se toma el Pedido modificado y se lo compara con los anteriores para bajarlo en la tabla.
	if(ordenPosterior != '' && ordenNuevo < ordenPosterior) {
		fila = filaPedido.detach();
		filaAux = $(filaPosterior).next('tr');
		ordenAux = $(filaAux).find("td > label").text();

		while(ordenAux != '' && ordenNuevo < ordenAux) {
			filaPosterior = filaAux;
			filaAux = $(filaPosterior).next('tr');
			ordenAux = $(filaAux).find("td > label").text();
		}
		$(filaPosterior).after(fila);
	}
	

}

function setOrdenUp(elemento) {
	// Fila del Pedido que se está modificando
	var filaPedido = $(elemento).parents('tr');
	// Nuevo Orden del Pedido que se está modificando
	var ordenNuevo = parseInt($(elemento).prevAll('label').text()) + 1;
	// Id del Pedido que se está modificando la orden
	var id = $(elemento).parents('tr').children('td.id').text();

	// Fila Anterior
	filaAnterior = $(elemento).parents('tr').prev('tr');
	// Orden del Pedido en la fila anterior
	var ordenAnterior = $(filaAnterior).find("td > label").text();

	// Imagen para avisar al usuario que se está llevando a cabo la actualización
	var imagen = $('<img>').attr('src', WEBROOT + 'img/load.gif').attr('class', 'load');
	$(elemento).prevAll('label').html(imagen);
	filaPedido.toggleClass('modificada', true);

	// Se persiste la orden del Pedido
	$.get(WEBROOT + "admin/pedidos/set_orden/" + id + "/" + ordenNuevo, function() {
		// Se escribe la Orden Actual en la pantalla
		$(elemento).prevAll('label').text(ordenNuevo);
		filaPedido.toggleClass('modificada', false);
	});

	// Si el orden del Pedido en la fila anterior es menor que el nuevo,
	// se toma el Pedido modificado y se lo compara con los anteriores para subirlo en la tabla.
	if(ordenAnterior != '' && ordenNuevo > ordenAnterior) {
		fila = filaPedido.detach();
		filaAux = $(filaAnterior).prev('tr');
		ordenAux = $(filaAux).find("td > label").text();

		while(ordenAux != '' && ordenNuevo > ordenAux) {
			filaAnterior = filaAux;
			filaAux = $(filaAnterior).prev('tr');
			ordenAux = $(filaAux).find("td > label").text();
		}
		$(filaAnterior).before(fila);
	}
}

/**
 * ordenarOrden(): ordena los pedidos según el número de orden.
 */
function ordenarOrden() {
	$('#pedidos > tbody > tr > td > label').each(function(index) {
		console.info(this);
	});
}