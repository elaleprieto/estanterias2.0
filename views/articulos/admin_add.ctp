<div class="articulos form">
	<?php echo $this -> Form -> create('Articulo');?>
	<fieldset>
		<legend>
			<?php __('Add Articulo');?>
		</legend>
		<?php
		echo $this -> Form -> input("id_posicion", array('options' => $articulos, 'label'=>'Agregar después de:'));
		echo $this -> Form -> input('codigo', array(
				'label' => 'Código',
		));
		echo $this -> Form -> input('detalle');
		echo $this -> Form -> input('unidad');
		echo $this -> Form -> input('precio');
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions');?></h3>
	<ul>
		<li>
			<?php echo $this -> Html -> link(__('List Articulos', true), array('action' => 'index'));?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('List Ubicados', true), array(
					'controller' => 'ubicados',
					'action' => 'index'
			));
			?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('New Ubicado', true), array(
					'controller' => 'ubicados',
					'action' => 'add'
			));
			?>
		</li>
	</ul>
</div>