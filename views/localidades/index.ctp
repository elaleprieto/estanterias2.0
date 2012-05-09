<div class="localidades index">
	<h2><?php __('Localidades');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('codigo_postal');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th><?php echo $this->Paginator->sort('provincia_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($localidades as $localidad):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $localidad['Localidad']['id']; ?>&nbsp;</td>
		<td><?php echo $localidad['Localidad']['nombre']; ?>&nbsp;</td>
		<td><?php echo $localidad['Localidad']['codigo_postal']; ?>&nbsp;</td>
		<td><?php echo $localidad['Localidad']['created']; ?>&nbsp;</td>
		<td><?php echo $localidad['Localidad']['modified']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($localidad['Provincia']['id'], array('controller' => 'provincias', 'action' => 'view', $localidad['Provincia']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $localidad['Localidad']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $localidad['Localidad']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $localidad['Localidad']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $localidad['Localidad']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Localidad', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Provincias', true), array('controller' => 'provincias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provincia', true), array('controller' => 'provincias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientes', true), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cliente', true), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
	</ul>
</div>