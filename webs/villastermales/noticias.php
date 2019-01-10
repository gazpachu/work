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
		var FO = { movie:"flash/main.swf", width:"100%", height:"100%", majorversion:"8", build:"0", setcontainercss:"true", menu:"false", quality:"best", bgcolor:"#D0D4D3", scale:"noscale", salign:"TL" };
		UFO.create(FO, "flashcontent");
		// ]]>
	</script>
   		
  </head>
  
  <body id="type-d">
  	<div id="flashcontent">
	     <div id="wrap">
			<div id="header">
				<div id="site-name"><a name="top" id="top"></a><img src="images/logo.gif" width="25" height="25" alt="Logo Villas Termales" /> VillasTermales.com</div>
				<ul id="nav">
				  <li class="first"><a href="/index.html">
				<span style="background-position: 0% 0%">Volver a la portada</span></a></li>
				</ul>
			</div>

			<div id="content-wrap">
			  <div id="content">
				<h1>Noticias de VillasTermales.com</h1>
				<br />
				<?php 
				
					include("db.php");
					
					$sql = "SELECT * FROM noticias";
					
					$recordset = query($sql);
					
					$ptr = mysql_fetch_array($recordset);
					
					while($ptr)
					{
						echo "<h2>" . utf8_decode($ptr["titulo"]) . "</h2>";
						echo "\n\n";
						echo "<em><strong>Fecha de publicaci&oacute;n: </strong>" . utf8_decode($ptr["fecha"]) . "</em><br />";
						echo "\n\n";
						echo utf8_decode($ptr["descripcion"]);
						echo "<br /><br />";
						
						if( $ptr["foto1"] != "" )
						echo "<a href=\"pics/noticia_" . $ptr["id"] . "pic1.jpg\"><img src=\"pics/thumb_noticia_" . $ptr["id"] . "pic1.jpg\" width=\"160\" height=\"120\" class=\"imageNews\" alt=\"" . utf8_decode($ptr["titulo"]) . "\" title=\"" . utf8_decode($ptr["titulo"]) . "\" /></a>";
						
						if( $ptr["foto2"] != "" )
						echo "<a href=\"pics/noticia_" . $ptr["id"] . "pic2.jpg\"><img src=\"pics/thumb_noticia_" . $ptr["id"] . "pic2.jpg\" width=\"160\" height=\"120\" class=\"imageNews\" alt=\"" . utf8_decode($ptr["titulo"]) . "\" title=\"" . utf8_decode($ptr["titulo"]) . "\" /></a>";
						
						if( $ptr["foto3"] != "" )
						echo "<a href=\"pics/noticia_" . $ptr["id"] . "pic3.jpg\"><img src=\"pics/thumb_noticia_" . $ptr["id"] . "pic3.jpg\" width=\"160\" height=\"120\" class=\"imageNews\" alt=\"" . utf8_decode($ptr["titulo"]) . "\" title=\"" . utf8_decode($ptr["titulo"]) . "\" /></a>";
						
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
  </body>
</html>