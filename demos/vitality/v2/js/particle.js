/*!
* particle.js
* This file contains the code for the particle logic
*
* @project   PRUHEALTH
* @date      2015-01-23
* @licensor  SAPIENTNITRO LONDON
*
*/

var PH_MODULES = (function (modules, $) {

    "use strict";

    function Particle(pX, pY, radius, cX, cY) {

        this.pX = pX;
        this.pY = pY;
        this.radius = radius;
        this.centerX = cX;
        this.centerY = cY;
    }

    Particle.prototype = {

        update: function() {

			var dX = this.centerX - this.pX, // Get the particle position in units from the screen center X
				dY = this.centerY - this.pY, // Get the particle position in units from the screen center Y
				distance = Math.floor( Math.sqrt( Math.pow(dX, 2) + Math.pow(dX, 2) ) ), // Get the distance between the particle and the screen center position
				rads = Math.atan2(dY, dX), // Get the angle from the triangle between the particle position and the screen center position						
				accel = Math.max( 0, (distance - this.centerY) / 1000),
				xVel = accel * Math.cos(rads),
				yVel = accel * Math.sin(rads);

			this.pX += xVel; // Get the new acceleration in the X axis
			this.pY += yVel; // Get the new acceleration in the Y axis
		}
    };

modules.Particle = Particle;
return modules;


})(PH_MODULES || {}, jQuery);
