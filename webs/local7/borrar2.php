<?php
$targetFile = $_GET["imagen"];
$targetFile2 = $_GET["thumb"];
if(unlink($targetFile))
{
  	if(unlink($targetFile2))
	{
		echo "&response=passed";
	}
	else
	{
	  	echo "&response=error";
	}
}
else
{
	echo "&response=error";
}

?>