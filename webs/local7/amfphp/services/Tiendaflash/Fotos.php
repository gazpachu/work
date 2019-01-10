<?php

class Fotos
{
	   function Fotos()
	   {
		   $this->methodTable = array
		   (
		   		"contar" => array (
					"description" => "cuenta las fotos", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listar" => array (
					"description" => "devuelve la foto solicitada", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listarTodas" => array (
					"description" => "devuelve todas las fotos", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listarTodas2" => array (
					"description" => "devuelve todas las fotos", 
					"access" => "remote"
				),
				"insertar" => array (
					"description" => "inserta una nueva foto", 
					"access" => "remote",
					"arguments" => array("idproducto", "titulo","comentario","ruta")
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
				"query" => array (
				    "description" => "ejecuta un query en MySQL",
					"access" => "private",
					"arguments" => array ("sql")
				)
			);
	   }
	   
	   function contar($id)
	   {
	   		$sql = "SELECT COUNT(*) FROM fotos WHERE id_producto='".$id."'";
			$res = $this->query($sql);
			list($total) = mysql_fetch_array($res);
			return $total;
	   }
	
	   function listar($id)
	   {
	   		$sql = "SELECT * FROM fotos WHERE id_foto='".$id."'";
			return $this->query($sql);
	   }
	
	   function listarTodas($id)
	   {
	   		$sql = "SELECT * FROM fotos WHERE id_producto='".$id."'";
			return $this->query($sql);
	   }

	   function listarTodas2()
	   {
	   		$sql = "SELECT * FROM fotos";
			return $this->query($sql);
	   }
	   
	   function insertar($idproducto, $titulo, $comentario, $ruta)
	   {
	   		$sql = "INSERT INTO fotos (id_producto, titulo, comentario, ruta) VALUES('".$idproducto."', '".$titulo."','".$comentario."','".$ruta."')";
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
	   
	   function query ($sql)
	   {
	    	$conex= mysql_connect("localhost","gazpachu_local7","LacOfn08") or die("no se puede conectar porque ".mysql_error());
			mysql_select_db("gazpachu_local7");
			$result = mysql_query($sql);
			mysql_close($conex);				   
	   		return $result;
	   }
}
	   
?>