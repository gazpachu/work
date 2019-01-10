<?php

class Villas
{
	   function Villas()
	   {
		   $this->methodTable = array
		   (
				"listar" => array (
					"description" => "devuelve la villa solicitada", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listar_en" => array (
					"description" => "devuelve la villa solicitada en ingles", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listar_revision" => array (
					"description" => "devuelve la revision solicitada", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listar_revision_en" => array (
					"description" => "devuelve la revision solicitada en ingles", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"listarTodas" => array (
					"description" => "devuelve todas las villas", 
					"access" => "remote"
				),
				"listarNombres" => array (
					"description" => "devuelve todos los nombres de las villas", 
					"access" => "remote"
				),
				"buscar" => array (
					"description" => "devuelve la villas solicitadas", 
					"access" => "remote",
					"arguments" => array("comunidad", "provincia", "localidad", "servicios", "aguas", "nombre")
				),
				"insertar" => array (
					"description" => "inserta una nueva villas", 
					"access" => "remote",
					"arguments" => array("id_villa", "nombre", "slogan", "descripcion", "rec_naturales", "rec_culturales", "nucleos", "excursiones", "productos", "gastronomia", "fiestas", "tipo_aguas", "tecnicas", "servicios", "direccion", "telefono", "fax", "email", "web", "municipio", "comarca", "marca", "provincia", "comunidad", "autopista", "autovia", "nacionales", "locales", "alojamientos1", "alojamientos2", "restaurantes1", "restaurantes2", "aguas", "activa", "lat", "lon", "gps", "kml")
				),
				"modificar" => array (
					"description" => "modifica una villa", 
					"access" => "remote",
					"arguments" => array("sobrescribir", "id", "nombre", "slogan", "descripcion", "rec_naturales", "rec_culturales", "nucleos", "excursiones", "productos", "gastronomia", "fiestas", "tipo_aguas", "tecnicas", "servicios", "direccion", "telefono", "fax", "email", "web", "municipio", "comarca", "marca", "provincia", "comunidad", "autopista", "autovia", "nacionales", "locales", "alojamientos1", "alojamientos2", "restaurantes1", "restaurantes2", "aguas", "activa", "lat", "lon", "gps", "kml")
				),
				"modificar_en" => array (
					"description" => "modifica una villa en ingles", 
					"access" => "remote",
					"arguments" => array("sobrescribir", "id", "nombre", "slogan", "descripcion", "rec_naturales", "rec_culturales", "nucleos", "excursiones", "productos", "gastronomia", "fiestas", "tipo_aguas", "tecnicas", "servicios", "direccion", "telefono", "fax", "email", "web", "municipio", "comarca", "marca", "provincia", "comunidad", "autopista", "autovia", "nacionales", "locales", "alojamientos1", "alojamientos2", "restaurantes1", "restaurantes2", "aguas", "activa", "lat", "lon", "gps", "kml")
				),
				"revisar" => array (
					"description" => "revisar una villa", 
					"access" => "remote",
					"arguments" => array("id", "nombre", "slogan", "descripcion", "rec_naturales", "rec_culturales", "nucleos", "excursiones", "productos", "gastronomia", "fiestas", "tipo_aguas", "tecnicas", "servicios", "direccion", "telefono", "fax", "email", "web", "municipio", "comarca", "marca", "provincia", "comunidad", "autopista", "autovia", "nacionales", "locales", "alojamientos1", "alojamientos2", "restaurantes1", "restaurantes2", "aguas", "activa", "lat", "lon", "gps", "kml")
				),
				"revisar_en" => array (
					"description" => "revisar una villa en ingles", 
					"access" => "remote",
					"arguments" => array("id", "nombre", "slogan", "descripcion", "rec_naturales", "rec_culturales", "nucleos", "excursiones", "productos", "gastronomia", "fiestas", "tipo_aguas", "tecnicas", "servicios", "direccion", "telefono", "fax", "email", "web", "municipio", "comarca", "marca", "provincia", "comunidad", "autopista", "autovia", "nacionales", "locales", "alojamientos1", "alojamientos2", "restaurantes1", "restaurantes2", "aguas", "activa", "lat", "lon", "gps", "kml")
				),
				"pendientes" => array (
					"description" => "devuelve las villas pendientes de revision", 
					"access" => "remote"
				),
				"pendientes_en" => array (
					"description" => "devuelve las villas pendientes de revision en ingles", 
					"access" => "remote"
				),
				"rechazar" => array (
					"description" => "rechaza la revision", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"aceptar" => array (
					"description" => "acepta la revision", 
					"access" => "remote",
					"arguments" => array("id")
				),
				"eliminar" => array (
					"description" => "elimina una villa", 
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
	   			$sql = "SELECT * FROM villas WHERE id_villa='".$id."'";
					return $this->query($sql);
	   }
	   
	   function listar_en($id)
	   {
	   			$sql = "SELECT * FROM villas_en WHERE id_villa='".$id."'";
					return $this->query($sql);
	   }
	   
	   function listar_revision($id)
	   {
	   			$sql = "SELECT * FROM revisiones WHERE id_villa='".$id."'";
					return $this->query($sql);
	   }
	   
	   function listar_revision_en($id)
	   {
	   			$sql = "SELECT * FROM revisiones_en WHERE id_villa='".$id."'";
					return $this->query($sql);
	   }
	
	   function listarTodas()
	   {
	   	  	$sql = "SELECT * FROM villas";
					return $this->query($sql);
	   }
	   
	   function listarNombres()
	   {
	   	  	$sql = "SELECT id_villa, nombre FROM villas ORDER BY nombre ASC";
					return $this->query($sql);
	   }
	   
	   function buscar($comunidad, $provincia, $localidad, $servicios, $aguas, $nombre)
	   {
					$sql = "SELECT id_villa, nombre, descripcion FROM villas WHERE 1 AND activa=1 ";
			
					if(!empty($nombre))
			 			$sql .= "AND SOUNDEX(nombre) = SOUNDEX('%".$nombre."%') OR LOWER(nombre) LIKE LOWER('%".$nombre."%')";
					
					if(!empty($comunidad) && $comunidad != "Todas")
			 			$sql .= "AND SOUNDEX(comunidad) = SOUNDEX('%".$comunidad."%') OR LOWER(comunidad) LIKE LOWER('%".$comunidad."%')";
					
					if(!empty($provincia) && $provincia != "Todas")
			 			$sql .= "AND SOUNDEX(provincia) = SOUNDEX('%".$provincia."%') OR LOWER(provincia) LIKE LOWER('%".$provincia."%')";
					
					if(!empty($localidad))
			 			$sql .= "AND SOUNDEX(localidad) = SOUNDEX('%".$localidad."%') OR LOWER(localidad) LIKE LOWER('%".$localidad."%')";
					
					if(!empty($servicios) && $servicios != "Todos")
			 			$sql .= "AND SOUNDEX(servicios) = SOUNDEX('%".$servicios."%') OR LOWER(servicios) LIKE LOWER('%".$servicios."%')";
					
					if(!empty($aguas) && $aguas != "Todas")
			 			$sql .= "AND SOUNDEX(tipo_aguas) = SOUNDEX('%".$aguas."%') OR LOWER(tipo_aguas) LIKE LOWER('%".$aguas."%')";
			
					return $this->query($sql);
	   }
	   
	   function insertar($id_villa, $nombre, $slogan, $descripcion, $rec_naturales, $rec_culturales, $nucleos, $excursiones, $productos, $gastronomia, $fiestas, $tipo_aguas, $tecnicas, $servicios, $direccion, $telefono, $fax, $email, $web, $municipio, $comarca, $marca, $provincia, $comunidad, $autopista, $autovia, $nacionales, $locales, $alojamientos1, $alojamientos2, $restaurantes1, $restaurantes2, $aguas, $activa, $lat, $lon, $gps, $kml)
	   {
	   			$sql = "INSERT INTO villas (id_villa, nombre, slogan, descripcion, rec_naturales, rec_culturales, nucleos, excursiones, productos, gastronomia, fiestas, tipo_aguas, tecnicas, servicios, direccion, telefono, fax, email, web, municipio, comarca, marca, provincia, comunidad, autopista, autovia, nacionales, locales, alojamientos1, alojamientos2, restaurantes1, restaurantes2, aguas, activa, lat, lon, gps, kml) VALUES('".$id_villa."', '".$nombre."', '".$slogan."', '".$descripcion."', '".$rec_naturales."', '".$rec_culturales."', '".$nucleos."', '".$excursiones."', '".$productos."', '".$gastronomia."', '".$fiestas."', '".$tipo_aguas."', '".$tecnicas."', '".$servicios."', '".$direccion."', '".$telefono."', '".$fax."', '".$email."', '".$web."', '".$municipio."', '".$comarca."', '".$marca."', '".$provincia."', '".$comunidad."', '".$autopista."', '".$autovia."', '".$nacionales."', '".$locales."', '".$alojamientos1."', '".$alojamientos2."', '".$restaurantes1."', '".$restaurantes2."', '".$aguas."', '".$activa."', '".$lat."', '".$lon."', '".$gps."', '".$kml."')";
	   			
	   			if( $this->query($sql) )
	   				$sql = "INSERT INTO villas_en (id_villa, nombre, slogan, descripcion, rec_naturales, rec_culturales, nucleos, excursiones, productos, gastronomia, fiestas, tipo_aguas, tecnicas, servicios, direccion, telefono, fax, email, web, municipio, comarca, marca, provincia, comunidad, autopista, autovia, nacionales, locales, alojamientos1, alojamientos2, restaurantes1, restaurantes2, aguas, activa, lat, lon, gps, kml) VALUES('".$id_villa."', '".$nombre."', '".$slogan."', '".$descripcion."', '".$rec_naturales."', '".$rec_culturales."', '".$nucleos."', '".$excursiones."', '".$productos."', '".$gastronomia."', '".$fiestas."', '".$tipo_aguas."', '".$tecnicas."', '".$servicios."', '".$direccion."', '".$telefono."', '".$fax."', '".$email."', '".$web."', '".$municipio."', '".$comarca."', '".$marca."', '".$provincia."', '".$comunidad."', '".$autopista."', '".$autovia."', '".$nacionales."', '".$locales."', '".$alojamientos1."', '".$alojamientos2."', '".$restaurantes1."', '".$restaurantes2."', '".$aguas."', '".$activa."', '".$lat."', '".$lon."', '".$gps."', '".$kml."')";
	   			
	   			if( $this->query($sql) )
	   				$sql = "INSERT INTO revisiones (id_villa, nombre, slogan, descripcion, rec_naturales, rec_culturales, nucleos, excursiones, productos, gastronomia, fiestas, tipo_aguas, tecnicas, servicios, direccion, telefono, fax, email, web, municipio, comarca, marca, provincia, comunidad, autopista, autovia, nacionales, locales, alojamientos1, alojamientos2, restaurantes1, restaurantes2, aguas, activa, lat, lon, gps, kml) VALUES('".$id_villa."', '".$nombre."', '".$slogan."', '".$descripcion."', '".$rec_naturales."', '".$rec_culturales."', '".$nucleos."', '".$excursiones."', '".$productos."', '".$gastronomia."', '".$fiestas."', '".$tipo_aguas."', '".$tecnicas."', '".$servicios."', '".$direccion."', '".$telefono."', '".$fax."', '".$email."', '".$web."', '".$municipio."', '".$comarca."', '".$marca."', '".$provincia."', '".$comunidad."', '".$autopista."', '".$autovia."', '".$nacionales."', '".$locales."', '".$alojamientos1."', '".$alojamientos2."', '".$restaurantes1."', '".$restaurantes2."', '".$aguas."', '".$activa."', '".$lat."', '".$lon."', '".$gps."', '".$kml."')";
	   			
	   			if( $this->query($sql) )
	   				$sql = "INSERT INTO revisiones_en (id_villa, nombre, slogan, descripcion, rec_naturales, rec_culturales, nucleos, excursiones, productos, gastronomia, fiestas, tipo_aguas, tecnicas, servicios, direccion, telefono, fax, email, web, municipio, comarca, marca, provincia, comunidad, autopista, autovia, nacionales, locales, alojamientos1, alojamientos2, restaurantes1, restaurantes2, aguas, activa, lat, lon, gps, kml) VALUES('".$id_villa."', '".$nombre."', '".$slogan."', '".$descripcion."', '".$rec_naturales."', '".$rec_culturales."', '".$nucleos."', '".$excursiones."', '".$productos."', '".$gastronomia."', '".$fiestas."', '".$tipo_aguas."', '".$tecnicas."', '".$servicios."', '".$direccion."', '".$telefono."', '".$fax."', '".$email."', '".$web."', '".$municipio."', '".$comarca."', '".$marca."', '".$provincia."', '".$comunidad."', '".$autopista."', '".$autovia."', '".$nacionales."', '".$locales."', '".$alojamientos1."', '".$alojamientos2."', '".$restaurantes1."', '".$restaurantes2."', '".$aguas."', '".$activa."', '".$lat."', '".$lon."', '".$gps."', '".$kml."')";
					
					return $this->query($sql);
	   }
	   
	   function modificar($sobrescribir, $id, $nombre, $slogan, $descripcion, $rec_naturales, $rec_culturales, $nucleos, $excursiones, $productos, $gastronomia, $fiestas, $tipo_aguas, $tecnicas, $servicios, $direccion, $telefono, $fax, $email, $web, $municipio, $comarca, $marca, $provincia, $comunidad, $autopista, $autovia, $nacionales, $locales, $alojamientos1, $alojamientos2, $restaurantes1, $restaurantes2, $aguas, $activa, $lat, $lon, $gps, $kml)
	   {
	   			$sql = "UPDATE villas SET nombre='".$nombre."', slogan='".$slogan."', descripcion='".$descripcion."', rec_naturales='".$rec_naturales."', rec_culturales='".$rec_culturales."', nucleos='".$nucleos."', excursiones='".$excursiones."', productos='".$productos."', gastronomia='".$gastronomia."', fiestas='".$fiestas."', tipo_aguas='".$tipo_aguas."', tecnicas='".$tecnicas."', servicios='".$servicios."', direccion='".$direccion."', telefono='".$telefono."', fax='".$fax."', email='".$email."', web='".$web."', municipio='".$municipio."', comarca='".$comarca."', marca='".$marca."', provincia='".$provincia."', comunidad='".$comunidad."', autopista='".$autopista."', autovia='".$autovia."', nacionales='".$nacionales."', locales='".$locales."', alojamientos1='".$alojamientos1."', alojamientos2='".$alojamientos2."', restaurantes1='".$restaurantes1."', restaurantes2='".$restaurantes2."', aguas='".$aguas."', activa='".$activa."', lat='".$lat."', lon='".$lon."', gps='".$gps."', kml='".$kml."' WHERE id_villa='".$id."'";
					$this->query($sql);
					
					if( $sobrescribir && $sql )
							$sql = "UPDATE revisiones SET nombre='".$nombre."', slogan='".$slogan."', descripcion='".$descripcion."', rec_naturales='".$rec_naturales."', rec_culturales='".$rec_culturales."', nucleos='".$nucleos."', excursiones='".$excursiones."', productos='".$productos."', gastronomia='".$gastronomia."', fiestas='".$fiestas."', tipo_aguas='".$tipo_aguas."', tecnicas='".$tecnicas."', servicios='".$servicios."', direccion='".$direccion."', telefono='".$telefono."', fax='".$fax."', email='".$email."', web='".$web."', municipio='".$municipio."', comarca='".$comarca."', marca='".$marca."', provincia='".$provincia."', comunidad='".$comunidad."', autopista='".$autopista."', autovia='".$autovia."', nacionales='".$nacionales."', locales='".$locales."', alojamientos1='".$alojamientos1."', alojamientos2='".$alojamientos2."', restaurantes1='".$restaurantes1."', restaurantes2='".$restaurantes2."', aguas='".$aguas."', activa='".$activa."', lat='".$lat."', lon='".$lon."', gps='".$gps."', kml='".$kml."' WHERE id_villa='".$id."'";
					
					return $this->query($sql);
	   }
	   
	   function modificar_en($sobrescribir, $id, $nombre, $slogan, $descripcion, $rec_naturales, $rec_culturales, $nucleos, $excursiones, $productos, $gastronomia, $fiestas, $tipo_aguas, $tecnicas, $servicios, $direccion, $telefono, $fax, $email, $web, $municipio, $comarca, $marca, $provincia, $comunidad, $autopista, $autovia, $nacionales, $locales, $alojamientos1, $alojamientos2, $restaurantes1, $restaurantes2, $aguas, $activa, $lat, $lon, $gps, $kml)
	   {
	   			$sql = "UPDATE villas_en SET nombre='".$nombre."', slogan='".$slogan."', descripcion='".$descripcion."', rec_naturales='".$rec_naturales."', rec_culturales='".$rec_culturales."', nucleos='".$nucleos."', excursiones='".$excursiones."', productos='".$productos."', gastronomia='".$gastronomia."', fiestas='".$fiestas."', tipo_aguas='".$tipo_aguas."', tecnicas='".$tecnicas."', servicios='".$servicios."', direccion='".$direccion."', telefono='".$telefono."', fax='".$fax."', email='".$email."', web='".$web."', municipio='".$municipio."', comarca='".$comarca."', marca='".$marca."', provincia='".$provincia."', comunidad='".$comunidad."', autopista='".$autopista."', autovia='".$autovia."', nacionales='".$nacionales."', locales='".$locales."', alojamientos1='".$alojamientos1."', alojamientos2='".$alojamientos2."', restaurantes1='".$restaurantes1."', restaurantes2='".$restaurantes2."', aguas='".$aguas."', activa='".$activa."', lat='".$lat."', lon='".$lon."', gps='".$gps."', kml='".$kml."' WHERE id_villa='".$id."'";
					$this->query($sql);
					
					if( $sobrescribir && $sql )
							$sql = "UPDATE revisiones_en SET nombre='".$nombre."', slogan='".$slogan."', descripcion='".$descripcion."', rec_naturales='".$rec_naturales."', rec_culturales='".$rec_culturales."', nucleos='".$nucleos."', excursiones='".$excursiones."', productos='".$productos."', gastronomia='".$gastronomia."', fiestas='".$fiestas."', tipo_aguas='".$tipo_aguas."', tecnicas='".$tecnicas."', servicios='".$servicios."', direccion='".$direccion."', telefono='".$telefono."', fax='".$fax."', email='".$email."', web='".$web."', municipio='".$municipio."', comarca='".$comarca."', marca='".$marca."', provincia='".$provincia."', comunidad='".$comunidad."', autopista='".$autopista."', autovia='".$autovia."', nacionales='".$nacionales."', locales='".$locales."', alojamientos1='".$alojamientos1."', alojamientos2='".$alojamientos2."', restaurantes1='".$restaurantes1."', restaurantes2='".$restaurantes2."', aguas='".$aguas."', activa='".$activa."', lat='".$lat."', lon='".$lon."', gps='".$gps."', kml='".$kml."' WHERE id_villa='".$id."'";
					
					return $this->query($sql);
	   }
	   
	   function revisar($id, $nombre, $slogan, $descripcion, $rec_naturales, $rec_culturales, $nucleos, $excursiones, $productos, $gastronomia, $fiestas, $tipo_aguas, $tecnicas, $servicios, $direccion, $telefono, $fax, $email, $web, $municipio, $comarca, $marca, $provincia, $comunidad, $autopista, $autovia, $nacionales, $locales, $alojamientos1, $alojamientos2, $restaurantes1, $restaurantes2, $aguas, $activa, $lat, $lon, $gps, $kml)
	   {
	   			$sql = "UPDATE revisiones SET nombre='".$nombre."', slogan='".$slogan."', descripcion='".$descripcion."', rec_naturales='".$rec_naturales."', rec_culturales='".$rec_culturales."', nucleos='".$nucleos."', excursiones='".$excursiones."', productos='".$productos."', gastronomia='".$gastronomia."', fiestas='".$fiestas."', tipo_aguas='".$tipo_aguas."', tecnicas='".$tecnicas."', servicios='".$servicios."', direccion='".$direccion."', telefono='".$telefono."', fax='".$fax."', email='".$email."', web='".$web."', municipio='".$municipio."', comarca='".$comarca."', marca='".$marca."', provincia='".$provincia."', comunidad='".$comunidad."', autopista='".$autopista."', autovia='".$autovia."', nacionales='".$nacionales."', locales='".$locales."', alojamientos1='".$alojamientos1."', alojamientos2='".$alojamientos2."', restaurantes1='".$restaurantes1."', restaurantes2='".$restaurantes2."', aguas='".$aguas."', activa='".$activa."', lat='".$lat."', lon='".$lon."', gps='".$gps."', kml='".$kml."' WHERE id_villa='".$id."'";
					return $this->query($sql);
	   }
	   
	   function revisar_en($id, $nombre, $slogan, $descripcion, $rec_naturales, $rec_culturales, $nucleos, $excursiones, $productos, $gastronomia, $fiestas, $tipo_aguas, $tecnicas, $servicios, $direccion, $telefono, $fax, $email, $web, $municipio, $comarca, $marca, $provincia, $comunidad, $autopista, $autovia, $nacionales, $locales, $alojamientos1, $alojamientos2, $restaurantes1, $restaurantes2, $aguas, $activa)
	   {
	   			$sql = "UPDATE revisiones_en SET nombre='".$nombre."', slogan='".$slogan."', descripcion='".$descripcion."', rec_naturales='".$rec_naturales."', rec_culturales='".$rec_culturales."', nucleos='".$nucleos."', excursiones='".$excursiones."', productos='".$productos."', gastronomia='".$gastronomia."', fiestas='".$fiestas."', tipo_aguas='".$tipo_aguas."', tecnicas='".$tecnicas."', servicios='".$servicios."', direccion='".$direccion."', telefono='".$telefono."', fax='".$fax."', email='".$email."', web='".$web."', municipio='".$municipio."', comarca='".$comarca."', marca='".$marca."', provincia='".$provincia."', comunidad='".$comunidad."', autopista='".$autopista."', autovia='".$autovia."', nacionales='".$nacionales."', locales='".$locales."', alojamientos1='".$alojamientos1."', alojamientos2='".$alojamientos2."', restaurantes1='".$restaurantes1."', restaurantes2='".$restaurantes2."', aguas='".$aguas."', activa='".$activa."', lat='".$lat."', lon='".$lon."', gps='".$gps."', kml='".$kml."' WHERE id_villa='".$id."'";
					return $this->query($sql);
	   }
	   
	   function pendientes( )
	   {
	   			$sql = "SELECT * FROM revisiones WHERE activa='1'";
	   			return $this->query($sql);
	   }
	   
	   function pendientes_en( )
	   {
	   			$sql = "SELECT * FROM revisiones_en WHERE activa='1'";
	   			return $this->query($sql);
	   }
	   
	   function rechazar( $id )
	   {
	   			$sql = "UPDATE revisiones SET activa='0' WHERE id_villa='".$id."'";
	   			
	   			if( $this->query($sql) )
	   				$sql = "UPDATE revisiones_en SET activa='0' WHERE id_villa='".$id."'";
	   			
	   			return $this->query($sql);
	   }
	   
	   function aceptar( $id )
	   {
	   			$sql = "UPDATE revisiones SET activa='0' WHERE id_villa='".$id."'";
	   			
	   			if( $this->query($sql) )
	   				$sql = "UPDATE revisiones_en SET activa='0' WHERE id_villa='".$id."'";
	   				
	   			if( $this->query($sql) )
	   			{
	   				$sql = "UPDATE villas, revisiones SET villas.nombre=revisiones.nombre, villas.slogan=revisiones.slogan, villas.descripcion=revisiones.descripcion, villas.rec_naturales=revisiones.rec_naturales, villas.rec_culturales=revisiones.rec_culturales, villas.nucleos=revisiones.nucleos, villas.excursiones=revisiones.excursiones, villas.productos=revisiones.productos, villas.gastronomia=revisiones.gastronomia, villas.fiestas=revisiones.fiestas, villas.tipo_aguas=revisiones.tipo_aguas, villas.tecnicas=revisiones.tecnicas, villas.servicios=revisiones.servicios, villas.direccion=revisiones.direccion, villas.telefono=revisiones.telefono, villas.fax=revisiones.fax, villas.email=revisiones.email, villas.web=revisiones.web, villas.municipio=revisiones.municipio, villas.comarca=revisiones.comarca, villas.marca=revisiones.marca, villas.provincia=revisiones.provincia, villas.comunidad=revisiones.comunidad, villas.autopista=revisiones.autopista, villas.autovia=revisiones.autovia, villas.nacionales=revisiones.nacionales, villas.locales=revisiones.locales, villas.alojamientos1=revisiones.alojamientos1, villas.alojamientos2=revisiones.alojamientos2, villas.restaurantes1=revisiones.restaurantes1, villas.restaurantes2=revisiones.restaurantes2, villas.aguas=revisiones.aguas, villas.lat=revisiones.lat, villas.lon=revisiones.lon, villas.gps=revisiones.gps, villas.kml=revisiones.kml WHERE villas.id_villa = revisiones.id_villa AND villas.id_villa = '".$id."'";
	   			}
	   			
	   			return $this->query($sql);
	   }
	   
	   function eliminar($id)
	   {
	   			$sql = "DELETE FROM villas WHERE id_villa='".$id."'";
	   			
	   			if( $this->query($sql) )
	   				$sql = "DELETE FROM villas_en WHERE id_villa='".$id."'";
	   			
	   			if( $this->query($sql) )
	   				$sql = "DELETE FROM revisiones WHERE id_villa='".$id."'";
	   				
	   			if( $this->query($sql) )
	   				$sql = "DELETE FROM revisiones_en WHERE id_villa='".$id."'";
	   			
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