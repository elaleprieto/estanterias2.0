<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li>
			<?php echo $this->Html->link('Listar Pedidos', array('controller' => 'pedidos','action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Listar Ubicados', array('controller' => 'ubicados', 'action' => 'index')); ?> 
		</li>
	</ul>
</div>