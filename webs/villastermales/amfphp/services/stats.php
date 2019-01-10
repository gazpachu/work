<?php

class Stats
{
	   function Stats()
	   {
		   $this->methodTable = array
		   (
				"listarweb" => array (
					"description" => "devuelve estadisticas entre esas fechas", 
					"access" => "remote",
					"arguments" => array("fecha_inicio", "fecha_fin")
				),
				"listarvillas" => array (
					"description" => "devuelve estadisticas entre esas fechas", 
					"access" => "remote",
					"arguments" => array("fecha_inicio", "fecha_fin")
				),
				"listaremails" => array (
					"description" => "devuelve estadisticas entre esas fechas", 
					"access" => "remote",
					"arguments" => array("fecha_inicio", "fecha_fin")
				),
				"listarvilla" => array (
					"description" => "devuelve estadisticas entre esas fechas", 
					"access" => "remote",
					"arguments" => array("id", "fecha_inicio", "fecha_fin")
				),
				"resetweb" => array (
					"description" => "resetea las estadisticas de la web", 
					"access" => "remote"
				),
				"resetvillas" => array (
					"description" => "resetea las estadisticas de las villas", 
					"access" => "remote"
				),
				"resetemails" => array (
					"description" => "resetea las estadisticas de los emails", 
					"access" => "remote"
				),
				"query" => array (
				  "description" => "ejecuta un query en MySQL",
					"access" => "private",
					"arguments" => array ("sql")
				)
			);
	   }
	
	   function listarweb($fecha_inicio, $fecha_fin)
	   {
	   			$sql = "SELECT id FROM stats_web WHERE fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'";
					return $this->query($sql);
	   }
	
	   function listarvillas($fecha_inicio, $fecha_fin)
	   {
	   	  	$sql = "SELECT id FROM stats_villa WHERE fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'";
					return $this->query($sql);
	   }
	   
	   function listaremails($fecha_inicio, $fecha_fin)
	   {
	   			$sql = "SELECT id FROM stats_email WHERE fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'";
					return $this->query($sql);
	   }
	   
	   function listarvilla($id, $fecha_inicio, $fecha_fin)
	   {
	   	  	$sql = "SELECT id FROM stats_villa WHERE id_villa = '".$id."' AND fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'";
					return $this->query($sql);
	   }
	   
	   function resetweb()
	   {
	   			$sql = "DELETE FROM stats_web";
					return $this->query($sql);
	   }
	   
	   function resetvillas()
	   {
	   			$sql = "DELETE FROM stats_villa";
					return $this->query($sql);	
	   }
	   
	   function resetemails()
	   {
	   			$sql = "DELETE FROM stats_email";
					return $this->query($sql);	
	   }
	   
	   function query ($sql)
	   {
	    		$conex= mysql_connect("localhost","gazpachu_termal","LamOfn11") or die("no se puede conectar porque ".mysql_error());
					mysql_select_db("gazpachu_villas");
					$result = mysql_query($sql);
					mysql_close($conex);				   
	   			return $result;
	   }
}
	   
?>