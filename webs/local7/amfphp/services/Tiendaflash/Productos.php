<?php

class Productos
{
	   function Productos()
	   {
		   $this->methodTable = array
		   (
				"listar" => array (
					"description" => "devuelve el producto solicitado", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"buscar" => array (
					"description" => "busca productos", 
					"access" => "remote",
					"arguments" => array("idCategoria", "marca", "modelo", "precio", "oferta")
				),
				"buscarCampo" => array (
					"description" => "busca campos en productos", 
					"access" => "remote",
					"arguments" => array("campo","busqueda")
				),
				"listarTodos" => array (
					"description" => "devuelve todos los productos", 
					"access" => "remote"
				),
				"insertar" => array (
					"description" => "inserta productos", 
					"access" => "remote",
					"arguments" => array("idCategoria", "fecha", "marca", "modelo", "precio", "oferta", "referencia", "titulo", "descripcion", "comentarios", "listado", "stockS", "stockM", "stockL", "stockXL", "stockXXL", "stockUnico")
				),
				"modificar" => array (
					"description" => "modifica productos", 
					"access" => "remote",
					"arguments" => array("id", "idCategoria", "fecha", "marca", "modelo", "precio", "oferta", "referencia", "titulo", "descripcion", "comentarios", "listado", "stockS", "stockM", "stockL", "stockXL", "stockXXL", "stockUnico")
				),
				"actualizarStock" => array (
					"description" => "busca campos en productos", 
					"access" => "remote",
					"arguments" => array("idProducto", "campo","valor", "incrementa")
				),
				"eliminar" => array (
					"description" => "elimina un producto", 
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
	   		$sql = "SELECT * FROM productos WHERE id_producto='".$id."'";
			return $this->query($sql);
	   }
	   
	   function buscarCampo($campo, $busqueda)
	   {
	    	$sql = "SELECT * FROM productos WHERE ".$campo." = '".$busqueda."'";
			return $this->query($sql);
	   }
	   
	   function buscar($idCategoria, $marca, $modelo, $precio, $oferta)
	   {
	    	$sql = "SELECT * FROM productos WHERE 1 ";
			
			if($idCategoria >= 0)
			{
			 	$sql .= "AND id_categoria = '".$idCategoria."'";
			}
			if(!empty($marca))
			{
			 	$sql .= "AND marca LIKE '%".$marca."%'";
			}
			if(!empty($modelo))
			{
			 	$sql .= "AND modelo LIKE '%".$modelo."%'";
			}
			if($precio > 0)
			{
			 	$sql .= "AND precio <= '".$precio."'";
			}
			if($oferta == true)
			{
			 	$sql .= "AND oferta > 0";
			}
			
			return $this->query($sql);
	   }
	
	   function listarTodos()
	   {
	   		$sql = "SELECT * FROM productos";
			return $this->query($sql);
	   }
	   
	   function insertar($idCategoria, $fecha, $marca, $modelo, $precio, $oferta, $referencia, $titulo, $descripcion, $comentarios, $listado, $stockS, $stockM, $stockL, $stockXL, $stockXXL, $stockUnico)
	   {
	   		$conex= mysql_connect("localhost","local7_admin","salva") or die("no se puede conectar porque ".mysql_error());
			mysql_select_db("local7_tienda");
	   		
			$sql = "INSERT INTO productos (id_categoria, fecha, marca, modelo, precio, oferta, referencia, titulo, descripcion, comentarios, listado, stockS, stockM, stockL, stockXL, stockXXL, stock_talla_unica) VALUES('".$idCategoria."','".$fecha."','".$marca."','".$modelo."','".$precio."','".$oferta."','".$referencia."','".$titulo."','".$descripcion."','".$comentarios."','".$listado."','".$stockS."','".$stockM."','".$stockL."','".$stockXL."','".$stockXXL."','".$stockUnico."')";
			
	   		$id = -1;
	   		if( mysql_query($sql) )
	   		{
	   			$sql = "SELECT id_producto FROM productos WHERE modelo='".$modelo."' AND marca='".$marca."' AND referencia='".$referencia."' AND precio='".$precio."'";
				$id = mysql_query($sql);
			}
			
			mysql_close($conex);
	   		return $id;
	   }
	   
	   function modificar($id, $idCategoria, $fecha, $marca, $modelo, $precio, $oferta, $referencia, $titulo, $descripcion, $comentarios, $listado, $stockS, $stockM, $stockL, $stockXL, $stockXXL, $stockUnico)
	   {
	   		$sql = "UPDATE productos SET id_categoria='".$idCategoria."', fecha='".$fecha."', marca='".$marca."', modelo='".$modelo."', precio='".$precio."', oferta='".$oferta."', referencia='".$referencia."', titulo='".$titulo."', descripcion='".$descripcion."', comentarios='".$comentarios."', listado='".$listado."', stockS='".$stockS."', stockM='".$stockM."', stockL='".$stockL."', stockXL='".$stockXL."', stockXXL='".$stockXXL."', stock_talla_unica='".$stockUnico."' WHERE id_producto='".$id."'";
			return $this->query($sql);
	   }

	   function actualizarStock($idProducto, $campo, $valor, $incrementa)
	   {
			$sql;
			if( $incrementa )
				$sql = "UPDATE productos SET  ".$campo." = ".$campo." + '".$valor."' WHERE id_producto='".$idProducto."'";
			else
				$sql = "UPDATE productos SET  ".$campo." = ".$campo." - '".$valor."' WHERE id_producto='".$idProducto."'";				

			return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM productos WHERE id_producto='".$id."'";
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