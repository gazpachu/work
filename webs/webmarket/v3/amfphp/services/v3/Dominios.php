<?php

class Dominios
{
	   function Dominios()
	   {
		   $this->methodTable = array
		   (
				"listar" => array (
					"description" => "devuelve el dominio solicitado", 
					"access" => "remote",
					"arguments" => array("id_dominio")
				),
				"listarTodos" => array (
					"description" => "devuelve todos los dominios del usuario", 
					"access" => "remote",
					"arguments" => array("id_usuario")
				),
				"contar" => array (
					"description" => "cuenta todos los dominios del usuario", 
					"access" => "remote"
				),
				"insertar" => array (
					"description" => "inserta un nuevo dominio", 
					"access" => "remote",
					"arguments" => array("id_dominio", "id_usuario", "dns1", "dns2", "locked", "tipo_registro", "redireccion", "periodicidad", "autorenovacion", "estado", "redireccionar", "whois_r", "whois_a", "whois_t", "whois_b")
				),
				"modificar" => array (
					"description" => "modifica un dominio", 
					"access" => "remote",
					"arguments" => array("id_dominio", "id_usuario", "dns1", "dns2", "locked", "tipo_registro", "redireccion", "periodicidad", "autorenovacion", "estado", "redireccionar", "whois_r", "whois_a", "whois_t", "whois_b")
				),
				"eliminar" => array (
					"description" => "elimina un dominio", 
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
	
	   function listar($id_dominio)
	   {
	   		$sql = "SELECT * FROM dominios WHERE id_dominio='".$id_dominio."'";
			return $this->query($sql);
	   }
	
	   function listarTodos($id_usuario)
	   {
	   		$sql = "SELECT * FROM dominios WHERE id_usuario='".$id_usuario."'";
			return $this->query($sql);
	   }

	   function contar()
	   {
	   		$sql = "SELECT id_usuario FROM dominios";
			return $this->query($sql);
	   }

	   function insertar($id_dominio, $id_usuario, $dns1, $dns2, $locked, $tipo_registro, $redireccion, $periodicidad, $autorenovacion, $estado, $redireccionar, $whois_r, $whois_a, $whois_t, $whois_b)
	   {
				$sql = "INSERT INTO dominios (id_dominio, id_usuario, dns1, dns2, locked, tipo_registro, redireccion, periodicidad, autorenovacion, estado, redireccionar, whois_r, whois_a, whois_t, whois_b) VALUES('".$id_dominio."', '".$id_usuario."', '".$nombre."', '".$dns1."', '".$dns2."', '".$locked."', '".$tipo_registro."', '".$redireccion."', '".$periodicidad."', '".$autorenovacion."', '".$estado."', '".$redireccionar."', '".$whois_r."', '".$whois_a."', '".$whois_t."', '".$whois_a."')";
				return $this->query($sql);
	   }
	   
	   function modificar($id_dominio, $id_usuario, $dns1, $dns2, $locked, $tipo_registro, $redireccion, $periodicidad, $autorenovacion, $estado, $redireccionar, $whois_r, $whois_a, $whois_t, $whois_b)
	   {
	   		$sql = "UPDATE dominios SET id_usuario='".$id_usuario."', dns1='".$dns1."', dns2='".$dns2."', locked='".$locked."', tipo_registro='".$tipo_registro."', redireccion='".$redireccion."', periodicidad='".$periodicidad."', autorenovacion='".$autorenovacion."', estado='".$estado."', redireccionar='".$redireccionar."', whois_r='".$whois_r."', whois_a='".$whois_a."', whois_t='".$whois_t."', whois_b='".$whois_b."' WHERE id_dominio='".$id_dominio."'";
			return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM dominios WHERE id_dominio='".$id."'";
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