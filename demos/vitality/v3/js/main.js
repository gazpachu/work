;(function(win){

	var shapes = [],
		lastWidth = 0,
		overflowCount =-1,
		amount = 520,
		canvas = document.getElementById("canvas"),
		context = canvas.getContext("2d"),
		canvasWidth = 533,
		canvasHeight = 533,
		initialized = false;

	canvas.width = canvasWidth;
	canvas.height = canvasHeight;

	// Load the shapes from shapes.jpg
	loadShapes();

	// Create nodes
	win.nodes = [];

	while (amount--) {

		win.nodes.push(new Node({
			xSpeed: (Math.random() * 8) + 1,
			ySpeed: (Math.random() * 8) + 1,
			zSpeed: (Math.random() * 8) + 1,
			bounce: (Math.random() * 0.5) + 0.5,
			bounds: { x: canvasWidth, y: canvasHeight }
		}));
	}

	// Assemble selected shapes: £20 = 023, £15 = 023
	$('body').on('click', function() {

		if (!initialized) {
			assembleShape(0);
			assembleShape(2);
			assembleShape(3);
			/*assembleShape(5);*/

			var len = win.nodes.length;

			while (len--) {
				win.nodes[len].fadeOut = true;
			}

			initialized = true;
		}
		else {
			releaseAll();
		}
	});

	loop();

	// Main animation loop
	function loop() {

		var len = win.nodes.length;

		// Erase canvas
		context.fillStyle = "#FFF";
  		context.fillRect(0, 0, canvasWidth, canvasHeight);

  		// Loop through the nodes to update their properties
		while (len--) {

			win.nodes[len].update();

			// Set nodes that don't have a target			
			if (!win.nodes[len].hasTarget) {

				var rangeA = 15;
				var repulsion = .3;
				var attraction = .05;

				// change the speeds of each ball based on its closeness to another
				for (var i = 0; i < win.nodes.length; i++) {

					if (win.nodes[i] !== win.nodes[len]) {

						var dX = win.nodes[i].x - win.nodes[len].x;
						var dY = win.nodes[i].y - win.nodes[len].y;
						var seperation = ((dX*dX) + (dY*dY))/2;

						if (seperation < 500) {

							var angle = Math.atan2(dY,dX);
							
							if (seperation < rangeA) {

								// don't get too close...
								var fraction = 1 - (seperation / rangeA);
								win.nodes[len].xSpeed -= Math.cos(angle) * repulsion * fraction;
								win.nodes[len].ySpeed -= Math.sin(angle) * repulsion * fraction;
							}
							else {
								// get close...
								win.nodes[len].xSpeed += Math.cos(angle) * attraction/seperation;
								win.nodes[len].ySpeed += Math.sin(angle) * attraction/seperation;
							}
						}
					}
				}
			}

			// Paint the node in the canvas
			context.beginPath();
			context.fillStyle = 'rgba(91, 181, 179, ' + win.nodes[len].alpha + ')'; // '#5BB5B3';
			context.arc(win.nodes[len].x, win.nodes[len].y, win.nodes[len].speedScale, 0, 2 * Math.PI, false);
			context.closePath();
			context.fill();

			// Remove the node if it's dead
			if (!win.nodes[len].alive) {
				win.nodes.splice(len, 1);
			}
		}

		// Stop the loop if there are not more nodes
		if (win.nodes.length > 0)
			requestAnimationFrame(loop);
	};

	function loadShapes() {

		//load image
		var img = $('#font')[0],
			canvas = $('<canvas/>')[0],
			cn = canvas.getContext('2d'),
			shape = [],
			shapeOffset = 0,
			highestY = 9999999;

		shapes = [];

		canvas.width = img.width;
		canvas.height = img.height;

		cn.drawImage(img, 0, 0, img.width, img.height);
		
		// run thrugh pixels
		for (var i = 0; i < img.width; i++) {
			
			var rowIsBlank = true;

			for (var j = 0; j < img.height; j++) {

				var c = cn.getImageData(i, j, 1, 1).data;

				if (c[0] + c[1] + c[2] < 384) {

					//colour is darker than 50% grey...
					shape.push([i - shapeOffset, j]);
					rowIsBlank = false;
				}
			}

			if (rowIsBlank) {

				shapeOffset = i + 1;

				if (shape.length > 0) {

					shapes.push(shape.slice()); //duplicate array
					shape = [];
				}
			}
		}
		
		// naturalise y values
		for (var let = 0; let < shapes.length; let++) {
			for (var pix = 0; pix < shapes[let].length; pix++) { //every shape
				highestY = Math.min(shapes[let][pix][1], highestY); //every pixel
			}
		}

		if (highestY > 0) {

			for (let = 0; let < shapes.length; let++) {
				for (pix = 0; pix < shapes[let].length; pix++) { //every shape
					shapes[let][pix][1] -= highestY; //every pixel
				}
			}
		}
	}

	function assembleShape(i) {

		var spacing = 12,
			Xoffset	= canvasWidth / 2,
			Yoffset	= canvasHeight / 2,
			pixelCount = 0,
			shape = shapes[i],
			width = getshapeWidth(shape);

		for (var i = 0; i < win.nodes.length; i++) {

			if (pixelCount < shape.length) {

				if (win.nodes[i].hasTarget) {
					win.nodes[i].shiftTarget(-(lastWidth + 2) * spacing, 0, (Math.random() + 1) * spacing);
				}
				else if(typeof win.nodes[i+8] !== 'undefined') {
					// Bring 8 more nodes around each target position

					// Center
					win.nodes[i].setTarget(Xoffset + (shape[pixelCount][0] * spacing), Yoffset + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Top
					win.nodes[i+1].setTarget(Xoffset + (shape[pixelCount][0] * spacing), Yoffset + 4 + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Bottom
					win.nodes[i+2].setTarget(Xoffset + (shape[pixelCount][0] * spacing), Yoffset - 4 + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Left
					win.nodes[i+3].setTarget(Xoffset - 4 + (shape[pixelCount][0] * spacing), Yoffset + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Right
					win.nodes[i+4].setTarget(Xoffset + 4 + (shape[pixelCount][0] * spacing), Yoffset + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Top left
					win.nodes[i+5].setTarget(Xoffset - 4 + (shape[pixelCount][0] * spacing), Yoffset + 4 + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Bottom left
					win.nodes[i+6].setTarget(Xoffset - 4 + (shape[pixelCount][0] * spacing), Yoffset - 4 + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Top right
					win.nodes[i+7].setTarget(Xoffset + 4 + (shape[pixelCount][0] * spacing), Yoffset + 4 + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Bottom right
					win.nodes[i+8].setTarget(Xoffset + 4 + (shape[pixelCount][0] * spacing), Yoffset - 4 + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					pixelCount++;
					i += 8;
				}
			}
		}

		lastWidth = width;
	}

	function releaseAll() {

		for (var i = 0; i < win.nodes.length; i++) {
			win.nodes[i].killTarget(-Math.random() * 3);
		}
		overflowCount =- 1;
	}

	function getshapeWidth(arr) {

		var wid = 0;

		for (var i = 0; i < arr.length; i++) {
			wid = Math.max(arr[i][0], wid);
		}

		return wid;
	}

})(window);