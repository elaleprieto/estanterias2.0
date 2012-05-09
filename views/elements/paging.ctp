<div class="paging listar">
	<?php
	// set url arguements
	$paginator -> options(array('url' => array($filter)));

	// render the previous link
	echo $paginator -> prev('anterior', null, null, null);

	echo " | ";
		
	// set up your alphabet
	$alpha = range('A', 'Z');
	?>
	<?php
	for ($i = 0; $i < count($alpha); $i++) {
		// if current letter is not in the links array, do not make it clickable
		if (!in_array($alpha[$i], $links)) {
			echo "<span class='nolink'>" . $alpha[$i] . "</span>";
		} else {
			if ($alpha[$i] == $filter) {
				echo "<span class='current'>" . $alpha[$i] . "</span>";
			} else {
				echo $html -> link($alpha[$i], array(
						'controller' => strtolower($this -> params['controller']),
						'action' => $accion,
						$alpha[$i]
				), array('class' => 'link')) . "";
			}
		}
		echo " | ";
	}
	// render the 'next' link
	echo $paginator -> next('siguiente', null, null, null);
	?>
</div>