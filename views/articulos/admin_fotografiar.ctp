<?php
# Se agregan las CSS
echo $this -> Html -> css('admin_articulos_fotografiar');
?>
<div class="foto">
	<?php echo $this -> Form -> create('Articulo', array('enctype' => 'multipart/form-data'));?>
	<fieldset>
		<legend>
			<?php __('Fotografiar Articulo');?>
		</legend>
		<h3><?php echo $this -> data['Articulo']['detalle'];?></h3>
		<?php
		echo $this -> Form -> input('id');
		echo $this -> Form -> input('Articulo.archivo', array(
				'between' => '<br />',
				'type' => 'file',
				'label' => FALSE
		));
		echo $this -> Form -> end(__('Actualizar', true));
		?>
	</fieldset>
	<?php echo $this -> Form -> end();?>
</div>
