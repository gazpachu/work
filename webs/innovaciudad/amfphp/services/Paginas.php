<?php

class Paginas
{
	   function Paginas()
	   {
		   $this->methodTable = array
		   (
		   		"contar" => array (
					"description" => "cuenta las pàginas", 
					"access" => "remote",
					"arguments" => array("seccion")
				),
				"listar" => array (
					"description" => "devuelve la pàgina solicitada", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listarTodas" => array (
					"description" => "devuelve todas las pàginas", 
					"access" => "remote",
					"arguments" => array("seccion")
				),
				"insertar" => array (
					"description" => "inserta una nueva pàgina", 
					"access" => "remote",
					"arguments" => array("titulo","texto_es","texto_en","texto_fr","seccion")
				),
				"modificar" => array (
					"description" => "modifica una pàgina", 
					"access" => "remote",
					"arguments" => array("id","tit","texto_es","texto_en","texto_fr")
				),
				"eliminar" => array (
					"description" => "elimina una pàgina", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"query" => array (
				    "description" => "ejecuta un query en MySQL",
					"access" => "private",
					"arguments" => array ("sql")
				)
			);
	   }
	   
	   function contar($seccion)
	   {
	   		$sql = "SELECT COUNT(*) FROM paginas WHERE seccion='".$seccion."'";
				$res = $this->query($sql);
				list($total) = mysql_fetch_array($res);
				return $total;
	   }
	
	   function listar($id)
	   {
	   		$sql = "SELECT * FROM paginas WHERE id_pagina='".$id."'";
				return $this->query($sql);
	   }
	
	   function listarTodas($seccion)
	   {
	   		$sql = "SELECT id_pagina, titulo FROM paginas WHERE seccion='".$seccion."'";
				return $this->query($sql);
	   }
	   
	   function insertar($titulo, $texto_es, $texto_en, $texto_fr, $seccion)
	   {
	   		$sql = "INSERT INTO paginas (titulo, texto_es, texto_en, texto_fr, seccion) VALUES('".$titulo."','".$texto_es."','".$texto_en."','".$texto_fr."','".$seccion."')";
				
				$id = -1;
	   		if( $this->query($sql) )
	   		{
	   			$sql = "SELECT MAX(id_pagina) FROM paginas";
					$res = $this->query($sql);
					$id = mysql_fetch_array($res);
				}
				
	   		return $id;
	   }
	   
	   function modificar($id, $tit, $texto_es, $texto_en, $texto_fr)
	   {
	   		$sql = "UPDATE paginas SET titulo='".$tit."', texto_es='".$texto_es."', texto_en='".$texto_en."', texto_fr='".$texto_fr."' WHERE id_pagina='".$id."'";
				return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM paginas WHERE id_pagina='".$id."'";
				return $this->query($sql);	
	   }
	   
	   function query ($sql)
	   {
	    	$conex= mysql_connect("localhost","gazpachu_innova","AvoOfn08") or die("no se puede conectar porque ".mysql_error());
			mysql_select_db("gazpachu_innovaciudad");
			$result = mysql_query($sql);
			mysql_close($conex);				   
	   		return $result;
	   }
}
	   
?>