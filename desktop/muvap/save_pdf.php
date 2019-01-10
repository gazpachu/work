<?php
require('fpdf/fpdf.php');

$preguntas = array("¿Qué producto se anuncia?", "¿Quién aparece en el anuncio?", "¿Qué otros elementos aparecen?", "¿Qué eslogan se incluye?",
								"¿A quiénes parece dirigido el anuncio?", "¿Qué colores destacan?", "¿Por qué se usa ese eslogan de ''Estoy frito''?", "¿Qué reclamo se utiliza para llamar la atención?",
								
								"¿Qué producto se anuncia?", "¿Quién aparece en el anuncio?", "¿Qué otros elementos aparecen?", "¿Qué eslogan se incluye y cómo?",
								"¿A quiénes parece dirigido el anuncio?", "¿Qué colores destacan?", "¿Por qué se usa ese eslogan", "¿Qué reclamo se utiliza para llamar la atención?",
								
								"¿Qué producto se anuncia?", "¿Quién aparece en el anuncio?", "¿Qué otros elementos aparecen?", "¿Qué eslogan se incluye",
								"¿A quiénes parece dirigido el anuncio?", "¿Qué colores destacan?", "¿Por qué se usan esas palabras?", "¿Qué reclamo se utiliza para llamar la atención?",
								
								"¿Qué producto se anuncia?", "¿Quién aparece en el anuncio?", "¿Qué otros elementos aparecen?", "¿Qué eslogan se incluye",
								"¿A quiénes parece dirigido el anuncio, fechado en 1960?", "¿Qué colores destacan?", "¿Por qué se usan esas palabras?", "¿Qué reclamo se utiliza para llamar la atención?");  //continuar...

