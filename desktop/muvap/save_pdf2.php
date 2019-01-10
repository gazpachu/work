<?php
require('fpdf/fpdf.php');

//Este vector contiene los titulos de las preguntas
$preguntas = array("�Qu� producto se anuncia?", "�Qu� personas aparecen?", "�Qu� otros elementos aparecen?", "�Qu� tipo de plano se emplea en el anuncio?", "�Qu� punto de vista se ha utilizado?", "�Qu� eslogan se incluye?",
        "�A qui�nes parece dirigido el anuncio?", "�Qu� elementos podr�an aparecer pero est�n ausentes?", "�Qu� met�fora visual parece usarse en el anuncio?", "�Qu� estereotipo encuentras en este anuncio?", "�Por qu� se emplea ese tipo de plano?", "�Por qu� se emplea ese punto de vista?", "�Qu� valor tienen los colores empleados?", "�Qu� valor tiene el tipo de luz empleado?", "�Por qu� se usa ese texto?", "�Qu� recurso ret�rico hay en el texto?",
        
        "�Qu� producto se anuncia?", "�Qu� personas aparecen?", "�Qu� otros elementos aparecen?", "�Qu� tipo de plano se emplea en el anuncio?", "�Qu� punto de vista se ha utilizado?", "�Qu� eslogan se incluye y c�mo?",
        "�A qui�nes parece dirigido el anuncio?", "�Qu� elementos podr�an aparecer pero est�n ausentes?", "�Qu� met�fora visual parece usarse en el anuncio?", "�Qu� estereotipo encuentras en este anuncio?", "�Por qu� se emplea ese tipo de plano?", "�Por qu� se emplea ese punto de vista?", "�Qu� valor tienen los colores empleados?", "�Qu� valor tiene el tipo de luz empleado?", "�Por qu� se usa ese texto?", "�Qu� recurso ret�rico hay en el texto?",
        
        "�Qu� producto se anuncia?", "�Qu� personas aparecen?", "�Qu� otros elementos aparecen?", "�Qu� tipo de plano se emplea en el anuncio?", "�Qu� punto de vista se ha utilizado?", "�Qu� eslogan se incluye y c�mo?",
        "�A qui�nes parece dirigido el anuncio?", "�Qu� elementos podr�an aparecer pero est�n ausentes?", "�Qu� met�fora visual parece usarse en el anuncio?", "�Qu� estereotipo encuentras en este anuncio?", "�Por qu� se emplea ese tipo de plano?", "�Por qu� se emplea ese punto de vista?", "�Qu� valor tienen los colores empleados?", "�Qu� valor tiene el tipo de luz empleado?", "�Por qu� se usa ese texto?", "�Qu� recurso ret�rico hay en el texto?",
        
        "�Qu� producto se anuncia?", "�Qu� personas aparecen?", "�Qu� otros elementos aparecen?", "�Qu� tipo de plano se emplea en el anuncio?", "�Qu� punto de vista se ha utilizado?", "�Qu� eslogan se incluye?",
        "�A qui�nes parece dirigido el anuncio?", "�Qu� elementos podr�an aparecer pero est�n ausentes?", "�Qu� met�fora visual parece usarse en el anuncio?", "�Qu� estereotipo encuentras en este anuncio?", "�Por qu� se emplea ese tipo de plano?", "�Por qu� se emplea ese punto de vista?", "�Qu� valor tienen los colores empleados?", "�Qu� valor tiene el tipo de luz empleado?", "�Por qu� se usa ese texto?", "�Qu� recurso ret�rico hay en el texto?");  //continuar...
 
