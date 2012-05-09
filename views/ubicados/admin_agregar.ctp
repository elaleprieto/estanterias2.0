<div class="ubicados form">
	<?php echo $this -> Form -> create('Ubicado');?>
	<fieldset>
		<legend>
			<?php __('Ubicar Artículo');?>
		</legend>
		<?php
			echo $this -> Form -> hidden('articulos', array('value' => $articulos));
			echo $this -> Form -> input('pasillo_id', array('selected' => '24'));
			echo $this -> Form -> input('ubicacion_id');
			echo $this -> Form -> input('estado', array('label' => 'Temporal'));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions');?></h3>
	<ul>
		<li>
			<?php echo $this -> Html -> link(__('List Ubicados', true), array('action' => 'index'));?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('List Articulos', true), array('controller' => 'articulos',
				'action' => 'index'));
			?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('New Articulo', true), array('controller' => 'articulos',
				'action' => 'add'));
			?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('List Ubicaciones', true), array('controller' => 'ubicaciones',
				'action' => 'index'));
			?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('New Ubicacion', true), array('controller' => 'ubicaciones',
				'action' => 'add'));
			?>
		</li>
	</ul>
</div>