<div class="articulos index">
	<h2><?php __('Articulos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this -> Paginator -> sort('foto');?></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('detalle');?></th>
			<th><?php echo $this->Paginator->sort('unidad');?></th>
			<th><?php echo $this->Paginator->sort('precio');?></th>
			<th><?php echo $this->Paginator->sort('stock');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($articulos as $articulo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php 
				# Se verifica la existencia de la foto del artículo en el directorio,
				# si no existe se carga la foto "nofoto.png"
				$imagen = $this -> Foto -> articulo($articulo['Articulo']['foto']);
				echo $this -> Html -> image($imagen, array('class' => 'ubicados_index'));
			?>
			&nbsp;
		</td>
		<td><?php echo $articulo['Articulo']['id']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['detalle']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['unidad']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['precio']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['stock']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['created']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $articulo['Articulo']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $articulo['Articulo']['id'])); ?>
			<?php echo $this->Html->link(__('Set Stock', true), array('action' => 'set_stock', $articulo['Articulo']['id'])); ?>
			<?php echo $this->Html->link(__('Fotografiar', true), array('action' => 'fotografiar', $articulo['Articulo']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $articulo['Articulo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $articulo['Articulo']['id'])); ?>
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
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Listar Ubicados', true), array('controller' => 'ubicados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Desubicados', true), array('controller' => 'articulos', 'action' => 'listar_desubicados')); ?> </li>
	</ul>
</div>