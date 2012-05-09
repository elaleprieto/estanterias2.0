<?php
// debug($articulos);

# Se carga la librería Jquery
echo $javascript -> link(array(
		'jquery-1.7.1.min',
		'jquery-ui-1.8.4.custom.min',
		'jquery.autocomplete.min'
), FALSE);
?>
<ul id="sortable">
	<li class="ui-state-default">
		<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1
	</li>
	<li class="ui-state-default">
		<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2
	</li>
	<li class="ui-state-default">
		<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3
	</li>
	<li class="ui-state-default">
		<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4
	</li>
	<li class="ui-state-default">
		<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5
	</li>
	<li class="ui-state-default">
		<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6
	</li>
	<li class="ui-state-default">
		<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7
	</li>
</ul>
<?= $ajax -> sortable('sortable');?>

<style>
.ac_results {
	padding: 0px;
	border: 1px solid black;
	background-color: white;
	overflow: hidden;
	z-index: 99999;
	color: black;
}

.ac_results ul {
	width: 100%;
	list-style-position: outside;
	list-style: none;
	padding: 0;
	margin: 0;
}

.ac_results li {
	margin: 0px;
	padding: 2px 5px;
	cursor: default;
	display: block;
	/* 
	if width will be 100% horizontal scrollbar will apear 
	when scroll mode will be used
	*/
	/*width: 100%;*/
	font: menu;
	font-size: 12px;
	/* 
	it is very important, if line-height not setted or setted 
	in relative units scroll will be broken in firefox
	*/
	line-height: 16px;
	overflow: hidden;
}

.ac_loading {
	background: white url('indicator.gif') right center no-repeat;
}

.ac_odd {
	background-color: #eee;
}

.ac_over {
	background-color: #0A246A;
	color: white;
}

</style>
<?php echo $form->create('Pedido', array('url' => '/ajax/view')); ?>
	<?php echo $ajax->autoComplete('Pedido.articulo', '/pedidos/autoComplete', array('id' => 'articulo_autocomplete'))?>
<?php echo $form->end('View Post')?>
            