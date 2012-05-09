<?php
	/* /app/views/helpers/foto.php */
	/**
	 * Este Helper se crea para ayudar con todo lo referente al tratamiento de fotos
	 * dentro del sistema.
	 */
	class FotoHelper extends AppHelper {

		/**
		 * articulo($archivo) recibe el nombre del archivo y verifica si existe
		 * una foto con ese nombre, si no existe devuelve la foto "nofoto.png".
		 * Dentro de la verificación, prueba con las extensiones "jpg" y "png".
		 */
		public function articulo($archivo) {
			if (file_exists('img/articulos/' . $archivo . '.jpg')) {
				$archivo = 'articulos/'.$archivo.'.jpg';
			} elseif (file_exists('img/articulos/' . $archivo . '.png')) {
				$archivo = 'articulos/'.$archivo.'.png';
			} else {
				$archivo = 'articulos/nofoto.png';
			}

			return $archivo;
		}
		
		/**
		 * articulo($archivo) recibe el nombre del archivo y verifica si existe
		 * una foto con ese nombre, si no existe devuelve la foto "nofoto.png".
		 * Dentro de la verificación, prueba con las extensiones "jpg" y "png".
		 */
		function existe($archivo) {
			$directorio = IMAGES_URL . 'articulos/';
			if(file_exists($directorio . $archivo . '.jpg') || file_exists($directorio . $archivo . '.png')) {
				return TRUE;
			}
			return FALSE;
		}
	}
?>
