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

	/********************************************************************
	 * 								Eventos								*
	 *
	 * 		Aquí se registran los eventos para los objetos de la vista	*
	 ********************************************************************/
	$('#formulario').submit(function(e) {
		return verificar();
	});
	$('input').keypress(function(e) {
		return verificarNumero(e);
	});
	$('input').keyup(function(e) {
		return actualizarBultos(e);
	});
});
/********************************************************************
 * 								Funciones							*
 *
 *				 		Aquí se escriben las funciones				*
 ********************************************************************/
function verificar() {
	var retorno = true;

	// Se verifica que se hayan seleccionado todos los Tipos de Bulto
	$('select').each(function() {
		if(!$(this).val() > 0) {
			$(this).focus();
			$('#mensaje_flotante').removeClass('mensaje_ok').addClass('mensaje_error').text('¡Cuidado! Embalado incompleto.').fadeIn().delay(2000).fadeOut();
			return retorno = false;
		}
	});
	if(!retorno) {
		return retorno;
	}

	// Se verifica que se hayan ingresado todos los N° de Bulto
	$('input').each(function() {
		if(!$(this).val() > 0) {
			$(this).focus();
			return retorno = false;
		}
	});
	return retorno;
}

function verificarNumero(event) {
	var tecla = event.which;

	// tecla = 0 = del
	// tecla = 8 = backspace
	if(tecla == 0 || tecla == 8) {
		return true;
	}

	// tecla = 48 = número 0 (cero)
	// tecla = 57 = número 9 (nueve)
	if(tecla >= 48 && tecla <= 57) {
		var numero = parseInt($(event.target).val() + tecla % 48);
		var bultos = parseInt($('#total').text());
		if(numero > bultos + 1) {
			$('#mensaje_flotante').removeClass('mensaje_ok').addClass('mensaje_error').text('¡Cuidado! Parece que falta el bulto: ' + bultos + 1 + ' antes que el ' + numero + '.').fadeIn().delay(2000).fadeOut();
			return false;
		}
		$('#total').text(bultos + 1);
		return true;
	}
	return false;
}

function actualizarBultos(event) {
	// console.info($(event.target).val());
}