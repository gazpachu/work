<?php
$targetFile = $_POST["imagen"];
$targetFile2 = $_POST["thumb"];
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