<div class="ubicaciones index">
	<h2><?php __('Ubicaciones');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo 'id';?></th>
			<th><?php echo 'posicion';?></th>
			<th><?php echo 'altura';?></th>
			<th><?php echo 'created';?></th>
			<th><?php echo 'modified';?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($ubicaciones as $ubicacion):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $ubicacion['Ubicacion']['id']; ?>&nbsp;</td>
		<td><?php echo $ubicacion['Ubicacion']['posicion']; ?>&nbsp;</td>
		<td><?php echo $ubicacion['Ubicacion']['altura']; ?>&nbsp;</td>
		<td><?php echo $ubicacion['Ubicacion']['created']; ?>&nbsp;</td>
		<td><?php echo $ubicacion['Ubicacion']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $ubicacion['Ubicacion']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $ubicacion['Ubicacion']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $ubicacion['Ubicacion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ubicacion['Ubicacion']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>

</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Ubicacion', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Pasillos', true), array('controller' => 'pasillos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pasillo', true), array('controller' => 'pasillos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ubicados', true), array('controller' => 'ubicados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ubicado', true), array('controller' => 'ubicados', 'action' => 'add')); ?> </li>
	</ul>
</div>