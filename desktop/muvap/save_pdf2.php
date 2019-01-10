<?php
require('fpdf/fpdf.php');

//Este vector contiene los titulos de las preguntas
$preguntas = array("¿Qué producto se anuncia?", "¿Qué personas aparecen?", "¿Qué otros elementos aparecen?", "¿Qué tipo de plano se emplea en el anuncio?", "¿Qué punto de vista se ha utilizado?", "¿Qué eslogan se incluye?",
        "¿A quiénes parece dirigido el anuncio?", "¿Qué elementos podrían aparecer pero están ausentes?", "¿Qué metáfora visual parece usarse en el anuncio?", "¿Qué estereotipo encuentras en este anuncio?", "¿Por qué se emplea ese tipo de plano?", "¿Por qué se emplea ese punto de vista?", "¿Qué valor tienen los colores empleados?", "¿Qué valor tiene el tipo de luz empleado?", "¿Por qué se usa ese texto?", "¿Qué recurso retórico hay en el texto?",
        
        "¿Qué producto se anuncia?", "¿Qué personas aparecen?", "¿Qué otros elementos aparecen?", "¿Qué tipo de plano se emplea en el anuncio?", "¿Qué punto de vista se ha utilizado?", "¿Qué eslogan se incluye y cómo?",
        "¿A quiénes parece dirigido el anuncio?", "¿Qué elementos podrían aparecer pero están ausentes?", "¿Qué metáfora visual parece usarse en el anuncio?", "¿Qué estereotipo encuentras en este anuncio?", "¿Por qué se emplea ese tipo de plano?", "¿Por qué se emplea ese punto de vista?", "¿Qué valor tienen los colores empleados?", "¿Qué valor tiene el tipo de luz empleado?", "¿Por qué se usa ese texto?", "¿Qué recurso retórico hay en el texto?",
        
        "¿Qué producto se anuncia?", "¿Qué personas aparecen?", "¿Qué otros elementos aparecen?", "¿Qué tipo de plano se emplea en el anuncio?", "¿Qué punto de vista se ha utilizado?", "¿Qué eslogan se incluye y cómo?",
        "¿A quiénes parece dirigido el anuncio?", "¿Qué elementos podrían aparecer pero están ausentes?", "¿Qué metáfora visual parece usarse en el anuncio?", "¿Qué estereotipo encuentras en este anuncio?", "¿Por qué se emplea ese tipo de plano?", "¿Por qué se emplea ese punto de vista?", "¿Qué valor tienen los colores empleados?", "¿Qué valor tiene el tipo de luz empleado?", "¿Por qué se usa ese texto?", "¿Qué recurso retórico hay en el texto?",
        
        "¿Qué producto se anuncia?", "¿Qué personas aparecen?", "¿Qué otros elementos aparecen?", "¿Qué tipo de plano se emplea en el anuncio?", "¿Qué punto de vista se ha utilizado?", "¿Qué eslogan se incluye?",
        "¿A quiénes parece dirigido el anuncio?", "¿Qué elementos podrían aparecer pero están ausentes?", "¿Qué metáfora visual parece usarse en el anuncio?", "¿Qué estereotipo encuentras en este anuncio?", "¿Por qué se emplea ese tipo de plano?", "¿Por qué se emplea ese punto de vista?", "¿Qué valor tienen los colores empleados?", "¿Qué valor tiene el tipo de luz empleado?", "¿Por qué se usa ese texto?", "¿Qué recurso retórico hay en el texto?");  //continuar...
 
