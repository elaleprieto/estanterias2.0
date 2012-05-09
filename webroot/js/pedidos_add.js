/**
 * articulos_actualizar() se llama para agregar el artículo a la lista.
 */
function articulos_actualizar() {
	/* definición de variables */
	// se obtiene el artículo seleccionado
	var articulo_id = ($('aux_articulo_id').innerHTML);
	// se obtiene la cantidad
	var cantidad = ($("cantidad").value);

	// se verifica que el artículo_id esté definido
	if(articulo_id > 0) {
		// se verifica que la cantidad esté definida
		if(cantidad && !(isNaN(cantidad))) {
			/* definición de variables */
			var condicion = existe_en_lista(articulo_id);

			if(!(condicion)) {
				/* definición de variables */
				// cuenta secuencial por si se eliminan artículos, siempre se incrementa
				var indice = parseInt($('serial_articulos').innerHTML);
				var sinCargo = 0;

				// creo la fila y columnas
				fila = new Element("tr");

				// columna Foto
				foto = new Element("img", {
					"class" : "ubicados_index",
					src : "../img/articulos/nofoto.png"
				});
				columnaFoto = new Element("td", {
					"id" : "f" + articulo_id
				}).update(foto);
				getFoto(articulo_id);

				// columna Id (oculta)
				inputId = new Element("input", {
					"name" : "data[Orden][" + indice + "][id]",
					"type" : "hidden",
					"value" : articulo_id
				});
				columnaId = new Element("td", {
					"class" : "invisible"
				}).update(inputId);
				
				// columna Cantidad (oculta)
				inputCantidadHidden = new Element("input", {
					"name" : "data[Orden][" + indice + "][Cantidad]",
					"type" : "hidden",
					"value" : cantidad
				});
				columnaCantidadHidden = new Element("td", {
					"class" : "invisible"
				}).update(inputCantidadHidden);

				// columna Codigo
				columnaCodigo = new Element("td", {
					"id" : "c" + articulo_id
				}).update(articulo_id);
				if($('sin_cargo_ckeckbox').checked) {
					columnaCodigo.update('Sin Cargo');
				}

				// columna Cantidad
				columnaCantidad = new Element("td").update(cantidad);

				// columna Unidad
				columnaUnidad = new Element("td", {
					"id" : "u" + articulo_id
				});
				getUnidad(articulo_id);

				// columna Artículo
				columnaArticulo = new Element("td", {
					"id" : "d" + articulo_id
				});
				getDetalle(articulo_id)

				// columna Acciones
				quitar = new Element("input", {
					"type" : "button",
					"class" : "articulo",
					"value" : "Quitar"
				});
				columnaAcciones = new Element("td").update(quitar);

				// columna para inidicar Artículo Sin Cargo o No (oculta)
				if($('sin_cargo_ckeckbox').checked) {
					sinCargo = 1;
				}
				inputSinCargo = new Element("input", {
					"name" : "data[Orden][" + indice + "][SinCargo]",
					"type" : "hidden",
					"value" : sinCargo
				});
				columnaSinCargo = new Element("td", {
					"class" : "invisible"
				}).update(inputSinCargo);

				// agrego las columnas a la fila
				fila.appendChild(columnaId);
				fila.appendChild(columnaCantidadHidden);
				fila.appendChild(columnaFoto);
				fila.appendChild(columnaCodigo);
				fila.appendChild(columnaCantidad);
				fila.appendChild(columnaUnidad);
				fila.appendChild(columnaArticulo);
				fila.appendChild(columnaAcciones);
				fila.appendChild(columnaSinCargo);

				// agrego la fila a la tabla en la primera posición
				if($("articulos").descendants().length > 0) {
					$("articulos").firstDescendant().insert({
						before : fila
					});
				} else {($("articulos").appendChild(fila));
				}

				// registración de eventos
				Event.observe(quitar, 'click', function(event) { quitar_articulo(this)
				}, false);
				
				// se suma 1(uno) a la cantidad de artículos del pedido y al serial.
				$('cantidad_articulos').update(parseInt($('cantidad_articulos').innerHTML) + 1);
				$('serial_articulos').update(parseInt($('serial_articulos').innerHTML) + 1);

				// se resetea el aux_articulo_id
				$('aux_articulo_id').update(0);
				$('articulo_autocomplete').value = "";

			} else {
				// si el artículo ya se encuentra en la tabla,
				// se le corrige la cantidad, se le suma la nueva.
				corregir_cantidad(articulo_id, cantidad);
			}
		} else {
			alert("Verifique la Cantidad.");
		}
	} else {
		alert("Verifique el Artículo.");
	}
}

/**
 *	getFoto se encarga de hacer la petición de la foto del artículo
 *	y colocarlo en la fila correspondiente.
 */
function getFoto(id) {
	if(id) {
		new Ajax.Updater("f" + id, WEBROOT + "articulos/get_foto/" + id);
	}
}

