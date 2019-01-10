<?php

class Detalle_ventas
{
	   function Detalle_ventas()
	   {
		   $this->methodTable = array
		   (
				"listar" => array (
					"description" => "devuelve el producto de la venta", 
					"access" => "remote",
					"arguments" => array("idVenta", "idProducto")
				),
				"listarVenta" => array (
					"description" => "devuelve los productos de la venta", 
					"access" => "remote",
					"arguments" => array("idVenta")
				),
				"insertar" => array (
					"description" => "inserta una nueva venta", 
					"access" => "remote",
					"arguments" => array("idVenta", "idProducto", "cantidad", "titulo", "talla", "precio")
				),
				"modificar" => array (
					"description" => "modifica una venta", 
					"access" => "remote",
					"arguments" => array("idVenta", "idProducto", "cantidad", "titulo", "talla", "precio")
				),
				"eliminar" => array (
					"description" => "elimina una venta", 
					"access" => "remote",
					"arguments" => array("idVenta", "idProducto")
				),
				"eliminarVenta" => array (
					"description" => "elimina una venta", 
					"access" => "remote",
					"arguments" => array("idVenta")
				),
				"query" => array (
				    "description" => "ejecuta un query en MySQL",
					"access" => "private",
					"arguments" => array ("sql")
				)
			);
	   }
	
	   function listar($idVenta, $idProducto)
	   {
	   		$sql = "SELECT * FROM detalle_ventas WHERE id_venta='".$idVenta."' AND id_producto='".$idProducto."'";
			return $this->query($sql);
	   }

	   function listarVenta($idVenta)
	   {
	   		$sql = "SELECT * FROM detalle_ventas WHERE id_venta='".$idVenta."'";
			return $this->query($sql);
	   }
	   
	   function insertar($idVenta, $idProducto, $cantidad, $titulo, $talla, $precio)
	   {
	   		$sql = "INSERT INTO detalle_ventas (id_venta, id_producto, cantidad, titulo, talla, precio) VALUES('".$idVenta."', '".$idProducto."', '".$cantidad."', '".$titulo."', '".$talla."', '".$precio."')";
			return $this->query($sql);
	   }
	   
	   function modificar($idVenta, $idProducto, $cantidad, $titulo, $talla, $precio)
	   {
	   		$sql = "UPDATE detalle_ventas SET cantidad='".$cantidad."', titulo='".$titulo."', talla='".$talla."', precio='".$precio."' WHERE id_venta='".$idVenta."' AND id_producto='".$idProducto."'";
			return $this->query($sql);
	   }
	   
	   function eliminar($idVenta, $idProducto)
	   {
	   		$sql = "DELETE FROM detalle_ventas WHERE id_venta='".$idVenta."' AND id_producto='".$idProducto."'";
			return $this->query($sql);	
	   }

	   function eliminarVenta($idVenta)
	   {
	   		$sql = "DELETE FROM detalle_ventas WHERE id_venta='".$idVenta."'";
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