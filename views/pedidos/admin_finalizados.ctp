<?php //debug($pedidos);?>
<div class="pedidos_index">
	<h2><?php __('Pedidos Finalizados');?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this -> Paginator -> sort('Número', 'Pedido.id');?></th>
			<th><?php echo $this -> Paginator -> sort('cliente_id');?></th>
			<th><?php echo $this -> Paginator -> sort('Creado', 'created');?></th>
			<th><?php echo $this -> Paginator -> sort('Finalizado', 'Pedido.finalizado');?></th>
			<th><?php echo $this -> Paginator -> sort('Tiempo[m]', 'Pedido.tiempo_preparacion');?></th>
			<th><?php echo $this -> Paginator -> sort('Transporte', 'Transporte.nombre');?></th>
			<th><?php echo $this -> Paginator -> sort('Observaciones', 'Pedido.observaciones');?></th>
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
			<td><?php echo $pedido['Pedido']['id'];?>&nbsp;</td>
			<td><?php echo $pedido['Cliente']['nombre'];?>&nbsp;</td>
			<td><?php
			# Fecha de creación formateada
			echo $this -> Time -> format($format = 'd/m/Y H:i', $pedido['Pedido']['created']);
			?>&nbsp; </td>
			<td><?php
			# Fecha de finalización formateada
			echo $this -> Time -> format($format = 'd/m/Y H:i', $pedido['Pedido']['finalizado']);
			?>&nbsp; </td>
			<td><?= sprintf("%.1f", $pedido['Pedido']['tiempo_preparacion'] / 60)?></td>
			<td><?= $pedido['Transporte']['nombre']?></td>
			<td><?= $pedido['Pedido']['observaciones']?></td>
			
			<!------------------------------------------------------------------------------------>
			<!-- 									Acciones									-->
			<!------------------------------------------------------------------------------------>
			<td class="actions">
				<?php echo $this -> Html -> link('Editar', array(
						'controller' => 'pedidos',
						'action' => 'edit',
						$pedido['Pedido']['id']
				));
				?>
				<?php echo $this -> Html -> link('Pendiente', array(
						'controller' => 'pedidos',
						'action' => 'index',
						$pedido['Pedido']['id']
					), null, sprintf('¿Devolver a Pedidos Pendientes el pedido de %s?', $pedido['Cliente']['nombre']));
				?>
				<?php echo $this -> Html -> link(__('Imprimir', true), array(
							'action' => 'imprimir',
							$pedido['Pedido']['id']
					), array('target' => '_blank'));
				?>
				<?php echo $this -> Html -> link('Controlado', array(
						'controller' => 'pedidos',
						'action' => 'controlados',
						$pedido['Pedido']['id']
					), null, sprintf('¿Ha sido controlado el pedido de %s?', $pedido['Cliente']['nombre']));
				?>
			</td>
			</tr> <?php endforeach;?>
	</table>
	<p>
		<?php
		echo $this -> Paginator -> counter(array('format' => __('Página %page% de %pages%, mostrando %current% registros de un total de %count%, empezando en el registro %start%, terminando en %end%', true)));
		?>
	</p>
	<div class="paging">
		<?php echo $this -> Paginator -> prev('<< ' . __('anterior', true), array(), null, array('class' => 'disabled'));?>
		| 	<?php echo $this -> Paginator -> numbers();?>
		|
		<?php echo $this -> Paginator -> next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>