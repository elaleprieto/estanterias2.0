<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('ELEFE :: Sistema de Ubicaciones ::'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('estanterias');
		echo $this->Html->css('supervisor');
		
		echo $this->Html->script(array('jquery-1.7.1.min', 'admin.ctp'));

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<table class="header" cellpadding="0" cellspacing="0">
				<tr>
					<td class="logo">
						<h1 class="default">
						<?php echo $this -> Html -> image('logo_120.png', 
										array('alt'=> __('ELEFE', true), 'class' => 'default_logo')); ?>
						Sistema de Ubicaciones
						</h1>
					</td>
					<td class="header">
						<div class="header" id="boton_pedido">
							<?php echo $this -> Html -> link('Pedidos', array(
									'controller' => 'pedidos',
									'action' => 'add'
							));
							echo $this -> Html -> image('down_arroww.png', array(
									'alt' => '',
									'class' => 'down_arrow'
							));
							?>
						</div>
					</td>
					<!--
					<td class="header">
						<div class="header" id="boton_articulo">
							<?php
							echo $this -> Html -> link('Articulos', array(
									'controller' => 'articulos',
									'action' => 'buscar'
							));
							echo $this -> Html -> image('down_arroww.png', array(
									'alt' => '',
									'class' => 'down_arrow'
							));
							?>
						</div>
					</td>
					<td class="header">
						<div class="header" id="boton_cliente">
							<?php echo $this -> Html -> link('Clientes', array(
									'controller' => 'clientes',
									'action' => 'index'
							));
							echo $this -> Html -> image('down_arroww.png', array(
									'alt' => '',
									'class' => 'down_arrow'
							));
							?>
						</div>
					</td>
					<td class="header">
						<div class="header" id="boton_transporte">
							<?php echo $this -> Html -> link('Transportes', array(
									'controller' => 'transportes',
									'action' => 'index'
							));
							echo $this -> Html -> image('down_arroww.png', array(
									'alt' => '',
									'class' => 'down_arrow'
							));
							?>
						</div>
					</td>
					-->
				</tr>
			</table>
		</div>
		<div id='menu_pedidos'>
			<?php echo $this -> Html -> link('Nuevo', 
					array('controller' => 'pedidos', 'action' => 'add')); ?>
			<br />
			<?php echo $this -> Html -> link('Pendientes', 
					array('controller' => 'pedidos', 'action' => 'index')); ?>
			<br />
			<?php echo $this -> Html -> link('Finalizados', 
					array('controller' => 'pedidos', 'action' => 'finalizados')); ?>
			<?php echo $this -> Html -> link('Controlados', 
					array('controller' => 'pedidos', 'action' => 'controlados')); ?>
			<?php echo $this -> Html -> link('Estadísticas', 
					array('controller' => 'pedidos', 'action' => 'estadisticas')); ?>
		</div>
		<div id='menu_articulos'>
			<?php echo $this -> Html -> link('Buscar', 
					array('controller' => 'articulos', 'action' => 'buscar')); ?>
			<br />
			<?php echo $this -> Html -> link('Listar', 
					array('controller' => 'articulos', 'action' => 'index')); ?>
			<br />
			<?php echo $this -> Html -> link('Ubicados', 
					array('controller' => 'ubicados', 'action' => 'index')); ?>
			<br />
			<?php echo $this -> Html -> link('Desubicados', 
					array('controller' => 'articulos', 'action' => 'listar')); ?>
			<br />
			<?php echo $this -> Html -> link('Etiquetas Mini', 
					array('controller' => 'articulos', 'action' => 'etiquetas_mini')); ?>
			<?php echo $this -> Html -> link('Faltantes', 
					array('controller' => 'ordenes', 'action' => 'faltantes')); ?>
		</div>
		<div id='menu_clientes'>
			<?php echo $this -> Html -> link('Buscar', 
					array('controller' => 'clientes', 'action' => 'buscar')); ?>
			<br />
			<?php echo $this -> Html -> link('Nuevo', 
					array('controller' => 'clientes', 'action' => 'add')); ?>
			<br />
			<?php echo $this -> Html -> link('Listar', 
					array('controller' => 'clientes', 'action' => 'index')); ?>
			<br />
			<?php echo $this -> Html -> link('Etiquetas', 
					array('controller' => 'clientes', 'action' => 'etiquetas')); ?>
		</div>
		<div id='menu_transportes'>
			<?php echo $this -> Html -> link('Nuevo', 
					array('controller' => 'transportes', 'action' => 'add')); ?>
			<br />
			<?php echo $this -> Html -> link('Listar', 
					array('controller' => 'transportes', 'action' => 'index')); ?>
		</div>
		<div id="content">
			<?php 
				# Se carga el preloader
				// echo $this -> element('preloader');
			?>
			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>