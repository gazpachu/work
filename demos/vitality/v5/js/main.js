(function(win, box2d) {

	function loadEvents() {

		// Transition from 1st to 2nd sequence
		$('#white-circle').on('click', function() {
			sequence = 0;

			$('#white-circle').find('h1, h2, div').fadeOut(function() {

				// Fallback for browsers without CSS animations
				if (Modernizr.cssanimations) {
					$('#white-circle').animate({ backgroundColor: 'white' }, 300);
				    $('#white-circle').addClass('zoom');
				}
				else {
					$('#white-circle').animate({ left: '-250px', top: '-250px', width: '1000px', height: '1000px' }, 500);
				}
				
				physics.debugDraw.SetFlags(0);

				// Dummy animation 
				$('#white-circle').animate({'color':'#FFF'}, 500, function() {
					
					clearInterval(physics.generator);
					delete physics.world;
					sequence = 2;

					$('body').css('background', '#FFF');
					$('#white-circle').remove();

					// Start the particle system
					loadShapes();
					loadNodes(520);

					var timer = setTimeout(function() {

						if (!initialized) {

							// Get a random gift
							giftIndex = Math.floor(Math.random() * gifts.length);
							var gift = gifts[giftIndex].shape;

							// Assemble the shapes
							for (var i = 0; i < gift.length; i++) {
								assembleShape(gift.charAt(i));	
							}

							var len = win.nodes.length;

							// Kill the nodes that are not necessary to assemble the gift
							while (len--) {
								win.nodes[len].fadeOut = true;
							}

							initialized = true;

							if (giftIndex < 4) $('#congrats h2').text('AN ITUNES VOUCHER');
							else $('#congrats h2').text('A SONG');

							$('#congrats').fadeIn();
						}
						else {
							releaseAll(); // This is not used at the moment. Just in case we need to fadeOut the gift
						}
					}, 5000); // Display the gift after 5 seconds
				});
			});
		});

		if (!Modernizr.touch) {
			$('#white-circle').hover(
				function() {
					$('#white-circle').animate({ backgroundColor: '#3f7f7c' }, 500);
					$('#white-circle h1, #white-circle h2').animate({ color: 'white' }, 500);
				}, function() {
					$('#white-circle').animate({ backgroundColor: 'white' }, 500);
					$('#white-circle h1').animate({ color: '#5BB5B3' }, 500);
					$('#white-circle h2').animate({ color: '#C1C0BE' }, 500);
				}
			);
		}
	}

	// Main animation loop
	function loop() {

		if (sequence < 2) {

			context.fillStyle = "#5BB5B3";
  			context.fillRect(0, 0, canvasWidth, canvasHeight);
			physics.update();
		}
		else {
			context.fillStyle = "#FFF";
			context.fillRect(0, 0, canvasWidth, canvasHeight);

			// Loop through the nodes to update their properties
	  		var len = win.nodes.length;

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
							var seperation = ((dX*dX) + (dY*dY)) / 2;

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

				context.fillStyle = 'rgba(91, 181, 179, ' + win.nodes[len].alpha + ')';

				// Paint the node in the canvas
				context.beginPath();
				context.arc(win.nodes[len].x, win.nodes[len].y, win.nodes[len].speedScale, 0, 2 * Math.PI, false);
				context.closePath();
				context.fill();

				// Remove the node if it's dead
				if (!win.nodes[len].alive) {
					win.nodes.splice(len, 1);
				}
			}
		}

		// Stop the loop if there are not more nodes
		requestAnimationFrame(loop);
	}

	function loadShapes() {

		//load image
		var canvas = $('<canvas/>')[0],
			cn = canvas.getContext('2d'),
			shape = [],
			shapeOffset = 0,
			highestY = 9999999;

		shapes = [];

		canvas.width = shapesImg.width;
		canvas.height = shapesImg.height;

		cn.drawImage(shapesImg, 0, 0, shapesImg.width, shapesImg.height);
		
		// run thrugh pixels
		for (var i = 0; i < shapesImg.width; i++) {
			
			var rowIsBlank = true;

			for (var j = 0; j < shapesImg.height; j++) {

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

	function loadNodes(amount) {

		if (!win.nodes) win.nodes = [];

		while (amount > win.nodes.length) {

			win.nodes.push(new Node({
				/*x: (Math.random() * canvasWidth) + 1,
				y: (Math.random() * canvasHeight) + 1,*/
				xSpeed: (Math.random() * 8) + 1,
				ySpeed: (Math.random() * 8) + 1,
				zSpeed: (Math.random() * 8) + 1,
				bounce: (Math.random() * 0.5) + 0.5,
				bounds: { x: canvasWidth, y: canvasHeight }
			}));
		}
	}

	function assembleShape(i) {

		var spacing = 12,
			Xoffset	= gifts[giftIndex].offset,
			Yoffset	= 180,
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


	/* App entry point */

	var gifts = [{shape: '04', offset: 286}, // £5, £10, £15, £20, HP
				{shape: '013', offset: 308},
				{shape: '014', offset: 308},
				{shape: '023', offset: 320},
				{shape: '5', offset: 207}],
		giftIndex = 0;

	// Only proceed in the browser supports canvas
	if ($('html').hasClass('canvas')) {

		/* Begin of requestAnimationFrame polyfill */
		var lastTime = 0;
	    var vendors = ['webkit', 'moz'];
	    for(var x = 0; x < vendors.length && !win.requestAnimationFrame; ++x) {
	        win.requestAnimationFrame = win[vendors[x]+'RequestAnimationFrame'];
	        win.cancelAnimationFrame =
	          win[vendors[x]+'CancelAnimationFrame'] || win[vendors[x]+'CancelRequestAnimationFrame'];
	    }

	    if (!win.requestAnimationFrame)
	        win.requestAnimationFrame = function(callback, element) {
	            var currTime = new Date().getTime();
	            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
	            var id = win.setTimeout(function() { callback(currTime + timeToCall); },
	              timeToCall);
	            lastTime = currTime + timeToCall;
	            return id;
	        };

	    if (!win.cancelAnimationFrame)
	        win.cancelAnimationFrame = function(id) {
	            clearTimeout(id);
	        };
	    /* End of requestAnimationFrame polyfill */

	    /* Initialize variables */
		var shapes = [],
			lastWidth = 0,
			overflowCount =-1,
			canvas = document.getElementById("canvas"),
			context = canvas.getContext("2d"),
			canvasWidth = 533,
			canvasHeight = 533,
			initialized = false,
			sequence = 1,
			shapesImg;

		canvas.width = canvasWidth;
		canvas.height = canvasHeight;

		//  Start Box2D
		var physics = new Physics(canvasWidth, canvasHeight, context);

		// Load shapes image
		shapesImg = new Image();
		shapesImg.src = 'img/shapes.jpg';

		loadEvents();
		loop();
	}
	else { // Browsers without canvas support

		// Get a random gift
		giftIndex = Math.floor(Math.random() * gifts.length);

		if (giftIndex < 4) $('#congrats h2').text('AN ITUNES VOUCHER');
		else $('#congrats h2').text('A SONG');

		$('#congrats').addClass('prize-' + giftIndex);

		$('#white-circle').on('click', function() {

			$('#white-circle').find('h1, h2, div').fadeOut(function() {

				$('#white-circle').fadeOut(function() {
					$('#white-circle').remove();
				});

				$('body').animate({ backgroundColor: '#FFFFFF' }, 500, function() {
					$('#congrats').fadeIn();
				});
			});
		});
	}

})(window, Box2D);