//Este vector contiene las posibles respuestas de cada pregunta (a, b, c)
$respuestas = array("Ropa primaveral de mujer.", "La naturaleza y sus derivados.", "Jab�n, colonia y extracto de la marca Flores del Campo.",
         "Una mujer atractiva se encuentra entre los productos anunciados.", "Aparece una mujer bailando. La mujer, con los brazos extendidos a la altura de los hombros, parece volar entre las flores. ", "Aparece el dibujo de una mujer morena con sombrero y un vestido largo de rayas horizontales azules y blancas.", 
         "Aparecen jabones. Un cielo azul propio de un d�a soleado y un cartel de color llamativo para que el receptor se detenga a leerlo.", "Un cartel rojo que llama mucho la atenci�n. Un fondo que sugiere el mar y unas flores que flotan para transmitir que se trata de una colonia ligera.", "En un fondo claro, aparece centrado el dibujo de una mujer rodeada de vegetaci�n. Delante de ella, un rect�ngulo rojo incluye en letras blancas el producto anunciado. En los laterales, dibujos de los productos anunciados.",
         "Primer plano, por la cercan�a de la mujer.", "Plano entero, muestra el cuerpo completo del personaje.", "Plano medio, destaca la cintura.",
         "Picado, desde arriba para empeque�ecer a la mujer.", "Levemente desde abajo, contrapicado.", "Cenital, desde el cielo.",
         "Constante primavera.", "Flores del campo.", "Floralia, Madrid.",
        
         "A personas adultas, de nivel econ�mico medio-alto y comprometidas con la naturaleza, porque en el dibujo predomina la vegetaci�n.", "A posibles compradores de jab�n y colonia en la �poca en Espa�a: seguramente mujeres a quienes se invita a sentirse esbeltas y bellas como la mujer dibujada.", "En general a todo el mundo, pero especialmente a hombres y ni�os, porque ser�an atra�dos por la imagen de la mujer.",
         "No falta nada; el anuncio es muy completo. ", "Falta el pa�s donde se vende el producto y el lugar de donde es originario. Tambi�n falta la fecha del anuncio.", "Est�n ausentes otro tipo de personas diferentes (de m�s edad, de distinta complexi�n f�sica, de distinto sexo y grupo social...).", 
         "El jab�n es como una playa agradable en la que una mujer joven puede disfrutar de total libertad para relacionarse con quien desee.", "La mujer aparece como una flor m�s en medio del campo, redundando en el nombre de la marca (Flores del campo).", "El frasco es la met�fora de la fragilidad del cristal y de los l�quidos alcoh�licos que podr�an estar dentro y proporcionar sentimientos de evasi�n a sus consumidores.",
         "El estereotipo del hombre. ", "El estereotipo de la madre de familia. ", "El estereotipo de la mujer como adorno, como objeto bello. ",
         "Para que se vea bien de cerca la cara de la mujer y los sentimientos que quiere expresar.", "Porque permite mostrar los productos en primer plano y el cuerpo entero del personaje.", "Para que el receptor vea bien lo que se vende.",
         "El punto de vista contrapicado, levemente desde abajo, engrandece al personaje. ", "Para que nos sintamos como la mujer del anuncio. ", "Porque es el punto de vista m�s frecuente. ", 
         "Los colores dan sensaci�n de pasi�n. Llaman la atenci�n vivamente y poseen connotaciones de sensualidad, deseo amoroso, exaltaci�n del cuerpo.", "El azul significa mar; el verde, esperanza; y el amarillo, dinero. ", "El fondo blanco puede tener connotaciones de limpieza. El contraste entre los colores fr�os que predominan y el color c�lido del cartel realza el eslogan. ",
         "La luz es difusa. Por ello, puede producir sensaci�n de claridad y limpieza.", "La luz es casi inexistente. No parece tener ning�n papel en el significado expresivo del anuncio. ",  "  ",
         "Porque en primavera es m�s frecuente el uso del producto. ", "Porque quiere dar sensaci�n de urgencia, de necesidad imperiosa de adquirir el producto por sus cualidades �nicas. ", "Porque busca impactar con una frase breve y perfumar el mensaje de connotaciones positivas arrastradas por la palabra 'primavera'. ",
         "Paralelismo. Se repiten dos estructuras muy similares: 'primavera'...'campo'.", "Ep�teto (adjetivo antepuesto, 'constante', que enfatiza emotivamente al sustantivo) y met�fora (la vida como una primavera continua). ", "S�mil o comparaci�n: esta colonia es como una primavera.",
         //---------------------------------------------------//        
         "Que todo el mundo pueda ser feliz.", "Los sentimientos positivos.", "Colchones de la marca Flex.",
         "Una ni�a en un columpio y, claro, la persona que la impulsa.", "Una ni�a muy alegre sentada en un columpio como si volase.", "Una ni�a morena de pelo largo sentada en un columpio. ", 
         "Texto, una l�nea curva azul, el logotipo de Flex y un gigantesco columpio.", "Una l�nea que significa alegr�a.", "Un texto de tama�o muy grande y el logotipo. ",
         "Primer plano, para ver bien a la ni�a.", "Plano entero (cuerpo completo del personaje) o general.", "Plano medio, destaca la cintura.",
         "Claramente picado, desde arriba para empeque�ecer a la ni�a.", "Frontal, a la altura de los ojos del personaje. ", "Cenital, desde el cielo. ",
         "El eslogan es 'Hoy', porque se quiere invitar a vivir intensamente cada d�a.", "El eslogan es 'Flex', que aparece como indicando sue�o.", "'Hoy me siento Flex'. Aparece en letra azul muy grande, ocupando casi toda la parte superior del anuncio. ",
        
         "Al p�blico infantil, atra�do por el columpio gigantesco y la sensaci�n de diversi�n.", "A posibles compradores de colchones: adultos que quiz� se enternezcan con la imagen y deseen dormir 'como un beb�'. ", "En general a todo el mundo, pero especialmente a ni�os y ni�as, porque se identifican con la imagen de la ni�a.",
         "No falta nada; el anuncio es muy completo. ", "Faltan las tiendas donde se se vende el producto. Tambi�n falta la fecha del anuncio.", "Falta el producto: el colch�n. En vez de mostrar simplemente el producto, se nos quiere trasmitir una sensaci�n (descanso...).", 
         "La l�nea curva azul es como un colch�n suave y mullido con su almohada en un extremo.", "El fondo azul es la met�fora del verano: compre Flex y se sentir� como en verano.", "El fondo azul y la ni�a en el columpio son met�fora de descanso, ausencia de preocupaciones.",
         "El estereotipo de ni�a delgada y feliz. ", "El estereotipo de la madre de familia. ", "El estereotipo de la mujer como objeto sexual. ",
         "Para que se vea bien de cerca la cara de la mujer y los sentimientos que quiere expresar.", "Para no impresionar demasiado al receptor.", "Para dar protagonismo al eslogan (que es m�s grande que el personaje).",
         "Para engrandecer al personaje y convertirlo en el eje del anuncio. ", "Para que nos sintamos como la ni�a del anuncio, suavemente balanceados (o acunados) ante la promesa de un colch�n Flex. ", "Porque es el punto de vista m�s frecuente. ",
         "Los colores dan sensaci�n de dinamismo. Llaman la atenci�n vivamente y poseen connotaciones de acci�n, excitaci�n, deseo...", "El predominio de colores fr�os (azul) parece connotar placidez, suavidad... ", "El color marr�n significa la tierra; el azul significa el cielo; el negro, la elegancia. ",
         "La luz es difusa. Por ello, puede producir sensaci�n de claridad, tranquilidad.", "La luz es casi inexistente. No parece tener ning�n papel en el significado expresivo del anuncio. ", "", 
         "Porque es una frase breve, f�cil de recordar, en el que la marca se convierte en un sentimiento. ", "Porque quiere dar sensaci�n de que hoy va a ser un gran d�a y que hay que vivirlo al m�ximo. ", "Porque Flex es una marca conocida en todo el mundo. ",
         "S�mil: compara el d�a de hoy con el colch�n Flex.", "Ant�tesis: hoy (preocupaci�n, trabajo, sufrimiento) frente a Flex (descanso, placer).", "Met�fora (me siento Flex=me siento bien por descansar bien) o antonomasia (Flex simbolizar�a el descanso por antonomasia).",
         //---------------------------------------------------//    
         "Vacaciones con alguna agencia de viajes.", "Ropa de ba�o para mujer.", "Cerveza Cruzcampo.",
         "No hay ninguna persona destacada en el anuncio.", "Una mujer en ba�ador rojo zambullida dentro del l�quido.", "Aparece una persona dif�cil de identificar, de aspecto andr�gino. ", 
         "Letras ('Cruzcampo', 'Refresca tu Mundo'), el ba�ador rojo de la mujer  y nada m�s.", "Letras en dos colores (rojo y negro, colores que incitan a la pasi�n), espuma y quiz� la boca que se bebe el l�quido.", "Texto en la esquina inferior derecha; l�quido de color dorado, la estela que deja la mujer y espuma por encima del l�quido.",
         "Primer plano, la mujer est� destacada.", "Plano general, el personaje se presenta en un amplio espacio.", "Plano americano, muy frecuente en las pel�culas americanas del oeste.",
         "Claramente cenital, desde arriba como si la c�mara fuera en un helic�ptero.", "Levemente por debajo de la horizontal de los ojos del personaje (contrapicado). ", "Nadir, se enfoca a la mujer desde abajo, el punto de vista de gusano, como si se la viera desde una alcantarilla.",
         "Bebe cerveza y refresca tu mundo.", "Refresca tu mundo, compra Cruzcampo. ", "En letras negras, esquina inferior derecha, 'Refresca tu Mundo'.",
        
         "A ni�os a los que les gustan las piscinas y las playas.", "A todas las personas a las que les guste la cerveza. ", "A posibles consumidores de cerveza, especialmente hombres por el uso de la mujer como reclamo.",
         "En este anuncio no falta nada; es una imagen muy bien dise�ada. ", "Falta, por ejemplo, la parte negativa del alcohol: los perjuicios que puede causar su consumo irresponsable. ", "Falta el trampol�n desde el que se ha tirado la mujer y el borde de la piscina que no quieren que veamos. ", 
         "Se identifica la mujer con la cerveza. Zambullirse en la cerveza es zambullirse en el deseo.", "La met�fora del esfuerzo. Cerveza=disfrute ganado despu�s de mucho tiempo, gracias al esfuerzo personal. ", "La met�fora de la vida como un l�quido en el que el ser humano nace, se desarrolla y termina desembocando en la muerte.",
         "El estereotipo de mujer trabajadora y din�mica. ", "El estereotipo de la mujer rubia, delgada, objeto de deseo. ", "El estereotipo de la mujer madura que dirige su vida de manera aut�noma. ",
         "Para que se perciban los sentimientos del personaje de la forma m�s directa posible. ", "Para no impresionar demasiado al receptor. Un primer plano quiz� habr�a sido m�s impactante.", "Para dar protagonismo al cuerpo de la mujer (que es el reclamo central del anuncio).",
         "Para convertir al personaje en objeto de deseo al que acceder. ", "Para que se vea bien el cuerpo de la mujer. ", "Porque se intenta hacer reflexionar al receptor con un punto de vista distanciado. ",
         "Los colores c�lidos dan sensaci�n de paz y tranquilidad.", "El amarillo significa oro, dinero, riquezas. ", "El color dorado dominante identifica al producto (cerveza); destaca el rojo, que conecta a la mujer (reclamo sexual) con la marca. ",
         "La luz es difusa, uniforme. Apoya el tono general de la imagen: placentero, con connotaciones de alegr�a, sin contrastes de luces y sombras.", "Hay claros contrastes de luz y sombra, lo que puede dar sensaci�n de algo inesperado y tenebroso. ", " ",
         "Para 'anclar' la imagen, es decir, para que el receptor sepa a qu� se refiere. ", "Porque texto e imagen se contradicen, lo que provoca la atenci�n del receptor. ", "Porque el texto recuerda al diario el Mundo.",
         "Paralelismo: se repite una estructura: campo/mundo.", "Paradoja: 'refresca' y 'tu mundo' son t�rminos contradictorios.", "Met�fora: se identifica el acto de beber cerveza fr�a ('refrescar') con renovar la propia vida con placeres...",
          //---------------------------------------------------//    
          "Los productos confeccionados con 'pura lana virgen'.", "La f�rmula para tener �xito en el amor.", "Una marca de sujetadores.",
         "Una mujer, una etiqueta y un abrigo que le han regalado. ", "S�lo una: una mujer de la que vemos �nicamente parte de su cuerpo.", "No aparece ninguna persona, es un anuncio muy abstracto. ", 
         "Una habitaci�n, un collar, el pelo rubio de la mujer, el abrigo que lleva.", "Una l�mpara que emite una hermosa luz c�lida, un collar, una habitaci�n que probablemente ser� su dormitorio.", "Un abrigo, un collar que engarza una etiqueta ('pura lana virgen') y un texto en letras blancas en el centro de la imagen. ",
         "Primer plano, la mujer est� muy cerca.", "Plano general, no se centra en un solo detalle del personaje.", "Plano medio: aunque no se ve la cara, abarca hasta la cintura.",
         "Claramente picado, desde arriba para empeque�ecer a la mujer.", "A la altura de los ojos del personaje.", "Contrapicado, se enfoca a la mujer desde abajo. ",
         "Compre lana que sea pura virgen.", "La lana virgen es como la naturaleza.", "Lana turaleza.",
        
         "A personas de alto nivel econ�mico, que pueden permitirse comprar productos naturales.", "A posibles compradores de ropa de abrigo: adultos a los que se les vende un tejido natural frente a los tejidos sint�ticos.", "A todo el mundo.",
         "En este anuncio no se puede decir que falte nada; es una imagen muy completa. ", "Falta el nombre de la mujer, que puede ser muy importante como reclamo.", "Falta la cara completa de la mujer, como si s�lo interesara mostrar su espalda desnuda. ", 
         "Se identifica la lana con la misma piel de la mujer.", "La met�fora del amor.", "La etiqueta de 'pura lana virgen' se identifica con una joya de alto valor, como se ve por su color negro.",
         "El estereotipo de mujer delgada cuyo cuerpo se emplea como reclamo. ", "El estereotipo de la mujer de negocios triunfadora. ", "El estereotipo de la madre de familia feliz que intenta cuidar a los suyos con los mejores productos.",
         "Para que se perciban los sentimientos del personaje de la forma m�s directa posible.", "Para no impresionar demasiado al receptor. Un primer plano quiz� habr�a sido m�s impactante.", "Para dar protagonismo al cuerpo de la mujer (que es el reclamo central del anuncio). ",
         "Para engrandecer al personaje y convertirlo en el eje del anuncio. ", "Para que se vea bien el cuerpo de la mujer. ", "Porque en los anuncios de prendas de vestir es el punto de vista m�s frecuente. ",
         "Los colores dan sensaci�n de belleza. Identifican a la lana con la belleza.", "El predominio de colores c�lidos produce precisamente sensaci�n de calidez. ", "El color vainilla significa dulzura; el azul significa la muerte o el final de algo. ",
         "La luz es difusa, uniforme. Por ello, puede resultar inexpresiva.", "Hay claros contrastes de luz y sombra, lo que puede dar sensaci�n de intimidad.", " ",
         "Porque es una frase agresiva, nunca o�da antes. ", "Porque puede llamar la atenci�n por incluir un juego de palabras. ", "Porque el texto contradice claramente a la imagen a la que se refiere.",
         "Hip�rbole: es una exageraci�n decir que la lana es natural.", "Ant�tesis: 'lana' frente a 'naturaleza', uni�n de dos t�rminos contrarios.", "Calambur (juego de palabras en el que la separaci�n distinta de una palabra da a entender otra)."); //continuar...
 