/**
 * 	getCodigo se encarga de hacer la petición del código del artículo
 *	y colocarlo en la fila correspondiente.
 *
 *  desde que actualicé el código por el id en la BD, no se utiliza esta función.
 */
function getCodigo(id) {
	if(id) {
		new Ajax.Updater("c" + id, WEBROOT + "articulos/get_codigo/" + id);
	}
}

/**
 * 	getUnidad se encarga de hacer la petición de la unidad del artículo
 *	y colocarlo en la fila correspondiente.
 */
function getUnidad(id) {
	if(id) {
		new Ajax.Updater("u" + id, WEBROOT + "articulos/get_unidad/" + id);
	}
}

/**
 * 	getDetalle se encarga de hacer la petición de la unidad del artículo
 *	y colocarlo en la fila correspondiente.
 */
function getDetalle(id) {
	if(id) {
		new Ajax.Updater("d" + id, WEBROOT + "articulos/get_detalle/" + id);
	}
}

/**
 * 	unidad_actualizar se encarga de hacer la petición del código del artículo
 *	y colocarlo en la fila correspondiente.
 */
function unidad_actualizar() {
	new Ajax.Updater("unidad", WEBROOT + "articulos/get_unidad/" + $('articulo_id').getValue());
}

/**
 * quitar_articulo() elimina la fila en la que se encuentra el botón
 */
function quitar_articulo(elemento) {
	// se elimina el elemento
	($(elemento).ancestors()[1]).remove();

	// se resta 1(uno) a la cantidad de artículos del pedido.
	$('cantidad_articulos').update(parseInt($('cantidad_articulos').innerHTML) - 1);
}

/**
 * existe_en_lista(articulo_id) recorre la lista de artículos
 * buscando si el artículo pasado como parámetro
 * ya se encuentra cargado.
 */
function existe_en_lista(articulo_id) {
	var filas = ($("articulos").childElements());
	var codigo = "c" + articulo_id;
	var existe = false;

	if(filas.length > 0) {
		filas.each(function(fila) {
			var columnas = (fila.childElements());

			// la columna 3 es la del código
			if(columnas[3].readAttribute('id') == codigo) {
				// verfico si el artículo es Sin Cargo o no.
				// si el artículo que se agrega es Sin Cargo, verifico su existencia.
				// si no es Sin Cargo también se verifica
				if(($('sin_cargo_ckeckbox').checked) && (columnas[3].innerHTML == 'Sin Cargo')) {
					existe = true;
				} else if(!($('sin_cargo_ckeckbox').checked) && (columnas[3].innerHTML == articulo_id)) {
					existe = true;
				}
			}
		});
	}
	return existe;
}

/**
 * corregir_cantidad(articulo_id, cantidad) recorre la lista de artículos buscando el artículo pasado como parámetro
 * y suma la cantidad pasada como parámetro.
 * Esta función verifica la existencia del artículo, pero igualmente debería llamarse
 * después de la función existe_en_lista(articulo_id) para evitar sorpresas o mal funcionamiento.
 */
function corregir_cantidad(articulo_id, cantidad) {
	var filas = ($("articulos").childElements());
	var codigo = "c" + articulo_id;
	var existe = false;

	if(!(isNaN(cantidad))) {
		if(filas.length > 0) {
			filas.each(function(fila) {
				var columnas = (fila.childElements());

				// la columna 3 es la del código
				if(columnas[3].readAttribute('id') == codigo) {
					// verfico si el artículo es Sin Cargo o no, y le cambio la cantidad al que sea.
					if(($('sin_cargo_ckeckbox').checked) && (columnas[3].innerHTML == 'Sin Cargo')) {
						// la columna 4 es la cantidad
						cantidad = parseInt(columnas[4].innerHTML) + parseInt(cantidad);
						columnas[4].update(cantidad);

						// la columna 1 es el campo oculto de la cantidad
						// el campo oculto de la cantidad es el que se toma para guardar en la BD
						input = (columnas[1].childElements());
						input[0].value = cantidad;
					} else if(!($('sin_cargo_ckeckbox').checked) && (columnas[3].innerHTML == articulo_id)) {
						// la columna 4 es la cantidad
						cantidad = parseInt(columnas[4].innerHTML) + parseInt(cantidad);
						columnas[4].update(cantidad);

						// la columna 1 es el campo oculto de la cantidad
						// el campo oculto de la cantidad es el que se toma para guardar en la BD
						input = (columnas[1].childElements());
						input[0].value = cantidad;
					}

				}
			});
		}
	}
}

function seleccionar(articulo_id) {
	new Ajax.Updater("unidad", WEBROOT + "articulos/get_unidad/" + articulo_id);
	$('aux_articulo_id').update(articulo_id);
}

function comprobar_tecla(e, articulo_id) {
	alert(e);
	// si se presiona la tecla Enter, se ha seleccionado un artículo
	// por lo tanto se llama a la función seleccionar,
	// si no, no se hace nada.
	if(e.keyCode == 13) {
		seleccionar(articulo_id);
	}
}