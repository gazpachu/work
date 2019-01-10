<?php

class Inmuebles
{
	   function Inmuebles()
	   {
		   $this->methodTable = array
		   (
				"listar" => array (
					"description" => "devuelve el inmueble solicitado", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"buscar" => array (
					"description" => "busca inmuebles", 
					"access" => "remote",
					"arguments" => array("zona","tipo","precio")
				),
				"buscarCampo" => array (
					"description" => "busca campos en inmuebles", 
					"access" => "remote",
					"arguments" => array("campo","busqueda")
				),
				"listarTodos" => array (
					"description" => "devuelve todos los inmuebles", 
					"access" => "remote"
				),
				"insertar" => array (
					"description" => "inserta inmuebles", 
					"access" => "remote",
					"arguments" => array("tipo", "zona", "referencia", "fecha","precio", "metros", "habitaciones", "descripcion", "comentarios", "reservado","listado")
				),
				"modificar" => array (
					"description" => "modifica inmuebles", 
					"access" => "remote",
					"arguments" => array("id", "tipo", "zona", "referencia", "fecha","precio", "metros", "habitaciones", "descripcion", "comentarios", "reservado","listado")
				),
				"eliminar" => array (
					"description" => "elimina un inmueble", 
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
	   		$sql = "SELECT * FROM inmuebles WHERE id_inmueble='".$id."'";
			return $this->query($sql);
	   }
	   
	   function buscarCampo($campo, $busqueda)
	   {
	    	$sql = "SELECT * FROM inmuebles WHERE ".$campo." = '".$busqueda."'";
			return $this->query($sql);
	   }
	   
	   function buscar($campo, $busqueda, $tipo, $precio)
	   {
	    	if( $campo && ($tipo >= 0) && ($precio >= 0) )
	   		{
				$sql = "SELECT * FROM inmuebles, zonas WHERE inmuebles.id_zona = zonas.id_zona AND inmuebles.precio <= '".$precio."' AND inmuebles.id_tipo = '".$tipo."' AND zonas.".$campo." = '".$busqueda."' ";
			}
			else if( $campo && ($tipo >= 0) && ($precio < 0) )
			{
				$sql = "SELECT * FROM inmuebles, zonas WHERE inmuebles.id_zona = zonas.id_zona AND inmuebles.id_tipo = '".$tipo."' AND zonas.".$campo." = '".$busqueda."' ";
			}
			else if( $campo && ($precio >= 0) && ($tipo < 0) )
			{
				$sql = "SELECT * FROM inmuebles, zonas WHERE inmuebles.id_zona = zonas.id_zona AND inmuebles.precio <= '".$precio."' AND zonas.".$campo." = '".$busqueda."' ";
			}
			else if( $campo && ($tipo < 0) && ($precio < 0) )
			{
				$sql = "SELECT * FROM inmuebles, zonas WHERE inmuebles.id_zona = zonas.id_zona AND zonas.".$campo." = '".$busqueda."'";
			}
			else if( !$campo && ($tipo >= 0) && ($precio >= 0) )
	   		{
				$sql = "SELECT * FROM inmuebles, zonas WHERE inmuebles.id_zona = zonas.id_zona AND inmuebles.precio <= '".$precio."' AND inmuebles.id_tipo = '".$tipo."' AND zonas.".$campo." = '".$busqueda."' ";
			}
			else if( !$campo && ($tipo >= 0) && ($precio < 0) )
			{
				$sql = "SELECT * FROM inmuebles, zonas WHERE inmuebles.id_zona = zonas.id_zona AND inmuebles.id_tipo = '".$tipo."' AND zonas.".$campo." = '".$busqueda."' ";
			}
			else if( !$campo && ($precio >= 0) && ($tipo < 0) )
			{
				$sql = "SELECT * FROM inmuebles, zonas WHERE inmuebles.id_zona = zonas.id_zona AND inmuebles.precio <= '".$precio."' AND zonas.".$campo." = '".$busqueda."' ";
			}
			else if( !$campo && ($tipo < 0) && ($precio < 0) )
			{
				$sql = "SELECT * FROM inmuebles";
			}
			
			return $this->query($sql);
	   }
	
	   function listarTodos()
	   {
	   		$sql = "SELECT * FROM inmuebles";
			return $this->query($sql);
	   }
	   
	   function insertar($tipo, $zona, $referencia, $fecha, $precio, $metros, $habitaciones, $descripcion, $comentarios, $reservado, $listado)
	   {
	   		$conex= mysql_connect("localhost","proyecto_admin","calvo") or die("no se puede conectar porque ".mysql_error());
			mysql_select_db("proyecto_inmoflash");
	   		
			$sql = "INSERT INTO inmuebles (id_tipo, id_zona, referencia, fecha, precio, metros, habitaciones, descripcion, comentarios, reservado, listado) VALUES('".$tipo."','".$zona."','".$referencia."','".$fecha."','".$precio."','".$metros."','".$habitaciones."','".$descripcion."','".$comentarios."','".$reservado."','".$listado."')";
	   		$id = -1;
	   		if( mysql_query($sql) )
	   		{
	   			$sql = "SELECT id_inmueble FROM inmuebles WHERE id_tipo='".$tipo."' AND id_zona='".$zona."' AND referencia='".$referencia."' AND precio='".$precio."'";
				$id = mysql_query($sql);
			}
			
			mysql_close($conex);
	   		return $id;
	   }
	   
	   function modificar($id, $tipo, $zona, $referencia, $fecha, $precio, $metros, $habitaciones, $descripcion, $comentarios, $reservado, $listado)
	   {
	   		$sql = "UPDATE inmuebles SET id_tipo='".$tipo."', id_zona='".$zona."', referencia='".$referencia."', fecha='".$fecha."', precio='".$precio."', metros='".$metros."', habitaciones='".$habitaciones."', descripcion='".$descripcion."', comentarios='".$comentarios."', reservado='".$reservado."', listado='".$listado."' WHERE id_inmueble='".$id."'";
			return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM inmuebles WHERE id_inmueble='".$id."'";
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