<div class="ubicados form">
	<?php echo $this -> Form -> create('Ubicado');?>
	<fieldset>
		<legend>
			<?php __('Ubicar Artículo');?>
		</legend>
		<h3><?php echo $articulo['Articulo']['detalle']; ?></h3>
		<?php
		echo $this -> Form -> hidden('articulo_id', array('value' => $articulo['Articulo']['id']));
		echo $this -> Form -> input('pasillo_id', array(
				'selected' => '25',
				'div' => 'pasillos'
		));
		echo $this -> Form -> submit('Ubicar', array('div' => 'pasillos ubicar', 'class' => 'ubicar'));
		echo $this -> Form -> input('posicion', array(
				'options' => $posiciones,
				'selected' => '01',
				'label' => 'Posición',
				'class' => 'posiciones'
		));
		echo $this -> Form -> input('altura', array(
				'options' => $alturas,
				'selected' => '1',
				'label' => 'Altura',
				'class' => 'alturas'
		));
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