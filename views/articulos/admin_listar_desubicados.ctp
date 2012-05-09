<?php
	# Se cargan las librería JavaScript
	echo $javascript -> link('prototype');
	echo $javascript -> link('scriptaculous');
	# Se define la ruta base
	echo $javascript -> codeBlock('WEBROOT="../"', 
		$options = array('allowCache'=>true,'safe'=>true,'inline'=>true));

	# Se crean las funciones auxiliares
	# (en webroot/js) 
	echo $javascript -> link('articulos_listar_desubicados');
?>
<div class="articulos index">
	<h2><?php __('Articulos');?></h2>
	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('detalle');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	echo $this -> Form -> create(null, array('url' => array('controller' => 'ubicados', 'action' => 'agregar')));
	$i = 0;
	$articuloN = 0;
	foreach ($articulos as $articulo):
		$class = null;
		$articuloN++;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr id="tr<?php echo $articulo['Articulo']['id']; ?>" <?php echo $class;?>>
		<td>
			<?php 
				echo $this -> Form -> hidden('Articulos.'.$articuloN.'.id', 
								array('value' => $articulo['Articulo']['id']));
				echo $this -> Form -> input('Articulos.'.$articuloN.'.estado', 
								array('label' => FALSE, 'type' => 'checkbox', 'div' => FALSE));
			?>&nbsp;
		</td>
		<td><?php echo $articulo['Articulo']['id']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['detalle']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ubicar', true), array('controller' => 'ubicados', 'action' => 'add', $articulo['Articulo']['id'])); ?>
		</td>
	</tr>
	<?php
		# Definición del evento JavaScript que cambia el estilo y tilda el checkbox
		# cada vez que se hace clic.
		# La función cambiar_estilo(fila_id) se encuentra en el archivo 
		# webroot/js/articulos_listar_desubicados.js
		echo $javascript -> event('tr'.$articulo['Articulo']['id'], 'click', 'cambiar_estilo("tr'.$articulo['Articulo']['id'].'", "Articulos'.$articuloN.'Estado")');
	?>
<?php endforeach; ?>
<?php echo $this -> Form -> end(__('Agregar', true));?>
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
		<li><?php echo $this->Html->link(__('Listar Artículos', true), array('controller' => 'articulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Ubicados', true), array('controller' => 'ubicados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Pasillo', true), array('controller' => 'pasillos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Posición', true), array('controller' => 'ubicacion', 'action' => 'add')); ?> </li>
	</ul>
</div>