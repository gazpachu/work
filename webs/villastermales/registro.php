<?php

$email = $_POST["email"];
$nombre= $_POST["nombre"];

if (!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$", $email))
{
	echo "response=emailerror";
}
else if (($length = strlen($nombre))<1 )
{
	echo "response=nameerror";
}
else
{ 	

$sendTo = "joan@webmarket.es";
$subject = "registro de usuario en villastermales.com";

$message .= "<html><head></head><body><font face=\"Verdana\" size=\"2\">";
$message .= "<b>Nombre del balneario: </b>" . nl2br($_POST["nombreBalneario"]);
$message .= "<b>Nombre: </b>" . nl2br($_POST["nombre"]);
$message .= "<b>Apellidos: </b>" . nl2br($_POST["apellidos"]);
$message .= "<b>Direcci&oacute;n: </b>" . nl2br($_POST["direccion"]);
$message .= "<b>Provincia: </b>" . nl2br($_POST["provincia"]);
$message .= "<b>Poblaci&oacute;n: </b>" . nl2br($_POST["poblacion"]);
$message .= "<b>Cod.Postal: </b>" . nl2br($_POST["cp"]);
$message .= "<b>E-mail: </b>" . nl2br($_POST["email"]);
$message .= "<b>Movil: </b>" . nl2br($_POST["movil"]);
$message .= "<b>Tel&eacute;fono: </b>" . nl2br($_POST["telefono"]);
$message .= "<b>Usuario: </b>" . nl2br($_POST["usuario"]);
$message .= "<b>Clave: </b>" . nl2br($_POST["clave"]);
$message .= "<br></font></body></html>";

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";   
$headers .= "From: " . $_POST["nombre"] ." <" . $_POST["email"] .">\r\n";
$headers .= "Reply-To: " . $_POST["email"] . "\r\n";
$headers .= "Return-path: " . $_POST["email"];

$success = mail($sendTo, $subject, $message, $headers);

if($success)
{

echo "response=passed";

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: VillasTermales< info@villastermales.com >\r\n";
$headers .= "Reply-To: info@villastermales.com\r\n";
$headers .= "To: ". $nombre ." <" .$email . ">\r\n";
 
mail($email, "Mensaje recibido!",
"Gracias por su solicitud, $nombre!<br><br>
        
Nos pondremos en contacto lo antes posible.<br><br>

Atentamente,<br><br>

VillasTermales.com",

$headers);

}
else
{

echo "response=othererror";

}

}

?>