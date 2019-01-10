<?php

class Deudas
{
	   function Deudas()
	   {
		   $this->methodTable = array
		   (
				"listar" => array (
					"description" => "devuelve la deuda solicitada", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listarExpediente" => array (
					"description" => "devuelve todas las deudas de un expediente", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"contar" => array (
					"description" => "cuenta todas las deudas", 
					"access" => "remote"
				),
				"insertar" => array (
					"description" => "inserta una nueva deuda", 
					"access" => "remote",
					"arguments" => array("id_expediente", "tipo_deuda", "cuota", "pendiente", "situacion", "entidad", "telefono")
				),
				"modificar" => array (
					"description" => "modifica una deuda", 
					"access" => "remote",
					"arguments" => array("id_deuda", "id_expediente", "tipo_deuda", "cuota", "pendiente", "situacion", "entidad", "telefono")
				),
				"eliminar" => array (
					"description" => "elimina una deuda", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"eliminarExpediente" => array (
					"description" => "elimina las deudas de un expediente", 
					"access" => "remote",
					"arguments" => array("id_expediente")
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
	   		$sql = "SELECT * FROM deudas WHERE id_deuda='".$id."'";
			return $this->query($sql);
	   }
	
	   function listarExpediente($id)
	   {
	   		$sql = "SELECT * FROM deudas WHERE id_expediente='".$id."'";
			return $this->query($sql);
	   }

	   function contar()
	   {
	   		$sql = "SELECT id_deuda FROM deudas";
			return $this->query($sql);
	   }

	   function insertar($id_expediente, $tipo_deuda, $cuota, $pendiente, $situacion, $entidad, $telefono)
	   {
			$sql = "INSERT INTO deudas (id_expediente, tipo_deuda, cuota, pendiente, situacion, entidad, telefono) VALUES('".$id_expediente."', '".$tipo_deuda."', '".$cuota."', '".$pendiente."', '".$situacion."', '".$entidad."', '".$telefono."')";
			return $this->query($sql);
	   }
	   
	   function modificar($id_deuda, $id_expediente, $tipo_deuda, $cuota, $pendiente, $situacion, $entidad, $telefono)
	   {
	   		$sql = "UPDATE deudas SET id_expediente='".$id_expediente."', tipo_deuda='".$tipo_deuda."', cuota='".$cuota."', pendiente='".$pendiente."', situacion='".$situacion."', entidad='".$entidad."', telefono='".$telefono."' WHERE id_deuda='".$id_deuda."'";
			return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM deudas WHERE id_deuda='".$id."'";
			return $this->query($sql);
	   }

	   function eliminarExpediente($id_expediente)
	   {
	   		$sql = "DELETE FROM deudas WHERE id_expediente='".$id_expediente."'";
			return $this->query($sql);
	   }
	   
	   function query ($sql)
	   {
	    	$conex= mysql_connect("localhost","gazpachu_asociad","DaiOfn08") or die("no se puede conectar porque ".mysql_error());
			mysql_select_db("gazpachu_crasociados");
			$result = mysql_query($sql);
			mysql_close($conex);				   
	   		return $result;
	   }
}
	   
?>