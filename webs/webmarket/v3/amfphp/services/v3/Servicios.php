<?php

class Servicios
{
	   function Servicios()
	   {
		   $this->methodTable = array
		   (
				"listar" => array (
					"description" => "devuelve el servicio solicitado", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listarTodos" => array (
					"description" => "devuelve todos los servicios", 
					"access" => "remote",
					"arguments" => array("id_usuario")
				),
				"contar" => array (
					"description" => "cuenta todos los servicios", 
					"access" => "remote"
				),
				"insertar" => array (
					"description" => "inserta un nuevo servicio", 
					"access" => "remote",
					"arguments" => array("id_usuario", "referencia", "categoria", "nombre", "descripcion", "precio", "f_inicio", "f_renovacion")
				),
				"modificar" => array (
					"description" => "modifica un servicio", 
					"access" => "remote",
					"arguments" => array("id_servicio", "id_usuario", "referencia", "categoria", "nombre", "descripcion", "precio", "f_inicio", "f_renovacion")
				),
				"eliminar" => array (
					"description" => "elimina un servicio", 
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
	   		$sql = "SELECT * FROM servicios WHERE id_servicio='".$id."'";
			return $this->query($sql);
	   }
	
	   function listarTodos($id_usuario)
	   {
	   		$sql = "SELECT * FROM servicios WHERE id_usuario='".$id_usuario."'";
			return $this->query($sql);
	   }

	   function contar()
	   {
	   		$sql = "SELECT id_usuario FROM servicios";
			return $this->query($sql);
	   }

	   function insertar($id_usuario, $referencia, $categoria, $nombre, $descripcion, $precio, $f_inicio, $f_renovacion)
	   {
				$sql = "INSERT INTO servicios (id_usuario, categoria, referencia, nombre, descripcion, precio, fecha_inicio, fecha_renovacion) VALUES('".$id_usuario."', '".$referencia."', '".$categoria."', '".$nombre."', '".$descripcion."', '".$precio."', '".$f_inicio."', '".$f_renovacion."')";
				
				$id = -1;
	   		if( $this->query($sql) )
	   		{
	   			$sql = "SELECT MAX(id_servicio) FROM servicios";
					$res = $this->query($sql);
					$id = mysql_fetch_array($res);
				}
				
	   		return $id;
	   }
	   
	   function modificar($id_servicio, $id_usuario, $referencia, $categoria, $nombre, $descripcion, $precio, $f_inicio, $f_renovacion)
	   {
	   		$sql = "UPDATE servicios SET id_usuario='".$id_usuario."', referencia='".$referencia."', categoria='".$categoria."', nombre='".$nombre."', descripcion='".$descripcion."', precio='".$precio."', f_inicio='".$f_inicio."', f_renovacion='".$f_renovacion."' WHERE id_servicio='".$id_servicio."'";
			return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM servicios WHERE id_servicio='".$id."'";
			return $this->query($sql);	
	   }
	   
	   function query ($sql)
	   {
	    	$conex= mysql_connect("localhost","gazpachu_webmark","TekOfn08") or die("no se puede conectar porque ".mysql_error());
			mysql_select_db("gazpachu_webmarket");
			$result = mysql_query($sql);
			mysql_close($conex);				   
	   		return $result;
	   }
}
	   
?>