//Este vector contiene las posibles respuestas de cada pregunta (a, b, c)
$respuestas = array("Ketchup o tomate frito en lata Orlando.", "Tomate frito y dibujos animados.", "Tomate frito Apis.", 
								 "No hay ninguna persona destacada en el anuncio.", "Una lata de tomate real, pero con brazos y manos.", "El dibujo de una lata de tomate sonriente, con brazos y manos.", 
								 "Un fondo que parece agua.", "La cocina en la que está el tomate.", "Sólo hay un fondo claro y textos. ",
								 "El tomate frito está delicioso.", "Estoy frito.", "Compra y come tomate Apis, el mejor tomate frito.", 
								 
								 "A las latas de tomate.", "A todos los españoles.", "A un público infantil (por el dibujo) y a posibles compradores de alimentos (adultos).", 
								 "Destaca sobre todo el color negro de las letras. ", "El azul del nombre de la marca, Apis.", "Destaca el color rojo del tomate, el negro del eslogan y el azul de la marca.", 
								 "Porque el tomate está harto de que lo metan en una lata.", "Porque el tomate en realidad es un ser humano.", "Porque es un juego de palabras que llama la atención (''frito'' de ''freír'' y ''frito'' de ''estar harto'').", 
								 "Una frase que nunca se ha oído. ", "Un dibujo simpático y una oración llamativa. ", "Un dibujo animado de un tomate convertido en persona. ", 
								 //---------------------------------------------------//								 
								 "No es un producto, es un perro. Puede ser una tienda de animales que vende mascotas.", "Es un anuncio de coches. La carretera indica que el coche es el protagonista.", "No se vende un producto directamente, se intenta concienciar sobre el abandono de animales.", 
								 "No hay ningún personaje destacado en el anuncio.", "Un perro en medio de una carretera.", "Una carretera vacía por la que conducir coches potentes con toda velocidad.", 
								 "Sólo aparece un perro.", "Un coche que va a aparecer en cualquier momento.", "Una carretera, un paisaje desierto y texto.", 
								 "No abandones a tu mascota. ", "Él nunca lo haría.", "Fundación Purina: no lo abandones.", 
								 
								 "A todos los perros de España.", "A todos los hombres, porque el perro es el mejor amigo del hombre.", "A todas las personas que tienen mascotas para que no las abandonen cuando se cansen de ellas.", 
								 "El negro por la tristeza del anuncio, el blanco de la raya que está pisando el animal.", "El blanco de las letras, para dar alegría. El marrón del pelo del perro. El negro de las orejas del perro, que destaca su abandono.", "Blanco (texto que resalta en fondo oscuro), azul (carretera y cielo), marrón (perro) y rojo (lengua). ", 
								 "Porque recuerda lo cruel que sería abandonar a una mascota que siempre es fiel a su dueño. ", "Porque el perro está pensando lo que va a hacer para volver a casa.", "Porque si abandonas un perro en medio de una carretera te puede perseguir la policía.", 
								 "El reclamo son los colores muy vivos de un paisaje desierto, que hacen que nos fijemos en el anuncio inmediatamente.", "El reclamo es utilizar una raza de perro que es muy valiosa porque hará pensar a mucha gente en el destino de ese perro tan preciado.", "La mirada de un perro abandonado en medio de una carretera con un texto que nos recuerda que él nunca nos lo haría si estuviera en nuestro lugar.",
								 //---------------------------------------------------//				
								 "Chucherías y ropa para encontrar pareja.", "Chucherías y un método para adelgazar.", "Chocolates y dulces Matías López.", 
								 "No hay ningún personaje destacado en el anuncio.", "Los dibujos de tres hombres y tres mujeres.", "Hombres y mujeres con exceso de peso.", 
								 "Sólo hay personas. No hay más elementos en este anuncio.", "Un fondo como de sangre.", "Un fondo claro (marrón alrededor de las figuras) y textos colocados en cintas onduladas.", 
								 "Ninguno. Es un anuncio muy antiguo y quizá por eso no lleve eslogan.", "Chocolates y dulces Matías López.", "Come chocolates y dulces de López.",
								 
								 "A las mujeres delgadas.", "Sólo a las niñas, porque con chocolate estarán contentas y muy favorecidas.", "A todos los posibles compradores de chocolates y dulces.", 
								 "El rojo y el verde, que se combinan en los trajes y en las cintas de los textos. ", "El blanco y el negro, para que se vean bien las letras del eslogan.", "Blanco (de la camisa del señor) y azul del cielo.", 
								 "Porque se informa de las oficinas de la empresa y se indican humorísticamente los efectos del chocolate. ", "Porque se hace como un cómic, con bocadillos en los que se incluye lo que los personajes hablan.", "Porque quieren destacar con el mayor tamaño el nombre del dueño de la empresa. ", 
								 "El reclamo son las palabras de los personajes, que reflejan el gusto de la gente de la calle. ", "El reclamo es mostrar tres parejas de personas caricaturizadas: flacas sin comer el producto, gordas después y atractivas si toman doble ración. ", "El reclamo es lo bueno que está el chocolate.",
								  //---------------------------------------------------//				
								  "Unas natillas muy ricas.", "Utensilios de cocina para que las comidas salgan perfectas.", "Postres instantáneos de la marca 'Yastá'.", 
								  "Una madre joven con pelo corto y una varilla en la mano.", "Una mujer sonriente, relativamente joven, con un vestido azul.", "Una mujer mayor que va a dar una sorpresa a su marido.", 
								  "La mujer tiene en una mano un cuenco y en la otra algo para matar las moscas o para batir algo.", "Un fondo azul claro y unas natillas recién hechas.", "Texto en la parte inferior, un fondo azul claro, un cuenco con postre en una mano y una varilla en la otra.", 
								  "Yastá.", "Pudding-crema-natillas.", "Listo en un minuto, sin cocer.",
								 
								  "A los niños, porque les gustan mucho las natillas. ", "A las mujeres de la época (la mayoría amas de casa), con la promesa de un postre fácil, hecho en poco tiempo.", "A los hombres, que podrían hacer un postre en poco tiempo.", 
								  "Hay una suave combinación de amarillo (postre y nombre del producto) y azul (mujer, fondo). ", "Destaca mucho el negro del texto, que es lo que quieren vender.", "El azul es el único color importante.", 
								  "Porque se informa de las ventajas del producto (listo en un minuto...) y se llama la atención con el nombre 'Yastá'. ", "Porque se intenta hacer creer algo imposible: que el postre se haga sin cocer.", "Porque poner tres nombres de postres da más hambre: pudding, crema, natillas. ", 
								  "El objeto que levanta la mujer en su mano, que parece que va a hacer algo con él. ", "El reclamo es la ropa que lleva la mujer, que desaparece por debajo. ", "El nombre del producto, presentado muy grande y con una forma chocante, fuera de la ortografía: 'Yastá'."); //continuar...

