$(document).ready(function() {
	/********************************************************************
	 *						Variables Globales							*
	 ********************************************************************/
	var seleccionado = 0;
	var submit = false;
	var opciones = new Array();
	/********************************************************************
	 *					Inicialización de Objetos						*
	 ********************************************************************/
	deshabilitarBotones();
	limpiarCampos();
	setCliente($('#cliente option:selected').val());

	/********************************************************************
	 * 								Eventos								*
	 *
	 * 		Aquí se registran los eventos para los objetos de la vista	*
	 ********************************************************************/
	$('#busqueda').keyup(function(e) {
		//37=>Left Key,38=>Up Key,39=>Right Key,40=>Down Key
		if(e.which == 39 || e.which == 40) {
			avanzar();
		} else if(e.which == 37 || e.which == 38) {
			retroceder();
		} else {
			buscar();
		}
	});
	$('#busqueda').keydown(function(e) {
		if(e.which == 9) {
			$('#lista').focus();
		}
	});
	$('#codigo').keyup(function(e) {
		if($('#codigo').val()) {
			if($('#lista option[value="' + $('#codigo').val() + '"]').length > 0) {
				$('#lista option[value="' + $('#codigo').val() + '"]').attr('selected', 'selected')
				setArticulo($('#lista option:selected').val());
				$('#mensaje_flotante').removeClass('mensaje_error').addClass('mensaje_ok').text('Código válido').fadeOut();
				$('#cantidad').removeAttr('disabled');
			} else {
				$('#mensaje_flotante').removeClass('mensaje_ok').addClass('mensaje_error').text('Código inválido').fadeIn();
				$('#cantidad').attr('disabled', 'disabled');
			}
		}
	});
	$('#anterior').click(function() {
		retroceder();
	});
	$('#siguiente').click(function() {
		avanzar();
	});
	$('#agregar').click(function() {
		articulosActualizar();
	});
	$('#cantidad, #lista').keypress(function(e) {
		if(e.which == 13) {
			articulosActualizar();
		}
	});
	$('#cantidad').keyup(function(e) {
		if(e.which != 13) {
			verificarCantidad();
		}
	});
	$('#lista option').click(function() {
		setArticulo($('#lista option:selected').val());
	});
	$('#formulario').submit(function(e) {
		// se envía el formulario sólo se se ha presionadao del botón #crear
		return submit;
	});
	$('#crear').click(function(e) {
		// se envía el formulario
		submit = true;
		$('#formulario').submit();
	});
	$(':checkbox').click(function() {
		if($(this).attr('checked')) {
			$(this).val(1);
		} else {
			$(this).val(0);
		}
	});
	$('#prioridad_imagen').click(function() {
		switch($('#prioridad').val()) {
			case '0':
				setPrioridad('1');
				break;
			case '1':
				setPrioridad('2');
				break;
			default:
				setPrioridad('0');
		}
	});
	$('#cliente').change(function() {
		$('#load_cliente').show();
		setCliente($('#cliente option:selected').val());
	});
});
/********************************************************************
 * 								Funciones							*
 ********************************************************************/
/**
 * buscar(): Obtiene un conjunto de objetos de la lista de artículos,
 * los cuales contienen la palabra ingresada por el usuario en algún lugar del texto.
 * @call: el usuario ingresa una palabra en el campo de búsqueda.
 */
function buscar() {
	deshabilitarBotones();
	var texto = $('#busqueda').val().toUpperCase();
	var palabras = texto.split(" ");
	var contiene = "";

	for(var i = palabras.length - 1; i >= 0; i--) {
		if(palabras[i] != "") {
			contiene += ':contains(' + palabras[i] + ')';
		};
	}
	opciones = $('#lista option' + contiene);
	seleccionado = 0;

	if(opciones.length > 0) {
		$(opciones[0]).attr('selected', 'selected');
		setArticulo($('#lista option:selected').val());
		habilitarBotones();
	}
}

/**
 * avanzar(): Selecciona el siguiente resultado en la lista de artículos. Funciona en conjunto con la función "buscar()".
 * @call: el usuario presiona el botón "Siguiente".
 */
function avanzar() {
	if(seleccionado >= opciones.length - 1) {
		seleccionado = 0;
	} else {
		seleccionado++;
	}
	$(opciones[seleccionado]).attr('selected', 'selected');
	setArticulo($('#lista option:selected').val());
}

/**
 * retroceder(): Selecciona el resultado anterior en la lista de artículos. Funciona en conjunto con la función "buscar()".
 * @call: el usuario presiona el botón "Anterior".
 */
