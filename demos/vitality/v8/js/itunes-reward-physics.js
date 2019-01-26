/*!
* itunes-reward-physics.js
* This file contains the box2d logic for the first animation
* 
* @project   VITALITY ITUNES PRIZE PICKER
* @date      2015-02-09 
* @author    JOAN MIRA, SapientNitro <jmira@sapient.com>
* @licensor  SAPIENTNITRO
*
*/

function Physics(canvasWidth, canvasHeight, context) {

	var self = this;
	this.b2Vec2 = Box2D.Common.Math.b2Vec2;
	this.world = new Box2D.Dynamics.b2World(new this.b2Vec2(0, 0), true);
	this.b2Color = Box2D.Common.b2Color;
	this.b2BodyDef = Box2D.Dynamics.b2BodyDef;
	this.b2Body = Box2D.Dynamics.b2Body;
	this.b2FixtureDef = Box2D.Dynamics.b2FixtureDef;
	this.b2Fixture = Box2D.Dynamics.b2Fixture;
	this.b2World = Box2D.Dynamics.b2World;
	this.b2CircleShape = Box2D.Collision.Shapes.b2CircleShape;
	this.b2DebugDraw = Box2D.Dynamics.b2DebugDraw;
	this.canvasWidth = canvasWidth;
	this.canvasHeight = canvasHeight;
	this.context = context;
	this.worldScale = 30;
	this.totalParticles = 0;
	this.previousValue = 1;
	this.whiteCircle = null;
	this.alpha = 1,
	this.resizeDir = 1,
	this.debugDraw = new this.b2DebugDraw();

	// Create a body for the white circle
	this.createCircle(120, canvasWidth/2, 180, this.b2Body.b2_staticBody);

	// Create particles every 50 ms until we reach 150
	this.generator = setInterval(function() {

		if(self.totalParticles < 150) {
			var plusOrMinus = Math.random() < 0.5 ? -1 : 1;
			var posX = Math.floor(Math.random() * self.canvasWidth) + (500 * plusOrMinus);
			plusOrMinus = Math.random() < 0.5 ? -1 : 1;
			var posY = Math.floor(Math.random() * self.canvasHeight-100) + (500 * plusOrMinus);
			var radius = Math.floor(Math.random() * 9) + 1;

			self.createCircle(radius, posX, posY, self.b2Body.b2_dynamicBody);
		}
		else {
			clearInterval(self.generator);
			self.generator = null;
		}
	}, 50);

	this.debugDraw.SetSprite(document.getElementById("ir-anim-canvas").getContext("2d"));
	this.debugDraw.SetDrawScale(30.0);
	this.debugDraw.SetFillAlpha(this.alpha);
	this.debugDraw.SetLineThickness(1.0);
	this.debugDraw.SetFlags(this.b2DebugDraw.e_shapeBit);
	this.world.SetDebugDraw(this.debugDraw);
}

Physics.prototype.createCircle = function(radius, pX, pY, type) {

	var bodyDef = new this.b2BodyDef();
	bodyDef.type = type;
	bodyDef.position.Set(pX / this.worldScale, pY / this.worldScale);

	var circleShape = new this.b2CircleShape();
	circleShape.SetRadius(radius / this.worldScale);

	var fixtureDef = new this.b2FixtureDef();
	fixtureDef.density = 5;
	fixtureDef.friction = 0.8;
	fixtureDef.restitution = .1;
	fixtureDef.shape = circleShape;

	var body = this.world.CreateBody(bodyDef);
	body.CreateFixture(fixtureDef);
	
	if (type === this.b2Body.b2_staticBody) {
		this.whiteCircle = body;
	}
	else {
		this.totalParticles++;
	}
}

Physics.prototype.update = function() {

	this.world.Step(1 / 60, 10, 10);
	this.world.DrawDebugData();
		
	this.world.ClearForces();

	for (var b = this.world.m_bodyList; b !== null; b = b.m_next) {

		var xPos = b.GetPosition().x;
		var yPos = b.GetPosition().y;

		// Only check the dynamic bodies
		if( b.GetType() !== this.b2Body.b2_staticBody) {

		    var x = Math.floor(xPos * this.worldScale);
		    var y = Math.floor(yPos * this.worldScale);

			var dX = 266 - x; // Get the body position in units from the screen center X
			var dY = 180 - y; // Get the body position in units from the screen center Y
			var distance = Math.floor( Math.sqrt( Math.floor(dX*dX + dX*dX) ) ); // Get the distance between the body and the screen center position
			var rads = Math.atan2(dY, dX); // Get the angle from the triangle between the body position and the screen center position						
			var accel = Math.max( 0, (distance - 10) / 5000);
			var xVel = accel * Math.cos(rads); // Get the new acceleration in the X asis
			var yVel = accel * Math.sin(rads); // Get the new acceleration in the Y asis

			if (this.previousValue > 0) 
				b.ApplyForce( new this.b2Vec2(xVel * this.previousValue * 5, yVel * this.previousValue * 5), new this.b2Vec2(xPos, yPos));
			else
				b.ApplyForce( new this.b2Vec2(xVel * this.previousValue, yVel * this.previousValue), new this.b2Vec2(xPos, yPos));
		}
		else {
			// Animate the white circle by quickly changing its size and position a bit
			if (b === this.whiteCircle) {

				var color = new this.b2Color(1, 1, 1);
				var xf = b.m_xf;

				if (this.resizeDir === 1) {
					if (this.previousValue > 5) this.resizeDir = 0; 
					else this.previousValue += Math.sin(0.05);
				}
				else {
					if (this.previousValue < -5) this.resizeDir = 1; 
					else this.previousValue -= Math.sin(0.05);
				}

				for( var f = b.m_fixtureList; f; f = f.m_next ) {

					var s = f.GetShape();
					f.GetShape().m_radius = 4 + this.previousValue / this.worldScale;
					this.world.DrawShape(s, xf, color);
				}
			}
		}
	}
}

Physics.prototype.destroy = function() {

	delete world;
}