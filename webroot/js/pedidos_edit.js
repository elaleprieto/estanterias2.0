/**
 * articulos_actualizar() se llama para agregar el artículo a la lista.
 */
function articulos_actualizar() {
	// se obtiene el artículo seleccionado
	var indice = ($("articulo_id").selectedIndex);
	var articulo_id = ($("articulo_id").value);
	// se obtiene la cantidad
	var cantidad = ($("cantidad").value);

	// se verifica que la cantidad esté definida
	if(cantidad && !(isNaN(cantidad))) {
		var condicion = existe_en_lista(articulo_id);
		if(!(condicion)) {
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

			// columna Id
			inputId = new Element("input", {
				"name" : "data[Orden][" + articulo_id + "][cantidad]",
				"type" : "hidden",
				"value" : cantidad
			});
			columnaId = new Element("td", {
				"class" : "invisible"
			}).update(inputId);
			
			// columna Estado
			inputEstado = new Element("input", {
				"name" : "data[Orden][" + articulo_id + "][estado]",
				"type" : "hidden",
				"value" : "0"
			});
			columnaEstado = new Element("td", {
				"class" : "invisible"
			}).update(inputEstado);

			// columna Codigo
			columnaCodigo = new Element("td", {
				"id" : "c" + articulo_id
			});
			getCodigo(articulo_id);

			// columna Cantidad
			columnaCantidad = new Element("td").update(cantidad);

			// columna Artículo
			columnaArticulo = new Element("td").update($("articulo_id").options[indice].text);

			// columna Acciones
			quitar = new Element("input", {
				"type" : "button",
				"class" : "articulo",
				"value" : "Quitar"
			});
			columnaAcciones = new Element("td").update(quitar);

			// agrego las columnas a la fila
			fila.appendChild(columnaId);
			fila.appendChild(columnaEstado);
			fila.appendChild(columnaFoto);
			fila.appendChild(columnaCodigo);
			fila.appendChild(columnaCantidad);
			fila.appendChild(columnaArticulo);
			fila.appendChild(columnaAcciones);

			// agrego la fila a la tabla
			($("articulos").appendChild(fila));

			// registración de eventos
			Event.observe(quitar, 'click', function(event) { quitar_articulo(this)
			}, false);
		} else {
			// si el artículo ya se encuentra en la tabla,
			// se le corrige la cantidad, se le suma la nueva.
			corregir_cantidad(articulo_id, cantidad);
		}
	} else {
		alert("Verifique la Cantidad.");
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
 */
function getCodigo(id) {
	if(id) {
		new Ajax.Updater("c" + id, WEBROOT + "articulos/get_codigo/" + id);
	}
}

/**
 * quitar_articulo() elimina la fila en la que se encuentra el botón
 */
function quitar_articulo(elemento) {
	($(elemento).ancestors()[1]).remove();
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
				//alert("ya existe");
				existe = true;
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
					// la columna 4 es la cantidad
					cantidad = parseInt(columnas[4].innerHTML) + parseInt(cantidad);
					columnas[4].update(cantidad);

					// la columna 0 es el campo oculto
					// el campo oculto es el que se toma para guardar en la BD
					input = (columnas[0].childElements());
					input[0].value = cantidad;
				}
			});
		}
	}
}