<?php

class Destinos
{
	   function Destinos()
	   {
		   $this->methodTable = array
		   (
				"buscar" => array (
					"description" => "busca destinos de un usuario", 
					"access" => "remote",
					"arguments" => array("idUsuario")
				),
				"buscarDestino" => array (
					"description" => "busca usuarios de un destino", 
					"access" => "remote",
					"arguments" => array("destino")
				),
				"insertar" => array (
					"description" => "inserta un nuevo destino", 
					"access" => "remote",
					"arguments" => array("idUsuario", "destino")
				),
				"eliminar" => array (
					"description" => "elimina un destino", 
					"access" => "remote",
					"arguments" => array("idDestino")
				),
				"query" => array (
				    "description" => "ejecuta un query en MySQL",
					"access" => "private",
					"arguments" => array ("sql")
				)
			);
	   }
	
	   function buscar($idUsuario)
	   {
			$sql = "SELECT * FROM destinos WHERE id_usuario='".$idUsuario."'";
			return $this->query($sql);
	   }

	   function buscarDestino($destino)
	   {
			$sql = "SELECT * FROM destinos WHERE destino='".$destino."'";
			return $this->query($sql);
	   }

	   function insertar($idUsuario, $destino)
	   {
	   		$sql = "INSERT INTO destinos (id_usuario, destino) VALUES('".$idUsuario."', '".$destino."')";
			return $this->query($sql);
	   }
	   
	   function eliminar($idDestino)
	   {
	   		$sql = "DELETE FROM destinos WHERE id_destino='".$idDestino."'";
			return $this->query($sql);	
	   }
	   
	   function query ($sql)
	   {
	    	$conex= mysql_connect("localhost","gazpachu_baxter","RetOfn08") or die("no se puede conectar porque ".mysql_error());
			mysql_select_db("gazpachu_baxtermead");
			$result = mysql_query($sql);
			mysql_close($conex);				   
	   		return $result;
	   }
}
	   
?>