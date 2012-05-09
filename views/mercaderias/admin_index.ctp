<?php
# Se agregan las CSS
echo $this -> Html -> css('mercaderias_admin_index');
?>
<div class="mercaderias index">
	<h2><?php __('Ingresos de Mercadería');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Fecha', 'created');?></th>
			<th><?php echo $this->Paginator->sort('articulo_id');?></th>
			<th><?php echo $this->Paginator->sort('cantidad');?></th>
			<th><?php echo $this->Paginator->sort('Stock Previo', 'cantidad_anterior');?></th>
			<th><?php echo $this->Paginator->sort('Stock Actual');?></th>
			<th><?php echo $this->Paginator->sort('observaciones');?></th>
			<th><?php echo $this->Paginator->sort('movimiento');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($mercaderias as $mercaderia):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $this -> Time -> format($format = 'd/m/Y H:i:s', $mercaderia['Mercaderia']['created']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($mercaderia['Articulo']['detalle'], array('controller' => 'articulos', 'action' => 'view', $mercaderia['Articulo']['id'])); ?>
		</td>
		<td><?php echo $mercaderia['Mercaderia']['cantidad']; ?>&nbsp;</td>
		<td><?php echo $mercaderia['Mercaderia']['cantidad_anterior']; ?>&nbsp;</td>
		<td><?php echo ($mercaderia['Mercaderia']['cantidad_anterior'] + $mercaderia['Mercaderia']['cantidad']); ?>&nbsp;</td>
		<td><?php echo $mercaderia['Mercaderia']['observaciones']; ?>&nbsp;</td>
		<td><?php 
				switch($mercaderia['Mercaderia']['movimiento']) {
					case 1: 
						echo $this -> Html -> image('cross.png', array('alt'=> __('ELEFE', true), 'class' => 'ingreso'));
						break;
					default:
						echo $this -> Html -> image('tick.png', array('alt'=> __('ELEFE', true), 'class' => 'ingreso'));
				}
			?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $mercaderia['Mercaderia']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $mercaderia['Mercaderia']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $mercaderia['Mercaderia']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mercaderia['Mercaderia']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
