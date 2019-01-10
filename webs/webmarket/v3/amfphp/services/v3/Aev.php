<?php

class Aev
{
	   function Aev()
	   {
		   $this->methodTable = array
		   (
				"listar" => array (
					"description" => "devuelve el aev solicitado", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listarTodos" => array (
					"description" => "devuelve todos los aev", 
					"access" => "remote"
				),
				"contar" => array (
					"description" => "cuenta todos los aev", 
					"access" => "remote"
				),
				"insertar" => array (
					"description" => "inserta un nuevo aev", 
					"access" => "remote",
					"arguments" => array("id_usuario", "cuerpo", "gafas", "gafas_y", "gafas_h", "gafas_w", "pecas", "pecas_y", "pecas_h", "pecas_w", "cosas_cara", "cosas_cara_y", "cosas_cara_h", "cosas_cara_w", "bigote", "bigote_y", "bigote_h", "bigote_w", "barba", "barba_y", "barba_h", "barba_w", "boca", "boca_y", "boca_h", "boca_w", "nariz", "nariz_y", "nariz_h", "nariz_w", "cejas", "cejas_y", "ceja1_x", "ceja2_x", "cejas_h", "cejas_w", "ceja1_r", "ceja2_r", "ojos", "ojos_y", "ojo1_x", "ojo2_x", "ojos_h", "ojos_w", "ojo1_r", "ojo2_r", "cara", "cara_y", "cara_w", "cara_h", "pelo", "pelo_y", "pelo_h", "pelo_w", "sombrero", "sombrero_y", "sombrero_h", "sombrero_w", "color_torso", "color_piernas", "color_barba", "color_cara", "color_pelo", "color_cejas", "color_gafas", "nombre", "perfil")
				),
				"eliminar" => array (
					"description" => "elimina un aev", 
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
	   		$sql = "SELECT * FROM aev WHERE id_usuario='".$id."'";
			return $this->query($sql);
	   }
	
	   function listarTodos()
	   {
	   		$sql = "SELECT * FROM aev";
			return $this->query($sql);
	   }

	   function contar()
	   {
	   		$sql = "SELECT id_usuario FROM aev";
			return $this->query($sql);
	   }

	   function insertar($id_usuario, $cuerpo, $gafas, $gafas_y, $gafas_h, $gafas_w, $pecas, $pecas_y, $pecas_h, $pecas_w, $cosas_cara, $cosas_cara_y, $cosas_cara_h, $cosas_cara_w, $bigote, $bigote_y, $bigote_h, $bigote_w, $barba, $barba_y, $barba_h, $barba_w, $boca, $boca_y, $boca_h, $boca_w, $nariz, $nariz_y, $nariz_h, $nariz_w, $cejas, $cejas_y, $ceja1_x, $ceja2_x, $cejas_h, $cejas_w, $ceja1_r, $ceja2_r, $ojos, $ojos_y, $ojo1_x, $ojo2_x, $ojos_h, $ojos_w, $ojo1_r, $ojo2_r, $cara, $cara_y, $cara_w, $cara_h, $pelo, $pelo_y, $pelo_h, $pelo_w, $sombrero, $sombrero_y, $sombrero_h, $sombrero_w, $color_torso, $color_piernas, $color_barba, $color_cara, $color_pelo, $color_cejas, $color_gafas, $nombre, $perfil)
	   {
			$sql="SELECT id_usuario FROM aev";
			$recordset = $this->query($sql);
			
			$ptr = mysql_fetch_array($recordset);
			$yaexiste = false;
			
			while($ptr && !$yaexiste)
			{
			  if($ptr["id_usuario"] == $id_usuario )
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
			  $sql = "UPDATE aev SET cuerpo='".$cuerpo."', gafas='".$gafas."', gafas_y='".$gafas_y."', gafas_h='".$gafas_h."', gafas_w='".$gafas_w."', pecas='".$pecas."', pecas_y='".$pecas_y."', pecas_h='".$pecas_h."', pecas_w='".$pecas_w."', cosas_cara='".$cosas_cara."', cosas_cara_y='".$cosas_cara_y."', cosas_cara_h='".$cosas_cara_h."', cosas_cara_w='".$cosas_cara_w."', bigote='".$bigote."', bigote_y='".$bigote_y."', bigote_h='".$bigote_h."', bigote_w='".$bigote_w."', barba='".$barba."', barba_y='".$barba_y."', barba_h='".$barba_h."', barba_w='".$barba_w."', boca='".$boca."', boca_y='".$boca_y."', boca_h='".$boca_h."', boca_w='".$boca_w."', nariz='".$nariz."', nariz_y='".$nariz_y."', nariz_h='".$nariz_h."', nariz_w='".$nariz_w."', cejas='".$cejas."', cejas_y='".$cejas_y."', ceja1_x='".$ceja1_x."', ceja2_x='".$ceja2_x."', cejas_h='".$cejas_h."', cejas_w='".$cejas_w."', ceja1_r='".$ceja1_r."', ceja2_r='".$ceja2_r."', ojos='".$ojos."', ojos_y='".$ojos_y."', ojo1_x='".$ojo1_x."', ojo2_x='".$ojo2_x."', ojos_h='".$ojos_h."', ojos_w='".$ojos_w."', ojo1_r='".$ojo1_r."', ojo2_r='".$ojo2_r."', cara='".$cara."', cara_y='".$cara_y."', cara_w='".$cara_w."', cara_h='".$cara_h."', pelo='".$pelo."', pelo_y='".$pelo_y."', pelo_h='".$pelo_h."', pelo_w='".$pelo_w."', sombrero='".$sombrero."', sombrero_y='".$sombrero_y."', sombrero_h='".$sombrero_h."', sombrero_w='".$sombrero_w."', color_torso='".$color_torso."', color_piernas='".$color_piernas."', color_barba='".$color_barba."', color_cara='".$color_cara."', color_pelo='".$color_pelo."', color_cejas='".$color_cejas."', color_gafas='".$color_gafas."', nombre='".$nombre."', perfil='".$perfil."' WHERE id_usuario='".$id_usuario."'";
				if( !$this->query($sql) )
					return 2;
				else
					return 0;
			}
			else  		
			{
				$sql = "INSERT INTO aev (id_usuario, cuerpo, gafas, gafas_y, gafas_h, gafas_w, pecas, pecas_y, pecas_h, pecas_w, cosas_cara, cosas_cara_y, cosas_cara_h, cosas_cara_w, bigote, bigote_y, bigote_h, bigote_w, barba, barba_y, barba_h, barba_w, boca, boca_y, boca_h, boca_w, nariz, nariz_y, nariz_h, nariz_w, cejas, cejas_y, ceja1_x, ceja2_x, cejas_h, cejas_w, ceja1_r, ceja2_r, ojos, ojos_y, ojo1_x, ojo2_x, ojos_h, ojos_w, ojo1_r, ojo2_r, cara, cara_y, cara_w, cara_h, pelo, pelo_y, pelo_h, pelo_w, sombrero, sombrero_y, sombrero_h, sombrero_w, color_torso, color_piernas, color_barba, color_cara, color_pelo, color_cejas, color_gafas, nombre, perfil) VALUES('".$id_usuario."', '".$cuerpo."', '".$gafas."', '".$gafas_y."', '".$gafas_h."', '".$gafas_w."', '".$pecas."', '".$pecas_y."', '".$pecas_h."', '".$pecas_w."', '".$cosas_cara."', '".$cosas_cara_y."', '".$cosas_cara_h."', '".$cosas_cara_w."', '".$bigote."', '".$bigote_y."', '".$bigote_h."', '".$bigote_w."', '".$barba."', '".$barba_y."', '".$barba_h."', '".$barba_w."', '".$boca."', '".$boca_y."', '".$boca_h."', '".$boca_w."', '".$nariz."', '".$nariz_y."', '".$nariz_h."', '".$nariz_w."', '".$cejas."', '".$cejas_y."', '".$ceja1_x."', '".$ceja2_x."', '".$cejas_h."', '".$cejas_w."', '".$ceja1_r."', '".$ceja2_r."', '".$ojos."', '".$ojos_y."', '".$ojo1_x."', '".$ojo2_x."', '".$ojos_h."', '".$ojos_w."', '".$ojo1_r."', '".$ojo2_r."', '".$cara."', '".$cara_y."', '".$cara_w."', '".$cara_h."', '".$pelo."', '".$pelo_y."', '".$pelo_h."', '".$pelo_w."', '".$sombrero."', '".$sombrero_y."', '".$sombrero_h."', '".$sombrero_w."', '".$color_torso."', '".$color_piernas."', '".$color_barba."', '".$color_cara."', '".$color_pelo."', '".$color_cejas."', '".$color_gafas."', '".$nombre."', '".$perfil."')";
				if( !$this->query($sql) )
					return 2;
				else
					return 0;
			}
	   }
	   
	   function eliminar($id)
	   {
	   		$sql = "DELETE FROM aev WHERE id_usuario='".$id."'";
			return $this->query($sql);	
	   }
	   
	   function query ($sql)
	   {
	    	$conex= mysql_connect("localhost","gazpachu_webmark","TekOfn08") or die("no se puede conectar porque ".mysql_error());
			mysql_select_db("gazpachu_webmarket");
			$result = mysql_query($sql);
			mysql_close($conex);				   
	   		return $result;
	   }
}
	   
?>