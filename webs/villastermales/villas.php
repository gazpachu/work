<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
  <head>
    <meta name="title" content="Villas Termales"/>
	<meta name="keywords" content="villas termales" />
	<meta name="description" content="Villas Termales" />
	<meta name="searchtitle" content="Villas Termales" />
	<meta name="author" content="" />
	<meta name="GOOGLEBOT" content="index follow" />
	<meta name="Revisit" content="1 days" />
	<meta name="robots" content="index,follow,all" />
	<meta name="revisit-after" content="3 days" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="Expires" content="Mon, 01 Jan 1990 00:00:01 GMT" />
	<meta name="language" content="es" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="shortcut icon" href="images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
	<title>Villas Termales</title>
    
    <script type="text/javascript" src="ufo.js"></script>
    
    <script type="text/javascript">
		// <![CDATA[
		function getQueryParamValue(param)
		{
			var q = document.location.search || document.location.hash;
			if(q){
				var startIndex = q.indexOf(param +"=");
				var endIndex = (q.indexOf("&", startIndex) > -1) ? q.indexOf("&", startIndex) : q.length;
				if (q.length > 1 && startIndex > -1) {
					return q.substring(q.indexOf("=", startIndex)+1, endIndex);
				}
			}
			return "";
		}
		// ]]>
	</script>
   		
	<script type="text/javascript">
		// <![CDATA[
		var FO = { movie:"flash/villas.swf", width:"1024", height:"768", flashvars: "villa=" + getQueryParamValue("villa") + "&lang=" + getQueryParamValue("lang") + "&revision=" + getQueryParamValue("revision"), majorversion:"8", build:"0", setcontainercss:"true", wmode:"transparent", menu:"false", quality:"best", bgcolor:"#D0D4D3", scale:"noscale", align:"middle" };
		UFO.create(FO, "flashcontent");
		// ]]>
	</script>
   		
  </head>
  
  <body id="type-d">
  <div id="container">
  	<div id="flashcontent">
	     <div id="wrap">
			<div id="header">
            
				<?php
                    include("db.php");
                    
                    $fecha = date("d/m/Y");
                    $ip = $_SERVER[REMOTE_ADDR];// obtenemos ip del usuario  		
                    $sql = "INSERT INTO stats_villa (id_villa, ip, fecha) VALUES ('".$_GET["villa"]."', '$ip', '$fecha')";
                    query($sql);
                ?>
            
				<div id="site-name"><a name="top" id="top"></a><img src="images/logo.gif" width="25" height="25" alt="Logo Villas Termales" /> VillasTermales.com</div>
				<ul id="nav">
				  <li class="first"><a href="listado_villas.php">
				<span style="background-position: 0% 0%">Volver al listado de Villas Termales</span></a></li>
				</ul>
			</div>

			<div id="content-wrap">
			  <div id="content">
			    <?php 
				
					include("db.php");
					
					$sql = "SELECT * FROM villas WHERE id_villa = '".$_GET["villa"]."'";
					
					$recordset = query($sql);
					
					$ptr = mysql_fetch_array($recordset);
					
					while($ptr)
					{
						echo "<h1>" . utf8_decode($ptr["nombre"]) . "</h1>";
						echo "<br />";
						echo "<h2>" . utf8_decode($ptr["slogan"]) . "</h2>";
						echo "<br />";
						
						echo "<img src=\"pics/" . $ptr["id_villa"] . "/portada.jpg\" width=\"360\" height=\"270\" class=\"image\" alt=\"" . utf8_decode($ptr["nombre"]) . "\" title=\"" . utf8_decode($ptr["nombre"]) . "\" />";
						
						echo utf8_decode(strip_tags($ptr["descripcion"]));
						echo "<br />";
						
						echo "<h3>Recursos naturales</h3>";
						echo utf8_decode(strip_tags($ptr["rec_naturales"]));
						echo "<br />";
						
						echo "<h3>Recursos culturales</h3>";
						echo utf8_decode(strip_tags($ptr["rec_culturales"]));
						echo "<br />";
						
						echo "<h3>N&uacute;cleos urbanos pr&oacute;ximos</h3>";
						echo utf8_decode(strip_tags($ptr["nucleos"]));
						echo "<br />";
						
						echo "<h3>Excursiones</h3>";
						echo utf8_decode(strip_tags($ptr["excursiones"]));
						echo "<br />";
						
						echo "<h3>Productos t&iacute;picos</h3>";
						echo utf8_decode(strip_tags($ptr["productos"]));
						echo "<br />";
						
						echo "<h3>Gastronom&iacute;a</h3>";
						echo utf8_decode(strip_tags($ptr["gastronomia"]));
						echo "<br />";
						
						echo "<h3>Fiestas locales</h3>";
						echo utf8_decode(strip_tags($ptr["fiestas"]));
						echo "<br />";
						
						echo "<h3>Aguas mineromedicinales</h3>";
						echo utf8_decode(strip_tags($ptr["tipo_aguas"]));
						echo "<br />";
						
						echo "<h3>Alojamientos</h3>";
						echo utf8_decode(strip_tags($ptr["alojamientos1"]));
						echo "<br />";
						echo utf8_decode(strip_tags($ptr["alojamientos2"]));
						
						echo "<h3>Restaurantes</h3>";
						echo utf8_decode(strip_tags($ptr["restaurantes1"]));
						echo "<br />";
						echo utf8_decode(strip_tags($ptr["restaurantes2"]));
						
						echo "<h3>Balnearios</h3>";
						
						echo "<strong>Direcci&oacute;n: </strong>" . utf8_decode($ptr["direccion"]);
						echo "<br />";
						echo "<strong>Tel&eacute;fono: </strong>" . utf8_decode($ptr["telefono"]);
						echo "<br />";
						echo "<strong>Fax: </strong>" . utf8_decode($ptr["fax"]);
						echo "<br />";
						echo "<strong>E-mail: </strong> <a href=\"mailto:" . utf8_decode($ptr["email"]) . "\">" . utf8_decode($ptr["email"]) . "</a>";
						echo "<br />";
						echo "<strong>P&aacute;gina Web: </strong> <a href=\"" . utf8_decode($ptr["web"]) . "\">" . utf8_decode($ptr["web"]) . "</a>";
						echo "<br />";
						
						echo "<h3>Tipos de aguas</h3>";
						echo utf8_decode(strip_tags($ptr["aguas"]));
						echo "<br />";
						
						echo "<h3>T&eacute;cnicas</h3>";
						echo utf8_decode(strip_tags($ptr["tecnicas"]));
						echo "<br />";
						
						echo "<h3>Servicios</h3>";
						echo utf8_decode(strip_tags($ptr["servicios"]));
						echo "<br />";
						
						echo "<h3>Localización</h3>";
						
						echo "<strong>Municipio: </strong>" . utf8_decode($ptr["municipio"]);
						echo "<br />";
						echo "<strong>Comarca: </strong>" . utf8_decode($ptr["comarca"]);
						echo "<br />";
						echo "<strong>Marca tur&iacute;stica: </strong>" . utf8_decode($ptr["marca"]);
						echo "<br />";
						echo "<strong>Provincia: </strong>" . utf8_decode($ptr["provincia"]);
						echo "<br />";
						echo "<strong>Comunidad aut&oacute;noma: </strong>" . utf8_decode($ptr["comunidad"]);
						echo "<br />";
						
						echo "<h3>Accesibilidad</h3>";
						
						echo "<strong>Autopistas: </strong>" . utf8_decode($ptr["autopista"]);
						echo "<br />";
						echo "<strong>Autovias: </strong>" . utf8_decode($ptr["autovia"]);
						echo "<br />";
						echo "<strong>Carreteras nacionales: </strong>" . utf8_decode($ptr["nacionales"]);
						echo "<br />";
						echo "<strong>Carreteras locales: </strong>" . utf8_decode($ptr["locales"]);
						echo "<br />";
						
						if( $ptr["gps"] != "" )
						{
							echo "<h3>Descargar datos GPS</h3>";
							
							echo "<a href=\"" . utf8_decode($ptr["gps"]) . "\">Click aqu&iacute; para descargar</a>";
						}
						
						echo "<h3>Im&aacute;genes</h3>";
						echo "<br />";
						
						$cuenta = 1;
						
						while ( $cuenta <= 30)
						{
							$tempStr = "pics/" . $ptr["id_villa"] . "/thumb_pic" . $cuenta . ".jpg";
							
							if( file_exists( $tempStr ) )
							{
								echo "<a href=\"pics/" . $ptr["id_villa"] . "/pic" . $cuenta . ".jpg\"><img src=\"pics/" . $ptr["id_villa"] . "/thumb_pic" . $cuenta . ".jpg\" width=\"70\" height=\"45\" class=\"imageNews\" alt=\"" . utf8_decode($ptr["nombre"]) . "\" title=\"" . utf8_decode($ptr["nombre"]) . "\" /></a>";
							}
							$cuenta++;
						}
						
						$ptr = mysql_fetch_array($recordset);
					}
				?>
			    <br /><br />
				<div id="footer">
                  <p>
                    <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml10-blue"
        alt="XHTML 1.0 Strict valido" height="31" width="88" /></a> <a href="http://jigsaw.w3.org/css-validator/"><img style="border:0;width:88px;height:31px"
        src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
        alt="¡CSS Válido!" />
                    </a>
                    <a href="http://www.w3.org/WAI/ATAG10AA-Conformance"
      title="Explanation of Level Double-A Conformance">
  <img height="32" width="88" src="http://www.w3.org/WAI/atag10AA" alt="Level Double-A conformance icon, W3C-WAI Authoring Tool Accessibility Guidelines 1.0" /></a>
                  </p>
</div>
					
			  </div>
				
				<div id="sidebar">
		
					<div class="featurebox">
					<h3>VillasTermales versi&oacute;n extendida</h3>
					<p><strong>Para poder visualizar la versi&oacute;n extendida de VillasTermales.com, </strong>es necesario tener instalado el reproductor de Flash. Haga <a href="http://get.adobe.com/es/flashplayer/" title="Descargar Adobe Flash player">click aqu&iacute;</a> para obtener m&aacute;s informaci&oacute;n.</p>
					</div>
					
					<div class="featurebox">
					<h3>El ocio se convierte en salud</h3>
					<p>Mejora tu salud con los beneficios de las aguas minero-medicinales y sus tratamientos. Respira aire puro entre montes, rios y bosques.</p>
					<ul>
					<li><strong>Todo tipo de deportes</strong></li>
					<li><strong>Excursiones por entornos con un patrimonio cultural y arquitect&oacute;nico de valor incalculable</strong></li>
					<li><strong>Sin olvidarte de saborear la rica oferta gastron&oacute;mica de nuestro pa&iacute;s.</strong></li></ul></div>
						
				</div>
				
		   </div>
		</div>   
    </div> 
    </div>
  </body>
</html>