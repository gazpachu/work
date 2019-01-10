/*
Windows/Mac Behaviour Script
This Script is Freeware
created by: Martyn van Beek
mailto: martyn@sophistry.nl
web: http://www.sophistry.nl
*/
onClipEvent (load) {
	// Creating Objects (MovieClips, Vars)
	sObj 				= new Object();
	gObj 				= new Array ( bulb , upy , downy , barstand , thumb , hitclip );
	barObj 				= new Array ( barstand.bottom , barstand.top , barstand , barstand.middle )
	bulbObj				= new Array ( bulb , bulb.bottom , bulb.top , bulb.middle )
	oObj 				= new Array ( _parent.frame , _parent.page , thumb , hitclip.invis);
	sObj.len 			= gObj.length;
	
	// setting not changeable properties
	sObj.frameH 			= oObj[0]._height
	sObj.bottomH			= barObj[0]._height
	sObj.topH			= barObj[1]._height
	// Creating Scrollbar (note: the MC _parent.frame's height is taken as height)
	sObj.smartH	 		= sObj.frameH - (gObj[1]._height + gObj[2]._height);
	hitclip._yscale 		= sObj.smartH
	downy._y 			= sObj.smartH
	sObj.smartH2			= sObj.smartH - (sObj.topH + sObj.bottomH);
	barObj[3]._height 		= sObj.smartH2
	barObj[0]._y 			= sObj.smartH2
	thumb._alpha 			= 0
	
	sObj.bottomH			= barObj[0]._height
	sObj.topH			= barObj[1]._height
	sObj.barH			= barObj[2]._height
		
	sObj.scrollS			= sObj.barH/50
	
	// delete Unnessesary
	
	delete smartheight
	delete smartheight2
	
	// functions
	
	function getInfo(){
		sObj.pageH		= oObj[1]._height;
		sObj.yposB		= oObj[2]._y;
		sObj.bulbH		= oObj[2]._height;
	}
	function setOnOff () {
		if ( sObj.pageHO <> sObj.pageH ) {
			if ( sObj.pageH >= sObj.frameH ) {
				var count		= 0;
				while ( count < sObj.len ) {
					gObj[count]._visible = true;
					count++;
				}
				oObj[1]._y 		= 0;
				oObj[2]._y 		= 0;
				bulbObj[0]._y 	= 0;
			} else if ( sObj.pageH < sObj.frameH ) {
				var count 		= 0;
				while ( count < sObj.len ) {
					gObj[count]._visible = false;
					count++;
				}
			}
		}
	}
	function calculate(){
		sObj.scrollA 		= sObj.barH - sObj.bulbH;
		sObj.percentF 		= sObj.scrollA / 100;
		sObj.areaTS 		= sObj.pageH - sObj.barH;
		sObj.per 		= -( sObj.areaTS /100 );
		sObj.ypos  		= sObj.yposB / ( sObj.scrollA / 100 );
		sObj.pageP  		= sObj.ypos * sObj.per;
		sObj.thumbH  		= ( sObj.barH / 100 * ( sObj.barH / ( sObj.pageH / 100 ) ) ) - ( sObj.topH + sObj.bottomH );
		sObj.bulbH 		= sObj.thumbH-(sObj.topH+sObj.bottomH)
	}
	function MoveDown () {
		if (oObj[2]._y <= sObj.scrollA - sObj.scrollS) {
			oObj[2]._y 	= sObj.down;
		} else {
			oObj[2]._y 	= sObj.scrollA;
		}
	}
	function MoveUp () {
		if (sObj.up > sObj.scrollS) {
			oObj[2]._y 	= sObj.up;
		} else {
			oObj[2]._y 	= 0;
		}
	}
	function stopDragging () {
		oObj[2].stopDrag();
	}
	function gotoScroll () {
		oObj[2]._y 		= (oObj[3]._y/100) * sObj.scrollA;
		stopDrag ();
	}
	function moveUpDown(){
		sObj.up 		= sObj.yposB - sObj.scrollS;
		sObj.down 		= sObj.yposB + sObj.scrollS;
	}
	function apply(){
		oObj[1]._y 		= sObj.pageP
		bulbObj[0]._y		= sObj.yposB
		if (os == 'Mac'){
			bulbObj[3]._height 	= 10
			bulbObj[1]._y 		= 15
			oObj[2]._height 	= 20
		}else{
			bulbObj[3]._height 	= sObj.bulbH
			bulbObj[1]._y 		= sObj.bulbH + sObj.topH
			oObj[2]._height 	= sObj.thumbH
		}
		
		
		sObj.pageHO		= sObj.pageH
	}	
}
onClipEvent (enterFrame) {
	getInfo()
	setOnOff ()
	calculate()	
	moveUpDown()
	apply()
}

