/*!
* itunes-reward-main.js
* This file contains the code for the animation logic
*
* @project   VITALITY ITUNES PRIZE PICKER
* @date      2015-02-09
* @author    JOAN MIRA, SapientNitro <jmira@sapient.com>
* @licensor  SAPIENTNITRO
*
*/

(function(box2d) {

	/* Easing effect used for the initial zoom animation */
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

	/* Loads the second part of the animation */
	function loadEvents() {

		// Transition from 1st to 2nd sequence
		$('#ir-anim-container #white-circle').on('click', function() {
			$('#ir-anim-container #white-circle').css('background', 'white');
			sequence = 0;

			$('#ir-anim-container #gifts').fadeOut();
			$('#ir-anim-container #white-circle').find('h1, h2').fadeOut(function() {

				// Fallback for browsers without CSS animations
				if (Modernizr.cssanimations) {
					$('#ir-anim-container #white-circle').animate({ backgroundColor: 'white' }, 300);
				    $('#ir-anim-container #white-circle').addClass('zoom');
				}
				else {
					$('#ir-anim-container #white-circle').animate({ left: '-250px', top: '-250px', width: '1000px', height: '1000px' }, 500);
				}

				physics.debugDraw.SetFlags(0);

				// Dummy animation  to delay the start of the particle generation
				$('#ir-anim-container #white-circle').animate({'color':'#FFF'}, 500, function() {

					clearInterval(physics.generator);
					delete physics.world;
					sequence = 2;

					$('body').css('background', '#FFF'); // This line is only for the demo. Remove on integration
					$('#ir-anim-container').css('background', '#FFF');
					$('#ir-anim-container #white-circle').remove();

					// Start assembling the gift after 5 secounds
					var timer = setTimeout(function() {

						if (!initialized) {
							assembleShape();

							var len = nodes.length;

							// Update the size of the nodes
							while (len--) {
								nodes[len].fadeOut = true;
								nodes[len].speedScale = (Math.random() * 2.8) + 0.5;
							}

							initialized = true;
							setTimeout(function() { $('#ir-anim-container #congrats').fadeIn() }, 4000);
						}

					}, 5000); // Display the gift after 5 seconds
				});
			});
		});
	}

	// Main animation loop
	function loop() {

		if (sequence < 2) {
			physics.update(); // Update Box2D bodies
		}
		else {
			// Clean the canvas
			context.fillStyle = "#FFF";
			context.fillRect(0, 0, canvasWidth, canvasHeight);

	  		var len = nodes.length;

	  		// Loop through the nodes to update their properties
			while (len--) {

				nodes[len].update();

				context.fillStyle = p2color;

				// Paint the circle particles in the canvas
				context.beginPath();
				context.arc(nodes[len].x, nodes[len].y, nodes[len].speedScale, 0, 2 * Math.PI, false); // x, y, radius
				context.closePath();
				context.fill();
			}
		}

		requestAnimationFrame(loop);
	}

	// Create the particles for the second animation
	function loadNodes() {

		if (!nodes) nodes = [];

		while (shapeSVG.length > nodes.length) {
			nodes.push(new Node(canvasWidth, canvasHeight));
		}
	}

	// Give a target to the particles based on the SVG coordinates and radius
	function assembleShape() {

		var spacing = 0,
			Xoffset	= offsetSVG,
			Yoffset	= 208,
			pixelCount = 0;

		for (var i = 0; i < nodes.length; i++) {
			nodes[i].setTarget(Xoffset + Number(shapeSVG[i][0]), Yoffset + Number(shapeSVG[i][1]), Number(shapeSVG[i][2]));
		}
	}

	// Read the selected SVG image and store the radius, x and y coordinates into an array
	function readSVG() {

        $.ajax({
	        type: "GET",
	        url: "img/prize-"+allReady+".svg",
	        dataType: "xml",
	        success: function(xml) {

	        	var i = 0;

	        	offsetSVG = (canvasWidth/2) - (parseInt($(xml).find('svg').attr('width'), 10) / 2);

	            $(xml).find('circle').each(function() {
	            	shapeSVG.push([$(this).attr('cx'), $(this).attr('cy'), $(this).attr('r')]);
                    i++;
	            });

	            loadNodes();

				// Intro fade ins
				$('#ir-anim-container #white-circle').animate({width: '240px', height: '240px', top: '59px'}, 2500, 'easeOutElastic', function() {
					$('#ir-anim-container #white-circle').css('background', 'none');
					loadEvents();
				});

				$('#ir-anim-container #white-circle h1, #ir-anim-container #white-circle h2').delay(500).fadeIn(function() {
					$('#ir-anim-container #gifts').fadeIn(function() {
						loop();
					});
				});
    		},
    		error: function(data) {
    			error();
    		}
		});
    }

    // If the data attributes are not present in the markup of something goes wrong reading the SVG files
    function error() {

    	$('#ir-anim-container').addClass('error');
		$('#ir-anim-container #congrats h1').text('Sorry, there was an error');
		$('#ir-anim-container #congrats p').text('Please, try again later');
		$('#ir-anim-container #gift-copy').remove();
		$('#ir-anim-container #gift-image').remove();
		$('#ir-anim-container #congrats').append('<img src="img/prize-error.png" alt="Sorry, there was an error" width="200" height="190" />');
    }

    // Util functions to convert Hex into RGB values for Box2D
    function hexToR(h) {return parseInt((cutHex(h)).substring(0,2),16)}
	function hexToG(h) {return parseInt((cutHex(h)).substring(2,4),16)}
	function hexToB(h) {return parseInt((cutHex(h)).substring(4,6),16)}
	function cutHex(h) {return (h.charAt(0)=="#") ? h.substring(1,7):h}

	/***********************************************************************************************
	/* App entry point
	/**********************************************************************************************/
	var allReady = $('#ir-anim-container #gift-image').data('prize');

	// Check if we have the selected prize in the markup
	if (allReady !== undefined) {

		// Only proceed with the animation if the prize has not been already revealed
		if (!$('#ir-anim-container').hasClass('revealed')) {

			// Only proceed in the browser supports canvas (needs Modernizr)
			if ($('html').hasClass('canvas')) {
				console.log('hi');
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
					shapeSVG = [],
					offsetSVG = 0,
					lastWidth = 0,
					overflowCount =-1,
					canvas = document.getElementById("ir-anim-canvas"),
					context = canvas.getContext("2d"),
					canvasWidth = 533,
					canvasHeight = 533,
					initialized = false,
					sequence = 1,
					shapesImg,
					p1color = $('#ir-anim-container').data('p1color') ? $('#ir-anim-container').data('p1color') : "#3f7f7c",
					p2color = $('#ir-anim-container').data('p2color') ? $('#ir-anim-container').data('p2color') : "#5ab6b2";

				canvas.width = canvasWidth;
				canvas.height = canvasHeight;

				//  Start Box2D and apply the selected colour
				var physics = new Physics(canvasWidth, canvasHeight, context);
				physics.debugDraw.pRcolor = hexToR(p1color) / 255;
				physics.debugDraw.pGcolor = hexToG(p1color) / 255;
				physics.debugDraw.pBcolor = hexToB(p1color) / 255;

				// Continue execution within the success response of the SVG loading
				readSVG();
			}
			else { // Browsers without canvas support (IE8)

				$('#ir-anim-container #white-circle').on('click', function() {

					$('#ir-anim-container #gifts').fadeOut();
					$('#ir-anim-container #white-circle').find('h1, h2').fadeOut(function() {

						$('#ir-anim-container #white-circle').fadeOut(function() {
							$('#ir-anim-container #white-circle').remove();
						});

						// This line is only for the demo. Remove on integration
						$('body').animate({ backgroundColor: '#FFFFFF' }, 500);

						$('#ir-anim-container').animate({ backgroundColor: '#FFFFFF' }, 500, function() {
							$('#ir-anim-container #congrats').fadeIn();
						});
					});
				});
			}
		}
	}
	else { // Display error message if we don't have a prize rendered in the markup from the backend

		error();
	}

})(Box2D);
