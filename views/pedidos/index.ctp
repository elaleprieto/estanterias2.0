<?php //debug($pedidos); ?>
<div class="pedidos_index">
	<h2><?php __('Pedidos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this -> Paginator -> sort('Número', 'Pedido.id');?></th>
			<th><?php echo $this -> Paginator -> sort('cliente_id');?></th>
			<th><?php echo $this -> Paginator -> sort('Fecha', 'created');?></th>
			<th><?php echo $this -> Paginator -> sort('estado');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($pedidos as $pedido):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $pedido['Pedido']['id']; ?>&nbsp;</td>
		<td><?php echo $pedido['Cliente']['nombre']; ?>&nbsp;</td>
		<td>
			<?php
				# Fecha de creación formateada 
				echo $this -> Time -> format($format = 'd/m/Y H:i', $pedido['Pedido']['created']); 
			?>&nbsp;
		</td>
		<td>
			<?php 
				if($pedido['Pedido']['estado']) {
					echo 'Finalizado';
				} else {
					echo 'Pendiente';
				} 
			?>&nbsp;
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Preparar', true), array('controller' => 'ordenes', 'action' => 'preparar', $pedido['Pedido']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página %page% de %pages%, mostrando %current% registros de un total de %count%, empezando en el registro %start%, terminando en %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>