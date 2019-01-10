<?php
$targetDir = $_POST["dir"];

function deleteDir($dir)
{
   if (substr($dir, strlen($dir)-1, 1) != '/')
       $dir .= '/';

   if ($handle = opendir($dir))
   {
       while ($obj = readdir($handle))
       {
           if ($obj != '.' && $obj != '..')
           {
               if (is_dir($dir.$obj))
               {
                   if (!deleteDir($dir.$obj))
                       return false;
               }
               elseif (is_file($dir.$obj))
               {
                   if (!unlink($dir.$obj))
                       return false;
               }
           }
       }

       closedir($handle);

       if (!@rmdir($dir))
           return false;
       return true;
   }
   return false;
}

if( deleteDir($targetDir) )
{
  echo "&resultado=passed";
}
else
{
  echo "&resultado=error con ".$targetDir;
}
?>