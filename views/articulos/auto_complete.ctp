<?php
	/*    <ul>
	 <?php foreach($articulos as $articulo):
	 ?>
	 <li>
	 <?php echo $articulo['Articulo']['detalle'];
	 ?>
	 </li>
	 <?php endforeach;
	 ?>
	 </ul>
	 */
	echo $html -> nestedList($articulos);
?>
