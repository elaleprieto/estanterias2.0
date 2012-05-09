<?php
// debug($pedido['Pedido']['preparacion_orden']);

# Se carga la librería Jquery
echo $javascript -> link(array('jquery-1.7.1.min','pedidos_admin_index'), FALSE);

# Se define la ruta base
echo $javascript -> codeBlock('WEBROOT="'.$this -> Html-> url('/', true).'"');

# Se agregan las CSS
echo $html -> css('pedidos_admin_index');
?>
<div class="pedidos_index">
	<h2 class="pendientes"><?php __('Pedidos Pendientes');?></h2>
	<p class="recargado">Actualizado: <?= date('h:i'); ?></p>
	<table cellpadding="0" cellspacing="0" id='pedidos'>
		<thead>
			<tr>
					<th><?php echo $this -> Paginator -> sort('Número', 'Pedido.id');?></th>
					<th><?php echo $this -> Paginator -> sort('cliente_id');?></th>
					<th><?php echo $this -> Paginator -> sort('Fecha', 'created');?></th>
					<th><?php echo $this -> Paginator -> sort('Artículos', 'articulos');?></th>
					<th><?php echo $this -> Paginator -> sort('progreso');?></th>
					<th><?php echo $this -> Paginator -> sort('Transporte', 'Transporte.nombre');?></th>
					<th><?php echo $this -> Paginator -> sort('observaciones');?></th>
					<th class="actions"><?php __('Acciones');?></th>
					<th><?php echo $this -> Paginator -> sort('Orden', 'preparacion_orden');?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($pedidos as $pedido):
			?>
				<tr>
					<td class="id"><?= $pedido['Pedido']['id']; ?></td>
					<td><?= $pedido['Cliente']['nombre']; ?></td>
					<td><?= $this -> Time -> format($format = 'd/m/Y H:i', $pedido['Pedido']['created']); ?></td>
					<td><?= $pedido['Pedido']['articulos']; ?></td>
					<td><?= sprintf("%.1f %%", $pedido['Pedido']['progreso']); ?></td>
					<td><?= $pedido['Transporte']['nombre']; ?></td>
					<td class="observaciones"><?= $pedido['Pedido']['observaciones']; ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('Editar', true), array('controller' => 'pedidos', 'action' => 'edit', $pedido['Pedido']['id'])); ?>
						<?php echo $this->Html->link(__('Preparar', true), array('admin' => FALSE, 'controller' => 'ordenes', 'action' => 'preparar', $pedido['Pedido']['id'])); ?>
					</td>
					<td><label><?= $pedido['Pedido']['preparacion_orden'];?></label>
						<?
						echo $this -> Html -> image('arrow_down_20.png', array('alt'=> 'down', 'class' => 'arrow_down')); 
						echo $this -> Html -> image('arrow_up_20.png', array('alt'=> 'up', 'class' => 'arrow_up')); 
						?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
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