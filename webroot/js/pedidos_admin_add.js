/**
 * articulosActualizar() se llama para agregar el artículo a la lista.
 */
function articulosActualizar() {
	// se obtiene el artículo seleccionado
	var articulo_id = $('#lista option:selected').val();
	// se obtiene la cantidad
	var cantidad = $("#cantidad").val();

	// se verifica que el artículo_id esté definido
	if(articulo_id > 0) {
		// se verifica que la cantidad esté definida
		if(cantidad && !(isNaN(cantidad))) {
			/* definición de variables */
			var condicion = existeEnLista(articulo_id);

			if(!(condicion)) {
				/* definición de variables */
				// cuenta secuencial por si se eliminan artículos, siempre se incrementa
				var indice = parseInt($('#serial_articulos').html());
				var sinCargo = 0;

				// creo la fila y columnas
				fila = $('<tr>');

				// columna Foto
				foto = $('<img>').attr("class", "ubicados_index").attr("src", WEBROOT + "img/articulos/nofoto.png");
				columnaFoto = $('<td>').attr("id", "f" + articulo_id).append(foto);
				getFoto(articulo_id, columnaFoto);

				// // columna Id (oculta)
				inputId = $('<input />').attr("type", "hidden").attr("name", "data[Orden][" + indice + "][id]").attr("value", articulo_id);
				columnaId = $('<td>').attr("class", "invisible").append(inputId);

				// columna Codigo
				columnaCodigo = $('<td>').attr("id", "c" + articulo_id).append(articulo_id);
				if($('#sin_cargo_ckeckbox').attr('checked')) {
					columnaCodigo.text('Sin Cargo');
				}

				// columna Cantidad
				inputCantidad = $('<input />').attr("class", "cantidad").attr("name", "data[Orden][" + indice + "][Cantidad]").attr("value", cantidad);
				columnaCantidad = $('<td>').append(inputCantidad);

				// columna Unidad
				columnaUnidad = $('<td>').attr("id", "u" + articulo_id).append($('#unidad').html());
				getUnidad(articulo_id, columnaUnidad);

				// columna Artículo
				columnaArticulo = $('<td>').attr("id", "d" + articulo_id);
				columnaArticulo.append($('#lista option:selected').html());

				// columna Observaciones
				inputObservaciones = $('<input />').attr("name", "data[Orden][" + indice + "][Observaciones]").attr("value", $('#articuloObservaciones').val());
				columnaObservaciones = $('<td>').append(inputObservaciones);

				// columna Acciones
				quitar = $('<input />').attr("type", "button").attr("class", "articulo").attr("value", "Quitar");
				$(quitar).click(function() {
					quitarArticulo($(this));
				});
				columnaAcciones = $('<td>').append(quitar);

				// columna para inidicar Artículo Sin Cargo o No (oculta)
				if($('#sin_cargo_ckeckbox').attr('checked')) {
					sinCargo = 1;
				}
				inputSinCargo = $('<input />').attr("type", "hidden").attr("name", "data[Orden][" + indice + "][SinCargo]").attr("value", sinCargo);
				columnaSinCargo = $('<td>').attr("class", "invisible").append(inputSinCargo);

				// agrego las columnas a la fila
				fila.append(columnaId);
				fila.append(columnaFoto);
				fila.append(columnaCodigo);
				fila.append(columnaCantidad);
				fila.append(columnaUnidad);
				fila.append(columnaArticulo);
				fila.append(columnaObservaciones);
				fila.append(columnaAcciones);
				fila.append(columnaSinCargo);

				// agrego la fila a la tabla en la primera posición
				$("#ordenes > tbody").hide().prepend(fila).fadeIn(1000);

				// se suma 1(uno) a la cantidad de artículos del pedido y al serial.
				$('#cantidad_articulos').html(parseInt($('#cantidad_articulos').html()) + 1);
				$('#serial_articulos').html(parseInt($('#serial_articulos').html()) + 1);

				$('#lista').focus();
			} else {
				// si el artículo ya se encuentra en la tabla,
				// se le corrige la cantidad, se le suma la nueva.
				// Ya no se usa, lo dejo por las dudas...
				// corregirCantidad(articulo_id, cantidad);

				// si el artículo ya se encuentra en la tabla,
				// se hace focus en el campo cantidad para corregirlo y se avisa al usuario.
				cantidadFocus(articulo_id);
			}
		} else {
			alert("Verifique la Cantidad.");
			$('#cantidad').focus();
		}
	} else {
		alert("Verifique el Artículo.");
	}
}