<?php

class Expedientes
{
	   function Expedientes()
	   {
		   $this->methodTable = array
		   (
				"listar" => array (
					"description" => "devuelve el expediente solicitado", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listarTodos" => array (
					"description" => "devuelve todos los expedientes", 
					"access" => "remote"
				),
				"contar" => array (
					"description" => "cuenta todos los expedientes", 
					"access" => "remote"
				),
				"contarAnual" => array (
					"description" => "cuenta todos los expedientes", 
					"access" => "remote",
					"arguments" => array("ano")
				),
		        "buscar" => array (
					"description" => "busca expedientes", 
					"access" => "remote",
					"arguments" => array("id_usuario", "nombre", "apellido1", "apellido2", "provincia", "dni", "referencia")
				),
				"insertar" => array (
					"description" => "inserta un nuevo expediente", 
					"access" => "remote",
					"arguments" => array("id_usuario", "gestor", "referencia", "f_solicitud", "dni1", "dni2", "nombre1", "nombre2", "apellido1_1", "apellido1_2", "apellido2_1", "apellido2_2", "f_nacimiento1", "f_nacimiento2", "domicilio", "localidad",
										 "provincia", "telefono", "movil1", "movil2", "estado_civil", "reg_matrimonial", "hijos", "t_operacion", "t_vivienda", "f_ent_riesgos", "f_sal_riesgos", "importeNeto", "importeTotal", "ingresos", "tasacion", "grado_deuda", "porcentage_vt",
										 "cuota", "plazo", "f_solicitud_doc", "f_recep_doc", "comision", "chk_1", "chk_2", "chk_3", "chk_4", "chk_5", "chk_6", "chk_7", "chk_8", "chk_9", "chk_10", "chk_11", "chk_12", "chk_13", "chk_14", "chk_15", "chk_16", "chk_17", "chk_18",
										 "chk_19", "chk_20", "otros", "f_retirada", "f_firma", "historico", "observaciones", "ingresos_a_1", "ingresos_a_2", "ingresos_a_3", "ingresos_a_4", "ingresos_a_5", "ingresos_b_1", "ingresos_b_2", "ingresos_b_3", "ingresos_b_4", "ingresos_b_5", "ingresos_c_1", "ingresos_c_2", "ingresos_c_3", "ingresos_c_4", "ingresos_c_5",
										 "ingresos_d_1", "ingresos_d_2", "ingresos_d_3", "ingresos_d_4", "ingresos_d_5", "ingresos_e_1", "ingresos_e_2", "ingresos_e_3", "ingresos_e_4", "ingresos_e_5", "ingresos_f_1", "ingresos_f_2", "ingresos_f_3", "ingresos_f_4", "ingresos_f_5",
										 "liquidez", "total_pagos", "finalidad", "honorarios" )
				),
				"modificar" => array (
					"description" => "modifica un expediente", 
					"access" => "remote",
					"arguments" => array("id_expediente", "id_usuario", "gestor", "referencia", "f_solicitud", "dni1", "dni2", "nombre1", "nombre2", "apellido1_1", "apellido1_2", "apellido2_1", "apellido2_2", "f_nacimiento1", "f_nacimiento2", "domicilio", "localidad",
										 "provincia", "telefono", "movil1", "movil2", "estado_civil", "reg_matrimonial", "hijos", "t_operacion", "t_vivienda", "f_ent_riesgos", "f_sal_riesgos", "importeNeto", "importeTotal", "ingresos", "tasacion", "grado_deuda", "porcentage_vt",
										 "cuota", "plazo", "f_solicitud_doc", "f_recep_doc", "comision", "chk_1", "chk_2", "chk_3", "chk_4", "chk_5", "chk_6", "chk_7", "chk_8", "chk_9", "chk_10", "chk_11", "chk_12", "chk_13", "chk_14", "chk_15", "chk_16", "chk_17", "chk_18",
										 "chk_19", "chk_20", "otros", "f_retirada", "f_firma", "historico", "observaciones", "ingresos_a_1", "ingresos_a_2", "ingresos_a_3", "ingresos_a_4", "ingresos_a_5", "ingresos_b_1", "ingresos_b_2", "ingresos_b_3", "ingresos_b_4", "ingresos_b_5", "ingresos_c_1", "ingresos_c_2", "ingresos_c_3", "ingresos_c_4", "ingresos_c_5",
										 "ingresos_d_1", "ingresos_d_2", "ingresos_d_3", "ingresos_d_4", "ingresos_d_5", "ingresos_e_1", "ingresos_e_2", "ingresos_e_3", "ingresos_e_4", "ingresos_e_5", "ingresos_f_1", "ingresos_f_2", "ingresos_f_3", "ingresos_f_4", "ingresos_f_5",
										 "liquidez", "total_pagos", "finalidad", "honorarios" )
				),
				"eliminar" => array (
					"description" => "elimina un expediente", 
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
	   		$sql = "SELECT * FROM expedientes WHERE id_usuario='".$id."'";
			return $this->query($sql);
	   }
	
	   function listarTodos()
	   {
	   		$sql = "SELECT * FROM expedientes";
			return $this->query($sql);
	   }

	   function contar()
	   {
	   		$sql = "SELECT referencia FROM expedientes";
			return $this->query($sql);
	   }

	   function contarAnual($ano)
	   {
	   		$sql = "SELECT id_expediente FROM expedientes WHERE f_solicitud LIKE '%".$ano."%'";
			return $this->query($sql);
	   }
	   
	   function buscar($id_usuario, $nombre, $apellido1, $apellido2, $provincia, $dni, $referencia)
	   {
			$sql = "SELECT * FROM usuarios, expedientes WHERE 1 AND usuarios.id_usuario = expedientes.id_usuario ";
			
			if(!empty($id_usuario))
			{
			 	$sql .= "AND expedientes.id_usuario LIKE '%".$id_usuario."%'";
			}
			if(!empty($nombre))
			{
			 	$sql .= "AND expedientes.nombre1 LIKE '%".$nombre."%'";
			}
			if(!empty($apellido1))
			{
			 	$sql .= "AND expedientes.apellido1_1 LIKE '%".$apellido1."%'";
			}
			if(!empty($apellido2))
			{
			 	$sql .= "AND expedientes.apellido1_2 LIKE '%".$apellido2."%'";
			}
			if(!empty($provincia))
			{
			 	$sql .= "AND expedientes.provincia LIKE '%".$provincia."%'";
			}
			if(!empty($dni))
			{
			 	$sql .= "AND expedientes.dni1 LIKE '%".$dni."%'";
			}
			if(!empty($referencia))
			{
			 	$sql .= "AND expedientes.referencia LIKE '%".$referencia."%'";
			}
			
			return $this->query($sql);
	   }

	   function insertar($id_usuario, $gestor, $referencia, $f_solicitud, $dni1, $dni2, $nombre1, $nombre2, $apellido1_1, $apellido1_2, $apellido2_1, $apellido2_2, $f_nacimiento1, $f_nacimiento2, $domicilio, $localidad,
						 $provincia, $telefono, $movil1, $movil2, $estado_civil, $reg_matrimonial, $hijos, $t_operacion, $t_vivienda, $f_ent_riesgos, $f_sal_riesgos, $importeNeto, $importeTotal, $ingresos, $tasacion, $grado_deuda, $porcentage_vt,
						 $cuota, $plazo, $f_solicitud_doc, $f_recep_doc, $comision, $chk_1, $chk_2, $chk_3, $chk_4, $chk_5, $chk_6, $chk_7, $chk_8, $chk_9, $chk_10, $chk_11, $chk_12, $chk_13, $chk_14, $chk_15, $chk_16, $chk_17, $chk_18,
						 $chk_19, $chk_20, $otros, $f_retirada, $f_firma, $historico, $observaciones, $ingresos_a_1, $ingresos_a_2, $ingresos_a_3, $ingresos_a_4, $ingresos_a_5, $ingresos_b_1, $ingresos_b_2, $ingresos_b_3, $ingresos_b_4, $ingresos_b_5, $ingresos_c_1, $ingresos_c_2, $ingresos_c_3, $ingresos_c_4, $ingresos_c_5,
										 $ingresos_d_1, $ingresos_d_2, $ingresos_d_3, $ingresos_d_4, $ingresos_d_5, $ingresos_e_1, $ingresos_e_2, $ingresos_e_3, $ingresos_e_4, $ingresos_e_5, $ingresos_f_1, $ingresos_f_2, $ingresos_f_3, $ingresos_f_4, $ingresos_f_5,
										 $liquidez, $total_pagos, $finalidad, $honorarios )
	   {
			$sql="SELECT referencia FROM expedientes";
			$recordset = $this->query($sql);
			
			$ptr = mysql_fetch_array($recordset);
			$yaexiste = false;
			
			while($ptr && !$yaexiste)
			{
			  if($ptr["referencia"] == $referencia)
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
				$sql = "INSERT INTO expedientes (id_usuario, gestor, referencia, f_solicitud, dni1, dni2, nombre1, nombre2, apellido1_1, apellido1_2, apellido2_1, apellido2_2, f_nacimiento1, f_nacimiento2, domicilio, localidad,
						 provincia, telefono, movil1, movil2, estado_civil, reg_matrimonial, hijos, t_operacion, t_vivienda, f_ent_riesgos, f_sal_riesgos, importeNeto, importeTotal, ingresos, tasacion, grado_deuda, porcentage_vt,
						 cuota, plazo, f_solicitud_doc, f_recep_doc, comision, chk_1, chk_2, chk_3, chk_4, chk_5, chk_6, chk_7, chk_8, chk_9, chk_10, chk_11, chk_12, chk_13, chk_14, chk_15, chk_16, chk_17, chk_18,
						 chk_19, chk_20, otros, f_retirada, f_firma, historico, observaciones, ingresos_a_1, ingresos_a_2, ingresos_a_3, ingresos_a_4, ingresos_a_5, ingresos_b_1, ingresos_b_2, ingresos_b_3, ingresos_b_4, ingresos_b_5, ingresos_c_1, ingresos_c_2, ingresos_c_3, ingresos_c_4, ingresos_c_5,
										 ingresos_d_1, ingresos_d_2, ingresos_d_3, ingresos_d_4, ingresos_d_5, ingresos_e_1, ingresos_e_2, ingresos_e_3, ingresos_e_4, ingresos_e_5, ingresos_f_1, ingresos_f_2, ingresos_f_3, ingresos_f_4, ingresos_f_5,
										 liquidez, total_pagos, finalidad, honorarios) VALUES('".$id_usuario."', '".$gestor."', '".$referencia."', '".$f_solicitud."', '".$dni1."', '".$dni2."', '".$nombre1."', '".$nombre2."', '".$apellido1_1."', '".$apellido1_2."', '".$apellido2_1."', '".$apellido2_2."', '".$f_nacimiento1."', '".$f_nacimiento2."', '".$domicilio."', '".$localidad."',
						 '".$provincia."', '".$telefono."', '".$movil1."', '".$movil2."', '".$estado_civil."', '".$reg_matrimonial."', '".$hijos."', '".$t_operacion."', '".$t_vivienda."', '".$f_ent_riesgos."', '".$f_sal_riesgos."', '".$importeNeto."', '".$importeTotal."', '".$ingresos."', '".$tasacion."', '".$grado_deuda."', '".$porcentage_vt."',
						 '".$cuota."', '".$plazo."', '".$f_solicitud_doc."', '".$f_recep_doc."', '".$comision."', '".$chk_1."', '".$chk_2."', '".$chk_3."', '".$chk_4."', '".$chk_5."', '".$chk_6."', '".$chk_7."', '".$chk_8."', '".$chk_9."', '".$chk_10."', '".$chk_11."', '".$chk_12."', '".$chk_13."', '".$chk_14."', '".$chk_15."', '".$chk_16."', '".$chk_17."', '".$chk_18."',
						 '".$chk_19."', '".$chk_20."', '".$otros."', '".$f_retirada."', '".$f_firma."', '".$historico."', '".$observaciones."', '".$ingresos_a_1."', '".$ingresos_a_2."', '".$ingresos_a_3."', '".$ingresos_a_4."', '".$ingresos_a_5."', '".$ingresos_b_1."', '".$ingresos_b_2."', '".$ingresos_b_3."', '".$ingresos_b_4."', '".$ingresos_b_5."', '".$ingresos_c_1."', '".$ingresos_c_2."', '".$ingresos_c_3."', '".$ingresos_c_4."', '".$ingresos_c_5."',
						 '".$ingresos_d_1."', '".$ingresos_d_2."', '".$ingresos_d_3."', '".$ingresos_d_4."', '".$ingresos_d_5."', '".$ingresos_e_1."', '".$ingresos_e_2."', '".$ingresos_e_3."', '".$ingresos_e_4."', '".$ingresos_e_5."', '".$ingresos_f_1."', '".$ingresos_f_2."', '".$ingresos_f_3."', '".$ingresos_f_4."', '".$ingresos_f_5."',
						 '".$liquidez."', '".$total_pagos."', '".$finalidad."', '".$honorarios."' )";
				if( !$this->query($sql) )
					return 2;
				else
					return 0;
			}
	   }
	   
	   function modificar($id, $id_usuario, $gestor, $referencia, $f_solicitud, $dni1, $dni2, $nombre1, $nombre2, $apellido1_1, $apellido1_2, $apellido2_1, $apellido2_2, $f_nacimiento1, $f_nacimiento2, $domicilio, $localidad,
						 $provincia, $telefono, $movil1, $movil2, $estado_civil, $reg_matrimonial, $hijos, $t_operacion, $t_vivienda, $f_ent_riesgos, $f_sal_riesgos, $importeNeto, $importeTotal, $ingresos, $tasacion, $grado_deuda, $porcentage_vt,
						 $cuota, $plazo, $f_solicitud_doc, $f_recep_doc, $comision, $chk_1, $chk_2, $chk_3, $chk_4, $chk_5, $chk_6, $chk_7, $chk_8, $chk_9, $chk_10, $chk_11, $chk_12, $chk_13, $chk_14, $chk_15, $chk_16, $chk_17, $chk_18,
						 $chk_19, $chk_20, $otros, $f_retirada, $f_firma, $historico, $observaciones, $ingresos_a_1, $ingresos_a_2, $ingresos_a_3, $ingresos_a_4, $ingresos_a_5, $ingresos_b_1, $ingresos_b_2, $ingresos_b_3, $ingresos_b_4, $ingresos_b_5, $ingresos_c_1, $ingresos_c_2, $ingresos_c_3, $ingresos_c_4, $ingresos_c_5,
										 $ingresos_d_1, $ingresos_d_2, $ingresos_d_3, $ingresos_d_4, $ingresos_d_5, $ingresos_e_1, $ingresos_e_2, $ingresos_e_3, $ingresos_e_4, $ingresos_e_5, $ingresos_f_1, $ingresos_f_2, $ingresos_f_3, $ingresos_f_4, $ingresos_f_5,
										 $liquidez, $total_pagos, $finalidad, $honorarios )
	   {
	   		$sql = "UPDATE expedientes SET id_usuario='".$id_usuario."', gestor='".$gestor."', referencia='".$referencia."', f_solicitud='".$f_solicitud."', dni1='".$dni1."', dni2='".$dni2."', nombre1='".$nombre1."', nombre2='".$nombre2."', apellido1_1='".$apellido1_1."', apellido1_2='".$apellido1_2."', apellido2_1='".$apellido2_1."', apellido2_2='".$apellido2_2."', f_nacimiento1='".$f_nacimiento1."', f_nacimiento2='".$f_nacimiento2."', domicilio='".$domicilio."', localidad='".$localidad."',
					provincia='".$provincia."', telefono='".$telefono."', movil1='".$movil1."', movil2='".$movil2."', estado_civil='".$estado_civil."', reg_matrimonial='".$reg_matrimonial."', hijos='".$hijos."', t_operacion='".$t_operacion."', t_vivienda='".$t_vivienda."', f_ent_riesgos='".$f_ent_riesgos."', f_sal_riesgos='".$f_sal_riesgos."', importeNeto='".$importeNeto."', importeTotal='".$importeTotal."', ingresos='".$ingresos."', tasacion='".$tasacion."', grado_deuda='".$grado_deuda."', porcentage_vt='".$porcentage_vt."',
					cuota='".$cuota."', plazo='".$plazo."', f_solicitud_doc='".$f_solicitud_doc."', f_recep_doc='".$f_recep_doc."', comision='".$comision."', chk_1='".$chk_1."', chk_2='".$chk_2."', chk_3='".$chk_3."', chk_4='".$chk_4."', chk_5='".$chk_5."', chk_6='".$chk_6."', chk_7='".$chk_7."', chk_8='".$chk_8."', chk_9='".$chk_9."', chk_10='".$chk_10."', chk_11='".$chk_11."', chk_12='".$chk_12."', chk_13='".$chk_13."', chk_14='".$chk_14."', chk_15='".$chk_15."', chk_16='".$chk_16."', chk_17='".$chk_17."', chk_18='".$chk_18."', chk_19='".$chk_19."',
					chk_20='".$chk_20."', otros='".$otros."', f_retirada='".$f_retirada."', f_firma='".$f_firma."', historico='".$historico."', observaciones='".$observaciones."', ingresos_a_1='".$ingresos_a_1."', ingresos_a_2='".$ingresos_a_2."', ingresos_a_3='".$ingresos_a_3."', ingresos_a_4='".$ingresos_a_4."', ingresos_a_5='".$ingresos_a_5."', ingresos_b_1='".$ingresos_b_1."', ingresos_b_2='".$ingresos_b_2."', ingresos_b_3='".$ingresos_b_3."', ingresos_b_4='".$ingresos_b_4."', ingresos_b_5='".$ingresos_b_5."', ingresos_c_1='".$ingresos_c_1."', ingresos_c_2='".$ingresos_c_2."', ingresos_c_3='".$ingresos_c_3."', ingresos_c_4='".$ingresos_c_4."', ingresos_c_5='".$ingresos_c_5."',
						 ingresos_d_1='".$ingresos_d_1."', ingresos_d_2='".$ingresos_d_2."', ingresos_d_3='".$ingresos_d_3."', ingresos_d_4='".$ingresos_d_4."', ingresos_d_5='".$ingresos_d_5."', ingresos_e_1='".$ingresos_e_1."', ingresos_e_2='".$ingresos_e_2."', ingresos_e_3='".$ingresos_e_3."', ingresos_e_4='".$ingresos_e_4."', ingresos_e_5='".$ingresos_e_5."', ingresos_f_1='".$ingresos_f_1."', ingresos_f_2='".$ingresos_f_2."', ingresos_f_3='".$ingresos_f_3."', ingresos_f_4='".$ingresos_f_4."', ingresos_f_5='".$ingresos_f_5."',
						 liquidez='".$liquidez."', total_pagos='".$total_pagos."', finalidad='".$finalidad."', honorarios='".$honorarios."' WHERE id_expediente='".$id."'";
			return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM expedientes WHERE id_expediente='".$id."'";
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