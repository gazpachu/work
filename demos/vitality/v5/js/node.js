
function Node(opts) {

	var defaults = {
		xSpeed: 4,
		ySpeed: 4,
		xAcl: 0.00,
		yAcl: 0.03,
		x: 266,
		y: 266,
		bounce: 0.8,
		bounds: {
			x: 500,
			y: 500,
		}
	};

	this.opts = $.extend({}, defaults, opts);
	this.reset();
}

Node.prototype.reset = function() {

	this.x = this.opts.x;
	this.y = this.opts.y;
	this.xSpeed = this.opts.xSpeed;
	this.ySpeed = this.opts.ySpeed;
	this.hasTarget = false;
	this.targetX = 266;
	this.targetY = 180;
	this.targetForce = 0;
	this.initialScale = (Math.random() * 6) + 1,
	this.speedScale = 1,
	this.friction = .003;
	this.minimumScale = 0.6; // scale the ball would have at the back of the box
	this.alive = true;
	this.alpha = 1;
	this.fadeOut = false;
	this.scenario = 1;
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

	//every frame the speed is increased by acceleration
	this.xSpeed += this.opts.xAcl;
	this.ySpeed += this.opts.yAcl;

	// the speed also is reduced by friction
	this.xSpeed *= 1 - this.friction;
	this.ySpeed *= 1 - this.friction;

	// if the ball will move off the edge of the screen then the speeds
	//direction is reversed. bounce is used to make the force a fraction of what it was
	if (this.x + this.xSpeed > this.opts.bounds.x || this.x + this.xSpeed < 0) {
		this.xSpeed = -this.opts.bounce * this.xSpeed;
	}

	if (this.y + this.ySpeed > this.opts.bounds.y || this.y + this.ySpeed < 0) {
		this.ySpeed = -this.opts.bounce * this.ySpeed;
	}

	// the position is increased by speed
	this.x += this.xSpeed;
	this.y += this.ySpeed;
	
	var thisScale = this.minimumScale + (1 - this.minimumScale);

	// we'll assume the back of the box is in the centre of the bounds
	var centerToX = this.x - this.opts.bounds.x / 2;
	var centerToY = this.y - this.opts.bounds.y / 2;

	// the distance from the center of the screen is reduced based on the scaling of the object
	var newX = (this.opts.bounds.x / 2) + (centerToX * thisScale);
	var newY = (this.opts.bounds.y / 2) + (centerToY * thisScale);

	if (this.fadeOut) {
		if (this.speedScale > 2) {
			this.speedScale -= 1;
		}
		else {
			this.speedScale = (Math.random() * 3) + 1; 
		}
	}
	else {
		if (this.speedScale < this.initialScale) {
			this.speedScale += 0.05;
		}
	}

	// if it has a target, go to it!
	if (this.hasTarget) {

		var dX = this.targetX - this.x,
			dY = this.targetY - this.y,
			seperation = Math.pow((dX * dX) + (dY * dY), .5),
			angle = Math.atan2(dY, dX),
			sepSpeed = Math.min(seperation * .1, 5); //max speed 5

		this.xSpeed += Math.cos(angle) * sepSpeed * .3;
		this.ySpeed += Math.sin(angle) * sepSpeed * .3;

		// up the friction!
		this.xSpeed *= .92; // 1 - (4 * this.friction);
		this.ySpeed *= .92; // 1 - (4 * this.friction);
	}
	else if (this.fadeOut) {
		this.alpha -= 0.03;

		if (this.alpha < 0.0) {
			this.alive = false;
		}
	}
}