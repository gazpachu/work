<?php

class Zonas //<--nombre de la clase igual al nombre del archivo
{
	   function Zonas() //<-- constructor de la clase, nombre igual al de la clase
	   {
		   $this->methodTable = array //<--definimos lo metodos que tendra nuestra clase
		   (
				"listar" => array (
					"description" => "devuelve la zona solicitada", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"buscar" => array (
					"description" => "busca zonas", 
					"access" => "remote",
					"arguments" => array("campo","busqueda")
				),
				"listarTodas" => array (
					"description" => "devuelve todas las zonas", 
					"access" => "remote"
				),
				"insertar" => array (
					"description" => "inserta una zona", 
					"access" => "remote",
					"arguments" => array("pais", "provincia", "poblacion", "zona")
				),
				"modificar" => array (
					"description" => "modifica una zona", 
					"access" => "remote",
					"arguments" => array("id","pais", "provincia", "poblacion", "zona")
				),
				"eliminar" => array (
					"description" => "elimina una zona", 
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
	   		$sql = "SELECT * FROM zonas WHERE id_zona='".$id."'";
			return $this->query($sql);
	   }
	   
	   function buscar($campo, $busqueda)
	   {
	   		
			$sql = "SELECT * FROM zonas WHERE ".$campo." = '".$busqueda."'";
			return $this->query($sql);
	   }
	
	   function listarTodas()
	   {
	   		$sql = "SELECT * FROM zonas";
			return $this->query($sql);
	   }
	   
	   function insertar($pais, $provincia, $poblacion, $zona)
	   {
	   		$sql = "INSERT INTO zonas (pais, provincia, poblacion, zona) VALUES('".$pais."','".$provincia."','".$poblacion."','".$zona."')";
			return $this->query($sql);
	   }
	   
	   function modificar($id, $pais, $provincia, $poblacion, $zona)
	   {
	   		$sql = "UPDATE zonas SET pais='".$pais."', provincia='".$provincia."', poblacion='".$poblacion."', zona='".$zona."' WHERE id_zona='".$id."'";
			return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM zonas WHERE id_zona='".$id."'";
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