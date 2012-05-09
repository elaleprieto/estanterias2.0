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
	
	/**
	 * Aquí se registra el cambio de estilo de la fila y se tilda el checkbox cuando se selecciona.
	 * @call: es llamada por articulos/admin_listar.ctp cuando se hace clic en la fila.
	 */
	$('div.articulo').click(function(){
		if($(this).css('backgroundColor') == 'rgb(255, 153, 0)') {
			$(this).css({backgroundColor: ''});
			$('input[type="checkbox"]', this).removeAttr('checked');
		} else {
			$(this).css({backgroundColor: '#FF9900'});
			$('input[type="checkbox"]', this).attr('checked', 'checked');
		}
	});
});