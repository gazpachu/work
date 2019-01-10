<?php

class Noticias2
{
	   function Noticias2()
	   {
		   $this->methodTable = array
		   (
				"listar" => array (
					"description" => "devuelve la noticia solicitada", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listarTodas" => array (
					"description" => "devuelve todas las noticias", 
					"access" => "remote"
				),
				"insertar" => array (
					"description" => "inserta una nueva noticia", 
					"access" => "remote",
					"arguments" => array("titulo", "fecha", "descripcion", "foto1", "foto2", "foto3")
				),
				"modificar" => array (
					"description" => "modifica una noticia", 
					"access" => "remote",
					"arguments" => array("id", "titulo", "fecha", "descripcion", "foto1", "foto2", "foto3")
				),
				"eliminar" => array (
					"description" => "elimina una noticia", 
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
	
	   function listar($id)
	   {
	   			$sql = "SELECT * FROM noticias2 WHERE id='".$id."'";
					return $this->query($sql);
	   }
	
	   function listarTodas()
	   {
	   	  	$sql = "SELECT * FROM noticias2";
					return $this->query($sql);
	   }
	   
	   function insertar($titulo, $fecha, $descripcion, $foto1, $foto2, $foto3)
	   {
	   			$sql = "INSERT INTO noticias2 (titulo, fecha, descripcion, foto1, foto2, foto3) VALUES('".$titulo."', '".$fecha."', '".$descripcion."', '".$foto1."', '".$foto2."', '".$foto3."')";
					return $this->query($sql);
	   }
	   
	   function modificar($id, $titulo, $fecha, $descripcion, $foto1, $foto2, $foto3)
	   {
	   			$sql = "UPDATE noticias2 SET titulo='".$titulo."', fecha='".$fecha."', descripcion='".$descripcion."', foto1='".$foto1."', foto2='".$foto2."', foto3='".$foto3."' WHERE id='".$id."'";
					return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   			$sql = "DELETE FROM noticias2 WHERE id='".$id."'";
					return $this->query($sql);	
	   }
	   
	   function query ($sql)
	   {
	    		$conex= mysql_connect("localhost","gazpachu_termal","LamOfn11") or die("no se puede conectar porque ".mysql_error());
					mysql_select_db("gazpachu_villas");
					$result = mysql_query($sql);
					mysql_close($conex);				   
	   			return $result;
	   }
}
	   
?>