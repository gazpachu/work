<?php
require('fpdf/fpdf.php');

$preguntas = array("�Qu� producto se anuncia?", "�Qui�n aparece en el anuncio?", "�Qu� otros elementos aparecen?", "�Qu� eslogan se incluye?",
								"�A qui�nes parece dirigido el anuncio?", "�Qu� colores destacan?", "�Por qu� se usa ese eslogan de ''Estoy frito''?", "�Qu� reclamo se utiliza para llamar la atenci�n?",
								
								"�Qu� producto se anuncia?", "�Qui�n aparece en el anuncio?", "�Qu� otros elementos aparecen?", "�Qu� eslogan se incluye y c�mo?",
								"�A qui�nes parece dirigido el anuncio?", "�Qu� colores destacan?", "�Por qu� se usa ese eslogan", "�Qu� reclamo se utiliza para llamar la atenci�n?",
								
								"�Qu� producto se anuncia?", "�Qui�n aparece en el anuncio?", "�Qu� otros elementos aparecen?", "�Qu� eslogan se incluye",
								"�A qui�nes parece dirigido el anuncio?", "�Qu� colores destacan?", "�Por qu� se usan esas palabras?", "�Qu� reclamo se utiliza para llamar la atenci�n?",
								
								"�Qu� producto se anuncia?", "�Qui�n aparece en el anuncio?", "�Qu� otros elementos aparecen?", "�Qu� eslogan se incluye",
								"�A qui�nes parece dirigido el anuncio, fechado en 1960?", "�Qu� colores destacan?", "�Por qu� se usan esas palabras?", "�Qu� reclamo se utiliza para llamar la atenci�n?");  //continuar...

