(function(box2d) {

	function loadEvents() {

		// Transition from 1st to 2nd sequence
		$('#white-circle').on('click', function() {
			$('#white-circle').css('background', 'white');
			sequence = 0;

			$('#gifts').fadeOut();
			$('#white-circle').find('h1, h2').fadeOut(function() {

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

					var timer = setTimeout(function() {

						if (!initialized) {

							var giftString = gifts[giftIndex].shape;
							var giftArray = giftString.split(',');

							// Assemble the shapes
							for (var i = 0; i < giftArray.length; i++) {
								assembleShape(giftArray[i]);	
							}

							var len = nodes.length;

							// Kill the nodes that are not necessary to assemble the gift
							while (len--) {
								nodes[len].fadeOut = true;
								nodes[len].speedScale = (Math.random() * 2.8) + 0.5;
							}

							initialized = true;
							$('#congrats').fadeIn();
							document.cookie = "prize="+allReady+"; path=/";
						}
						else {
							releaseAll(); // This is not used at the moment. Just in case we need to fadeOut the gift
						}
					}, 6000); // Display the gift after 5 seconds
				});
			});
		});
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
	  		var len = nodes.length;

			while (len--) {

				nodes[len].update();

				context.fillStyle = 'rgba(91, 181, 179, ' + nodes[len].alpha + ')';

				// Paint the node in the canvas
				context.beginPath();
				context.arc(nodes[len].x, nodes[len].y, nodes[len].speedScale, 0, 2 * Math.PI, false);
				context.closePath();
				context.fill();

				// Remove the node if it's dead
				if (!nodes[len].alive) {
					nodes.splice(len, 1);
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

		if (!nodes) nodes = [];

		while (amount > nodes.length) {
			nodes.push(new Node(canvasWidth, canvasHeight));
		}
	}

	function assembleShape(i) {

		var spacing = 12,
			Xoffset	= gifts[giftIndex].offset,
			Yoffset	= 240,
			pixelCount = 0,
			shape = shapes[i],
			width = getshapeWidth(shape);

		for (var i = 0; i < nodes.length; i++) {

			if (pixelCount < shape.length) {

				if (nodes[i].hasTarget) {
					nodes[i].shiftTarget(-(lastWidth + 2) * spacing, 0, (Math.random() + 1) * spacing);
				}
				else if(typeof nodes[i+8] !== 'undefined') {
					// Bring 8 more nodes around each target position

					// Center
					nodes[i].setTarget(Xoffset + (shape[pixelCount][0] * spacing), Yoffset + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Top
					nodes[i+1].setTarget(Xoffset + (shape[pixelCount][0] * spacing), Yoffset + 4 + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Bottom
					nodes[i+2].setTarget(Xoffset + (shape[pixelCount][0] * spacing), Yoffset - 4 + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Left
					nodes[i+3].setTarget(Xoffset - 4 + (shape[pixelCount][0] * spacing), Yoffset + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Right
					nodes[i+4].setTarget(Xoffset + 4 + (shape[pixelCount][0] * spacing), Yoffset + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Top left
					nodes[i+5].setTarget(Xoffset - 4 + (shape[pixelCount][0] * spacing), Yoffset + 4 + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Bottom left
					nodes[i+6].setTarget(Xoffset - 4 + (shape[pixelCount][0] * spacing), Yoffset - 4 + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Top right
					nodes[i+7].setTarget(Xoffset + 4 + (shape[pixelCount][0] * spacing), Yoffset + 4 + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					// Bottom right
					nodes[i+8].setTarget(Xoffset + 4 + (shape[pixelCount][0] * spacing), Yoffset - 4 + (shape[pixelCount][1] * spacing), (Math.random() + 1) * spacing);

					pixelCount++;
					i += 8;
				}
			}
		}

		lastWidth = width;
	}

	function releaseAll() {

		for (var i = 0; i < nodes.length; i++) {
			nodes[i].killTarget(-Math.random() * 3);
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

	function getCookie(name) {

		var value = "; " + document.cookie;
		var parts = value.split("; " + name + "=");
		if (parts.length == 2) return parts.pop().split(";").shift();
	}



	/***********************************************************************************************
	/* App entry point 
	/**********************************************************************************************/
	var allReady = '',
		prizeCookie = getCookie('prize');

	// Check if the user already had a prize
	if (prizeCookie) {

		allReady = prizeCookie;

		if (allReady !== 'song') $('#gift-copy').text('AN ITUNES VOUCHER');
		else $('#gift-copy').text('A SONG');

		$('#gift-image').attr('src', 'img/prize-'+allReady+'.png');
		$('#gift-image').data('prize', allReady);
	}
	else {
		allReady = $('#gift-image').data('prize');
	}

	if (allReady) {

		// Vouchers from 5 to 100 pounds and the song
		var gifts = [{shape: '10,5', offset: 286}, // £5
					{shape: '10,1,0', offset: 308}, // £10
					{shape: '10,1,5', offset: 308}, // £15
					{shape: '10,2,0', offset: 320}, // £20
					{shape: '10,2,5', offset: 320}, // £25
					{shape: '10,3,0', offset: 320}, // £30
					{shape: '10,3,5', offset: 320}, // £35
					{shape: '10,4,0', offset: 320}, // £40
					{shape: '10,4,5', offset: 320}, // £45
					{shape: '10,5,0', offset: 320}, // £50
					{shape: '10,5,5', offset: 320}, // £55
					{shape: '10,6,0', offset: 320}, // £60
					{shape: '10,6,5', offset: 320}, // £65
					{shape: '10,7,0', offset: 320}, // £70
					{shape: '10,7,5', offset: 320}, // £75
					{shape: '10,8,0', offset: 320}, // £80
					{shape: '10,8,5', offset: 320}, // £85
					{shape: '10,9,0', offset: 320}, // £90
					{shape: '10,9,5', offset: 320}, // £95
					{shape: '11', offset: 207}], // headphones
			giftIndex = 0;

		// Translate the prize data attribute into a shape we can work with
		switch(String(allReady)) {

			case '5': giftIndex = 0; break;
			case '10': giftIndex = 1; break;
			case '15': giftIndex = 2; break;
			case '20': giftIndex = 3; break;
			case '25': giftIndex = 4; break;
			case '30': giftIndex = 5; break;
			case '35': giftIndex = 6; break;
			case '40': giftIndex = 7; break;
			case '45': giftIndex = 8; break;
			case '50': giftIndex = 9; break;
			case '55': giftIndex = 10; break;
			case '60': giftIndex = 11; break;
			case '65': giftIndex = 12; break;
			case '70': giftIndex = 13; break;
			case '75': giftIndex = 14; break;
			case '80': giftIndex = 15; break;
			case '85': giftIndex = 16; break;
			case '90': giftIndex = 17; break;
			case '95': giftIndex = 18; break;
			case 'song': giftIndex = 19; break;
		}

		// Only proceed in the browser supports canvas
		if ($('html').hasClass('canvas')) {

			/* Begin of requestAnimationFrame polyfill (works on IE9) */
			var lastTime = 0;
		    var vendors = ['webkit', 'moz'];
		    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
		        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
		        window.cancelAnimationFrame =
		          window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
		    }

		    if (!window.requestAnimationFrame)
		        window.requestAnimationFrame = function(callback, element) {
		            var currTime = new Date().getTime();
		            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
		            var id = window.setTimeout(function() { callback(currTime + timeToCall); },
		              timeToCall);
		            lastTime = currTime + timeToCall;
		            return id;
		        };

		    if (!window.cancelAnimationFrame)
		        window.cancelAnimationFrame = function(id) {
		            clearTimeout(id);
		        };
		    /* End of requestAnimationFrame polyfill */

		    /* Initialize variables */
			var shapes = [],
				nodes = [],
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

			// Continue after loading is complete
			shapesImg.onload = function() {
				loadEvents();
				loadShapes();
				loadNodes(550);

				// Intro fade ins
				$('#white-circle').animate({width: '240px', height: '240px', top: '59px', left: '145px'}, 2500, 'easeOutElastic', function() {
					$('#white-circle').css('background', 'none');
				});
				$('#white-circle h1, #white-circle h2').delay(500).fadeIn(function() {
					$('#gifts').fadeIn(function() {
						loop();
					});
				});
			}
		}
		else { // Browsers without canvas support

			$('#white-circle').on('click', function() {

				$('#gifts').fadeOut();
				$('#white-circle').find('h1, h2').fadeOut(function() {

					$('#white-circle').fadeOut(function() {
						$('#white-circle').remove();
					});

					$('body').animate({ backgroundColor: '#FFFFFF' }, 500, function() {
						$('#congrats').fadeIn();
					});
				});

				document.cookie = "prize="+allReady+"; path=/";
			});
		}
	}
	else { // Display error message if we don't have a prize from the backend/cookie

		$('html').addClass('error');
		$('#congrats h1').text('Sorry, there was an error');
		$('#congrats p').text('Please, try again later');
		$('#gift-copy').remove();
		$('#gift-image').remove();
		$('#congrats').append('<img src="img/prize-error.png" alt="Sorry, there was an error" width="200" height="190" />');
		document.cookie = "prize="+allReady+"; path=/";
	}

})(Box2D);


/* Easing effect */
jQuery.easing['jswing'] = jQuery.easing['swing'];
jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	}
});