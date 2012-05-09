<?php
	echo $articulo['Articulo']['stock'] ? $articulo['Articulo']['stock'] : sprintf("%.2f", $articulo['Articulo']['stock']);
?>