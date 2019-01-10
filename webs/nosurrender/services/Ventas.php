<?php

class Ventas
{
	   function Ventas()
	   {
		   $this->methodTable = array
		   (
				"listar" => array (
					"description" => "devuelve la venta solicitada", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"buscar" => array (
					"description" => "busca ventas", 
					"access" => "remote",
					"arguments" => array("dia", "mes", "ano", "numFactura", "idUsuario", "portes")
				),
				"buscarCampo" => array (
					"description" => "busca campos en ventas", 
					"access" => "remote",
					"arguments" => array("campo","busqueda")
				),
				"listarTodas" => array (
					"description" => "devuelve todas las ventas", 
					"access" => "remote"
				),
				"insertar" => array (
					"description" => "inserta una venta", 
					"access" => "remote",
					"arguments" => array("idUsuario", "dia", "mes", "ano", "portes", "obs")
				),
				"modificar" => array (
					"description" => "modifica una venta", 
					"access" => "remote",
					"arguments" => array("idVenta", "idUsuario", "dia", "mes", "ano", "portes", "obs")
				),
				"eliminar" => array (
					"description" => "elimina una venta", 
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
	   		$sql = "SELECT * FROM ventas WHERE id_venta='".$id."'";
			return $this->query($sql);
	   }
	   
	   function buscarCampo($campo, $busqueda)
	   {
	    	$sql = "SELECT * FROM ventas WHERE ".$campo." = '".$busqueda."'";
			return $this->query($sql);
	   }
	   
	   function buscar($dia, $mes, $ano, $numFactura, $idUsuario, $portes)
	   {
	    	$sql = "SELECT * FROM ventas WHERE 1 ";
			
			if($numFactura > 0)
			{
			 	$sql .= "AND id_factura = '".$numFactura."'";
			}
			if($precio > 0)
			{
			 	$sql .= "AND portes <= '".$portes."'";
			}
			if($idUsuario > 0)
			{
			 	$sql .= "AND id_usuario = '".$idUsuario."'";
			}
			if(!empty($dia))
			{
			 	$sql .= "AND dia = '".$dia."'";
			}
			if(!empty($mes))
			{
			 	$sql .= "AND dia = '".$dia."'";
			}
			if(!empty($ano))
			{
			 	$sql .= "AND dia = '".$dia."'";
			}
		
			
			return $this->query($sql);
	   }
	
	   function listarTodos()
	   {
	   		$sql = "SELECT * FROM ventas";
			return $this->query($sql);
	   }
	   
	   function insertar($idUsuario, $dia, $mes, $ano, $portes, $obs)
	   {
	   		$conex= mysql_connect("localhost","gazpachu_surrend","DneOfn08") or die("no se puede conectar porque ".mysql_error());
			mysql_select_db("gazpachu_nosurrender");
	   		
			$sql = "SELECT max(id_factura) FROM ventas";
			$idFactura= mysql_result(mysql_query($sql), 0, 0);
			$idFactura++;

			$sql = "INSERT INTO ventas (id_usuario, id_factura, dia, mes, ano, portes, obs) VALUES('".$idUsuario."','".$idFactura."','".$dia."','".$mes."','".$ano."','".$portes."','".$obs."')";
			
	   		$id = -1;
	   		if( mysql_query($sql) )
	   		{
	   			$sql = "SELECT * FROM ventas WHERE id_usuario='".$idUsuario."' AND id_factura='".$idFactura."' AND dia='".$dia."' AND mes='".$mes."' AND ano='".$ano."'";
				$id = mysql_query($sql);
			}
			
			mysql_close($conex);
	   		return $id;
	   }
	   
	   function modificar($idVenta, $idUsuario, $dia, $mes, $ano, $portes, $obs)
	   {
	   		$sql = "UPDATE ventas SET id_usuario='".$idUsuario."', dia='".$dia."', mes='".$mes."', ano='".$ano."', portes='".$portes."', obs='".$obs."' WHERE id_venta='".$idVenta."'";
			return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM ventas WHERE id_venta='".$id."'";
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