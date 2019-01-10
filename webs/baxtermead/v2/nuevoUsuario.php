<?php

require("phpmailer/class.phpmailer.php");

$email = $_POST["email"];
$nombre = utf8_decode($_POST["nombre"]);
$usuario = $_POST["username"];
$pass = $_POST["pass"];
$smtpuser = "info@baxtermead.es";
$smtppass = "53461059";
$mailhost = "mail.baxtermead.es";

if (!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$", $email))
{
	echo "response=emailerror";
}
else
{

	$mail = new PHPMailer();
	$mail->PluginDir = "phpmailer/";
	$mail->Host     = $mailhost;
	$mail->Mailer   = "smtp";
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = $smtpuser;  // SMTP username
	$mail->Password = $smtppass; // SMTP password
	
	$mail->From     = "info@baxtermead.es";
	$mail->FromName = "[Baxtermead.es]";
	$mail->Subject  = "Alta como cliente en Baxtermead.es";
	
	// HTML body
	$body .= "<font face=\"Verdana\" size=\"2\">";
	$body .= "<b>Gracias por registrarte en Baxtermead.es!</b><br><br>";
	$body .= "Tu nombre de usuario es: <b>" . $usuario . "</b><br>";
	$body .= "Tu contraseña es: <b>" . $pass . "</b><br><br>";
	$body .= "A partir de ahora ya puedes entrar al menu privado de clientes.<br><br>";
	$body .= "Atentamente,<br><br>";
	$body .= "Dpto. de soporte<br>";
	$body .= "www.baxtermead.es<br>";
	$body .= "<br></font>";
	
	// Plain text body (for mail clients that cannot read HTML)
	$text_body .= "Gracias por registrarte en Baxtermead.es!\n\n";
	$text_body .= "Tu nombre de usuario es: " . $usuario . "\n";
	$text_body .= "Tu contraseña es: " . $pass . "\n\n";
	$text_body .= "A partir de ahora ya puedes entrar al menu privado de clientes.\n\n";
	$text_body .= "Atentamente,\n\n";
	$text_body .= "Dpto. de soporte\n";
	$text_body .= "www.baxtermead.es\n";
	
	$mail->Body    = $body;
	$mail->AltBody = $text_body;
	$mail->AddAddress($email, $nombre);
	
	if(!$mail->Send())
	{
	    echo "response=othererror";
	}
	else
	{
		$mail = new PHPMailer();
		$mail->PluginDir = "phpmailer/";
		$mail->Host     = $mailhost;
		$mail->Mailer   = "smtp";
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = $smtpuser;  // SMTP username
		$mail->Password = $smtppass; // SMTP password
	
		$mail->From     = "info@baxtermead.es";
		$mail->FromName = "[Baxtermead.es]";
		$mail->Subject  = "Alta de cliente en Baxtermead.es";
		
		// HTML body
		$body = "<font face=\"Verdana\" size=\"2\">";
		$body .= "<b>$nombre</b> se ha registrado como cliente en baxtermead.es<br><br>";
		$body .= "Mensaje auto generado desde baxtermead.es";
		$body .= "<br></font>";
	
		// Plain text body (for mail clients that cannot read HTML)
		$text_body = "$nombre se ha registrado como cliente en baxtermead.es\n\n";
		$text_body .= "Mensaje auto generado desde baxtermead.es";
		
		$mail->Body    = $body;
	    $mail->AltBody = $text_body;
	    $mail->AddAddress("info@baxtermead.es", "Baxtermead España");
		$mail->Send();
	
		echo "response=passed";
	}
}

?>