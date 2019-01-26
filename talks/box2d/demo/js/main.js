(function () {

	window.requestAnimFrame = (function () {
		return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (callback, element) {
				window.setTimeout(callback, 1000 / 60);
			};
	})();

	$(document).ready(function () {

		var world,
			b2Vec2 = Box2D.Common.Math.b2Vec2,
			b2AABB = Box2D.Collision.b2AABB,
			b2BodyDef = Box2D.Dynamics.b2BodyDef,
			b2Body = Box2D.Dynamics.b2Body,
			b2FixtureDef = Box2D.Dynamics.b2FixtureDef,
			b2Fixture = Box2D.Dynamics.b2Fixture,
			b2World = Box2D.Dynamics.b2World,
			b2PolygonShape = Box2D.Collision.Shapes.b2PolygonShape,
			b2DebugDraw = Box2D.Dynamics.b2DebugDraw,
			worldScale = 30,
			canvas = document.getElementById("canvas"),
			context = canvas.getContext("2d");

		canvas.width = 800;
		canvas.height = 600;

		// Init Box2D
		world = new b2World(new b2Vec2(0, 10), true);

		// Create world borders
		createBox(800, 1, 400, 600, b2Body.b2_staticBody, null);
		createBox(800, 1, 400, 0, b2Body.b2_staticBody, null);
		createBox(1, 600, 0, 300, b2Body.b2_staticBody, null);
		createBox(1, 600, 800, 300, b2Body.b2_staticBody, null);

		paint();
		update();

		document.addEventListener("mousedown", function (e) {

			createBox(32, 32, e.clientX - $('#canvas').offset().left, e.clientY - $('#canvas').offset().top, b2Body.b2_dynamicBody, document.getElementById("crate"));
		});
		
		function createBox(width, height, pX, pY, type, data) {

			var bodyDef = new b2BodyDef();
			bodyDef.type = type;
			bodyDef.position.Set(pX / worldScale, pY / worldScale);
			bodyDef.userData = data;

			var polygonShape = new b2PolygonShape();
			polygonShape.SetAsBox(width / 2 / worldScale, height / 2 / worldScale);

			var fixtureDef = new b2FixtureDef();
			fixtureDef.density = 2.0;
			fixtureDef.friction = 0.2;
			fixtureDef.restitution = 0.5;
			fixtureDef.shape = polygonShape;

			var body = world.CreateBody(bodyDef);
			body.CreateFixture(fixtureDef);
		}
		
		function paint() {
			
			debugDraw = new b2DebugDraw();
			debugDraw.SetSprite(document.getElementById("canvas").getContext("2d"));
			debugDraw.SetDrawScale(30.0);
			debugDraw.SetFillAlpha(0.5);
			debugDraw.SetLineThickness(1.0);
			debugDraw.SetFlags(b2DebugDraw.e_shapeBit | b2DebugDraw.e_jointBit);
			world.SetDebugDraw(debugDraw);
		}
		
		function update() {

			world.Step(1 / 60, 10, 10);
			world.DrawDebugData();
			
			for (var b = world.m_bodyList; b !== null; b = b.m_next) {

				if (b.GetUserData()) {
					context.save();
					context.translate(b.GetPosition().x * worldScale, b.GetPosition().y * worldScale);
					context.rotate(b.GetAngle());
					context.drawImage(b.GetUserData(), -b.GetUserData().width / 2, -b.GetUserData().height / 2);
					context.restore();
				}
			}

			world.ClearForces();
			requestAnimFrame(update);
		}
	});

})();