//Este vector contiene las posibles respuestas de cada pregunta (a, b, c)
$respuestas = array("Ketchup o tomate frito en lata Orlando.", "Tomate frito y dibujos animados.", "Tomate frito Apis.", 
								 "No hay ninguna persona destacada en el anuncio.", "Una lata de tomate real, pero con brazos y manos.", "El dibujo de una lata de tomate sonriente, con brazos y manos.", 
								 "Un fondo que parece agua.", "La cocina en la que est� el tomate.", "S�lo hay un fondo claro y textos. ",
								 "El tomate frito est� delicioso.", "Estoy frito.", "Compra y come tomate Apis, el mejor tomate frito.", 
								 
								 "A las latas de tomate.", "A todos los espa�oles.", "A un p�blico infantil (por el dibujo) y a posibles compradores de alimentos (adultos).", 
								 "Destaca sobre todo el color negro de las letras. ", "El azul del nombre de la marca, Apis.", "Destaca el color rojo del tomate, el negro del eslogan y el azul de la marca.", 
								 "Porque el tomate est� harto de que lo metan en una lata.", "Porque el tomate en realidad es un ser humano.", "Porque es un juego de palabras que llama la atenci�n (''frito'' de ''fre�r'' y ''frito'' de ''estar harto'').", 
								 "Una frase que nunca se ha o�do. ", "Un dibujo simp�tico y una oraci�n llamativa. ", "Un dibujo animado de un tomate convertido en persona. ", 
								 //---------------------------------------------------//								 
								 "No es un producto, es un perro. Puede ser una tienda de animales que vende mascotas.", "Es un anuncio de coches. La carretera indica que el coche es el protagonista.", "No se vende un producto directamente, se intenta concienciar sobre el abandono de animales.", 
								 "No hay ning�n personaje destacado en el anuncio.", "Un perro en medio de una carretera.", "Una carretera vac�a por la que conducir coches potentes con toda velocidad.", 
								 "S�lo aparece un perro.", "Un coche que va a aparecer en cualquier momento.", "Una carretera, un paisaje desierto y texto.", 
								 "No abandones a tu mascota. ", "�l nunca lo har�a.", "Fundaci�n Purina: no lo abandones.", 
								 
								 "A todos los perros de Espa�a.", "A todos los hombres, porque el perro es el mejor amigo del hombre.", "A todas las personas que tienen mascotas para que no las abandonen cuando se cansen de ellas.", 
								 "El negro por la tristeza del anuncio, el blanco de la raya que est� pisando el animal.", "El blanco de las letras, para dar alegr�a. El marr�n del pelo del perro. El negro de las orejas del perro, que destaca su abandono.", "Blanco (texto que resalta en fondo oscuro), azul (carretera y cielo), marr�n (perro) y rojo (lengua). ", 
								 "Porque recuerda lo cruel que ser�a abandonar a una mascota que siempre es fiel a su due�o. ", "Porque el perro est� pensando lo que va a hacer para volver a casa.", "Porque si abandonas un perro en medio de una carretera te puede perseguir la polic�a.", 
								 "El reclamo son los colores muy vivos de un paisaje desierto, que hacen que nos fijemos en el anuncio inmediatamente.", "El reclamo es utilizar una raza de perro que es muy valiosa porque har� pensar a mucha gente en el destino de ese perro tan preciado.", "La mirada de un perro abandonado en medio de una carretera con un texto que nos recuerda que �l nunca nos lo har�a si estuviera en nuestro lugar.",
								 //---------------------------------------------------//				
								 "Chucher�as y ropa para encontrar pareja.", "Chucher�as y un m�todo para adelgazar.", "Chocolates y dulces Mat�as L�pez.", 
								 "No hay ning�n personaje destacado en el anuncio.", "Los dibujos de tres hombres y tres mujeres.", "Hombres y mujeres con exceso de peso.", 
								 "S�lo hay personas. No hay m�s elementos en este anuncio.", "Un fondo como de sangre.", "Un fondo claro (marr�n alrededor de las figuras) y textos colocados en cintas onduladas.", 
								 "Ninguno. Es un anuncio muy antiguo y quiz� por eso no lleve eslogan.", "Chocolates y dulces Mat�as L�pez.", "Come chocolates y dulces de L�pez.",
								 
								 "A las mujeres delgadas.", "S�lo a las ni�as, porque con chocolate estar�n contentas y muy favorecidas.", "A todos los posibles compradores de chocolates y dulces.", 
								 "El rojo y el verde, que se combinan en los trajes y en las cintas de los textos. ", "El blanco y el negro, para que se vean bien las letras del eslogan.", "Blanco (de la camisa del se�or) y azul del cielo.", 
								 "Porque se informa de las oficinas de la empresa y se indican humor�sticamente los efectos del chocolate. ", "Porque se hace como un c�mic, con bocadillos en los que se incluye lo que los personajes hablan.", "Porque quieren destacar con el mayor tama�o el nombre del due�o de la empresa. ", 
								 "El reclamo son las palabras de los personajes, que reflejan el gusto de la gente de la calle. ", "El reclamo es mostrar tres parejas de personas caricaturizadas: flacas sin comer el producto, gordas despu�s y atractivas si toman doble raci�n. ", "El reclamo es lo bueno que est� el chocolate.",
								  //---------------------------------------------------//				
								  "Unas natillas muy ricas.", "Utensilios de cocina para que las comidas salgan perfectas.", "Postres instant�neos de la marca 'Yast�'.", 
								  "Una madre joven con pelo corto y una varilla en la mano.", "Una mujer sonriente, relativamente joven, con un vestido azul.", "Una mujer mayor que va a dar una sorpresa a su marido.", 
								  "La mujer tiene en una mano un cuenco y en la otra algo para matar las moscas o para batir algo.", "Un fondo azul claro y unas natillas reci�n hechas.", "Texto en la parte inferior, un fondo azul claro, un cuenco con postre en una mano y una varilla en la otra.", 
								  "Yast�.", "Pudding-crema-natillas.", "Listo en un minuto, sin cocer.",
								 
								  "A los ni�os, porque les gustan mucho las natillas. ", "A las mujeres de la �poca (la mayor�a amas de casa), con la promesa de un postre f�cil, hecho en poco tiempo.", "A los hombres, que podr�an hacer un postre en poco tiempo.", 
								  "Hay una suave combinaci�n de amarillo (postre y nombre del producto) y azul (mujer, fondo). ", "Destaca mucho el negro del texto, que es lo que quieren vender.", "El azul es el �nico color importante.", 
								  "Porque se informa de las ventajas del producto (listo en un minuto...) y se llama la atenci�n con el nombre 'Yast�'. ", "Porque se intenta hacer creer algo imposible: que el postre se haga sin cocer.", "Porque poner tres nombres de postres da m�s hambre: pudding, crema, natillas. ", 
								  "El objeto que levanta la mujer en su mano, que parece que va a hacer algo con �l. ", "El reclamo es la ropa que lleva la mujer, que desaparece por debajo. ", "El nombre del producto, presentado muy grande y con una forma chocante, fuera de la ortograf�a: 'Yast�'."); //continuar...

