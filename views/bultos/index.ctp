<div class="bultos index">
	<h2><?php __('Bultos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('categoria');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($bultos as $bulto):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $bulto['Bulto']['id']; ?>&nbsp;</td>
		<td><?php echo $bulto['Bulto']['categoria']; ?>&nbsp;</td>
		<td><?php echo $bulto['Bulto']['created']; ?>&nbsp;</td>
		<td><?php echo $bulto['Bulto']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $bulto['Bulto']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $bulto['Bulto']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $bulto['Bulto']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bulto['Bulto']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Bulto', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Ordenes', true), array('controller' => 'ordenes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Orden', true), array('controller' => 'ordenes', 'action' => 'add')); ?> </li>
	</ul>
</div>