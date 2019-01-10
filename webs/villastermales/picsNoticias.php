<?php

// Parcheado para nombres de archivo personalizados y simples

// Definimos la ruta para las imagenes
$uploadName = utf8_decode($_GET["filename"]);
$uploadDir = utf8_decode($_GET["dir"]);
$uploadThumbDir = utf8_decode($_GET["thumbdir"]);
$uploadFile = $uploadDir . $uploadName;
$uploadThumb = $uploadThumbDir . $uploadName;

// Obtenemos la información de la imagen
$im_info = getimagesize($_FILES['Filedata'] ['tmp_name']);

// Creamos la imagen en GD 
$imagen = imagecreatefromjpeg(utf8_decode($_FILES['Filedata'] ['tmp_name']));

// Definimos la medida máxima
$th_max = 160; // de la muestra (thumbnail)
$det_max = 600; // de la imagen detalle

// Evaluamos si la imagen es horizontal
if($im_info[0]>$im_info[1])
{
    // Definimos las medidas de las imagenes
    $th_w = $th_max;
    $th_h = ($im_info[1]/$im_info[0])*$th_max;
    $det_w = $det_max;
    $det_h = ($im_info[1]/$im_info[0])*$det_max;
}
else
{
		$th_w = ($im_info[0]/$im_info[1])*$th_max;
    $th_h = $th_max;
    $det_w = ($im_info[0]/$im_info[1])*$det_max;
    $det_h = $det_max;
}

// Creamos las imágenes
$thumb = imagecreatetruecolor($th_w,$th_h);
$detalle = imagecreatetruecolor($det_w,$det_h);

// Copiamos la original escalada
imagecopyresampled($thumb,$imagen,0,0,0,0, $th_w,$th_h,imagesx($imagen),imagesy($imagen));
imagecopyresampled($detalle,$imagen,0,0,0,0, $det_w,$det_h,imagesx($imagen),imagesy($imagen));

// Destruimos la imagen original 
imagedestroy($imagen);

// Damos salida a nuestros archivos
imagejpeg($thumb,$uploadThumb,80);
imagejpeg($detalle,$uploadFile,80);

// Destruimos las imagenes temporales
imagedestroy($thumb);
imagedestroy($detalle);

?>