/*!
* itunes-reward-node.js
* This file contains the code for the second animation particles
* 
* @project   VITALITY ITUNES PRIZE PICKER
* @date      2015-02-09 
* @author    JOAN MIRA, SapientNitro <jmira@sapient.com>
* @licensor  SAPIENTNITRO
*
*/

function Node(w, h) {
	
	this.x = w/2;
	this.y = h/2;
	this.angle = Math.random() * (2*Math.PI);
	this.speed = (Math.random() * 15) + 5;
	this.xSpeed = this.speed * Math.cos(this.angle);
	this.ySpeed = this.speed * Math.sin(this.angle);
	this.hasTarget = false;
	this.targetX = 266;
	this.targetY = 180;
	this.targetR = 4;
	this.initialScale = (Math.random() * 6) + 1;
	this.speedScale = 1;
	this.friction = .004;
	this.fadeOut = false;
	this.minimumScale = 0.6;
	this.bounce = (Math.random() * 0.5) + 0.5;
	this.bounds = {x: w, y: h};
}

Node.prototype.setTarget = function(xLoc, yLoc, radius) {

	this.hasTarget = true;
	this.targetX = xLoc;
	this.targetY = yLoc;
	this.targetR = radius;
}

Node.prototype.update = function() {

	// the speed also is reduced by friction
	this.xSpeed *= 1 - this.friction;
	this.ySpeed *= 1 - this.friction;

	// if the ball will move off the edge of the screen then the speeds
	// direction is reversed. bounce is used to make the force a fraction of what it was
	if (this.x + this.xSpeed > this.bounds.x || this.x + this.xSpeed < 0) {
		this.xSpeed = -this.bounce * this.xSpeed;
	}

	if (this.y + this.ySpeed > this.bounds.y || this.y + this.ySpeed < 0) {
		this.ySpeed = -this.bounce * this.ySpeed;
	}

	// the position is increased by speed
	this.x += this.xSpeed;
	this.y += this.ySpeed;
	
	var thisScale = this.minimumScale + (1 - this.minimumScale);

	if (!this.fadeOut && this.speedScale < this.initialScale) {
		this.speedScale += 0.03;
	}

	// if it has a target, go to it!
	if (this.hasTarget) {

		var dX = this.targetX - this.x,
			dY = this.targetY - this.y,
			separation = Math.pow((dX * dX) + (dY * dY), .5),
			angle = Math.atan2(dY, dX),
			sepSpeed = Math.min(separation * .1, 5); //max speed 5

		this.xSpeed += Math.cos(angle) * sepSpeed * .3;
		this.ySpeed += Math.sin(angle) * sepSpeed * .3;

		// up the friction!
		this.xSpeed *= 1 - (4 * this.friction);
		this.ySpeed *= 1 - (4 * this.friction);

		if (this.speedScale < this.targetR) this.speedScale += 0.1;
		else if (this.speedScale > this.targetR) this.speedScale -= 0.1;

		if (Math.sqrt((this.xSpeed * this.xSpeed) + (this.ySpeed * this.ySpeed)) < .04 && Math.sqrt((dX * dX) + (dY * dY)) < 3) {
			this.friction = 0;
		}
	}
}