<?php

class Noticias
{
	   function Noticias()
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
					"arguments" => array("titulo", "fecha", "descripcion", "foto1", "foto2", "foto3", "archivo")
				),
				"modificar" => array (
					"description" => "modifica una noticia", 
					"access" => "remote",
					"arguments" => array("id", "titulo", "fecha", "descripcion", "foto1", "foto2", "foto3", "archivo")
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
	   			$sql = "SELECT * FROM noticias WHERE id='".$id."'";
					return $this->query($sql);
	   }
	
	   function listarTodas()
	   {
	   	  	$sql = "SELECT * FROM noticias";
					return $this->query($sql);
	   }
	   
	   function insertar($titulo, $fecha, $descripcion, $foto1, $foto2, $foto3, $archivo)
	   {
	   			$sql = "INSERT INTO noticias (titulo, fecha, descripcion, foto1, foto2, foto3, archivo) VALUES('".$titulo."', '".$fecha."', '".$descripcion."', '".$foto1."', '".$foto2."', '".$foto3."', '".$archivo."')";
					return $this->query($sql);
	   }
	   
	   function modificar($id, $titulo, $fecha, $descripcion, $foto1, $foto2, $foto3, $archivo)
	   {
	   			$sql = "UPDATE noticias SET titulo='".$titulo."', fecha='".$fecha."', descripcion='".$descripcion."', foto1='".$foto1."', foto2='".$foto2."', foto3='".$foto3."', archivo='".$archivo."' WHERE id='".$id."'";
					return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   			$sql = "DELETE FROM noticias WHERE id='".$id."'";
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