<?php

class Pais
{
	   function Pais()
	   {
		   $this->methodTable = array
		   (
				"listar" => array (
					"description" => "devuelve la categoria solicitada", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listarTodas" => array (
					"description" => "devuelve todas las categorias", 
					"access" => "remote"
				),
				"insertar" => array (
					"description" => "inserta una nueva categoria", 
					"access" => "remote",
					"arguments" => array("titulo")
				),
				"modificar" => array (
					"description" => "modifica una categoria", 
					"access" => "remote",
					"arguments" => array("id","titulo")
				),
				"eliminar" => array (
					"description" => "elimina una categoria", 
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
	   		$sql = "SELECT * FROM pais WHERE id_pais='".$id."'";
			return $this->query($sql);
	   }
	
	   function listarTodas()
	   {
	   		$sql = "SELECT * FROM pais";
			return $this->query($sql);
	   }
	   
	   function insertar($titulo)
	   {
	   		$sql = "INSERT INTO pais (nombre) VALUES('".$titulo."')";
			return $this->query($sql);
	   }
	   
	   function modificar($id, $titulo)
	   {
	   		$sql = "UPDATE pais SET nombre='".$titulo."' WHERE id_pais='".$id."'";
			return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM pais WHERE id_pais='".$id."'";
			return $this->query($sql);	
	   }
	   
	   function query ($sql)
	   {
	    	$conex= mysql_connect("us-cdbr-iron-east-03.cleardb.net","b9026191cde9b4","fb5db224") or die("no se puede conectar porque ".mysql_error());
			mysql_select_db("heroku_c0b154937f26a88");
			$result = mysql_query($sql);
			mysql_close($conex);				   
	   		return $result;
	   }
}
	   
?>