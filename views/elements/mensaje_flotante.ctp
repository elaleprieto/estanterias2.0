<?php
# Se agregan las CSS
echo $html -> css('mensaje_flotante');
?>
<div id="mensaje_flotante" class="mensaje_error">
  <?= $mensaje; ?>
</div>