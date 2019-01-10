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
				"buscarsub" => array (
					"description" => "busca productos", 
					"access" => "remote",
					"arguments" => array("idsubcategoria", "marca", "modelo", "precio")
				),
				"buscarUltimos" => array (
					"description" => "busca ultimos productos", 
					"access" => "remote"
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
					"arguments" => array("idCategoria", "fecha", "marca", "modelo", "precio", "oferta", "referencia", "titulo", "descripcion", "comentarios", "listado", "stockS", "stockM", "stockL", "stockXL", "stockXXL", "stockUnico","pais","subcategoria","stock34", "stock56", "stock78", "stock91", "stock12")
				),
				"modificar" => array (
					"description" => "modifica productos", 
					"access" => "remote",
					"arguments" => array("id", "idCategoria", "fecha", "marca", "modelo", "precio", "oferta", "referencia", "titulo", "descripcion", "comentarios", "listado", "stockS", "stockM", "stockL", "stockXL", "stockXXL", "stockUnico","pais","subcategoria","stock34", "stock56", "stock78", "stock91", "stock12")
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
	   
	   function buscarUltimos()
	   {
	    	$sql = "SELECT * FROM productos ORDER BY id_producto DESC LIMIT 0,8";
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
	   
	    function buscarsub($idsubcategoria, $marca, $modelo, $precio)
	   {
	    	$sql = "SELECT * FROM productos WHERE 1 ";
			
			if($idSubcategoria >= 0)
			{
			 	$sql .= "AND id_subcategoria = '".$idsubcategoria."'";
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
			return $this->query($sql);
	   }
	
	   function listarTodos()
	   {
	   		$sql = "SELECT * FROM productos";
			return $this->query($sql);
	   }
	   
	   function insertar($idCategoria, $fecha, $marca, $modelo, $precio, $oferta, $referencia, $titulo, $descripcion, $comentarios, $listado, $stockS, $stockM, $stockL, $stockXL, $stockXXL, $stockUnico, $pais, $subcategoria, $stock34, $stock56, $stock78, $stock91, $stock12)
	   {
	   		$conex= mysql_connect("localhost","gazpachu_surrend","DneOfn08") or die("no se puede conectar porque ".mysql_error());
			mysql_select_db("gazpachu_nosurrender");
	   		
			$sql = "INSERT INTO productos (id_categoria, fecha, marca, modelo, precio, oferta, referencia, titulo, descripcion, comentarios, listado, stockS, stockM, stockL, stockXL, stockXXL, stock_talla_unica, pais, id_subcategoria, stock34, stock56, stock78, stock91, stock12) VALUES('".$idCategoria."','".$fecha."','".$marca."','".$modelo."','".$precio."','".$oferta."','".$referencia."','".$titulo."','".$descripcion."','".$comentarios."','".$listado."','".$stockS."','".$stockM."','".$stockL."','".$stockXL."','".$stockXXL."','".$stockUnico."','".$pais."','".$subcategoria."','".$stock34."','".$stock56."','".$stock78."','".$stock91."','".$stock12."')";
			
	   		$id = -1;
	   		if( mysql_query($sql) )
	   		{
	   			$sql = "SELECT id_producto FROM productos WHERE modelo='".$modelo."' AND marca='".$marca."' AND referencia='".$referencia."' AND precio='".$precio."'";
				$id = mysql_query($sql);
			}
			
			mysql_close($conex);
	   		return $id;
	   }
	   
	   function modificar($id, $idCategoria, $fecha, $marca, $modelo, $precio, $oferta, $referencia, $titulo, $descripcion, $comentarios, $listado, $stockS, $stockM, $stockL, $stockXL, $stockXXL, $stockUnico, $pais, $subcategoria, $stock34, $stock56, $stock78, $stock91, $stock12)
	   {
	   		$sql = "UPDATE productos SET id_categoria='".$idCategoria."', fecha='".$fecha."', marca='".$marca."', modelo='".$modelo."', precio='".$precio."', oferta='".$oferta."', referencia='".$referencia."', titulo='".$titulo."', descripcion='".$descripcion."', comentarios='".$comentarios."', listado='".$listado."', stockS='".$stockS."', stockM='".$stockM."', stockL='".$stockL."', stockXL='".$stockXL."', stockXXL='".$stockXXL."', stock_talla_unica='".$stockUnico."', pais='".$pais."',id_subcategoria='".$subcategoria."', stock34='".$stock34."', stock56='".$stock56."', stock78='".$stock78."', stock91='".$stock91."', stock12='".$stock12."' WHERE id_producto='".$id."'";
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
	    	$conex= mysql_connect("us-cdbr-iron-east-03.cleardb.net","b9026191cde9b4","fb5db224") or die("no se puede conectar porque ".mysql_error());
			mysql_select_db("heroku_c0b154937f26a88");
			$result = mysql_query($sql);
			mysql_close($conex);				   
	   		return $result;
	   }
}
	   
?>