function retroceder() {
	if(seleccionado == 0) {
		seleccionado = opciones.length - 1;
	} else {
		seleccionado--;
	}
	$(opciones[seleccionado]).attr('selected', 'selected');
	setArticulo($('#lista option:selected').val());
}

/**
 * deshabilitarBotones(): Se utiliza en conjunto con habilitarBotones() para permitir un mayor control de la acciones del usuario.
 * @call: al inicializar la página.
 * @call: el usuario escribe en el campo de búsqueda.
 */
function deshabilitarBotones() {
	$('#anterior').attr('disabled', 'disabled');
	$('#siguiente').attr('disabled', 'disabled');
}

/**
 * habilitarBotones(): Se utiliza en conjunto con deshabilitarBotones() para permitir un mayor control de la acciones del usuario.
 * @call: Se llama cuando el campo de búsqueda contiene una palabra que arroja resultados en la lista de artículos
 */
function habilitarBotones() {
	$('#anterior').removeAttr('disabled');
	$('#siguiente').removeAttr('disabled');
}

/**
 * limpiarCampos(): Setea en blanco los valores de los campos al inicializar.
 */
function limpiarCampos() {
	$('#busqueda').val('');
	$('#cantidad').val('');
	$('#cobinpro').attr('checked', 'checked');
}

/**
 * existeEnLista(articulo_id) recorre la lista de artículos
 * buscando si el artículo pasado como parámetro
 * ya se encuentra cargado.
 */
function existeEnLista(articulo_id) {
	var codigo = "c" + articulo_id;
	var existe = false;

	// se busca si existe una celda (td) en la tabla cuya ID sea el Codigo
	// y contenga la leyenda Sin Cargo o el articulo_id según el artículo que se está agregando.
	if(($('#sin_cargo_ckeckbox').attr('checked'))) {
		// si está marcado el campo Sin Cargo
		celda = $('td[id=' + codigo + ']:contains("Sin Cargo")');
	} else {
		// si no está marcado el campo Sin Cargo
		celda = $('td[id=' + codigo + ']:contains("' + articulo_id + '")');
	}

	// aquí se verifica si se encontró alguna coincidencia.
	if(celda.length > 0) {
		existe = true;
	}
	return existe;
}

/**
 * cantidadFocus(articulo_id) recorre la lista de artículos
 * buscando si el artículo pasado como parámetro
 * ya se encuentra cargado y hace foco en el campo cantidad.
 */
function cantidadFocus(articulo_id) {
	var codigo = "c" + articulo_id;

	// se busca si existe una celda (td) en la tabla cuya ID sea el Codigo
	// y contenga la leyenda Sin Cargo o el articulo_id según el artículo que se está agregando.
	if(($('#sin_cargo_ckeckbox').attr('checked'))) {
		// si está marcado el campo Sin Cargo
		$('td[id=' + codigo + ']:contains("Sin Cargo") + td > input').focus();
	} else {
		// si no está marcado el campo Sin Cargo
		$('td[id=' + codigo + ']:contains("' + articulo_id + '") + td > input').focus();
	}
	alert('Ya se agregó ese artículo')
}

/**
 * corregirCantidad(articulo_id, cantidad) recorre la lista de artículos buscando el artículo pasado como parámetro
 * y suma la cantidad pasada como parámetro.
 * Esta función verifica la existencia del artículo, pero igualmente debería llamarse
 * después de la función existeEnLista(articulo_id) para evitar sorpresas o mal funcionamiento.
 */
function corregirCantidad(articulo_id, cantidad) {
	var codigo = "c" + articulo_id;
	var existe = false;

	if(!(isNaN(cantidad))) {
		// se busca si existe una celda (td) en la tabla cuya ID sea el Codigo
		// y contenga la leyenda Sin Cargo o el articulo_id según el artículo que se está agregando.
		if(($('#sin_cargo_ckeckbox').attr('checked'))) {
			// si está marcado el campo Sin Cargo
			celda = $('td[id=' + codigo + ']:contains("Sin Cargo")');
		} else {
			// si no está marcado el campo Sin Cargo
			celda = $('td[id=' + codigo + ']:contains("' + articulo_id + '")');
		}

		// aquí se verifica si se encontró alguna coincidencia.
		if(celda.length > 0) {
			// se obntienen todas las columnas de la fila
			columnas = $(celda).parent().children();

			// la columna 4 es la cantidad
			$(columnas[4]).html(parseFloat($(columnas[4]).html()) + parseFloat(cantidad));

			// la columna 1 es el campo oculto de la cantidad
			// el campo oculto de la cantidad es el que se toma para guardar en la BD
			$(columnas[1]).children().val(parseFloat($(columnas[1]).children().val()) + parseFloat(cantidad));
		}
	}
}