//Este vector contiene los comentarios que aparecen al hacer clic en cada respuesta (a, b, c)
$comentarios = array("Mira mejor el anuncio. No hay una sola marca de tomate frito.", "Mira mejor. Este anuncio no vende dibujos animados.", "�Claro!", 
								  "Aunque no sea una persona real, hay un personaje muy destacado en este anuncio.", "Mira mejor. �Seguro que es una lata de tomate real? ", "Efectivamente. ", 
								  "Mira atentamente todo lo que hay.", "Sigue mirando, pero no a�adas lo que no se ve. Describe lo que hay.", "Efectivamente.",
								  "El eslogan es una frase (u oraci�n) que aparece directamente en el anuncio: esta no aparece.", "�S�! Ese es el eslogan.", "El eslogan es una frase (u oraci�n) que aparece directamente en el anuncio: esta no aparece.", 
								  
								  "Eso es el producto que se vende. Se te pregunta ahora a qui�n crees que quieren vender este producto a trav�s de este anuncio.", "Pi�nsalo mejor. Al anunciante seguro que le interesa tambi�n llegar a compradores que hablen castellano aunque no sean espa�oles.", "Buena respuesta.", 
								  "Hay m�s colores destacados. Pi�nsalo mejor.", "Hay m�s colores destacados. Pi�nsalo mejor. ", "Efectivamente. ", 
								  "Piensa mejor. El anuncio se hace para atraer a los que lo ven, no para contar la vida de un tomate.", "�No flipes tanto y piensa mejor!", "�Bien pensado!", 
								  "Pi�nsalo mejor: esa no es una frase nunca o�da. ", "Efectivamente, el dibujo de la lata sonriente y su ''Estoy frito'' sirven para reclamar la atenci�n. ", "Piensa mejor: no es un dibujo animado, no tiene movimiento. ", 
								  //---------------------------------------------------//	
								  "Mira mejor el anuncio. No se trata de vender animales. ", "Mira mejor. Este anuncio no vende coches.", "�Claro!", 
								  "Aunque no sea una persona, hay un personaje muy destacado en este anuncio.", "Ese es el personaje de este anuncio.", "Ese es el fondo que aparece, el espacio. Pero el personaje es otro.", 
								  "Mira atentamente todo lo que hay.", "Sigue mirando, pero no a�adas lo que no se ve. ", "Efectivamente. ", 
								  "El eslogan es una frase (u oraci�n) que aparece directamente en el anuncio: esta no aparece.", "�S�! Ese es el eslogan.", "'Fundaci�n Purina' no es el eslogan, es la organizaci�n que ha impulsado este anuncio.", 
								 
								  "Pi�nsalo mejor. El destinatario es a qu� personas parece que va dirigido el anuncio.", "Pi�nsalo mejor. Este anuncio podr�a tambi�n dirigirse a mujeres que tengan perro. ", "Buena respuesta. ", 
								  "Hay m�s colores destacados. Pi�nsalo mejor.", "Hay m�s colores destacados. Pi�nsalo mejor. ", "�Buena respuesta! ", 
								  "�Buena respuesta!", "Pi�nsalo mejor. A quien quieren hacer pensar es a las personas que ven este anuncio.", "Pi�nsalo mejor; el anuncio intenta que las personas piensen en c�mo actuar correctamente (no porque la polic�a les persiga). ", 
								  "Mira con atenci�n: hay cosas que llaman m�s la atenci�n en este anuncio. ", "En este caso, la raza de perro no tiene por qu� llamar la atenci�n especialmente. Piensa en otra cosa.", "�Bien pensado!" ,
								  //---------------------------------------------------//				
								  "No se anuncia cualquier tipo de chucher�as. Y no se vende ropa. Piensa mejor.", "Mira mejor. No se vende ning�n m�todo concreto para adelgazar. ", "�Claro!", 
								  "Aunque no haya nadie muy destacado, se te pide que descubras qui�nes aparecen.", "�Bien visto!", "�Mira bien lo que hay!", 
								  "Mira atentamente todo lo que hay. Hay m�s cosas adem�s de los dibujos de personas.", "Mira mejor. Para anunciar un chocolate no parece probable que el anunciante aqu� quiera relacionarlo con sangre.", "�Bien visto!", 
								  "Efectivamente.", "Ese no es el eslogan (frase publicitaria original y atractiva), es el producto que se vende.", "El eslogan tiene que estar directamente escrito en el anuncio. Esta oraci�n no aparece.",
								 
								  "Pi�nsalo mejor. �Y los hombres no comen chocolate? ", "Pi�nsalo mejor. Este anuncio podr�a tambi�n dirigirse a ni�os y adultos. ", "Buena respuesta. ", 
								  "�Bien visto!", "Pi�nsalo mejor. Este anuncio no tiene eslogan. ", "Busca unos colores m�s importantes aqu�, que tengan un papel m�s destacado.", 
								  "�Buena respuesta!", "Pi�nsalo mejor. No hay globos ni bocadillos en la imagen. El texto no es lo que hablan los personajes.", "Mira mejor; el nombre del due�o no es el texto m�s grande. ", 
								  "Mira con atenci�n: no se nos ofrecen las palabras de los personajes. ", "�Buena respuesta!", "Pero sigue pensando: adem�s de que te guste el chocolate, en este anuncio concreto hay algo m�s que llamar�a la atenci�n de quienes lo viesen.",
								   //---------------------------------------------------//				
								  "Mira bien: no es s�lo eso el producto que se anuncia. ", "Mira mejor. No se vende ning�n utensilio de cocina. ", "�Claro!", 
								  "�C�mo sabes que es madre? En la imagen no hay nada definitivo que lo confirme.", "�Bien visto!", "�Mira bien lo que hay! Aqu� se te pide ver lo que hay, no suponer o inventar.", 
								  "Mira mejor. En la mano sostiene un utensilio de cocina que se suele llamar varilla.", "Mira mejor. Hay algo importante que falta.", "�Bien visto!", 
								  "Ese parece el nombre del producto. En este anuncio es la expresi�n m�s original y chocante, pero no parece un eslogan.", "Ese no es el eslogan (frase publicitaria original y atractiva), es el tipo de producto que se vende.", "Efectivamente. De todo el texto que aparece, eso es lo m�s parecido a un eslogan.",
								 
								  "Pi�nsalo mejor. �Y no va dirigido a los adultos que las compran? ", "�Bien pensado!", "En Espa�a en 1960 gran parte de las familias dejaban todo el peso de la cocina a la mujer. Debido a la mentalidad de entonces, que un hombre cocinase en casa no era un hecho frecuente.", 
								  "�Bien visto!", "Pi�nsalo mejor. Hay colores m�s destacados.", "Busca m�s colores. Hay alguno m�s muy destacado. ", 
								  "�Buena respuesta!", "Pi�nsalo mejor. �Est�s seguro de que eso es imposible? ", "Adem�s de eso, las palabras usadas tienen otra explicaci�n. Pi�nsalo.", 
								  "Mira con atenci�n: hay alg�n reclamo m�s destacado. ", "Mira con atenci�n: hay alg�n reclamo m�s destacado. ", "�Bien pensado!"); //continuar...

