<?php

function query ($sql)
	   {
	    		$conex= mysql_connect("localhost","gazpachu_termal","LamOfn11") or die("no se puede conectar porque ".mysql_error());
					mysql_select_db("gazpachu_villas");
					$result = mysql_query($sql);
					mysql_close($conex);				   
	   			return $result;
	   }

?>