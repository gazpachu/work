/*!
* starpach.js
* Starpach game logic
*
* @project   JOANMIRA.COM
* @date      22-02-2015
* @author    JOAN MIRA, <hello@joanmira.com>
* @license  ALL RIGHTS RESERVED
*
*/

var JM_MODULES = (function (modules, $, window, Phaser) {

	"use strict";

	var Vector2=function(x,y){this.x=x||0;this.y=y||0;};Vector2.prototype={reset:function(x,y){this.x=x;this.y=y;return this;},toString:function(decPlaces){decPlaces=decPlaces||3;var scalar=Math.pow(10,decPlaces);return"["+ Math.round(this.x*scalar)/ scalar + ", " + Math.round (this.y * scalar) / scalar + "]";
},clone:function(){return new Vector2(this.x,this.y);},copyTo:function(v){v.x=this.x;v.y=this.y;},copyFrom:function(v){this.x=v.x;this.y=v.y;},magnitude:function(){return Math.sqrt((this.x*this.x)+(this.y*this.y));},magnitudeSquared:function(){return(this.x*this.x)+(this.y*this.y);},normalise:function(){var m=this.magnitude();this.x=this.x/m;this.y=this.y/m;return this;},reverse:function(){this.x=-this.x;this.y=-this.y;return this;},plusEq:function(v){this.x+=v.x;this.y+=v.y;return this;},plusNew:function(v){return new Vector2(this.x+v.x,this.y+v.y);},minusEq:function(v){this.x-=v.x;this.y-=v.y;return this;},minusNew:function(v){return new Vector2(this.x-v.x,this.y-v.y);},multiplyEq:function(scalar){this.x*=scalar;this.y*=scalar;return this;},multiplyNew:function(scalar){var returnvec=this.clone();return returnvec.multiplyEq(scalar);},divideEq:function(scalar){this.x/=scalar;this.y/=scalar;return this;},divideNew:function(scalar){var returnvec=this.clone();return returnvec.divideEq(scalar);},dot:function(v){return(this.x*v.x)+(this.y*v.y);},angle:function(useRadians){return Math.atan2(this.y,this.x)*(useRadians?1:Vector2Const.TO_DEGREES);},rotate:function(angle,useRadians){var cosRY=Math.cos(angle*(useRadians?1:Vector2Const.TO_RADIANS));var sinRY=Math.sin(angle*(useRadians?1:Vector2Const.TO_RADIANS));Vector2Const.temp.copyFrom(this);this.x=(Vector2Const.temp.x*cosRY)-(Vector2Const.temp.y*sinRY);this.y=(Vector2Const.temp.x*sinRY)+(Vector2Const.temp.y*cosRY);return this;},equals:function(v){return((this.x==v.x)&&(this.y==v.x));},isCloseTo:function(v,tolerance){if(this.equals(v))return true;Vector2Const.temp.copyFrom(this);Vector2Const.temp.minusEq(v);return(Vector2Const.temp.magnitudeSquared()<tolerance*tolerance);},rotateAroundPoint:function(point,angle,useRadians){Vector2Const.temp.copyFrom(this);Vector2Const.temp.minusEq(point);Vector2Const.temp.rotate(angle,useRadians);Vector2Const.temp.plusEq(point);this.copyFrom(Vector2Const.temp);},isMagLessThan:function(distance){return(this.magnitudeSquared()<distance*distance);},isMagGreaterThan:function(distance){return(this.magnitudeSquared()>distance*distance);}};var Vector2Const={TO_DEGREES:180/Math.PI,TO_RADIANS:Math.PI/180,temp:new Vector2()};

	var starpach = {

		game: null,
		windowWidth: $(window).width(),
		windowHeight: $(window).height(),
		halfWidth: 0,
		halfHeight: 0,
		starfieldCanvas: document.getElementById('starfield'),
		starpachCanvas: null,
		$scoreBoard: $('.hero h2'),
		$gameInfo: $('.game-info'),
		spaceship: null,
		powerup: null,
		spaceshipTimer: null,
		spaceshipCounter: 0,
		cursors: null,
		bullet: null,
		bullets: null,
		asteroids: null,
		bulletTime: 0,
		gameState: 0,
		score: 0,
		lives: 3,
		hiscore: 0,
		shots: 0,
		hits: 0,
		level: 1,
		nextLevel: false,
		musicOn: false,
		sfxOn: false,
		music: null,
		sfx: null,
		paused: false,
		loadingCompleted: false,
		engine: null,
		touches: [], // array of touch vectors
		leftTouchID: -1, 
		leftTouchPos: new Vector2(0,0),
		leftTouchStartPos: new Vector2(0,0),
		leftVector: new Vector2(0,0),

		states: {
			INIT: 0,
			PAUSED: 1,
			PLAYING: 2,
			LEVELUP: 3,
			DYING: 4
		},

		starfield: {
			context: null,
			warpZ: 12,
		    units: 500,
		    stars: [],
		    z: 0.08,
		    maxVel: 0.5,
		    cx: 0,
		    cy: 0
		},

		init: function() {

			starpach.halfWidth = this.windowWidth/2;
			starpach.halfHeight = this.windowHeight/2;

			// Starfield setup
			starpach.starfieldCanvas.width = this.windowWidth;
			starpach.starfieldCanvas.height = this.windowHeight;
			starpach.starfield.context = starpach.starfieldCanvas.getContext('2d');
			starpach.starfield.context.globalAlpha = 0.25;

			starpach.starfield.cx = this.halfWidth;
			starpach.starfield.cy = this.halfHeight;

			for (var i = 0, n; i < starpach.starfield.units; i++) {
				n = {};
				starpach.resetStar(n);
				starpach.starfield.stars.push(n);
			}

			$(window).blur(function() {
				starpach.paused = true;
			});

			$(window).focus(function() {
				starpach.paused = false;
				requestAnimationFrame(starpach.render);
			});
		},

		destroy: function() {

			cancelAnimationFrame(starpach.render);
			this.game.destroy();
		},

		preload: function() {

			// Preload audio assets
		},

		load: function() {

			this.game.load.image('bullet', '../images/bullets.png');
			this.game.load.spritesheet('asteroid1', '../images/asteroid1.png', 130, 130, 1);
			this.game.load.spritesheet('asteroid2', '../images/asteroid2.png', 130, 130, 1);
			this.game.load.spritesheet('asteroid3', '../images/asteroid3.png', 130, 130, 1);
			this.game.load.spritesheet('asteroid4', '../images/asteroid4.png', 130, 130, 1);
			this.game.load.spritesheet('asteroid5', '../images/asteroid5.png', 130, 130, 4);
			this.game.load.image('emitter-asteroid', '../images/emitter-asteroid.png');
			this.game.load.image('emitter-ship', '../images/emitter-ship.png');
			//this.game.load.image('powerup', '../images/powerup.png');
			this.game.load.spritesheet('ship', '../images/ship.png', 143, 67, 4);

			if (starpach.sfxOn) {
				this.game.load.audio('sfx', ['../sounds/sfx.mp3', '../sounds/sfx.ogg']);
			}

			if (starpach.musicOn) {
				this.game.load.audio('music', ['../sounds/music.mp3', '../sounds/music.ogg']);
			}

			this.game.load.start();
		},

		loadProgress: function(progress, cacheKey, success, totalLoaded, totalFiles) {

			$('.game-status').text('Loading ' + cacheKey + ' ... ' + progress + '%');

			// Start the game and don't wait for the audio to finish loading
			if (cacheKey === 'ship' && success) {
				starpach.startGame();
			}
		},

		create: function() {

			// Load events
			this.game.load.onFileComplete.add(starpach.loadProgress, this);
			this.game.load.onLoadComplete.add(starpach.loadComplete, this);
			starpach.load();
		},

		loadComplete: function() {

			if (starpach.musicOn) starpach.music.play("track1");
			starpach.loadingCompleted = true;
			starpach.updateScore();
		},

		startGame: function() {

			// Load music
			if (starpach.musicOn) {
				starpach.music = starpach.game.add.audio('music');
				starpach.music.addMarker('track1', 0, 115, 0.8, true);
			}

			// Load SFX
			if (starpach.sfxOn) {
				starpach.sfx = starpach.game.add.audio('sfx');
				starpach.sfx.allowMultiple = true;
				starpach.sfx.addMarker('game-over', 0, 1, 1, false);
				starpach.sfx.addMarker('fire', 0.97, 0.3, 0.5, false);
				starpach.sfx.addMarker('fire2', 1.05, 0.4, 1, false);
				starpach.sfx.addMarker('explosion', 2.55, 2.8, 1, false);
				starpach.sfx.addMarker('explosion2', 5.35, 2.15, 1, false);

				starpach.engine = starpach.game.add.audio('sfx');
				starpach.engine.addMarker('engine', 1.48, 1.02, 1, true);
			}

			// Game setup
			starpach.starpachCanvas = document.getElementById('starpach');
			this.game.renderer.clearBeforeRender = true;
			this.game.renderer.roundPixels = true;
			this.game.physics.startSystem(Phaser.Physics.ARCADE);

			// Bullets
			starpach.bullets = this.game.add.group();
			starpach.bullets.enableBody = true;
			starpach.bullets.physicsBodyType = Phaser.Physics.ARCADE;
			starpach.bullets.createMultiple(40, 'bullet');

			// Asteroid emmitter
			starpach.emitterAsteroid = this.game.add.emitter(0, 0, 200);
            starpach.emitterAsteroid.makeParticles(["emitter-asteroid"]);
            starpach.emitterAsteroid.gravity = 0;

            // Spaceship emmitter
            starpach.emitterShip = this.game.add.emitter(0, 0, 200);
            starpach.emitterShip.makeParticles(["emitter-ship"]);
            starpach.emitterShip.gravity = 0;

            // Power up
   			// starpach.powerup = this.game.add.sprite(this.game.width/2, this.game.height/1.5, 'powerup');
			// starpach.powerup.anchor.set(0.5, 0.5);
			// this.game.physics.enable(starpach.powerup, Phaser.Physics.ARCADE);

			// Controls
			starpach.cursors = this.game.input.keyboard.createCursorKeys();
			this.game.input.keyboard.addKeyCapture([ Phaser.Keyboard.SPACEBAR ]);

			// Browser events
			starpach.starpachCanvas.addEventListener('touchstart', starpach.onTouchStart, false);
			starpach.starpachCanvas.addEventListener('touchmove', starpach.onTouchMove, false);
			starpach.starpachCanvas.addEventListener('touchend', starpach.onTouchEnd, false);
			window.onorientationchange = starpach.resetCanvas;  
			window.onresize = starpach.resetCanvas;

			starpach.updateStates(starpach.states.INIT);
			starpach.spaceshipTimer = setInterval(starpach.respawnSpaceship, 150);
			starpach.updateStates(starpach.states.PLAYING);
		},

		startEngine: function(music, sfx, stars) {

			starpach.musicOn = music;
			starpach.sfxOn = sfx;

			if (!music) $('.music-switch').hide();
			if (!sfx) $('.sfx-switch').hide();
			if (!stars) $('.stars-switch').hide();

			if (stars) {
				starpach.render();
			}

			// Initialise Phaser
			this.game = new Phaser.Game(this.windowWidth, this.windowHeight, Phaser.CANVAS, 'starpach', { preload: this.preload, create: this.create, update: this.update }, true);
		},

		update: function() {

			var accelerating = false;

			if (starpach.gameState == starpach.states.PLAYING) {
				starpach.updateAsteroids(starpach.asteroids);

				// Keyboard events
				if (starpach.cursors.up.isDown) {
					starpach.accelerate(starpach.spaceship.rotation, 500);
					accelerating = true;
				}
				else {

					// Touch events
					if (starpach.leftVector.x !== 0 || starpach.leftVector.y !== 0) {
						starpach.accelerate(starpach.leftVector.angle(true), starpach.leftVector.magnitude() * 10);
						starpach.spaceship.body.rotation = starpach.leftVector.angle();
						accelerating = true;
					}
					else {
						starpach.decelerate();
					}
				}

				// Left and right cursors
				if (starpach.cursors.left.isDown) {
					starpach.spaceship.body.angularVelocity = -300;
				}
				else if (starpach.cursors.right.isDown) {
					starpach.spaceship.body.angularVelocity = 300;
				}
				else {
					starpach.spaceship.body.angularVelocity = 0;
				}

				// Wrap spaceship and calculate collisions
				starpach.screenWrap(starpach.spaceship);
				starpach.resolveCollisions();

				//starpach.bullets.forEachExists(starpach.screenWrap, this);

				// Fade out particles from the explosions
				starpach.emitterAsteroid.forEachAlive(function(p){
					p.alpha = p.lifespan / starpach.emitterAsteroid.lifespan;
				});

				starpach.emitterShip.forEachAlive(function(p){
					p.alpha = p.lifespan / starpach.emitterShip.lifespan;
				});
			}

			// Fire bullets
			if (this.game.input.keyboard.isDown(Phaser.Keyboard.SPACEBAR)) {
				starpach.pressButton();
			}
			else {
				starpach.bulletTime = 0;
			}

			// If we are changing level, go to hyper velocity
			if (accelerating || starpach.nextLevel) {
				if (starpach.nextLevel) starpach.starfield.z += 0.01;
				else if (starpach.starfield.z < starpach.starfield.maxVel) starpach.starfield.z += 0.01;
			}
			else {
				if (starpach.starfield.z > 0.08) starpach.starfield.z -= 0.01;
			}
		},

		accelerate: function(rotation, speed) {

			this.game.physics.arcade.accelerationFromRotation(starpach.spaceship.rotation, 500, starpach.spaceship.body.acceleration);

			starpach.spaceship.animations.play('fly', 50, true);
			if (starpach.sfxOn && !starpach.engine.isPlaying) starpach.engine.play('engine');
		},

		decelerate: function() {

			starpach.spaceship.body.acceleration.set(0);
			starpach.spaceship.animations.stop('fly', true);
			if (starpach.sfxOn) starpach.engine.stop();
		},

		pressButton: function() {

			if (starpach.gameState == starpach.states.INIT || starpach.gameState == starpach.states.PAUSED) {
				starpach.updateStates(starpach.states.PLAYING);
			}
			else if (starpach.gameState == starpach.states.DYING) {
				starpach.updateStates(starpach.states.INIT);
			}
			else {
				starpach.fire();
			}
		},

		startSpaceship: function() {

			// Spaceship
			if (starpach.spaceship !== null && starpach.spaceship.exists) starpach.spaceship.kill();
			starpach.spaceship = this.game.add.sprite(this.game.width/2, this.game.height/1.5, 'ship');
			starpach.spaceship.anchor.set(0.7, 0.5);
			starpach.spaceship.animations.add('fly');
			this.game.physics.enable(starpach.spaceship, Phaser.Physics.ARCADE);
			starpach.spaceship.body.drag.set(100);
			starpach.spaceship.body.maxVelocity.set(300);
		},

		respawnSpaceship: function() {

			if (starpach.spaceshipCounter > 20) {
				starpach.spaceship.alpha = 1;
				starpach.spaceshipCounter = 0;
				clearInterval(starpach.spaceshipTimer);
				starpach.spaceshipTimer = null;
			}
			else {
				starpach.spaceshipCounter++;

				if (starpach.spaceship.alpha === 1) {
					starpach.spaceship.alpha = 0;
				} else {
					starpach.spaceship.alpha = 1;
				}
			}
		},

		startAsteroids: function() {

			// Asteroids
			if (starpach.asteroids !== null && starpach.asteroids.exists) starpach.asteroids.removeAll();
			starpach.asteroids = this.game.add.group();
            starpach.asteroids.enableBody = true;
            starpach.asteroids.physicsBodyType = Phaser.Physics.ARCADE;
            starpach.createAsteroids(starpach.asteroids);
		},

		updateStates: function (nextState) {

			starpach.gameState = nextState;

			switch (nextState) {

				case starpach.states.INIT: {
					starpach.startSpaceship();
				}
				break;

				case starpach.states.PAUSED: {
					
				}
				break;

				case starpach.states.PLAYING: {
					starpach.$gameInfo.text('');
					starpach.startAsteroids();
					starpach.updateScore();
				}
				break;

				case starpach.states.DYING: {

					if (starpach.lives === 0) {

						if (starpach.sfxOn) starpach.sfx.play('game-over');

						var messages = ['And yes, everyone else in the room is now looking and judging you',
										'Because of your utter incompetence an Elf died. That\'s like killing a unicorn. Now try living with yourself.',
										'Blame everything and everyone but yourself',
										'Ha ha ha, that was brutal',
										'Nice move, ACE. Really spectacular.',
										'It\'s a sad thing that your adventures have ended here!.',
										'Sadly, no trace of your spaceship was ever found.',
										'Congratulations! You have died.',
										'All crewmembers have died. Your ship will continue to drift for eternity. Or until looters destroy it.',
										'If this were really space, you\'d be banging against your cockpit window screaming to no one as your oxygen slowly ran out and you drifted into infinity and a lonely, lonely death'];
						var gameOver = (starpach.score === 0) ? 'Zero points? If I had hands I\'d be slow clapping right now.' : messages[Math.floor(Math.random()*messages.length)];

						starpach.$scoreBoard.html('Your reached <strong>' + starpach.score + '</strong> points at level <strong>' + starpach.level + '</strong><br />' + gameOver);
						starpach.$gameInfo.html('GAME OVER<br />Press SPACE to start again.');
						if (starpach.asteroids !== null && starpach.asteroids.exists) starpach.asteroids.removeAll();
						starpach.lives = 3;
						starpach.score = 0;
						starpach.level = 1;
					}
					else {
						starpach.lives--;
						starpach.startSpaceship();
						starpach.updateScore();
						starpach.spaceshipTimer = setInterval(starpach.respawnSpaceship, 150);
						starpach.gameState = starpach.states.PLAYING;
					}
				}
				break;

				case starpach.states.LEVELUP: {
					starpach.nextLevel = false;
					starpach.updateStates(starpach.states.PLAYING);
				}
			}
		},

		screenWrap: function(sprite) {

			if (sprite.x < 0)
			{
				sprite.x = this.game.width;
			}
			else if (sprite.x > this.game.width)
			{
				sprite.x = 0;
			}

			if (sprite.y < 0)
			{
				sprite.y = this.game.height;
			}
			else if (sprite.y > this.game.height)
			{
				sprite.y = 0;
			}
		},

		fire: function() {

			if (this.game.time.now > starpach.bulletTime) {
				starpach.bullet = starpach.bullets.getFirstExists(false);

				if (starpach.bullet) {
					starpach.bullet.reset(starpach.spaceship.body.x + 80, starpach.spaceship.body.y + 24);
					starpach.bullet.lifespan = 1000;
					starpach.bullet.rotation = starpach.spaceship.rotation;
					this.game.physics.arcade.velocityFromRotation(starpach.spaceship.rotation, (400 + Math.abs(starpach.spaceship.body.velocity.x + starpach.spaceship.body.velocity.y)), starpach.bullet.body.velocity);
					starpach.bulletTime = this.game.time.now + 1000;
					if (starpach.sfxOn) starpach.sfx.play('fire');
				}
			}
		},

		updateAsteroids: function () {

			starpach.asteroids.forEach((function (item) {
				item.x += item.moveX;
				item.y += item.moveY;
				item.angle += item.rotateAngle;

				if (item.x + item.width < 0) {
					item.x = this.game.width;
				} else if (item.x > this.game.width) {
					item.x = -item.width;
				}
				if (item.y + item.height < 0) {
					item.y = this.game.height;
				} else if (item.y > this.game.height) {
					item.y = -item.height;
				}

			}).bind(this));
		},

		createAsteroids: function (asteroids) {

			asteroids.enableBody = true;

			for (var enemyIndex = 0; enemyIndex < 3 + starpach.level; enemyIndex++) {
				var indexEntry = this.game.rnd.integerInRange(0, 3),
					x, y;

				switch (indexEntry) {
					case 0: x = this.game.world.randomX; y = 0; break;
					case 1: x = this.game.width; y = this.game.world.randomY; break;
					case 2: x = this.game.world.randomX; y = this.game.height; break;
					case 3: x = 0; y = this.game.world.randomY; break;
				}

				var enemy = asteroids.create(x, y, "asteroid" + this.game.rnd.integerInRange(1, 5));
				enemy.moveX = this.game.rnd.integerInRange(-2, 2);

				while (enemy.moveX === 0) {
					enemy.moveX = this.game.rnd.integerInRange(-2, 2);
				}
				enemy.moveY = this.game.rnd.integerInRange(-2, 2);

				while (enemy.moveY === 0) {
					enemy.moveY = this.game.rnd.integerInRange(-2, 2);
				}
				enemy.rotateAngle = this.game.rnd.integerInRange(-2, 2);

				while (enemy.rotateAngle === 0) {
					enemy.rotateAngle = this.game.rnd.integerInRange(-2, 2);
				}
				enemy.asteroidSize = 3;

				asteroids.add(enemy);
				this.game.physics.enable(enemy, Phaser.Physics.ARCADE);
			}

			asteroids.setAll("anchor.x", 0.5);
			asteroids.setAll("anchor.y", 0.5);
		},

		resolveCollisions: function () {

			if (starpach.asteroids.countLiving() > 0 && starpach.spaceshipTimer === null)
				this.game.physics.arcade.overlap(starpach.spaceship, starpach.asteroids, null, starpach.resolveShipCollision);

			if (starpach.bullets.countLiving() > 0)
				this.game.physics.arcade.overlap(starpach.bullets, starpach.asteroids, null, starpach.resolveBulletCollision);
		},

		resolveShipCollision: function (ship, target) {

			starpach.emitterShip.x = ship.x;
			starpach.emitterShip.y = ship.y;
			starpach.emitterShip.start(true, 1500, null, 20);
			if (starpach.sfxOn) starpach.sfx.play('explosion');
			ship.kill();
			starpach.game.time.events.add(1500, starpach.updateStates, this, starpach.states.DYING);
		},

		resolveBulletCollision: function (bullet, asteroid) {

			if ((asteroid.alive) && (bullet.alive)) {

				starpach.score += (3 - asteroid.asteroidSize) * 10;
				starpach.updateScore();

				starpach.emitterAsteroid.x = bullet.x;
				starpach.emitterAsteroid.y = bullet.y;
				starpach.emitterAsteroid.start(true, 1500, null, asteroid.asteroidSize * 10);

				bullet.kill();

				if (asteroid.asteroidSize > 1) {
					if (starpach.sfxOn) starpach.sfx.play('explosion');

					var enemy = asteroid.parent.create(asteroid.x, asteroid.y, "asteroid" + starpach.game.rnd.integerInRange(1, 5));
					enemy.moveX = + starpach.game.rnd.integerInRange(-2, 2);
					enemy.moveY = + starpach.game.rnd.integerInRange(-2, 2);
					enemy.rotateAngle = starpach.game.rnd.integerInRange(-2, 2);
					enemy.asteroidSize = asteroid.asteroidSize - 1;
					enemy.scale.set(0.4 + (0.3 * enemy.asteroidSize));
					enemy.anchor.set(0.5);

					asteroid.parent.add(enemy);
				}
				else {
					if (starpach.sfxOn) starpach.sfx.play('explosion2');

					if (asteroid.parent.countLiving() == 1) {
						starpach.level++;
						starpach.nextLevel = true;
						starpach.$gameInfo.text('Level ' + starpach.level);
						starpach.game.time.events.add(3000, starpach.updateStates, this, starpach.states.LEVELUP);
					}
				}

				asteroid.kill();
			}
		},

		updateScore: function () {

			if (starpach.loadingCompleted) {
				starpach.$scoreBoard.html('Score: <strong>' + starpach.score.toString() + '</strong> | Lives: <strong>' + starpach.lives + '</strong> | Level: <strong>' + starpach.level + '</strong>');
			}
		},

		updateSettings: function(option, value) {

			if (this.game !== null) {
				switch (option) {
					case 'music': {
						this.musicOn = value;
						if (value) this.music.play("track1");
						else this.music.stop();
						break;
					}
					case 'sfx': this.sfxOn = value; break;
					case 'stars': 	if (value) {
										starpach.paused = false;
										requestAnimationFrame(starpach.render);
									}
									else {
										starpach.paused = true;
									}
									break;
					case 'quit': break;
					case 'pause': starpach.updateStates(starpach.states.PAUSED); break;
				}
			}
		},

		resetStar: function(a) {

			a.x = (Math.random() * starpach.windowWidth - (starpach.windowWidth * 0.5)) * starpach.starfield.warpZ;
			a.y = (Math.random() * starpach.windowHeight - (starpach.windowHeight * 0.5)) * starpach.starfield.warpZ;
			a.z = starpach.starfield.warpZ;
			a.px = 0;
			a.py = 0;
		},

		render: function() {

			// Render starfield
			starpach.starfield.context.clearRect(0, 0, starpach.windowWidth, starpach.windowHeight);
			
			if (starpach.spaceship) {
				starpach.starfield.cx = (starpach.spaceship.body.position.x - starpach.windowWidth / 2) + (starpach.windowWidth / 2);
				starpach.starfield.cy = (starpach.spaceship.body.position.y - starpach.windowHeight / 2) + (starpach.windowHeight / 2);
			}

			// update all stars
			var sat = Math.floor(starpach.starfield.z * 500); // Z range 0.01 -> 0.5
			if (sat > 100) sat = 100;

			for (var i = 0; i < starpach.starfield.units; i++) {

				var n = starpach.starfield.stars[i], 	// the star
					xx = n.x / n.z,          			// star X position
					yy = n.y / n.z,						// star Y position
					e = (1.0 / n.z + 1) * 2;   			// size i.e. z

				if (n.px !== 0) {

					// hsl colour from a sine wave
					starpach.starfield.context.strokeStyle = "hsl(30," + sat + "%,85%)";
					starpach.starfield.context.lineWidth = e;
					starpach.starfield.context.beginPath();
					starpach.starfield.context.moveTo(xx + starpach.starfield.cx, yy + starpach.starfield.cy);
					starpach.starfield.context.lineTo(n.px + starpach.starfield.cx, n.py + starpach.starfield.cy);
					starpach.starfield.context.stroke();
				}

				// update star position values with new settings
				n.px = xx;
				n.py = yy;
				n.z -= starpach.starfield.z;

				// reset when star is out of the view field
				if (n.z < starpach.starfield.z || n.px > starpach.windowWidth || n.py > starpach.windowHeight) {
					// reset star
					starpach.resetStar(n);
				}
			}

			// Touch events
			for(i = 0; i < starpach.touches.length; i++) {
				
				var touch = starpach.touches[i],
					c = starpach.starfieldCanvas.getContext( '2d' );
				
				if(touch.identifier == starpach.leftTouchID){
					c.beginPath(); 
					c.strokeStyle = "white"; 
					c.lineWidth = 6; 
					c.arc(starpach.leftTouchStartPos.x, starpach.leftTouchStartPos.y, 40,0,Math.PI*2,true); 
					c.stroke();
					c.beginPath(); 
					c.strokeStyle = "white"; 
					c.lineWidth = 2; 
					c.arc(starpach.leftTouchStartPos.x, starpach.leftTouchStartPos.y, 60,0,Math.PI*2,true); 
					c.stroke();
					c.beginPath(); 
					c.strokeStyle = "white"; 
					c.arc(starpach.leftTouchPos.x, starpach.leftTouchPos.y, 40, 0,Math.PI*2, true); 
					c.stroke(); 
					
				}
				else {
					c.beginPath(); 
					c.strokeStyle = "red";
					c.lineWidth = "6";
					c.arc(touch.clientX, touch.clientY, 40, 0, Math.PI*2, true); 
					c.stroke();
				}
			}

			if (!starpach.paused) requestAnimationFrame(starpach.render);
		},

		resetCanvas: function(e) {  
			// resize the canvas - but remember - this clears the canvas too. 
			starpach.windowWidth = $(window).width(); 
			starpach.windowHeight = $(window).height();

			starpach.halfWidth = starpach.windowWidth/2; 
			starpach.halfHeight = starpach.windowHeight/2;

			starpachCanvas.width = starpach.windowWidth;
			starpachCanvas.height = starpach.windowHeight;
			starfieldCanvas.width = starpach.windowWidth;
			starfieldCanvas.height = starpach.windowHeight;
		},

		onTouchStart: function(e) {

			for(var i = 0; i < e.changedTouches.length; i++) {

				var touch = e.changedTouches[i]; 

				if((starpach.leftTouchID < 0) && (touch.clientX < starpach.halfWidth))
				{
					starpach.leftTouchID = touch.identifier; 
					starpach.leftTouchStartPos.reset(touch.clientX, touch.clientY); 	
					starpach.leftTouchPos.copyFrom(starpach.leftTouchStartPos); 
					starpach.leftVector.reset(0,0); 
					continue; 		
				} else {
					starpach.pressButton(); 
				}	
			}
			starpach.touches = e.touches; 
		},

		onTouchMove: function(e) {

			// Prevent the browser from doing its default thing (scroll, zoom)
			e.preventDefault();
			
			for(var i = 0; i < e.changedTouches.length; i++) {
				var touch = e.changedTouches[i];

				if(starpach.leftTouchID == touch.identifier)
				{
					starpach.leftTouchPos.reset(touch.clientX, touch.clientY); 
					starpach.leftVector.copyFrom(starpach.leftTouchPos); 
					starpach.leftVector.minusEq(starpach.leftTouchStartPos); 	
					break; 		
				}		
			}
			//console.log(starpach.leftTouchPos, starpach.leftVector, starpach.leftTouchStartPos);
			starpach.touches = e.touches;
		},

		onTouchEnd: function(e) {

			starpach.touches = e.touches;

			for(var i = 0; i < e.changedTouches.length; i++) {
				var touch = e.changedTouches[i];

				if (starpach.leftTouchID == touch.identifier) {
					starpach.leftTouchID = -1; 
					starpach.leftVector.reset(0,0); 
					break; 		
				}		
			}
			//console.log(starpach.leftTouchPos, starpach.leftVector, starpach.leftTouchStartPos);
		}
	};

    modules.starpach = starpach;
    return  modules;


})(JM_MODULES || {}, jQuery, window, Phaser);