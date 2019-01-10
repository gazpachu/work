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
					"description" => "devuelve todos los usuarios", 
					"access" => "remote"
				),
				"validar"=> array(
		            "description" => "identifica a usuarios registrados en la base de datos",
		            "access" => "remote",
		            "arguments" => array("username", "pass", "admin")
		        ),
		        "buscar" => array (
					"description" => "busca inmuebles", 
					"access" => "remote",
					"arguments" => array("nombre", "apellido1", "apellido2", "username", "provincia", "poblacion", "pais", "zip")
				),
				"insertar" => array (
					"description" => "inserta un nuevo usuario", 
					"access" => "remote",
					"arguments" => array("nombre", "apellido1", "apellido2", "username", "pass", "email", "telefono", "direccion", "provincia", "poblacion", "pais", "zip", "zona", "subscrito", "rango")
				),
				"modificar" => array (
					"description" => "modifica un usuario", 
					"access" => "remote",
					"arguments" => array("id", "nombre", "apellido1", "apellido2", "username", "pass", "email", "telefono", "direccion", "provincia", "poblacion", "pais", "zip", "zona", "subscrito", "rango")
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
	   
	   function validar($username, $pass, $admin)
	   {
	      $sql="SELECT * FROM usuarios";
	      
	      $recordset = $this->query($sql);
	
		  $ptr = mysql_fetch_array($recordset);
	      $salir = false;
	      $ejecucion = -1;
		
		  while($ptr && !$salir)
		  {
			  if($ptr["username"] == $username && $ptr["pass"] == $pass)
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
			  $ejecucion=$ptr["id_usuario"];
	
	      return $ejecucion;
	   }
	   
	   function buscar($nombre, $apellido1, $apellido2, $username, $provincia, $poblacion, $pais, $zip)
	   {
			$sql = "SELECT * FROM usuarios WHERE 1 ";
			
			if(!empty($nombre))
			{
			 	$sql .= "AND nombre LIKE '%".$nombre."%'";
			}
			if(!empty($apellido1))
			{
			 	$sql .= "AND apellido1 LIKE '%".$apellido1."%'";
			}
			if(!empty($apellido2))
			{
			 	$sql .= "AND apellido2 LIKE '%".$apellido2."%'";
			}
			if(!empty($username))
			{
			 	$sql .= "AND username LIKE '%".$username."%'";
			}
			if(!empty($provincia))
			{
			 	$sql .= "AND provincia LIKE '%".$provincia."%'";
			}
			if(!empty($poblacion))
			{
			 	$sql .= "AND poblacion LIKE '%".$poblacion."%'";
			}
			if(!empty($pais))
			{
			 	$sql .= "AND pais LIKE '%".$pais."%'";
			}
			if(!empty($zip))
			{
			 	$sql .= "AND zip LIKE '%".$zip."%'";
			}
			
			return $this->query($sql);
	   }
	   
	   function insertar($nombre, $apellido1, $apellido2, $username, $pass, $email, $telefono, $direccion, $provincia, $poblacion, $pais, $zip, $zona, $subscrito, $rango)
	   {
			$sql="SELECT username, email FROM usuarios";
			$recordset = $this->query($sql);
			
			$ptr = mysql_fetch_array($recordset);
			$yaexiste = false;
			
			while($ptr && !$yaexiste)
			{
			  if($ptr["username"] == $username || $ptr["email"] == $email)
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
		   		$sql = "INSERT INTO usuarios (nombre, apellido1, apellido2, username, pass, email, telefono, direccion, provincia, poblacion, pais, zip, zona, subscrito, rango) VALUES('".$nombre."', '".$apellido1."', '".$apellido2."', '".$username."', '".$pass."', '".$email."', '".$telefono."', '".$direccion."', '".$provincia."', '".$poblacion."', '".$pais."', '".$zip."', '".$zona."', '".$subscrito."', '".$rango."')";
				if( !$this->query($sql) )
					return 2;
				else
					return 0;
			}
	   }
	   
	   function modificar($id, $nombre, $apellido1, $apellido2, $username, $pass, $email, $telefono, $direccion, $provincia, $poblacion, $pais, $zip, $zona, $subscrito, $rango)
	   {
	   		$sql = "UPDATE usuarios SET nombre='".$nombre."', apellido1='".$apellido1."', apellido2='".$apellido2."', username='".$username."', pass='".$pass."', email='".$email."', telefono='".$telefono."', direccion='".$direccion."', provincia='".$provincia."', poblacion='".$poblacion."', pais='".$pais."', zip='".$zip."', zona='".$zona."', subscrito='".$subscrito."', rango='".$rango."' WHERE id_usuario='".$id."'";
			return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM usuarios WHERE id_usuario='".$id."'";
			return $this->query($sql);	
	   }
	   
	   function query ($sql)
	   {
	    	$conex= mysql_connect("us-cdbr-iron-east-03.cleardb.net","b9026191cde9b4","fb5db224") or die("no se puede conectar porque ".mysql_error());
			mysql_select_db("heroku_c0b154937f26a88");
			$result = mysql_query($sql);
			mysql_close($conex);				   
	   		return $result;
	   }
}
	   
?>