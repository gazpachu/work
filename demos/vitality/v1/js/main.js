(function () {

	window.requestAnimFrame = (function () {
		return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (callback, element) {
				window.setTimeout(callback, 1000 / 60);
			};
	})();

	$(document).ready(function () {

		var world,
			b2Vec2 = Box2D.Common.Math.b2Vec2,
			b2Color = Box2D.Common.b2Color,
			b2BodyDef = Box2D.Dynamics.b2BodyDef,
			b2Body = Box2D.Dynamics.b2Body,
			b2FixtureDef = Box2D.Dynamics.b2FixtureDef,
			b2Fixture = Box2D.Dynamics.b2Fixture,
			b2World = Box2D.Dynamics.b2World,
			b2PolygonShape = Box2D.Collision.Shapes.b2PolygonShape,
			b2CircleShape = Box2D.Collision.Shapes.b2CircleShape,
			b2DebugDraw = Box2D.Dynamics.b2DebugDraw,
			worldScale = 30,
			canvas = document.getElementById("canvas"),
			context = canvas.getContext("2d"),
			canvasWidth = 533,
			canvasHeight = 533,
			totalParticles = 0,
			sequence = 1,
			whiteCircle,
			previousValue = 1;

		canvas.width = canvasWidth;
		canvas.height = canvasHeight;

		// Shapes
		var zeroShape = [{x:20, y:20}, {x:40, y:30}];

		// Start box2d world
		world = new b2World(new b2Vec2(0, 0), true);

		createBox(canvasWidth, 1, canvasWidth/2, canvasHeight, b2Body.b2_staticBody); //bottom
		createBox(canvasWidth, 1, canvasWidth/2, 0, b2Body.b2_staticBody); //top
		createBox(1, canvasHeight, 0, canvasHeight/2, b2Body.b2_staticBody); //left
		createBox(1, canvasHeight, canvasWidth, canvasHeight/2, b2Body.b2_staticBody); //right
		createCircle(120, canvasWidth/2, 180, b2Body.b2_staticBody);

		document.addEventListener("mousedown", function (e) {

			var offset = $('#canvas').offset();
			var radius = Math.floor(Math.random() * 5) + 1;
			createCircle(radius, e.clientX - offset.left, e.clientY - offset.top, b2Body.b2_dynamicBody);
		});

		var generator = setInterval(function() {

			if(totalParticles < 300) {
				var plusOrMinus = Math.random() < 0.5 ? -1 : 1;
				var posX = Math.floor(Math.random() * canvasWidth) + (100 * plusOrMinus);
				var posY = Math.floor(Math.random() * canvasHeight) + (100 * plusOrMinus);
				var radius = Math.floor(Math.random() * 7) + 1;

				createCircle(radius, posX, posY, b2Body.b2_dynamicBody);
			}
			else {
				clearInterval(generator);
			}
		}, 1);

		$('#white-circle').on('click', function() {
			sequence = 0;

			$('#white-circle').find('h1, h2, div').fadeOut(function() {
				$('#white-circle').animate({ left: '-250px', top: '-250px', width: '1000px', height: '1000px' }, 1000, function() {
					$('#container').css('background', 'none');
					$('body').css('background', '#FFF');
					$('#white-circle').remove();
					
					world.SetGravity(new b2Vec2(0,10));

					for (var b = world.m_bodyList; b !== null; b = b.m_next) {
						for( var f = b.m_fixtureList; f; f = f.m_next ) {
							f.GetShape().m_radius = 3 / worldScale;
						}
					}

					loadShape('zero');
					sequence = 2;
				});
			});
		});

		initDebugDraw();
		update();

		function createBox(width, height, pX, pY, type) {

			var bodyDef = new b2BodyDef();
			bodyDef.type = type;
			bodyDef.position.Set(pX / worldScale, pY / worldScale);

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

		function createCircle(radius, pX, pY, type) {

			var bodyDef = new b2BodyDef();
			bodyDef.type = type;
			bodyDef.position.Set(pX / worldScale, pY / worldScale);

			var circleShape = new b2CircleShape();
			circleShape.SetRadius(radius / worldScale);

			var fixtureDef = new b2FixtureDef();
			fixtureDef.density = 2;
			fixtureDef.friction = 0.2;
			fixtureDef.restitution = 0;
			fixtureDef.shape = circleShape;

			var body = world.CreateBody(bodyDef);
			body.CreateFixture(fixtureDef);
			
			if (type === b2Body.b2_staticBody) {
				whiteCircle = body;
			}
			else {
				totalParticles++;
			}
		}

		function loadShape(shape) {

			loadSceneIntoWorld( myRubeScene, world );
		}

		function initDebugDraw() {
			
			debugDraw = new b2DebugDraw();
			debugDraw.SetSprite(document.getElementById("canvas").getContext("2d"));
			debugDraw.SetDrawScale(30.0);
			debugDraw.SetFillAlpha(1);
			debugDraw.SetLineThickness(1.0);
			debugDraw.SetFlags(b2DebugDraw.e_shapeBit);
			world.SetDebugDraw(debugDraw);
		}

		function update() {

			world.Step(1 / 60, 10, 10);
			world.DrawDebugData();
				
			if(sequence > 0) {	
				//context.clearRect(0, 0, canvasWidth, canvasHeight);
				world.ClearForces();

				for (var b = world.m_bodyList; b !== null; b = b.m_next) {

					// Only check the dynamic bodies
					if( b.GetType() !== b2Body.b2_staticBody) {

					    var x = Math.floor(b.GetPosition().x * worldScale);
					    var y = Math.floor(b.GetPosition().y * worldScale);
					    //var angle = Math.floor(b.GetAngle());

						if (sequence === 1) {
							var dX = (canvasWidth / 2) - x; // Get the body position in units from the screen center X
							var dY = (180) - y; // Get the body position in units from the screen center Y
							var distance = Math.floor( Math.sqrt( Math.pow(dX, 2) + Math.pow(dX, 2) ) ); // Get the distance between the body and the screen center position
							var rads = Math.atan2(dY, dX); // Get the angle from the triangle between the body position and the screen center position						
							var accel = Math.max( 0, (distance - ((canvasHeight/3) / 3) ) / 1000);
							var xVel = accel * Math.cos(rads); // Get the new acceleration in the X asis
							var yVel = accel * Math.sin(rads); // Get the new acceleration in the Y asis

							b.ApplyForce( new b2Vec2( xVel * 30, yVel * 30 ), new b2Vec2( b.GetPosition().x, b.GetPosition().y ) );
						}
						else if (sequence === 2) {

							//b.SetType(false);
							var dX = canvasWidth - x; // Get the body position in units from the screen center X
							var dY = canvasHeight - y; // Get the body position in units from the screen center Y
							var distance = Math.floor( Math.sqrt( Math.pow(dX, 2) + Math.pow(dX, 2) ) ); // Get the distance between the body and the screen center position
							var rads = Math.atan2(dY, dX); // Get the angle from the triangle between the body position and the screen center position						
							var accel = Math.max( 0, (distance - canvasWidth));
							var xVel = accel * Math.cos(rads); // Get the new acceleration in the X asis
							var yVel = accel * Math.sin(rads); // Get the new acceleration in the Y asis

							b.ApplyForce( new b2Vec2( xVel * 2, yVel * 2 ), new b2Vec2( b.GetPosition().x, b.GetPosition().y ) );
						}
					}
					else {
						// Animate the white circle by quickly changing its size and position a bit
						if (b === whiteCircle) {
							var color = new b2Color(1, 1, 1);
							var xf = b.m_xf;
							previousValue = (previousValue * -1);

							for( var f = b.m_fixtureList; f; f = f.m_next ) {
								var s = f.GetShape();
								f.GetShape().m_radius = f.GetShape().m_radius + (previousValue * 10) / worldScale;
								whiteCircle.SetPosition(new b2Vec2( whiteCircle.GetPosition().x - (previousValue * -10) / worldScale, whiteCircle.GetPosition().y - (previousValue * -10) / worldScale ));
								world.DrawShape(s, xf, color);
							}
						}
					}
				}
			}
			else {
				if (whiteCircle) {
					world.DestroyBody(whiteCircle);;
				}
			}

			requestAnimFrame(update);
		}
	});

})();