//Este vector contiene los comentarios que aparecen al hacer clic en cada respuesta (a, b, c)
$comentarios = array("No te despistes: el fin de un anuncio es vender un producto. Identif�calo.", "El fin de un anuncio es vender un producto. Aunque lo adornen con valores que buscan reclamar la atenci�n del receptor, el producto que venden tiene que ser identificable.", "Ese es el producto que se quiere vender.",
         "Decir que la mujer es atractiva es emitir un juicio: para algunas personas y para algunas culturas puede no serlo.", "Mira con detenimiento lo que hay en el anuncio, no a�adas nada que no sea evidente. ", "Efectivamente, esa es la persona que aparece en el anuncio. ", 
         "En esta fase se te pide una descripci�n objetiva, sin a�adir opiniones ni interpretaciones. Sigue mirando, descubre m�s elementos. ", "Sigue mirando, pero sin incluir opiniones ni interpretaciones. Descubre lo que hay. ", "Efectivamente, esos son los elementos fundamentales que se puede a�adir en una descripci�n objetiva.",
         "Atenci�n: se ve m�s que el rostro de la mujer. ", "Efectivamente, a este encuadre se le llama plano entero. ", "Si se viera al personaje hasta la cintura, ser�a plano medio. Pero aqu� se ve m�s del personaje. ",
         "En esta fase (descripci�n sin opiniones, 'mirada objetiva') se te pide mirar lo que hay, no interpretar. ", "Efectivamente, la mujer parece observada desde m�s abajo de la horizontal de sus ojos.", "Si el personaje estuviera visto desde encima de su cabeza ser�a cenital. Ese punto de vista no corresponde a este anuncio. ",
         "Ese es el eslogan, breve frase que identifica al producto. ", "Esa es la marca, no el eslogan. ", "Necesitas un descanso. Y luego int�ntalo otra vez.",
        
         "La vegetaci�n parece aqu� un simple adorno, no parece indicar ninguna reivindicaci�n en defensa del medio natural. ", "Bien argumentado. ", "El producto vendido (jab�n) no parece corresponder con las expectativas o las estrategias de persuasi�n para una audiencia infantil.",
         "Esa ser�a una mirada ingenua: todo mensaje publicitario supone un recorte de la realidad. Se destacan elementos y se omiten otros de manera intencionada. ", "Hay cosas m�s relevantes que faltan. ", "Bien argumentado. ", 
         "Mira mejor el anuncio, no inventes lo que no est� en �l. ", "Bien argumentado. La met�fora visual es: la mujer es una flor.", "Mira mejor el anuncio. La connotaci�n de fragilidad no parece buscada por este anuncio. ",
         "No aparece ning�n hombre. ", "No hay se�ales evidentes de que se nos presente a una madre de familia. ", "Efectivamente, ese estereotipo aparece de manera central en este anuncio. ",
         "Para eso habr�a sido m�s adecuado un primer plano. ", "Bien argumentado. ", "Para eso podr�a ser m�s adecuado un plano detalle de los productos.",
         "Efectivamente, presentar a un personaje enfocado desde m�s abajo de la horizontal de sus ojos se llama contrapicado y puede tener un efecto de engrandecimiento. ", "Para eso habr�a sido m�s adecuado un punto de vista subjetivo, que nos situar�a en la visi�n del personaje. ", "La frecuencia no es un argumento para el uso de ese punto de vista. Su uso en publicidad estar� vinculado al valor expresivo que aporta. ",
         "El predominio de colores fr�os (azul, verde, blanco) no parece ser muy connotador de pasi�n. ", "Los colores no significan siempre lo mismo en cualquier contexto. Hay que interpretar su papel en el mensaje concreto. ", "Bien argumentado. ",
         "Efectivamente, se llama luz difusa a una iluminaci�n repartida uniformemente. En este anuncio de productos de higiene parece evidente su significado a�adido de claridad, limpieza.", "Es evidente que en la imagen aparece una iluminaci�n caracter�stica con un significado expresivo. Pi�nsalo mejor. ",   "  ",
         "El uso de un jab�n no tiene por qu� ser exclusivo de una estaci�n del a�o. ", "El l�xico empleado ('constante', 'primavera', 'flores', 'campo') no tiene connotaciones de urgencia. ", "Bien argumentado. ",
         "No hay una repetici�n de estructuras. ", "Efectivamente, esos dos recursos ret�ricos est�n en el anuncio.", "No hay s�mil porque en el texto no aparece la palabra 'como', que har�a expl�cita la comparaci�n. ",
         //---------------------------------------------------//        
         "No te despistes: el fin de un anuncio es vender un producto. Identif�calo. ", "El fin de un anuncio es vender un producto. Aunque lo adornen con valores que buscan reclamar la atenci�n del receptor, el producto que venden tiene que ser identificable. ", "Efectivamente. Flex es una conocida marca de colchones. Debajo del logotipo se lee: 'Duerma bien y vivir� mejor'.",
         "En esta fase se te pide ver simplemente lo que hay, no suponer o interpretar.", "Mira con detenimiento lo que hay en el anuncio, no a�adas nada que no sea evidente. ", "Efectivamente. ", 
         "Efectivamente. ", "Sigue mirando, pero sin incluir opiniones ni interpretaciones. Descubre lo que hay. ", "Sigue mirando, descubre m�s elementos. ",
         "Atenci�n: se ve m�s que el rostro de la ni�a. ", "Efectivamente, este plano suele denominarse entero o general.", "Si se viera al personaje hasta la cintura, ser�a plano medio. Pero aqu� se ve m�s. ",
         "En esta fase (descripci�n sin opiniones, 'mirada objetiva') se te pide mirar lo que hay, no interpretar. ", "Efectivamente, la imagen parece tomada m�s o menos desde la horizontal de los ojos de la ni�a.", "Si el personaje estuviera visto desde encima de su cabeza ser�a cenital. Ese punto de vista no corresponde a este anuncio.",
         "Mira mejor: es eslogan no es s�lo 'Hoy'.", "'Flex' es la marca, no el eslogan. ", "Efectivamente. Ese es el eslogan de campa�a. En tama�o m�s peque�o se distingue otro eslogan de marca: 'Duerma bien y vivir� mejor'.",
        
         "Podr�a ser. Pero el p�blico infantil no tiene poder adquisitivo para adquirir un colch�n, que es lo que se vende.", "Bien argumentado. ", "Todo anuncio busca una audiencia espec�fica. En este caso, el p�blico infantil no tiene poder adquisitivo para adquirir un colch�n, que es lo que se vende. ",
         "Esa ser�a una mirada ingenua: todo mensaje publicitario supone un recorte de la realidad. Se destacan elementos y se omiten otros de manera intencionada. ", "Hay cosas m�s relevantes que faltan. ", "Bien argumentado.", 
         "Mira mejor el anuncio, hay una met�fora visual m�s evidente. ", "Mira mejor el anuncio, hay una met�fora visual m�s evidente. ", "Efectivamente, un fondo azul sin nubes y una ni�a vestida con sombrero y ropa c�moda puede simbolizar la sensaci�n de descanso.",
         "Efectivamente, ese es un estereotipo muy utilizado en la publicidad en nuestro contexto. ", "No aparece ninguna madre de familia. ", "En este caso aparece una ni�a. No se destaca el cuerpo de una mujer como reclamo. ",
         "Para eso habr�a sido m�s adecuado un primer plano. ", "Piensa en otro argumento. La publicidad busca llamar la atenci�n del receptor.", "Bien argumentado.",
         "No parece que el enfoque de la imagen sea claramente desde abajo, lo que podr�a producir ese efecto de engrandecimiento. ", "Buena explicaci�n.", "La frecuencia no es un argumento para el uso de ese punto de vista. Su uso en publicidad estar� vinculado al valor expresivo que aporta. ",
         "El predominio de colores fr�os (azul) no parece muy connotador de acci�n, excitaci�n, deseo. ", "Efectivamente, esas son connotaciones que pueden tener aqu� los colores.", "Los colores no significan siempre lo mismo en cualquier contexto. Hay que interpretar su papel en el mensaje concreto. ",
         "Bien interpretado. ", "Es evidente que en la imagen aparece una iluminaci�n caracter�stica con un significado expresivo. Pi�nsalo mejor. ", " ",
         "Bien argumentado. ", "No parece el texto una invocaci�n a la acci�n (por ejemplo, 'disfruta al m�ximo'), sino una constataci�n de felicidad (seg�n el anunciante, vinculada al colch�n Flex)", "Piensa un poco mejor y busca un argumennto directamente deducible del anuncio.",
         "El s�mil es una comparaci�n expresa (que aqu� no est�).", "El texto no parece evidenciar esa contraposici�n de ideas que es la ant�tesis.", "Bien hallado.",
         //---------------------------------------------------//    
         "Mira mejor el anuncio. ", "Mira mejor. Aunque aparezca una mujer, el producto vendido no tiene que ver necesariamente con las mujeres.", "Efectivamente.",
         "Aunque no se destaque, describe lo que hay. Identifica qu� persona hay en el anuncio.", "Efectivamente.", "Aunque su tama�o sea relativamente peque�o, mira mejor para identificar a la persona. ", 
         "Mira atentamente todo lo que hay.", "Sigue mirando, pero sin incluir opiniones ni interpretaciones. Describe lo que hay. ", "Efectivamente. ",
         "En un primer plano se ver�a s�lo el rostro. ", "Efectivamente. ", "Mira mejor: el plano americano corta a los personajes por las rodillas.",
         "Mira de nuevo: la mujer no est� enfocada desde ah�. ", "Efectivamente.", "Mira de nuevo: al personaje no se le ve desde su vertical inferior. ",
         "El eslogan es una frase que aparece expl�citamente en el anuncio, por lo que no puede ser este.", "El eslogan no es una suposici�n del receptor, es una frase que aparece expl�citamente en el anuncio. ", "Efectivamente, ese es el eslogan. ",
        
         "Como posibles consumidores futuros, podr�a ser. Pero quiz� hay otros destinatarios m�s claros.", "Al anunciante seguro que le interesa tambi�n llegar a nuevos clientes, aunque no les guste mucho la cerveza o la hayan probado poco. ", "Bien argumentado.",
         "Todo mensaje publicitario supone un recorte de la realidad. Se destacan elementos y se omiten otros de manera intencionada. ", "Efectivamente, esa es una omisi�n muy relevante que una mirada cr�tica debe descubrir.  ", "Pi�nsalo mejor: hay elipsis m�s relevantes.", 
         "Efectivamente. Hasta tal punto se ofrece la ecuaci�n mujer=cerveza que la mujer del anuncio est� metida dentro de la bebida, como una burbuja m�s.", "Mira mejor el anuncio, esa met�fora no est� en la imagen. ", "Mira mejor lo que el anuncio incluye, hay una met�fora visual m�s evidente. ",
         "Mira de nuevo: no hay signos evidentes de ese estereotipo. ", "Efectivamente. La mujer es presentada en ba�ador (al parecer) sumergida en l�quido (elemento que puede despertar connotaciones relacionadas con el deseo sexual).", "No hay signos evidentes de ese estereotipo de mujer, pi�nsalo mejor. ",
         "Para eso habr�a sido m�s adecuado un primer plano. ", "Piensa en otro argumento. La publicidad busca llamar la atenci�n del receptor.", "Bien argumentado.",
         "Efectivamente, puede ser una interpretaci�n razonable. El receptor, que ve a la mujer desde abajo, es invitado a 'ascender' a su deseo gracias a la cerveza. ", "El punto de vista no produce ese efecto; es el encuadre el que no permite ver el cuerpo entero de la mujer.", "M�s que a la reflexi�n, la construcci�n de este mensaje publicitario apela a las sensaciones y emociones de los receptores. ",
         "En este anuncio, los colores no parecen connotar eso. Pi�nsalo mejor.", "Los colores no significan siempre lo mismo en cualquier contexto. Hay que interpretar su papel en el mensaje concreto. ", "Bien interpretado. Es evidente que el rojo s�lo aparece en dos lugares: significativamente son el cuerpo de la mujer y la marca de cerveza. ",
         "Efectivamente.", "Mira de nuevo: no hay claros contrastes de luces y sombras.", " ",
         "Efectivamente. El texto aqu� tiene la funci�n que Roland Barthes llam� anclaje. Sin el texto, la interpretaci�n de la imagen podr�a ser ambigua. Con �l sabemos claramente que se nos vende una cerveza Cruzcampo.", "Pi�nsalo mejor: texto e imagen no se contradicen en este caso.", "Pi�nsalo de nuevo; no te detengas en el significado literal de las palabras. ",
         "Pi�nsalo mejor; no se repite una estructura sint�ctica como 'disfruta de este mundo/disfruta de esta manera'.", "No hay paradoja en esta oraci�n. 'Refrescar' o renovar y el mundo personal no son conceptos contradictorios.", "Efectivamente. ",
          //---------------------------------------------------//    
          "Efectivamente, eso parece por lo que podemos ver.", "El fin de un anuncio es vender un producto. Aunque se componga con se�uelos que buscan reclamar la atenci�n del receptor, el producto que venden tiene que ser identificable. ", "Vuelve a mirar el anuncio.",
         "En esta fase se te pide ver simplemente lo que hay, no suponer o interpretar.", "Efectivamente. ", "Mira con detenimiento lo que hay en el anuncio. Es evidente que aparece alguna persona. ", 
         "Mira atentamente lo que hay.", "Sigue mirando, pero sin incluir opiniones ni interpretaciones. Descubre lo que hay. ", "Efectivamente. ",
         "En un primer plano se ver�a s�lo el rostro. ", "En un plano general, el espacio tendr�a m�s peso que el personaje, cosa que no sucede aqu�. ", "Efectivamente, se llama plano medio al que corta al personaje por la cintura.",
         "En esta fase (descripci�n sin opiniones, 'mirada objetiva') se te pide mirar lo que hay, no interpretar. ", "Aunque no veamos sus ojos, la mujer no parece enfocada desde la horizontal de sus ojos.", "Efectivamente, este tipo de �ngulo se denomina contrapicado: enfoca al personaje desde m�s abajo de la horizontal de los ojos del personaje. ",
         "El eslogan es una frase que aparece expl�citamente en el anuncio, por lo que no puede ser este.", "El eslogan no es una suposici�n del receptor, es una frase que aparece expl�citamente en el anuncio. ", "Efectivamente, ese es el eslogan. ",
        
         "No hay signos evidentes en el anuncio de que se busque un p�blico de ese perfil.", "Bien argumentado. ", "Todo anuncio busca una audiencia espec�fica. Aunque lo pueda ver todo el mundo, ha sido dise�ado con un objetivo concreto. ",
         "Todo mensaje publicitario supone un recorte de la realidad. Se destacan elementos y se omiten otros de manera intencionada. ", "Hay cosas m�s relevantes que faltan. ", "Bien argumentado.", 
         "Efectivamente. Desde un punto de vista cr�tico, a trav�s de esa met�fora se puede apreciar el uso del cuerpo femenino como objeto.", "Mira mejor el anuncio, hay una met�fora visual m�s evidente. ", "El color negro no tiene por qu� indicar esa met�fora. Mira mejor el anuncio, hay una met�fora visual m�s evidente.",
         "Efectivamente, hasta tal punto se utiliza ese estereotipo que no interesa ni mostrar la cara de la mujer, sino tan s�lo su cuerpo desnudo. ", "No hay signos evidentes de ese estereotipo, pi�nsalo mejor. ", "No hay signos evidentes de ese estereotipo de madre, pi�nsalo mejor. ",
         "Para eso habr�a sido m�s adecuado un primer plano. ", "Piensa en otro argumento. La publicidad busca llamar la atenci�n del receptor.", "Bien argumentado.",
         "Efectivamente, el enfoque desde m�s abajo de la horizontal de los ojos del personaje puede tener ese efecto.", "El punto de vista no produce ese efecto; es el encuadre el que no permite ver el cuerpo entero de la mujer.", "La frecuencia no es un argumento para el uso de ese punto de vista. Su uso en publicidad estar� vinculado al valor expresivo que aporta. ",
         "No hay signos evidentes de que los colores connoten ese concepto. Pi�nsalo mejor.", "Efectivamente, ese valor puede estar detr�s de este anuncio de productos de lana. ", "Los colores no significan siempre lo mismo en cualquier contexto. Hay que interpretar su papel en el mensaje concreto. ",
         "Mira mejor: la luz aqu� no es difusa.", "Bien argumentado.", " ",
         "Este texto no tiene esas caracter�sticas. Pi�nsalo mejor.", "Efectivamente.", "Piensa un poco mejor y busca un argumento directamente deducible del anuncio.",
         "Pi�nsalo mejor; no hay hip�rbole en este texto.", "'Lana' y 'naturaleza' no son t�rminos antit�ticos.", "Efectivamente. 'La naturaleza', separado como 'lana turaleza' es un juego de palabras que conecta el producto vendido con la idea de naturaleza (sugiriendo su superioridad frente a los productos sint�ticos)."); //continuar...

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
for($i=0;$i<=63;$i++)
{
	$pdf->SetFont('Arial','B',15);
	$pdf->SetTextColor(178,38,0);
	
	if( $i == 0 )
	{
		$pdf->Cell(0,10,"FLORES DEL CAMPO",0,1);
		$pdf->Cell(0,2,"________________________________________________________________",0,1);
		$pdf->Ln(5);
	}
		
	if( $i == 16 )
	{
		$pdf->Ln();
		$pdf->Cell(0,10,"HOY ME SIENTO FLEX",0,1);
		$pdf->Cell(0,2,"________________________________________________________________",0,1);
		$pdf->Ln(5);
	}
		
	if( $i == 32 )
	{
		$pdf->Ln();
		$pdf->Cell(0,10,"REFRESCA TU MUNDO",0,1);
		$pdf->Cell(0,2,"________________________________________________________________",0,1);
		$pdf->Ln(5);
	}
	
	if( $i == 48 )
	{
		$pdf->Ln();
		$pdf->Cell(0,10,"LANA FLEX",0,1);
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