//Este vector contiene los comentarios que aparecen al hacer clic en cada respuesta (a, b, c)
$comentarios = array("Mira mejor el anuncio. No hay una sola marca de tomate frito.", "Mira mejor. Este anuncio no vende dibujos animados.", "¡Claro!", 
								  "Aunque no sea una persona real, hay un personaje muy destacado en este anuncio.", "Mira mejor. ¿Seguro que es una lata de tomate real? ", "Efectivamente. ", 
								  "Mira atentamente todo lo que hay.", "Sigue mirando, pero no añadas lo que no se ve. Describe lo que hay.", "Efectivamente.",
								  "El eslogan es una frase (u oración) que aparece directamente en el anuncio: esta no aparece.", "¡Sí! Ese es el eslogan.", "El eslogan es una frase (u oración) que aparece directamente en el anuncio: esta no aparece.", 
								  
								  "Eso es el producto que se vende. Se te pregunta ahora a quién crees que quieren vender este producto a través de este anuncio.", "Piénsalo mejor. Al anunciante seguro que le interesa también llegar a compradores que hablen castellano aunque no sean españoles.", "Buena respuesta.", 
								  "Hay más colores destacados. Piénsalo mejor.", "Hay más colores destacados. Piénsalo mejor. ", "Efectivamente. ", 
								  "Piensa mejor. El anuncio se hace para atraer a los que lo ven, no para contar la vida de un tomate.", "¡No flipes tanto y piensa mejor!", "¡Bien pensado!", 
								  "Piénsalo mejor: esa no es una frase nunca oída. ", "Efectivamente, el dibujo de la lata sonriente y su ''Estoy frito'' sirven para reclamar la atención. ", "Piensa mejor: no es un dibujo animado, no tiene movimiento. ", 
								  //---------------------------------------------------//	
								  "Mira mejor el anuncio. No se trata de vender animales. ", "Mira mejor. Este anuncio no vende coches.", "¡Claro!", 
								  "Aunque no sea una persona, hay un personaje muy destacado en este anuncio.", "Ese es el personaje de este anuncio.", "Ese es el fondo que aparece, el espacio. Pero el personaje es otro.", 
								  "Mira atentamente todo lo que hay.", "Sigue mirando, pero no añadas lo que no se ve. ", "Efectivamente. ", 
								  "El eslogan es una frase (u oración) que aparece directamente en el anuncio: esta no aparece.", "¡Sí! Ese es el eslogan.", "'Fundación Purina' no es el eslogan, es la organización que ha impulsado este anuncio.", 
								 
								  "Piénsalo mejor. El destinatario es a qué personas parece que va dirigido el anuncio.", "Piénsalo mejor. Este anuncio podría también dirigirse a mujeres que tengan perro. ", "Buena respuesta. ", 
								  "Hay más colores destacados. Piénsalo mejor.", "Hay más colores destacados. Piénsalo mejor. ", "¡Buena respuesta! ", 
								  "¡Buena respuesta!", "Piénsalo mejor. A quien quieren hacer pensar es a las personas que ven este anuncio.", "Piénsalo mejor; el anuncio intenta que las personas piensen en cómo actuar correctamente (no porque la policía les persiga). ", 
								  "Mira con atención: hay cosas que llaman más la atención en este anuncio. ", "En este caso, la raza de perro no tiene por qué llamar la atención especialmente. Piensa en otra cosa.", "¡Bien pensado!" ,
								  //---------------------------------------------------//				
								  "No se anuncia cualquier tipo de chucherías. Y no se vende ropa. Piensa mejor.", "Mira mejor. No se vende ningún método concreto para adelgazar. ", "¡Claro!", 
								  "Aunque no haya nadie muy destacado, se te pide que descubras quiénes aparecen.", "¡Bien visto!", "¡Mira bien lo que hay!", 
								  "Mira atentamente todo lo que hay. Hay más cosas además de los dibujos de personas.", "Mira mejor. Para anunciar un chocolate no parece probable que el anunciante aquí quiera relacionarlo con sangre.", "¡Bien visto!", 
								  "Efectivamente.", "Ese no es el eslogan (frase publicitaria original y atractiva), es el producto que se vende.", "El eslogan tiene que estar directamente escrito en el anuncio. Esta oración no aparece.",
								 
								  "Piénsalo mejor. ¿Y los hombres no comen chocolate? ", "Piénsalo mejor. Este anuncio podría también dirigirse a niños y adultos. ", "Buena respuesta. ", 
								  "¡Bien visto!", "Piénsalo mejor. Este anuncio no tiene eslogan. ", "Busca unos colores más importantes aquí, que tengan un papel más destacado.", 
								  "¡Buena respuesta!", "Piénsalo mejor. No hay globos ni bocadillos en la imagen. El texto no es lo que hablan los personajes.", "Mira mejor; el nombre del dueño no es el texto más grande. ", 
								  "Mira con atención: no se nos ofrecen las palabras de los personajes. ", "¡Buena respuesta!", "Pero sigue pensando: además de que te guste el chocolate, en este anuncio concreto hay algo más que llamaría la atención de quienes lo viesen.",
								   //---------------------------------------------------//				
								  "Mira bien: no es sólo eso el producto que se anuncia. ", "Mira mejor. No se vende ningún utensilio de cocina. ", "¡Claro!", 
								  "¿Cómo sabes que es madre? En la imagen no hay nada definitivo que lo confirme.", "¡Bien visto!", "¡Mira bien lo que hay! Aquí se te pide ver lo que hay, no suponer o inventar.", 
								  "Mira mejor. En la mano sostiene un utensilio de cocina que se suele llamar varilla.", "Mira mejor. Hay algo importante que falta.", "¡Bien visto!", 
								  "Ese parece el nombre del producto. En este anuncio es la expresión más original y chocante, pero no parece un eslogan.", "Ese no es el eslogan (frase publicitaria original y atractiva), es el tipo de producto que se vende.", "Efectivamente. De todo el texto que aparece, eso es lo más parecido a un eslogan.",
								 
								  "Piénsalo mejor. ¿Y no va dirigido a los adultos que las compran? ", "¡Bien pensado!", "En España en 1960 gran parte de las familias dejaban todo el peso de la cocina a la mujer. Debido a la mentalidad de entonces, que un hombre cocinase en casa no era un hecho frecuente.", 
								  "¡Bien visto!", "Piénsalo mejor. Hay colores más destacados.", "Busca más colores. Hay alguno más muy destacado. ", 
								  "¡Buena respuesta!", "Piénsalo mejor. ¿Estás seguro de que eso es imposible? ", "Además de eso, las palabras usadas tienen otra explicación. Piénsalo.", 
								  "Mira con atención: hay algún reclamo más destacado. ", "Mira con atención: hay algún reclamo más destacado. ", "¡Bien pensado!"); //continuar...

class PDF extends FPDF
{
//Cabecera de página
function Header()
{
    //Logo
    $this->Image('logo.png',0,0,210);
	
    //Salto de línea
    $this->Ln(35);
}
}

$fromFlash = $_POST['seleccionadas'];
$arrayFlash = explode(",", $fromFlash);  

//Creación del objeto de la clase heredada
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