/**
 * 	getUnidad se encarga de hacer la petición de la unidad del artículo
 *	y colocarlo en la fila correspondiente.
 */
function getUnidad(id, columnaUnidad) {
	if(id && columnaUnidad) {
		$(columnaUnidad).load(WEBROOT + "articulos/get_unidad/" + id);
	}
}

/**
 *	getFoto se encarga de hacer la petición de la foto del artículo
 *	y colocarlo en la fila correspondiente.
 */
function getFoto(id, columnaFoto) {
	if(id && columnaFoto) {
		$(columnaFoto).load(WEBROOT + "articulos/get_foto/" + id);
	}
}

/**
 * quitarArticulo() elimina la fila en la que se encuentra el botón
 */
function quitarArticulo(elemento) {
	// se elimina la fila de la tabla
	console.log($(elemento).parent().parent().remove().fadeOut(1000));

	// se resta 1(uno) a la cantidad de artículos del pedido.
	$('#cantidad_articulos').html(parseInt($('#cantidad_articulos').html()) - 1);
}

/**
 * setArticulo(articulo_id): setea los valores de unidad, stock y pack, del artículo seleccionado en la lista.
 */
function setArticulo(articulo_id) {
	imagen = $('<img>').attr('src', WEBROOT + 'img/load.gif').attr('class', 'load');
	$('#unidad').html(imagen);
	$('#precio').html(imagen);
	$('#stock').html(imagen.clone());
	$('#pack').html(imagen.clone());
	$.getJSON(WEBROOT + "articulos/get_articulo/" + articulo_id, function(data) {
		$('#unidad').html(data.unidad);
		$('#precio').html('$ ' + Number(data.precio_venta).toFixed(2));
		$('#stock').html(data.stock);
		$('#pack').html(data.pack);
		verificarCantidad();
	});
}

/**
 * setCliente(cliente_id): setea los valores de transporte, contrarrembolso y cobinpro, del cliente seleccionado en el combobox.
 */
function setCliente(cliente_id) {
	$.getJSON(WEBROOT + "clientes/get_cliente/" + cliente_id, function(data) {
		// seteo del transporte
		if(data.transporte_id > 0) {
			$('#transporte option[value="' + data.transporte_id + '"]').attr('selected', 'selected');
		} else {
			$('#transporte option[value=""]').attr('selected', 'selected');
		}

		// seteo del contrarrembolso
		if(data.contrarrembolso) {
			$('#contrarrembolso').attr('checked', 'checked');
			$('#contrarrembolso').val(1);
		} else {
			$('#contrarrembolso').removeAttr('checked');
			$('#contrarrembolso').val(0);
		}

		// seteo del cobinpro
		if(data.cobinpro) {
			$('#cobinpro').attr('checked', 'checked');
			$('#cobinpro').val(1);
		} else {
			$('#cobinpro').removeAttr('checked');
			$('#cobinpro').val(0);
		}
		// seteo la prioridad
		setPrioridad(data.prioridad);
		$('#load_cliente').hide();
	});
}

/**
 * verificarCantidad(): revisa que la cantidad ingresada concuerde con el pack del producto 
 * y la prioridad del pedido.
 */
function verificarCantidad() {
	var cantidad = $("#cantidad").val();
	var pack = $('#pack').text();
	var prioridad = $('#prioridad').val();
	
	/* se desaparece el mensaje si lo hay */
	$('#mensaje_flotante').hide();
	
	/* se verifica el pack */
	if((pack > 0) && (cantidad % pack != 0)) {
		$('#mensaje_flotante').removeClass('mensaje_ok').addClass('mensaje_error').text('La Cantidad ' + cantidad + ' no es múltiplo del Pack ' + pack).show().delay(1500).fadeOut();
		return;
	}
	/* se verifica la prioridad */
	pack *= 2;
	if((prioridad > 0) && (pack > 0) && (cantidad < pack)) {
		$('#mensaje_flotante').removeClass('mensaje_ok').addClass('mensaje_error').text('Cuidado con la prioridad').show().delay(1500).fadeOut();
	}
}

/**
 * setPrioridad(): setea la prioridad del pedido pasada como parámetro.
 */
function setPrioridad(prioridad) {
	switch(prioridad) {
		case '1':
			$('#prioridad').val('1');
			$('#prioridad_imagen').attr('src', WEBROOT + 'img/prioridad_baja.png');
			break;
		case '2':
			$('#prioridad').val('2');
			$('#prioridad_imagen').attr('src', WEBROOT + 'img/prioridad_alta.png');
			break;
		default:
			$('#prioridad').val('0');
			$('#prioridad_imagen').attr('src', WEBROOT + 'img/prioridad_no.png');
	}
}
