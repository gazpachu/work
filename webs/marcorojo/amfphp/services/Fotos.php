<?php

class Fotos
{
	   function Fotos()
	   {
		   $this->methodTable = array
		   (
		   		"contar" => array (
					"description" => "cuenta las fotos", 
					"access" => "remote"
				),
				"listar" => array (
					"description" => "devuelve la foto solicitada", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listarTodas" => array (
					"description" => "devuelve todas las fotos", 
					"access" => "remote",
					"arguments" => array("boda")
				),
				"insertar" => array (
					"description" => "inserta una nueva foto", 
					"access" => "remote",
					"arguments" => array("boda", "titulo","comentario","ruta")
				),
				"modificar" => array (
					"description" => "modifica una foto", 
					"access" => "remote",
					"arguments" => array("id","tit","coment")
				),
				"eliminar" => array (
					"description" => "elimina una foto", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"eliminarTodas" => array (
					"description" => "elimina todas las fotos de un usuario", 
					"access" => "remote",
					"arguments" => array("boda")
				),
				"query" => array (
				    "description" => "ejecuta un query en MySQL",
					"access" => "private",
					"arguments" => array ("sql")
				)
			);
	   }
	   
	   function contar()
	   {
	   		$sql = "SELECT COUNT(*) FROM fotos";
			$res = $this->query($sql);
			list($total) = mysql_fetch_array($res);
			return $total;
	   }
	
	   function listar($id)
	   {
	   		$sql = "SELECT * FROM fotos WHERE id_foto='".$id."'";
			return $this->query($sql);
	   }
	
	   function listarTodas($boda)
	   {
	   		$sql = "SELECT * FROM fotos WHERE boda='".$boda."'";
			return $this->query($sql);
	   }
	   
	   function insertar($boda, $titulo, $comentario, $ruta)
	   {
	   		$sql = "INSERT INTO fotos (boda, titulo, comentario, ruta) VALUES('".$boda."','".$titulo."','".$comentario."','".$ruta."')";
			return $this->query($sql);
	   }
	   
	   function modificar($id, $tit, $coment)
	   {
	   		$sql = "UPDATE fotos SET titulo='".$tit."', comentario='".$coment."' WHERE id_foto='".$id."'";
			return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM fotos WHERE id_foto='".$id."'";
			return $this->query($sql);	
	   }
	   
	   function eliminarTodas($boda)
	   {
	   		$sql = "DELETE FROM fotos WHERE boda='".$boda."'";
			return $this->query($sql);	
	   }
	   
	   function query ($sql)
	   {
	    	$conex= mysql_connect("localhost","gazpachu_marco","narco") or die("no se puede conectar porque ".mysql_error());
			mysql_select_db("gazpachu_marcorojo");
			$result = mysql_query($sql);
			mysql_close($conex);				   
	   		return $result;
	   }
}
	   
?>