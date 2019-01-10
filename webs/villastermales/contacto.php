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

include("db.php");

$fecha = date("d/m/Y");
$ip = $_SERVER[REMOTE_ADDR];// obtenemos ip del usuario  		
$sql = "INSERT INTO stats_email (ip, fecha) VALUES ('$ip', '$fecha')";
query($sql);
                

$sendTo = "villastermales@femp.es";
$subject = "mensaje desde villastermales.com";

$message .= "<html><head></head><body><font face=\"Verdana\" size=\"2\">";
$message .= "<b>Tel&eacute;fono de contacto: </b>" . nl2br($_POST["telefono"]);
$message .= "<br>" . nl2br($_POST["mensaje"]);
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
$headers .= "From: VillasTermales< villastermales@femp.es >\r\n";
$headers .= "Reply-To: villastermales@femp.es\r\n";
$headers .= "To: ". $nombre ." <" .$email . ">\r\n";
 
mail($email, "Mensaje recibido!",
"Gracias por su mensaje, $nombre!<br><br>
        
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