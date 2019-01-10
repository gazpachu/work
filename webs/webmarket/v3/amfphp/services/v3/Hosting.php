<?php

class Hosting
{
	   function Hosting()
	   {
		   $this->methodTable = array
		   (
				"listar" => array (
					"description" => "devuelve el hosting solicitado", 
					"access" => "remote",
					"arguments" => array("id_hosting")
				),
				"listarTodos" => array (
					"description" => "devuelve todos los hosting del usuario", 
					"access" => "remote",
					"arguments" => array("id_usuario")
				),
				"contar" => array (
					"description" => "cuenta todos los hosting del usuario", 
					"access" => "remote"
				),
				"insertar" => array (
					"description" => "inserta un nuevo hosting", 
					"access" => "remote",
					"arguments" => array("id_hosting", "id_usuario", "dominio", "username", "pass", "periodicidad", "autorenovacion", "estado")
				),
				"modificar" => array (
					"description" => "modifica un hosting", 
					"access" => "remote",
					"arguments" => array("id_hosting", "id_usuario", "dominio", "username", "pass", "periodicidad", "autorenovacion", "estado")
				),
				"eliminar" => array (
					"description" => "elimina un hosting", 
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
	
	   function listar($id_hosting)
	   {
	   		$sql = "SELECT * FROM hosting WHERE id_hosting='".$id_hosting."'";
			return $this->query($sql);
	   }
	
	   function listarTodos($id_usuario)
	   {
	   		$sql = "SELECT * FROM hosting WHERE id_usuario='".$id_usuario."'";
			return $this->query($sql);
	   }

	   function contar()
	   {
	   		$sql = "SELECT id_usuario FROM hosting";
			return $this->query($sql);
	   }

	   function insertar($id_hosting, $id_usuario, $dominio, $username, $pass, $periodicidad, $autorenovacion, $estado)
	   {
				$sql = "INSERT INTO hosting (id_hosting, id_usuario, dominio, username, pass, periodicidad, autorenovacion, estado) VALUES('".$id_hosting."', '".$id_usuario."', '".$dominio."', '".$username."', '".$pass."', '".$periodicidad."', '".$autorenovacion."', '".$estado."')";
				return $this->query($sql);
	   }
	   
	   function modificar($id_hosting, $id_usuario, $dominio, $username, $pass, $periodicidad, $autorenovacion, $estado)
	   {
	   		$sql = "UPDATE hosting SET id_usuario='".$id_usuario."', dominio='".$dominio."', username='".$username."', pass='".$pass."', periodicidad='".$periodicidad."', autorenovacion='".$autorenovacion."', estado='".$estado."' WHERE id_hosting='".$id_hosting."'";
			return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM hosting WHERE id_hosting='".$id."'";
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