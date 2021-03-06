<?php

class Usuarios
{
	   function Usuarios()
	   {
		   $this->methodTable = array
		   (
				"listar" => array (
					"description" => "devuelve el usuario solicitado", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listarTodos" => array (
					"description" => "devuelve todos los usuario", 
					"access" => "remote"
				),
				"contar" => array (
					"description" => "cuenta los usuarios en total", 
					"access" => "remote"
				),
				"validar"=> array(
		      "description" => "identifica a usuarios registrados en la base de datos",
		      "access" => "remote",
		      "arguments" => array("username", "pass", "admin")
		    ),
		    "buscar" => array (
					"description" => "busca usuarios", 
					"access" => "remote",
					"arguments" => array("nombre", "apellidos", "activos")
				),
				"updatepass" => array (
					"description" => "actualiza la clave del usuario", 
					"access" => "remote",
					"arguments" => array("clave", "id")
				),
				"insertar" => array (
					"description" => "inserta un nuevo usuario", 
					"access" => "remote",
					"arguments" => array("usuario", "clave", "nombre1", "nombre2", "dia", "mes", "anyo", "lugar")
				),
				"modificar" => array (
					"description" => "modifica un usuario", 
					"access" => "remote",
					"arguments" => array("id", "usuario", "clave", "nombre1", "nombre2", "dia", "mes", "anyo", "lugar")
				),
				"eliminar" => array (
					"description" => "elimina un usuario", 
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
	   		$sql = "SELECT * FROM usuarios WHERE id='".$id."'";
			return $this->query($sql);
	   }
	
	   function listarTodos()
	   {
	   		$sql = "SELECT * FROM usuarios";
			return $this->query($sql);
	   }
	   
	   function contar()
	   {
	   		$sql = "SELECT COUNT(id) FROM usuarios";
			return $this->query($sql);
	   }
	   
	   function validar($username, $pass, $admin)
	   {
	      $sql="SELECT id, usuario, clave, rango FROM usuarios";
	      
	      $recordset = $this->query($sql);
	
		  	$ptr = mysql_fetch_array($recordset);
	      $salir = false;
	      $ejecucion = -1;
		
		  	while($ptr && !$salir)
		  	{
			  	if($ptr["usuario"] == $username && $ptr["clave"] == $pass )
			  	{
			      if($admin)
				  	{
							if( $ptr["rango"] == 5 )
								$salir = true;
							else
								$ptr = mysql_fetch_array($recordset);
				  	}
				  	else
							$salir = true;		
		      }
		      else
		      {
			      $ptr = mysql_fetch_array($recordset);
			  	}
		  	}
		
		  	if($salir == true)
			  	$ejecucion=$ptr["id"];
	
	      return $ejecucion;
	   }
		
		 function buscar($nombre, $apellidos, $activos)
	   {
				$sql = "SELECT * FROM usuarios WHERE 1 ";
			
				if(!empty($nombre))
				{
			 		$sql .= "AND LOWER(nombre) LIKE LOWER('%".$nombre."%')";
				}
				if(!empty($apellidos))
				{
			 		$sql .= "AND LOWER(apellidos) LIKE LOWER('%".$apellidos."%')";
				}
			
				if(!empty($activos))
				{
			 		$sql .= "AND activo IN ('%".$activos."%')";
				}
			
				return $this->query($sql);
	   }
		
		 function updatepass($clave, $id)
	   {
			$sql = "UPDATE usuarios SET clave='".$clave."' WHERE id='".$id."'";
			return $this->query($sql);
		}
	   
	   function insertar($usuario, $clave, $nombre1, $nombre2, $dia, $mes, $anyo, $lugar)
	   {
		   	$sql="SELECT usuario FROM usuarios";
				$recordset = $this->query($sql);
				
				$ptr = mysql_fetch_array($recordset);
				$yaexiste = false;
				
				while($ptr && !$yaexiste)
				{
				  if($ptr["usuario"] == $usuario )
				  {
				      $yaexiste = true;
				  }
				  else
				  {
				      $ptr = mysql_fetch_array($recordset);
				  }
				}
			
				if($yaexiste == true)
				{
				  return -1;
				}
				else  		
				{
					$sql = "INSERT INTO usuarios (usuario, clave, nombre1, nombre2, dia, mes, anyo, lugar) VALUES('".$usuario."', '".$clave."', '".$nombre1."', '".$nombre2."', '".$dia."', '".$mes."', '".$anyo."', '".$lugar."')";
					if( !$this->query($sql) )
						return -2;
					else
					{
						$sql="SELECT id FROM usuarios WHERE usuario='".$usuario."'";
						$recordset = $this->query($sql);
		  			$ptr = mysql_fetch_array($recordset);
						return $ptr["id"];
					}
				}
	   }
	   
	   function modificar($id, $usuario, $clave, $nombre1, $nombre2, $dia, $mes, $anyo, $lugar)
	   {
	   		$sql="SELECT usuario, id FROM usuarios";
				$recordset = $this->query($sql);
				
				$ptr = mysql_fetch_array($recordset);
				$yaexiste = false;
				
				while($ptr && !$yaexiste)
				{
				  if($ptr["usuario"] == $usuario && $ptr["id"] != $id)
				  {
				      $yaexiste = true;
				  }
				  else
				  {
				      $ptr = mysql_fetch_array($recordset);
				  }
				}
			
				if($yaexiste == true)
				{
				  return 1;
				}
				else  		
				{
					$sql = "UPDATE usuarios SET usuario='".$usuario."', clave='".$clave."', nombre1='".$nombre1."', nombre2='".$nombre2."', dia='".$dia."', mes='".$mes."', anyo='".$anyo."', lugar='".$lugar."' WHERE id='".$id."'";
					if( !$this->query($sql) )
						return 2;
					else
						return 0;
				}
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM usuarios WHERE id='".$id."'";
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