<?php
$targetDir = $_POST["dir"];
if( mkdir($targetDir, 0777) )
{
  echo "&resultado=passed";
}
else
{
  echo "&resultado=error con ".$targetDir;
}
?>