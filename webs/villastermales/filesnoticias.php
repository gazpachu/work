<?php

$uploadName = utf8_decode($_GET["filename"]);
$uploadDir = utf8_decode($_GET["dir"]);

$uploadFile = $uploadDir . $uploadName;

if(move_uploaded_file($_FILES['Filedata']['tmp_name'], $uploadFile))
{
	echo( '1 ' . $_FILES['Filedata']['name']);
}
else
{
	echo( '0' . $_FILES['Filedata']['name']);
}

?>