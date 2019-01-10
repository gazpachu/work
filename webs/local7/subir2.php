<?php

// Definimos la ruta para las imagenes
$uploadDir = "imagenes/";
$uploadThumbDir = "imagenes/";
$uploadFile = $uploadDir . utf8_decode($_FILES['Filedata']['name']);
$uploadThumb = $uploadThumbDir . utf8_decode($_FILES['Filedata']['name']);
//$uploadThumb2 = $uploadThumbDir . "2nd_" .$_FILES['Filedata']['name'];

// Obtenemos la información de la imagen
$im_info = getimagesize(utf8_decode($_FILES['Filedata']['tmp_name']));

// Evaluamos si es GIF(1) o JPEG(2)
// y creamos la imagen en GD 
switch($im_info[2])
{
  case 1:
    $imagen = imagecreatefromgif(utf8_decode($_FILES['Filedata']['tmp_name'])); break;
  case 2:
    $imagen = imagecreatefromjpeg(utf8_decode($_FILES['Filedata']['tmp_name'])); break;
}

// Definimos la medida máxima 
$th_max = 150; // de la muestra (thumbnail)
//$th2_max = 300; // de la muestra (thumbnail2) 
$det_max = 600; // de la imagen detalle 

// Evaluamos si la imagen es horizontal
if($im_info[0]>$im_info[1])
{
    // Definimos las medidas de las imagenes 
    $th_w = $th_max;
    $th_h = ($im_info[1]/$im_info[0])*$th_max;
    //$th2_w = $th2_max;
    //$th2_h = ($im_info[1]/$im_info[0])*$th2_max;
    $det_w = $det_max;
    $det_h = ($im_info[1]/$im_info[0])*$det_max;
}
else
{
    $th_w = ($im_info[0]/$im_info[1])*$th_max;
    $th_h = $th_max;
    //$th2_w = ($im_info[0]/$im_info[1])*$th2_max;
    //$th2_h = $th2_max;
    $det_w = ($im_info[0]/$im_info[1])*$det_max;
    $det_h = $det_max;
}

// Creamos las imágenes 
$thumb = imagecreatetruecolor($th_w,$th_h);
//$thumb2 = imagecreatetruecolor($th_w2,$th_h2);
$detalle = imagecreatetruecolor($det_w,$det_h);

// Copiamos la original escalada 
imagecopyresampled($thumb,$imagen,0,0,0,0, $th_w,$th_h,imagesx($imagen),imagesy($imagen));

//imagecopyresampled($thumb2,$imagen,0,0,0,0, $th2_w,$th2_h,imagesx($imagen),imagesy($imagen));

imagecopyresampled($detalle,$imagen,0,0,0,0, $det_w,$det_h,imagesx($imagen),imagesy($imagen));

// Destruimos la imagen original 
imagedestroy($imagen);

// Damos salida a nuestros archivos 
imagejpeg($thumb,$uploadThumb,60);
//imagejpeg($thumb2,$uploadThumb,60);
imagejpeg($detalle,$uploadFile,80);

// Destruimos las imagenes temporales 
imagedestroy($thumb);
//imagedestroy($thumb2);
imagedestroy($detalle);

/*if(move_uploaded_file($_FILES['Filedata']['tmp_name'], $uploadFile) )
{
  echo "&response=passed";
}
else
{
  echo "&response=error";
}*/


?>