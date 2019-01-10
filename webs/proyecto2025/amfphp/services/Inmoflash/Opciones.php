<?php

class Opciones
{
	   function Opciones()
	   {
		   $this->methodTable = array
		   (
				"listarOpciones" => array (
					"description" => "devuelve todas las opciones", 
					"access" => "remote"
				),
				"guardarOpciones" => array (
					"description" => "modifica las opciones", 
					"access" => "remote",
					"arguments" => array("escritorio", "moneda", "idioma", "paisDefecto", "provinciaDefecto", "poblacionDefecto", "zonaDefecto")
				),
				"query" => array (
				    "description" => "ejecuta un query en MySQL",
					"access" => "private",
					"arguments" => array ("sql")
				)
			);
	   }
	
	   function listarOpciones()
	   {
	   		$sql = "SELECT * FROM opciones";
			return $this->query($sql);
	   }
	   
	   function guardarOpciones($escritorio, $moneda, $idioma, $paisDefecto, $provinciaDefecto, $poblacionDefecto, $zonaDefecto)
	   {
	   		$sql = "UPDATE opciones SET escritorio='".$escritorio."', moneda='".$moneda."', idioma='".$idioma."', pais_defecto='".$pais_Defecto."', provincia_defecto='".$provinciaDefecto."', poblacion_defecto='".$poblacionDefecto."', zona_defecto='".$zonaDefecto."'";
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