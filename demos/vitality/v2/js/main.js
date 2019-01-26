(function () {

	window.requestAnimFrame = (function () {
		return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (callback, element) {
				window.setTimeout(callback, 1000 / 60);
			};
	})();

	// Start the App
	$(document).ready(function () {

		var canvas = document.getElementById("canvas"),
			context = canvas.getContext("2d"),
			canvasWidth = 533,
			canvasHeight = 533,
			centerX = canvasWidth / 2,
      		centerY = canvasHeight / 2,
			particles = [];

		canvas.width = canvasWidth;
		canvas.height = canvasHeight;

		// Generate particles on click
		document.addEventListener("mousedown", function (e) {

			var offset = $('#canvas').offset();
			var radius = Math.floor(Math.random() * 5) + 1;
			createParticle(radius, e.clientX - offset.left, e.clientY - offset.top);
		});

		// Generate particles automatically
		var generator = setInterval(function() {

			if(particles.length < 300) {
				var posX = Math.floor(Math.random() * canvasWidth) + 1;
				var posY = Math.floor(Math.random() * canvasHeight) + 1;
				var radius = Math.floor(Math.random() * 5) + 1;
				createParticle(radius, posX, posY);
			}
			else {
				clearInterval(generator);
			}
		}, 1);

		update();

		function createParticle(radius, pX, pY) {

			var particle = new PH_MODULES.Particle(pX, pY, radius, centerX, centerY);
			particles.push(particle);
		}

		function update() {

			// Erase canvas
  			context.fillStyle = "#5BB5B3";
      		context.fillRect(0, 0, canvasWidth, canvasHeight);
      		context.fillStyle = '#3f7f7c';

      		// Update and draw particles
			for (var i=0; i < particles.length; i++) {

				particles[i].update();

				context.beginPath();
				context.arc(particles[i].pX, particles[i].pY, particles[i].radius, 0, 2 * Math.PI, false);
				context.closePath();
				context.fill();
			}

			requestAnimFrame(update);
		}
	});

})();