class PDF extends FPDF
{
//Cabecera de p�gina
function Header()
{
    //Logo
    $this->Image('logo.png',0,0,210);
	
    //Salto de l�nea
    $this->Ln(35);
}
}

$fromFlash = $_POST['seleccionadas'];
$arrayFlash = explode(",", $fromFlash);  

//Creaci�n del objeto de la clase heredada
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
for($i=0;$i<=31;$i++)
{
	$pdf->SetFont('Arial','B',15);
	$pdf->SetTextColor(178,38,0);
	
	if( $i == 0 )
	{
		$pdf->Cell(0,10,"TOMATE FRITO",0,1);
		$pdf->Cell(0,2,"________________________________________________________________",0,1);
		$pdf->Ln(5);
	}
		
	if( $i == 8 )
	{
		$pdf->Ln();
		$pdf->Cell(0,10,"NO LO ABANDONES",0,1);
		$pdf->Cell(0,2,"________________________________________________________________",0,1);
		$pdf->Ln(5);
	}
		
	if( $i == 16 )
	{
		$pdf->Ln();
		$pdf->Cell(0,10,"CHOCOLATES",0,1);
		$pdf->Cell(0,2,"________________________________________________________________",0,1);
		$pdf->Ln(5);
	}
	
	if( $i == 24 )
	{
		$pdf->Ln();
		$pdf->Cell(0,10,"POSTRE",0,1);
		$pdf->Cell(0,2,"________________________________________________________________",0,1);
		$pdf->Ln(5);
	}
	
	$seleccionada = $arrayFlash[$i];
	
	 //Arial bold 15
    $pdf->SetFont('Arial','B',13);
	$pdf->SetTextColor(0);
	
	$pregnum = $i + 1;

    $pdf->Cell(0,10,$pregnum.'. '.$preguntas[$i],0,1);
	
	 //Arial bold 15
    $pdf->SetFont('Arial','I',12);

	if( $respuestas[$seleccionada] != "" )
		$pdf->Cell(0,10,$respuestas[$seleccionada],0,1);
	else
		$pdf->Cell(0,10,"Sin respuesta",0,1);
}
$pdf->Output();
?>