//Este vector contiene las posibles respuestas de cada pregunta (a, b, c)
$respuestas = array("Ropa primaveral de mujer.", "La naturaleza y sus derivados.", "Jabón, colonia y extracto de la marca Flores del Campo.",
         "Una mujer atractiva se encuentra entre los productos anunciados.", "Aparece una mujer bailando. La mujer, con los brazos extendidos a la altura de los hombros, parece volar entre las flores. ", "Aparece el dibujo de una mujer morena con sombrero y un vestido largo de rayas horizontales azules y blancas.", 
         "Aparecen jabones. Un cielo azul propio de un día soleado y un cartel de color llamativo para que el receptor se detenga a leerlo.", "Un cartel rojo que llama mucho la atención. Un fondo que sugiere el mar y unas flores que flotan para transmitir que se trata de una colonia ligera.", "En un fondo claro, aparece centrado el dibujo de una mujer rodeada de vegetación. Delante de ella, un rectángulo rojo incluye en letras blancas el producto anunciado. En los laterales, dibujos de los productos anunciados.",
         "Primer plano, por la cercanía de la mujer.", "Plano entero, muestra el cuerpo completo del personaje.", "Plano medio, destaca la cintura.",
         "Picado, desde arriba para empequeñecer a la mujer.", "Levemente desde abajo, contrapicado.", "Cenital, desde el cielo.",
         "Constante primavera.", "Flores del campo.", "Floralia, Madrid.",
        
         "A personas adultas, de nivel económico medio-alto y comprometidas con la naturaleza, porque en el dibujo predomina la vegetación.", "A posibles compradores de jabón y colonia en la época en España: seguramente mujeres a quienes se invita a sentirse esbeltas y bellas como la mujer dibujada.", "En general a todo el mundo, pero especialmente a hombres y niños, porque serían atraídos por la imagen de la mujer.",
         "No falta nada; el anuncio es muy completo. ", "Falta el país donde se vende el producto y el lugar de donde es originario. También falta la fecha del anuncio.", "Están ausentes otro tipo de personas diferentes (de más edad, de distinta complexión física, de distinto sexo y grupo social...).", 
         "El jabón es como una playa agradable en la que una mujer joven puede disfrutar de total libertad para relacionarse con quien desee.", "La mujer aparece como una flor más en medio del campo, redundando en el nombre de la marca (Flores del campo).", "El frasco es la metáfora de la fragilidad del cristal y de los líquidos alcohólicos que podrían estar dentro y proporcionar sentimientos de evasión a sus consumidores.",
         "El estereotipo del hombre. ", "El estereotipo de la madre de familia. ", "El estereotipo de la mujer como adorno, como objeto bello. ",
         "Para que se vea bien de cerca la cara de la mujer y los sentimientos que quiere expresar.", "Porque permite mostrar los productos en primer plano y el cuerpo entero del personaje.", "Para que el receptor vea bien lo que se vende.",
         "El punto de vista contrapicado, levemente desde abajo, engrandece al personaje. ", "Para que nos sintamos como la mujer del anuncio. ", "Porque es el punto de vista más frecuente. ", 
         "Los colores dan sensación de pasión. Llaman la atención vivamente y poseen connotaciones de sensualidad, deseo amoroso, exaltación del cuerpo.", "El azul significa mar; el verde, esperanza; y el amarillo, dinero. ", "El fondo blanco puede tener connotaciones de limpieza. El contraste entre los colores fríos que predominan y el color cálido del cartel realza el eslogan. ",
         "La luz es difusa. Por ello, puede producir sensación de claridad y limpieza.", "La luz es casi inexistente. No parece tener ningún papel en el significado expresivo del anuncio. ",  "  ",
         "Porque en primavera es más frecuente el uso del producto. ", "Porque quiere dar sensación de urgencia, de necesidad imperiosa de adquirir el producto por sus cualidades únicas. ", "Porque busca impactar con una frase breve y perfumar el mensaje de connotaciones positivas arrastradas por la palabra 'primavera'. ",
         "Paralelismo. Se repiten dos estructuras muy similares: 'primavera'...'campo'.", "Epíteto (adjetivo antepuesto, 'constante', que enfatiza emotivamente al sustantivo) y metáfora (la vida como una primavera continua). ", "Símil o comparación: esta colonia es como una primavera.",
         //---------------------------------------------------//        
         "Que todo el mundo pueda ser feliz.", "Los sentimientos positivos.", "Colchones de la marca Flex.",
         "Una niña en un columpio y, claro, la persona que la impulsa.", "Una niña muy alegre sentada en un columpio como si volase.", "Una niña morena de pelo largo sentada en un columpio. ", 
         "Texto, una línea curva azul, el logotipo de Flex y un gigantesco columpio.", "Una línea que significa alegría.", "Un texto de tamaño muy grande y el logotipo. ",
         "Primer plano, para ver bien a la niña.", "Plano entero (cuerpo completo del personaje) o general.", "Plano medio, destaca la cintura.",
         "Claramente picado, desde arriba para empequeñecer a la niña.", "Frontal, a la altura de los ojos del personaje. ", "Cenital, desde el cielo. ",
         "El eslogan es 'Hoy', porque se quiere invitar a vivir intensamente cada día.", "El eslogan es 'Flex', que aparece como indicando sueño.", "'Hoy me siento Flex'. Aparece en letra azul muy grande, ocupando casi toda la parte superior del anuncio. ",
        
         "Al público infantil, atraído por el columpio gigantesco y la sensación de diversión.", "A posibles compradores de colchones: adultos que quizá se enternezcan con la imagen y deseen dormir 'como un bebé'. ", "En general a todo el mundo, pero especialmente a niños y niñas, porque se identifican con la imagen de la niña.",
         "No falta nada; el anuncio es muy completo. ", "Faltan las tiendas donde se se vende el producto. También falta la fecha del anuncio.", "Falta el producto: el colchón. En vez de mostrar simplemente el producto, se nos quiere trasmitir una sensación (descanso...).", 
         "La línea curva azul es como un colchón suave y mullido con su almohada en un extremo.", "El fondo azul es la metáfora del verano: compre Flex y se sentirá como en verano.", "El fondo azul y la niña en el columpio son metáfora de descanso, ausencia de preocupaciones.",
         "El estereotipo de niña delgada y feliz. ", "El estereotipo de la madre de familia. ", "El estereotipo de la mujer como objeto sexual. ",
         "Para que se vea bien de cerca la cara de la mujer y los sentimientos que quiere expresar.", "Para no impresionar demasiado al receptor.", "Para dar protagonismo al eslogan (que es más grande que el personaje).",
         "Para engrandecer al personaje y convertirlo en el eje del anuncio. ", "Para que nos sintamos como la niña del anuncio, suavemente balanceados (o acunados) ante la promesa de un colchón Flex. ", "Porque es el punto de vista más frecuente. ",
         "Los colores dan sensación de dinamismo. Llaman la atención vivamente y poseen connotaciones de acción, excitación, deseo...", "El predominio de colores fríos (azul) parece connotar placidez, suavidad... ", "El color marrón significa la tierra; el azul significa el cielo; el negro, la elegancia. ",
         "La luz es difusa. Por ello, puede producir sensación de claridad, tranquilidad.", "La luz es casi inexistente. No parece tener ningún papel en el significado expresivo del anuncio. ", "", 
         "Porque es una frase breve, fácil de recordar, en el que la marca se convierte en un sentimiento. ", "Porque quiere dar sensación de que hoy va a ser un gran día y que hay que vivirlo al máximo. ", "Porque Flex es una marca conocida en todo el mundo. ",
         "Símil: compara el día de hoy con el colchón Flex.", "Antítesis: hoy (preocupación, trabajo, sufrimiento) frente a Flex (descanso, placer).", "Metáfora (me siento Flex=me siento bien por descansar bien) o antonomasia (Flex simbolizaría el descanso por antonomasia).",
         //---------------------------------------------------//    
         "Vacaciones con alguna agencia de viajes.", "Ropa de baño para mujer.", "Cerveza Cruzcampo.",
         "No hay ninguna persona destacada en el anuncio.", "Una mujer en bañador rojo zambullida dentro del líquido.", "Aparece una persona difícil de identificar, de aspecto andrógino. ", 
         "Letras ('Cruzcampo', 'Refresca tu Mundo'), el bañador rojo de la mujer  y nada más.", "Letras en dos colores (rojo y negro, colores que incitan a la pasión), espuma y quizá la boca que se bebe el líquido.", "Texto en la esquina inferior derecha; líquido de color dorado, la estela que deja la mujer y espuma por encima del líquido.",
         "Primer plano, la mujer está destacada.", "Plano general, el personaje se presenta en un amplio espacio.", "Plano americano, muy frecuente en las películas americanas del oeste.",
         "Claramente cenital, desde arriba como si la cámara fuera en un helicóptero.", "Levemente por debajo de la horizontal de los ojos del personaje (contrapicado). ", "Nadir, se enfoca a la mujer desde abajo, el punto de vista de gusano, como si se la viera desde una alcantarilla.",
         "Bebe cerveza y refresca tu mundo.", "Refresca tu mundo, compra Cruzcampo. ", "En letras negras, esquina inferior derecha, 'Refresca tu Mundo'.",
        
         "A niños a los que les gustan las piscinas y las playas.", "A todas las personas a las que les guste la cerveza. ", "A posibles consumidores de cerveza, especialmente hombres por el uso de la mujer como reclamo.",
         "En este anuncio no falta nada; es una imagen muy bien diseñada. ", "Falta, por ejemplo, la parte negativa del alcohol: los perjuicios que puede causar su consumo irresponsable. ", "Falta el trampolín desde el que se ha tirado la mujer y el borde de la piscina que no quieren que veamos. ", 
         "Se identifica la mujer con la cerveza. Zambullirse en la cerveza es zambullirse en el deseo.", "La metáfora del esfuerzo. Cerveza=disfrute ganado después de mucho tiempo, gracias al esfuerzo personal. ", "La metáfora de la vida como un líquido en el que el ser humano nace, se desarrolla y termina desembocando en la muerte.",
         "El estereotipo de mujer trabajadora y dinámica. ", "El estereotipo de la mujer rubia, delgada, objeto de deseo. ", "El estereotipo de la mujer madura que dirige su vida de manera autónoma. ",
         "Para que se perciban los sentimientos del personaje de la forma más directa posible. ", "Para no impresionar demasiado al receptor. Un primer plano quizá habría sido más impactante.", "Para dar protagonismo al cuerpo de la mujer (que es el reclamo central del anuncio).",
         "Para convertir al personaje en objeto de deseo al que acceder. ", "Para que se vea bien el cuerpo de la mujer. ", "Porque se intenta hacer reflexionar al receptor con un punto de vista distanciado. ",
         "Los colores cálidos dan sensación de paz y tranquilidad.", "El amarillo significa oro, dinero, riquezas. ", "El color dorado dominante identifica al producto (cerveza); destaca el rojo, que conecta a la mujer (reclamo sexual) con la marca. ",
         "La luz es difusa, uniforme. Apoya el tono general de la imagen: placentero, con connotaciones de alegría, sin contrastes de luces y sombras.", "Hay claros contrastes de luz y sombra, lo que puede dar sensación de algo inesperado y tenebroso. ", " ",
         "Para 'anclar' la imagen, es decir, para que el receptor sepa a qué se refiere. ", "Porque texto e imagen se contradicen, lo que provoca la atención del receptor. ", "Porque el texto recuerda al diario el Mundo.",
         "Paralelismo: se repite una estructura: campo/mundo.", "Paradoja: 'refresca' y 'tu mundo' son términos contradictorios.", "Metáfora: se identifica el acto de beber cerveza fría ('refrescar') con renovar la propia vida con placeres...",
          //---------------------------------------------------//    
          "Los productos confeccionados con 'pura lana virgen'.", "La fórmula para tener éxito en el amor.", "Una marca de sujetadores.",
         "Una mujer, una etiqueta y un abrigo que le han regalado. ", "Sólo una: una mujer de la que vemos únicamente parte de su cuerpo.", "No aparece ninguna persona, es un anuncio muy abstracto. ", 
         "Una habitación, un collar, el pelo rubio de la mujer, el abrigo que lleva.", "Una lámpara que emite una hermosa luz cálida, un collar, una habitación que probablemente será su dormitorio.", "Un abrigo, un collar que engarza una etiqueta ('pura lana virgen') y un texto en letras blancas en el centro de la imagen. ",
         "Primer plano, la mujer está muy cerca.", "Plano general, no se centra en un solo detalle del personaje.", "Plano medio: aunque no se ve la cara, abarca hasta la cintura.",
         "Claramente picado, desde arriba para empequeñecer a la mujer.", "A la altura de los ojos del personaje.", "Contrapicado, se enfoca a la mujer desde abajo. ",
         "Compre lana que sea pura virgen.", "La lana virgen es como la naturaleza.", "Lana turaleza.",
        
         "A personas de alto nivel económico, que pueden permitirse comprar productos naturales.", "A posibles compradores de ropa de abrigo: adultos a los que se les vende un tejido natural frente a los tejidos sintéticos.", "A todo el mundo.",
         "En este anuncio no se puede decir que falte nada; es una imagen muy completa. ", "Falta el nombre de la mujer, que puede ser muy importante como reclamo.", "Falta la cara completa de la mujer, como si sólo interesara mostrar su espalda desnuda. ", 
         "Se identifica la lana con la misma piel de la mujer.", "La metáfora del amor.", "La etiqueta de 'pura lana virgen' se identifica con una joya de alto valor, como se ve por su color negro.",
         "El estereotipo de mujer delgada cuyo cuerpo se emplea como reclamo. ", "El estereotipo de la mujer de negocios triunfadora. ", "El estereotipo de la madre de familia feliz que intenta cuidar a los suyos con los mejores productos.",
         "Para que se perciban los sentimientos del personaje de la forma más directa posible.", "Para no impresionar demasiado al receptor. Un primer plano quizá habría sido más impactante.", "Para dar protagonismo al cuerpo de la mujer (que es el reclamo central del anuncio). ",
         "Para engrandecer al personaje y convertirlo en el eje del anuncio. ", "Para que se vea bien el cuerpo de la mujer. ", "Porque en los anuncios de prendas de vestir es el punto de vista más frecuente. ",
         "Los colores dan sensación de belleza. Identifican a la lana con la belleza.", "El predominio de colores cálidos produce precisamente sensación de calidez. ", "El color vainilla significa dulzura; el azul significa la muerte o el final de algo. ",
         "La luz es difusa, uniforme. Por ello, puede resultar inexpresiva.", "Hay claros contrastes de luz y sombra, lo que puede dar sensación de intimidad.", " ",
         "Porque es una frase agresiva, nunca oída antes. ", "Porque puede llamar la atención por incluir un juego de palabras. ", "Porque el texto contradice claramente a la imagen a la que se refiere.",
         "Hipérbole: es una exageración decir que la lana es natural.", "Antítesis: 'lana' frente a 'naturaleza', unión de dos términos contrarios.", "Calambur (juego de palabras en el que la separación distinta de una palabra da a entender otra)."); //continuar...
 
