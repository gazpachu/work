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

$sendTo = "soporte@webmarket.es";
$subject = "mensaje de webmarket.es";

$message .= "<html><head></head><body><font face=\"Verdana\" size=\"2\">";
$message .= "<b>Empresa: </b>" . $_POST["empresa"] . "<br>";
$message .= "<b>Ciudad: </b>" . $_POST["ciudad"] . "<br>";
$message .= "<b>Telefono: </b>" . $_POST["telefono"] . "<br>";
$message .= "<b>Mensaje: </b><br>" . nl2br($_POST["mensaje"]);
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
$headers .= "From: Comercial [Webmarket.es]< soporte@webmarket.es >\r\n";
$headers .= "Reply-To: soporte@webmarket.es\r\n";
$headers .= "To: ". $nombre ." <" .$email . ">\r\n";
 
mail($email, "Soporte - INMO Flash",
"Gracias por su mensaje, $nombre!<br><br>
        
Nos pondremos en contacto con usted lo antes posible.<br><br>

Un saludo!<br><br>

Soporte INMO Flash
Dept. Soporte Webmarket.es
www.webmarket.es/soporte",

$headers);

}
else
{

echo "response=othererror";

}

}

?>