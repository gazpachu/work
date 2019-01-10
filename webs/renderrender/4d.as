function paint()
{
	ang += 0.05*(_root._xmouse-275)/550;
	ang2 += 0.05*(_root._ymouse-200)/400;
	ang3 +=slider.GetValue();
	
	sina = Math.sin(ang);
	sinb = Math.sin(ang2);
	sinc = Math.sin(ang3);
	
	cosa = Math.cos(ang);
	cosb = Math.cos(ang2);
	cosc = Math.cos(ang3);
	
	for(i = 0; i < points.length; i++)
	{
		x = points[i][0];
		y = cosa*points[i][1] + sina*points[i][2];
		z = -sina*points[i][1] + cosa*points[i][2];
		w = points[i][3];
		
		x =  x*cosb + w*sinb;
		y = y;
		z = z;
		w = -x*sinb + w*cosb;
		
		x = x ;
		y = y*cosc - w*sinc;
		z = z;
		
		scalar = 4 / (z + 4);
		_root["point" add i]._x = scalar*x*75+185;
		_root["point" add i]._y = scalar*y*75+200;
	}
	
	for(i = 0; i < faces.length; i++)
	{
		var d = _root["face" add i];
		d.clear();
		if(showFaces)
		{
			d.moveTo(_root["point" add faces[i][0]]._x,_root["point" add faces[i][0]]._y);
			d.beginFill(0x006699,20);
			for(j = 1; j < faces[i].length; j++)
			{
				var c = _root["point" add faces[i][j]];
				d.lineTo(c._x, c._y);
			}
			d.endFill();
		}
	}

	_root.line.clear();
	var d = _root.line;
	d.lineStyle( 1, 0xcccccc, 100 );
	if(showLines)
	{
		for(i = 0; i < lines.length; i++)
		{
			d.moveTo(_root["point" add lines[i][0]]._x,_root["point" add lines[i][0]]._y);
			for(j = 1; j < lines[i].length; j++)
			{
				d.lineTo(_root["point" add lines[i][j]]._x,_root["point" add lines[i][j]]._y);
			}
		}
	}
	
}


function createAssets()
{
	ang = 0;
	ang2 = 0;
	ang3 = 0;
	
	for(i = 0; i < points.length; i++)
	{
		_root.createEmptyMovieClip("point" add i,i);
		with(_root["point" add i])
		{
			beginFill(0xcc3333,100);
			moveTo(-2,-2)
			lineTo(-2,2);
			lineTo(2,2);
			lineTo(2,-2);
			endFill();
		}
	}
	
	for(j = 0; j < faces.length; j++)
	{
		_root.createEmptyMovieClip("face" add j, 600 + j);
	}
	
	_root.createEmptyMovieClip("line", 200);
	
	int1 = setInterval(paint, 10);
}

function parseXML()
{
	var c = file.firstchild.firstChild;
	points = new Array();
	for(i = 0; i < c.childNodes.length; i++)
	{
		points.push( c.childNodes[i].attributes.coords.split(",") );
	}
	
	var c = file.firstchild.childNodes[1];
	lines = new Array();
	for(i = 0; i < c.childNodes.length; i++)
	{
		lines.push( c.childNodes[i].attributes.points.split(",") );
	}
	
	var c = file.firstchild.childNodes[2];
	faces = new Array();
	for(i = 0; i < c.childNodes.length; i++)
	{
		faces.push( c.childNodes[i].attributes.points.split(",") );
	}
	delete file;
	createAssets();
}

function xmlLoaded(success)
{
	if(success)
	{
		parseXML();
	}
}

function toggleLines()
{
	showLines = !showLines;
}

function togglePoints()
{
	showPoints = !showPoints;
	if(!showPoints)
	{
		for(i = 0; i < points.length; i++)
		{
			_root["point" add i]._visible = false;
		}
	}
	else
	{
		for(i = 0; i < points.length; i++)
		{
			_root["point" add i]._visible = true;
		}
	}
}

function toggleFaces()
{
	showFaces = !showFaces;
}

showLines = true;
showPoints = true;
showFaces = false;

//Define points
file = new XML('<4d><points><point coords="-1,-1,-1,-1" /><point coords="1,-1,-1,-1" /><point coords="-1,1,-1,-1" /><point coords="1,1,-1,-1" /><point coords="-1,-1,1,-1" /><point coords="1,-1,1,-1" /><point coords="-1,1,1,-1" /><point coords="1,1,1,-1" /><point coords="-1,-1,-1,1" /><point coords="1,-1,-1,1" /><point coords="-1,1,-1,1" /><point coords="1,1,-1,1" /><point coords="-1,-1,1,1" /><point coords="1,-1,1,1" /><point coords="-1,1,1,1" /><point coords="1,1,1,1" /></points><lines><line points="0,2,6,4,0,1" /><line points="6,7,5,1,3,7" /><line points="8,9,13,15,11,9" /><line points="15,14,10,8,12,14" /><line points="4,5,13,12,4" /><line points="2,3,11,10,2" /><line points="0,8" /><line points="1,9" /><line points="6,14" /><line points="7,15" /></lines><faces><face points="4,5,7,6" /><face points="12,13,15,14" /><face points="0,1,9,8" /><face points="2,3,11,10" /></faces></4d>');
xmlLoaded(true);