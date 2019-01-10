<?php

class Tipos
{
	   function Tipos()
	   {
		   $this->methodTable = array
		   (
				"listar" => array (
					"description" => "devuelve el tipo solicitado", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listarTodos" => array (
					"description" => "devuelve todos los tipos", 
					"access" => "remote"
				),
				"insertar" => array (
					"description" => "inserta un nuevo tipo", 
					"access" => "remote",
					"arguments" => array("titulo")
				),
				"modificar" => array (
					"description" => "modifica un tipo", 
					"access" => "remote",
					"arguments" => array("id","titulo")
				),
				"eliminar" => array (
					"description" => "elimina un tipo", 
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
	   		$sql = "SELECT * FROM tipos WHERE id_tipo='".$id."'";
			return $this->query($sql);
	   }
	
	   function listarTodos()
	   {
	   		$sql = "SELECT * FROM tipos";
			return $this->query($sql);
	   }
	   
	   function insertar($titulo)
	   {
	   		$sql = "INSERT INTO tipos (titulo) VALUES('".$titulo."')";
			return $this->query($sql);
	   }
	   
	   function modificar($id, $titulo)
	   {
	   		$sql = "UPDATE tipos SET titulo='".$titulo."'WHERE id_tipo='".$id."'";
			return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM tipos WHERE id_tipo='".$id."'";
			return $this->query($sql);	
	   }
	   
	   function query ($sql)
	   {
	    	//require_once($_SERVER['DOCUMENT_ROOT']."/includes/connecttodatabase.inc.php");
	    	$conex= mysql_connect("localhost","gazpachu_proyect","TceOfn08") or die("no se puede conectar porque ".mysql_error());
			mysql_select_db("gazpachu_proyecto2025");
			$result = mysql_query($sql);
			mysql_close($conex);				   
	   		return $result;
	   }
}
	   
?>