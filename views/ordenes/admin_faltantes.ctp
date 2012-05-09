<?php
# Se agregan las CSS
echo $html -> css('ordenes_admin_faltantes');

echo $form -> create('Ordenes');
if (isset($fechaInicio)) {
	$diaInicio = $fechaInicio['day'];
	$mesInicio = $fechaInicio['month'];
	$añoInicio = $fechaInicio['year'];
} else {
	$diaInicio = date('d');
	$mesInicio = date('m');
	$añoInicio = date('Y');
}
if (isset($fechaFin)) {
	$diaFin = $fechaFin['day'];
	$mesFin = $fechaFin['month'];
	$añoFin = $fechaFin['year'];
} else {
	$diaFin = date('d');
	$mesFin = date('m');
	$añoFin = date('Y');
}
?>
<table cellpadding="0" cellspacing="0">
	<tr>
		<td><?php echo $form -> label('Fecha Inicial');?></td>
		<td><?php echo $form -> label('Fecha Final');?></td>
		<td><?php echo $form -> label('Cliente');?></td>
		<td><?php echo $form -> label('Articulo');?></td>
	</tr>
	<tr>
		<td><?php
		echo $form -> day('fechaInicio', $diaInicio, array('empty' => FALSE));
		echo $form -> month('fechaInicio', $mesInicio, array('empty' => FALSE));
		echo $form -> year('fechaInicio', 2000, date('Y'), $añoInicio, array('empty' => FALSE));
		?></td>
		<td><?php
		echo $form -> day('fechaFin', $diaFin, array('empty' => FALSE));
		echo $form -> month('fechaFin', $mesFin, array('empty' => FALSE));
		echo $form -> year('fechaFin', 2000, date('Y'), $añoFin, array('empty' => FALSE));
		?></td>
		<td><?php echo $form -> input('cliente', array(
					'empty' => '(Todos)',
					'label' => FALSE,
					'div' => FALSE
			));
		?></td>
		<td><?php echo $form -> input('articulo', array(
					'empty' => '(Todos)',
					'label' => FALSE,
					'div' => FALSE
			));
		?></td>
	</tr>
	<tr>
		<td colspan="4"><?php
		echo $this -> Form -> submit('Filtrar', array('div' => FALSE));
		?></td>
	</tr>
</table>
<?php
echo $this -> Form -> end();
?>

<!-- Cabeceras -->
<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Código</th>
			<th>Cantidad Pedida</th>
			<th>Cantidad Enviada</th>
			<th>Stock</th>
			<th>Articulo</th>
			<th>Cliente</th>
		</tr>
	</thead>
	<tbody>
		<?php
// debug($ordenes);
foreach($ordenes as $orden){
		?>
		<tr>
			<td><?= $this -> Time -> format($format = 'd/m/Y', $orden[0]['finalizado']) ?></td>
			<td><?= $orden[0]['articulo_id'] ?></td>
			<td><?= $orden[0]['cantidad_original'] ?></td>
			<td><?= $orden[0]['cantidad'] ?></td>
			<td><?= $orden[0]['stock'] ?></td>
			<td class="articulo"><?= $orden[0]['detalle'] ?></td>
			<td class="cliente"><?= $orden[0]['nombre'] ?></td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>