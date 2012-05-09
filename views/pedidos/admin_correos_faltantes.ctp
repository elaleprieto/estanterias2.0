<?php
App::import('Lib', 'phpMailer/class.phpmailer');
App::import('Lib', 'phpMailer/class.smtp');

// require(‘class.phpmailer.php’);
// require(‘class.smtp.php’);
$mail = new PHPMailer();
$body = "<b>A continuación se detallan los artículos faltantes: </b>";
$mail -> IsSMTP();

# la dirección del servidor, p. ej.: smtp.servidor.com
$mail -> Host = "smtp.googlemail.com";

# dirección remitente, p. ej.: no-responder@miempresa.com
$mail -> From = "compras@elefe.com.ar";

# nombre remitente, p. ej.: "Servicio de envío automático"
$mail -> FromName = "Departamento de Compras";

# asunto y cuerpo alternativo del mensaje
$mail -> Subject = "Artículos Faltantes";
$mail -> AltBody = "A continuación se detallan los artículos faltantes:";

# si el cuerpo del mensaje es HTML
$mail -> MsgHTML($body);

# podemos hacer varios AddAdress
$mail -> AddAddress("aleprieto@elefe.com.ar", "Alejandro Prieto");

# si el SMTP necesita autenticación
$mail -> SMTPAuth = true;

# credenciales usuario
$mail -> Username = "compras@elefe.com.ar";
$mail -> Password = "!$4S3guRo4$!";
if (!$mail -> Send()) {
	echo "Error enviando: " . $mail -> ErrorInfo;
} else {
	echo "¡¡Enviado!!";
}
?>