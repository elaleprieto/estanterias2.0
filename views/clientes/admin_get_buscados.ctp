<?php
// debug($clientes);
?>

<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?= 'Código';?></th>
		<th><?= 'Nombre';?></th>
		<th><?= 'Dirección';?></th>
		<th><?= 'CUIT';?></th>
		<th><?= 'Bonificación';?></th>
		<th><?= 'Localidad';?></th>
		<th><?= 'Provincia';?></th>
		<th><?= 'IVA';?></th>
		<th class="actions">Acciones</th>
	</tr>
	<?php
	$i = 0;
	foreach ($clientes as $cliente):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
		# no sé por qué la consulta personalizada del controller genera un array dentro del otro,
		# acá lo que se hace es corrigirlo para trabajar con el array interno que es el que interesa.
		$cliente = $cliente[0];
	?>
	<tr<?php echo $class;?>>
		<td><?= $cliente['id']; ?></td>
		<td><?php echo $this -> Html -> link($cliente['nombre'], array('controller' => 'clientes',
			'action' => 'view',
			$cliente['id']));
		?></td>
		<td><?= $cliente['direccion']; ?></td>
		<td><?= $cliente['cuit']; ?></td>
		<td><?= $cliente['bonificacion']; ?></td>
		<td><?= $cliente['localidad']; ?></td>
		<td><?= $cliente['provincia']; ?></td>
		<td><?= $cliente['iva']; ?></td>
		
		<td class="actions">
			<?php echo $this->Html->link('Ver', array('action' => 'view', $cliente['id'], 'admin' => TRUE)); ?>
			<?php echo $this->Html->link('Editar', array('action' => 'edit', $cliente['id'])); ?>
			<?php echo $this->Html->link('Etiquetar', array('action' => 'etiquetas', $cliente['id'])); ?>
		</td>
		</tr> <?php endforeach;?>
</table>