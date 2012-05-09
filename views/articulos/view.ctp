<div class="articulos view">
<h2><?php  __('Articulo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Codigo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $articulo['Articulo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Detalle'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $articulo['Articulo']['detalle']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Unidad'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $articulo['Articulo']['unidad']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Stock'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $articulo['Articulo']['stock']; ?>
			&nbsp;
		</dd>
		<?php if(!empty($ubicacion)) { 
				# Aquí se verifica si el artículo tiene asignada una ubicación	
		?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pasillo'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $ubicacion['Pasillo']['nombre']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lado'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $ubicacion['Pasillo']['lado']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Posición'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $ubicacion['Ubicacion']['posicion']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Altura'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $ubicacion['Ubicacion']['altura']; ?>
				&nbsp;
			</dd>
		<?php } else {
				# Si el artículo no tiene asignada una ubicación, se escribe una ubicación vacía	
		?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ubicación'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				Artículo sin ubicación FIJA cargada.
				&nbsp;
			</dd>
		<?php } ?>
		<dt><?php __('Foto'); ?></dt>
		<dd>
			<?php 
			# Se verifica la existencia de la foto del artículo en el directorio,
			# si no existe se carga la foto "nofoto.png"
			$foto = $this -> Foto -> articulo($articulo['Articulo']['foto']);
			echo $this -> Html -> image($foto, array('class' => 'articulo_view')); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Listar Ubicados', true), array('controller' => 'ubicados', 'action' => 'index')); ?> </li>
	</ul>
</div>
