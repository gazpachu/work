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
				"validar"=> array(
		            "description" => "identifica a usuarios registrados en la base de datos",
		            "access" => "remote",
		            "arguments" => array("username", "pass")
		        ),
				"insertar" => array (
					"description" => "inserta un nuevo usuario", 
					"access" => "remote",
					"arguments" => array("username", "pass", "email", "telefono", "subscrito", "rango")
				),
				"modificar" => array (
					"description" => "modifica un usuario", 
					"access" => "remote",
					"arguments" => array("id", "username", "pass", "email", "telefono", "subscrito", "rango")
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
	   		$sql = "SELECT * FROM usuarios WHERE id_usuario='".$id."'";
			return $this->query($sql);
	   }
	
	   function listarTodos()
	   {
	   		$sql = "SELECT * FROM usuarios";
			return $this->query($sql);
	   }
	   
	   function validar($username, $pass)
	   {
	      $sql="SELECT * FROM usuarios";
	      
	      $recordset = $this->query($sql);
	
		  $ptr = mysql_fetch_array($recordset);
	      $salir = false;
	      $ejecucion = -1;
		
		  while($ptr && !$salir)
		  {
			  if($ptr["username"] == $username && $ptr["password"] == $pass)
			  {
			      $salir = true;
		      }
		      else
		      {
			      $ptr = mysql_fetch_array($recordset);
			  }
		  }
		
		  if($salir == true)
			  $ejecucion=$ptr["id_usuario"];
	
	      return $ejecucion;
	   }
	   
	   function insertar($username, $pass, $email, $telefono, $subscrito, $rango)
	   {
	   		$sql = "INSERT INTO usuarios (username, pass, email, telefono, subscrito, rango) VALUES('".$username."', '".$pass."', '".$email."', '".$telefono."', '".$subscrito."', '".$rango."')";
			return $this->query($sql);
	   }
	   
	   function modificar($id, $username, $pass, $email, $telefono, $subscrito, $rango)
	   {
	   		$sql = "UPDATE usuarios SET username='".$username."', pass='".$pass."', email='".$email."', telefono='".$telefono."', subscrito='".$subscrito."', rango='".$rango."' WHERE id_usuario='".$id."'";
			return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM usuarios WHERE id_usuario='".$id."'";
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