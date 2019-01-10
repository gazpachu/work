<?php

require("phpmailer/class.phpmailer.php");

$pais = $_POST["pais"];
$senderName = utf8_decode($_POST["senderName"]);
$subject = utf8_decode($_POST["subject"]);
$message = nl2br(utf8_decode($_POST["message"]));
$signature = utf8_decode($_POST["signature"]);

$mail = new PHPMailer();
$mail->PluginDir = "phpmailer/";
$mail->SetLanguage('es', './phpmailer/language/');

$mail->From     = "info@baxtermead.es";
$mail->FromName = $senderName;
$mail->Host     = "mail.baxtermead.es";
$mail->Mailer   = "smtp";
$mail->SMTPAuth = true;
$mail->Username = "info@webmarket.es";
$mail->Password = "53461059";
$mail->Timeout = 30;
$mail->Subject  = $subject;

mysql_connect("localhost","david_david","53461059");
mysql_select_db("david_baxter");
$query  = "SELECT usuarios.email, usuarios.nombre FROM usuarios, destinos WHERE usuarios.id_usuario = destinos.id_usuario AND destinos.destino = " . "'$pais'";
$result = mysql_query($query);

while($row = mysql_fetch_array($result))
{
    // HTML body
	$body = "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"></head><body>";
    $body .= "<font face=\"Verdana\" size=\"2\">Hola <b>" . $row["nombre"] . "</b>,<br /><br />";
	$body .= $message;
    $body .= "<br /><br />Puede obtener más información <a href=\"http://www.baxtermead.es/index.html?pais=" . utf8_decode($pais) . "\">aqui</a><br /><br />";
    $body .= $signature;
	$body .= "</font></body></html>";

    // Plain text body (for mail clients that cannot read HTML)
    $text_body  = "Hola " . $row["nombre"] . ", \n\n";
	$text_body .= $message;
    $text_body .= "Puede obtener más información aqui:\n\n";
	$text_body .= "http://www.baxtermead.es\index.html?pais=" . utf8_decode($pais) . "\n\n";
	$text_body .= $signature;

    $mail->Body    = $body;
    $mail->AltBody = $text_body;
    $mail->AddAddress($row["email"], $row["nombre"]);

    if(!$mail->Send())
        echo "response=Error-> " . $row["nombre"] . " " . $row["email"] . " " . $mail->ErrorInfo . " " . "\n";
	else
		echo "response=OK-> " . $row["nombre"] . " " . $row["email"] . "\n";

    // Clear all addresses and attachments for next loop
    $mail->ClearAddresses();
}

?>