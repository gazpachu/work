
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
	this.targetForce = 0;
	this.initialScale = (Math.random() * 6) + 1;
	this.speedScale = 1;
	this.friction = .004;
	this.minimumScale = 0.6;
	this.alive = true;
	this.alpha = 1;
	this.fadeOut = false;
	this.scenario = 1;
	this.bounce = (Math.random() * 0.5) + 0.5;
	this.bounds = {x: w, y: h};
}

Node.prototype.setTarget = function(xLoc, yLoc, force) {

	this.hasTarget = true;
	this.targetX = xLoc;
	this.targetY = yLoc;
	this.targetForce = force;
}

Node.prototype.shiftTarget = function(xLocChange, yLocChange, force) {

	this.targetX += xLocChange;
	this.targetY += yLocChange;

	if (force !== 0) this.targetForce = force;
}

Node.prototype.killTarget = function(sp) {

	this.hasTarget = false;
	this.targetX = 0;
	this.targetY = 0;
	this.targetForce = 0;
	this.ySpeed = sp;
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


		if (Math.sqrt((this.xSpeed*this.xSpeed) + (this.ySpeed*this.ySpeed)) < .05 &&
			Math.sqrt((dX*dX) + (dY*dY)) < 3) {
			this.friction = 0;
		}
	}
	else if (this.fadeOut) {
		this.alpha -= 0.03;

		if (this.alpha < 0.0) {
			this.alive = false;
		}
	}
}