//Este vector contiene los comentarios que aparecen al hacer clic en cada respuesta (a, b, c)
$comentarios = array("No te despistes: el fin de un anuncio es vender un producto. Identifícalo.", "El fin de un anuncio es vender un producto. Aunque lo adornen con valores que buscan reclamar la atención del receptor, el producto que venden tiene que ser identificable.", "Ese es el producto que se quiere vender.",
         "Decir que la mujer es atractiva es emitir un juicio: para algunas personas y para algunas culturas puede no serlo.", "Mira con detenimiento lo que hay en el anuncio, no añadas nada que no sea evidente. ", "Efectivamente, esa es la persona que aparece en el anuncio. ", 
         "En esta fase se te pide una descripción objetiva, sin añadir opiniones ni interpretaciones. Sigue mirando, descubre más elementos. ", "Sigue mirando, pero sin incluir opiniones ni interpretaciones. Descubre lo que hay. ", "Efectivamente, esos son los elementos fundamentales que se puede añadir en una descripción objetiva.",
         "Atención: se ve más que el rostro de la mujer. ", "Efectivamente, a este encuadre se le llama plano entero. ", "Si se viera al personaje hasta la cintura, sería plano medio. Pero aquí se ve más del personaje. ",
         "En esta fase (descripción sin opiniones, 'mirada objetiva') se te pide mirar lo que hay, no interpretar. ", "Efectivamente, la mujer parece observada desde más abajo de la horizontal de sus ojos.", "Si el personaje estuviera visto desde encima de su cabeza sería cenital. Ese punto de vista no corresponde a este anuncio. ",
         "Ese es el eslogan, breve frase que identifica al producto. ", "Esa es la marca, no el eslogan. ", "Necesitas un descanso. Y luego inténtalo otra vez.",
        
         "La vegetación parece aquí un simple adorno, no parece indicar ninguna reivindicación en defensa del medio natural. ", "Bien argumentado. ", "El producto vendido (jabón) no parece corresponder con las expectativas o las estrategias de persuasión para una audiencia infantil.",
         "Esa sería una mirada ingenua: todo mensaje publicitario supone un recorte de la realidad. Se destacan elementos y se omiten otros de manera intencionada. ", "Hay cosas más relevantes que faltan. ", "Bien argumentado. ", 
         "Mira mejor el anuncio, no inventes lo que no está en él. ", "Bien argumentado. La metáfora visual es: la mujer es una flor.", "Mira mejor el anuncio. La connotación de fragilidad no parece buscada por este anuncio. ",
         "No aparece ningún hombre. ", "No hay señales evidentes de que se nos presente a una madre de familia. ", "Efectivamente, ese estereotipo aparece de manera central en este anuncio. ",
         "Para eso habría sido más adecuado un primer plano. ", "Bien argumentado. ", "Para eso podría ser más adecuado un plano detalle de los productos.",
         "Efectivamente, presentar a un personaje enfocado desde más abajo de la horizontal de sus ojos se llama contrapicado y puede tener un efecto de engrandecimiento. ", "Para eso habría sido más adecuado un punto de vista subjetivo, que nos situaría en la visión del personaje. ", "La frecuencia no es un argumento para el uso de ese punto de vista. Su uso en publicidad estará vinculado al valor expresivo que aporta. ",
         "El predominio de colores fríos (azul, verde, blanco) no parece ser muy connotador de pasión. ", "Los colores no significan siempre lo mismo en cualquier contexto. Hay que interpretar su papel en el mensaje concreto. ", "Bien argumentado. ",
         "Efectivamente, se llama luz difusa a una iluminación repartida uniformemente. En este anuncio de productos de higiene parece evidente su significado añadido de claridad, limpieza.", "Es evidente que en la imagen aparece una iluminación característica con un significado expresivo. Piénsalo mejor. ",   "  ",
         "El uso de un jabón no tiene por qué ser exclusivo de una estación del año. ", "El léxico empleado ('constante', 'primavera', 'flores', 'campo') no tiene connotaciones de urgencia. ", "Bien argumentado. ",
         "No hay una repetición de estructuras. ", "Efectivamente, esos dos recursos retóricos están en el anuncio.", "No hay símil porque en el texto no aparece la palabra 'como', que haría explícita la comparación. ",
         //---------------------------------------------------//        
         "No te despistes: el fin de un anuncio es vender un producto. Identifícalo. ", "El fin de un anuncio es vender un producto. Aunque lo adornen con valores que buscan reclamar la atención del receptor, el producto que venden tiene que ser identificable. ", "Efectivamente. Flex es una conocida marca de colchones. Debajo del logotipo se lee: 'Duerma bien y vivirá mejor'.",
         "En esta fase se te pide ver simplemente lo que hay, no suponer o interpretar.", "Mira con detenimiento lo que hay en el anuncio, no añadas nada que no sea evidente. ", "Efectivamente. ", 
         "Efectivamente. ", "Sigue mirando, pero sin incluir opiniones ni interpretaciones. Descubre lo que hay. ", "Sigue mirando, descubre más elementos. ",
         "Atención: se ve más que el rostro de la niña. ", "Efectivamente, este plano suele denominarse entero o general.", "Si se viera al personaje hasta la cintura, sería plano medio. Pero aquí se ve más. ",
         "En esta fase (descripción sin opiniones, 'mirada objetiva') se te pide mirar lo que hay, no interpretar. ", "Efectivamente, la imagen parece tomada más o menos desde la horizontal de los ojos de la niña.", "Si el personaje estuviera visto desde encima de su cabeza sería cenital. Ese punto de vista no corresponde a este anuncio.",
         "Mira mejor: es eslogan no es sólo 'Hoy'.", "'Flex' es la marca, no el eslogan. ", "Efectivamente. Ese es el eslogan de campaña. En tamaño más pequeño se distingue otro eslogan de marca: 'Duerma bien y vivirá mejor'.",
        
         "Podría ser. Pero el público infantil no tiene poder adquisitivo para adquirir un colchón, que es lo que se vende.", "Bien argumentado. ", "Todo anuncio busca una audiencia específica. En este caso, el público infantil no tiene poder adquisitivo para adquirir un colchón, que es lo que se vende. ",
         "Esa sería una mirada ingenua: todo mensaje publicitario supone un recorte de la realidad. Se destacan elementos y se omiten otros de manera intencionada. ", "Hay cosas más relevantes que faltan. ", "Bien argumentado.", 
         "Mira mejor el anuncio, hay una metáfora visual más evidente. ", "Mira mejor el anuncio, hay una metáfora visual más evidente. ", "Efectivamente, un fondo azul sin nubes y una niña vestida con sombrero y ropa cómoda puede simbolizar la sensación de descanso.",
         "Efectivamente, ese es un estereotipo muy utilizado en la publicidad en nuestro contexto. ", "No aparece ninguna madre de familia. ", "En este caso aparece una niña. No se destaca el cuerpo de una mujer como reclamo. ",
         "Para eso habría sido más adecuado un primer plano. ", "Piensa en otro argumento. La publicidad busca llamar la atención del receptor.", "Bien argumentado.",
         "No parece que el enfoque de la imagen sea claramente desde abajo, lo que podría producir ese efecto de engrandecimiento. ", "Buena explicación.", "La frecuencia no es un argumento para el uso de ese punto de vista. Su uso en publicidad estará vinculado al valor expresivo que aporta. ",
         "El predominio de colores fríos (azul) no parece muy connotador de acción, excitación, deseo. ", "Efectivamente, esas son connotaciones que pueden tener aquí los colores.", "Los colores no significan siempre lo mismo en cualquier contexto. Hay que interpretar su papel en el mensaje concreto. ",
         "Bien interpretado. ", "Es evidente que en la imagen aparece una iluminación característica con un significado expresivo. Piénsalo mejor. ", " ",
         "Bien argumentado. ", "No parece el texto una invocación a la acción (por ejemplo, 'disfruta al máximo'), sino una constatación de felicidad (según el anunciante, vinculada al colchón Flex)", "Piensa un poco mejor y busca un argumennto directamente deducible del anuncio.",
         "El símil es una comparación expresa (que aquí no está).", "El texto no parece evidenciar esa contraposición de ideas que es la antítesis.", "Bien hallado.",
         //---------------------------------------------------//    
         "Mira mejor el anuncio. ", "Mira mejor. Aunque aparezca una mujer, el producto vendido no tiene que ver necesariamente con las mujeres.", "Efectivamente.",
         "Aunque no se destaque, describe lo que hay. Identifica qué persona hay en el anuncio.", "Efectivamente.", "Aunque su tamaño sea relativamente pequeño, mira mejor para identificar a la persona. ", 
         "Mira atentamente todo lo que hay.", "Sigue mirando, pero sin incluir opiniones ni interpretaciones. Describe lo que hay. ", "Efectivamente. ",
         "En un primer plano se vería sólo el rostro. ", "Efectivamente. ", "Mira mejor: el plano americano corta a los personajes por las rodillas.",
         "Mira de nuevo: la mujer no está enfocada desde ahí. ", "Efectivamente.", "Mira de nuevo: al personaje no se le ve desde su vertical inferior. ",
         "El eslogan es una frase que aparece explícitamente en el anuncio, por lo que no puede ser este.", "El eslogan no es una suposición del receptor, es una frase que aparece explícitamente en el anuncio. ", "Efectivamente, ese es el eslogan. ",
        
         "Como posibles consumidores futuros, podría ser. Pero quizá hay otros destinatarios más claros.", "Al anunciante seguro que le interesa también llegar a nuevos clientes, aunque no les guste mucho la cerveza o la hayan probado poco. ", "Bien argumentado.",
         "Todo mensaje publicitario supone un recorte de la realidad. Se destacan elementos y se omiten otros de manera intencionada. ", "Efectivamente, esa es una omisión muy relevante que una mirada crítica debe descubrir.  ", "Piénsalo mejor: hay elipsis más relevantes.", 
         "Efectivamente. Hasta tal punto se ofrece la ecuación mujer=cerveza que la mujer del anuncio está metida dentro de la bebida, como una burbuja más.", "Mira mejor el anuncio, esa metáfora no está en la imagen. ", "Mira mejor lo que el anuncio incluye, hay una metáfora visual más evidente. ",
         "Mira de nuevo: no hay signos evidentes de ese estereotipo. ", "Efectivamente. La mujer es presentada en bañador (al parecer) sumergida en líquido (elemento que puede despertar connotaciones relacionadas con el deseo sexual).", "No hay signos evidentes de ese estereotipo de mujer, piénsalo mejor. ",
         "Para eso habría sido más adecuado un primer plano. ", "Piensa en otro argumento. La publicidad busca llamar la atención del receptor.", "Bien argumentado.",
         "Efectivamente, puede ser una interpretación razonable. El receptor, que ve a la mujer desde abajo, es invitado a 'ascender' a su deseo gracias a la cerveza. ", "El punto de vista no produce ese efecto; es el encuadre el que no permite ver el cuerpo entero de la mujer.", "Más que a la reflexión, la construcción de este mensaje publicitario apela a las sensaciones y emociones de los receptores. ",
         "En este anuncio, los colores no parecen connotar eso. Piénsalo mejor.", "Los colores no significan siempre lo mismo en cualquier contexto. Hay que interpretar su papel en el mensaje concreto. ", "Bien interpretado. Es evidente que el rojo sólo aparece en dos lugares: significativamente son el cuerpo de la mujer y la marca de cerveza. ",
         "Efectivamente.", "Mira de nuevo: no hay claros contrastes de luces y sombras.", " ",
         "Efectivamente. El texto aquí tiene la función que Roland Barthes llamó anclaje. Sin el texto, la interpretación de la imagen podría ser ambigua. Con él sabemos claramente que se nos vende una cerveza Cruzcampo.", "Piénsalo mejor: texto e imagen no se contradicen en este caso.", "Piénsalo de nuevo; no te detengas en el significado literal de las palabras. ",
         "Piénsalo mejor; no se repite una estructura sintáctica como 'disfruta de este mundo/disfruta de esta manera'.", "No hay paradoja en esta oración. 'Refrescar' o renovar y el mundo personal no son conceptos contradictorios.", "Efectivamente. ",
          //---------------------------------------------------//    
          "Efectivamente, eso parece por lo que podemos ver.", "El fin de un anuncio es vender un producto. Aunque se componga con señuelos que buscan reclamar la atención del receptor, el producto que venden tiene que ser identificable. ", "Vuelve a mirar el anuncio.",
         "En esta fase se te pide ver simplemente lo que hay, no suponer o interpretar.", "Efectivamente. ", "Mira con detenimiento lo que hay en el anuncio. Es evidente que aparece alguna persona. ", 
         "Mira atentamente lo que hay.", "Sigue mirando, pero sin incluir opiniones ni interpretaciones. Descubre lo que hay. ", "Efectivamente. ",
         "En un primer plano se vería sólo el rostro. ", "En un plano general, el espacio tendría más peso que el personaje, cosa que no sucede aquí. ", "Efectivamente, se llama plano medio al que corta al personaje por la cintura.",
         "En esta fase (descripción sin opiniones, 'mirada objetiva') se te pide mirar lo que hay, no interpretar. ", "Aunque no veamos sus ojos, la mujer no parece enfocada desde la horizontal de sus ojos.", "Efectivamente, este tipo de ángulo se denomina contrapicado: enfoca al personaje desde más abajo de la horizontal de los ojos del personaje. ",
         "El eslogan es una frase que aparece explícitamente en el anuncio, por lo que no puede ser este.", "El eslogan no es una suposición del receptor, es una frase que aparece explícitamente en el anuncio. ", "Efectivamente, ese es el eslogan. ",
        
         "No hay signos evidentes en el anuncio de que se busque un público de ese perfil.", "Bien argumentado. ", "Todo anuncio busca una audiencia específica. Aunque lo pueda ver todo el mundo, ha sido diseñado con un objetivo concreto. ",
         "Todo mensaje publicitario supone un recorte de la realidad. Se destacan elementos y se omiten otros de manera intencionada. ", "Hay cosas más relevantes que faltan. ", "Bien argumentado.", 
         "Efectivamente. Desde un punto de vista crítico, a través de esa metáfora se puede apreciar el uso del cuerpo femenino como objeto.", "Mira mejor el anuncio, hay una metáfora visual más evidente. ", "El color negro no tiene por qué indicar esa metáfora. Mira mejor el anuncio, hay una metáfora visual más evidente.",
         "Efectivamente, hasta tal punto se utiliza ese estereotipo que no interesa ni mostrar la cara de la mujer, sino tan sólo su cuerpo desnudo. ", "No hay signos evidentes de ese estereotipo, piénsalo mejor. ", "No hay signos evidentes de ese estereotipo de madre, piénsalo mejor. ",
         "Para eso habría sido más adecuado un primer plano. ", "Piensa en otro argumento. La publicidad busca llamar la atención del receptor.", "Bien argumentado.",
         "Efectivamente, el enfoque desde más abajo de la horizontal de los ojos del personaje puede tener ese efecto.", "El punto de vista no produce ese efecto; es el encuadre el que no permite ver el cuerpo entero de la mujer.", "La frecuencia no es un argumento para el uso de ese punto de vista. Su uso en publicidad estará vinculado al valor expresivo que aporta. ",
         "No hay signos evidentes de que los colores connoten ese concepto. Piénsalo mejor.", "Efectivamente, ese valor puede estar detrás de este anuncio de productos de lana. ", "Los colores no significan siempre lo mismo en cualquier contexto. Hay que interpretar su papel en el mensaje concreto. ",
         "Mira mejor: la luz aquí no es difusa.", "Bien argumentado.", " ",
         "Este texto no tiene esas características. Piénsalo mejor.", "Efectivamente.", "Piensa un poco mejor y busca un argumento directamente deducible del anuncio.",
         "Piénsalo mejor; no hay hipérbole en este texto.", "'Lana' y 'naturaleza' no son términos antitéticos.", "Efectivamente. 'La naturaleza', separado como 'lana turaleza' es un juego de palabras que conecta el producto vendido con la idea de naturaleza (sugiriendo su superioridad frente a los productos sintéticos)."); //continuar...

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