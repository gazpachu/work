(function(){


/* Box2D circles */
window.requestAnimFrame = (function(){
    return  window.requestAnimationFrame       || 
            window.webkitRequestAnimationFrame || 
            window.mozRequestAnimationFrame    || 
            window.oRequestAnimationFrame      || 
            window.msRequestAnimationFrame     || 
            function(callback, element){
              window.setTimeout(callback, 1000 / 60);
            };
})();

// Keep a reference to the Box2D World
var world;

// The scale between Box2D units and pixels
var SCALE = 30;

// Multiply to convert degrees to radians.
var D2R = Math.PI / 180;

// Multiply to convert radians to degrees.
var R2D = 180 / Math.PI;

// 360 degrees in radians.
var PI2 = Math.PI * 2;

// Box2d "imports"
var b2Vec2 = Box2D.Common.Math.b2Vec2,
    b2BodyDef = Box2D.Dynamics.b2BodyDef,
    b2AABB = Box2D.Collision.b2AABB,
    b2Body = Box2D.Dynamics.b2Body,
    b2FixtureDef = Box2D.Dynamics.b2FixtureDef,
    b2Fixture = Box2D.Dynamics.b2Fixture,
    b2World = Box2D.Dynamics.b2World,
    b2MassData = Box2D.Collision.Shapes.b2MassData,
    b2PolygonShape = Box2D.Collision.Shapes.b2PolygonShape,
    b2CircleShape = Box2D.Collision.Shapes.b2CircleShape,
    b2DebugDraw = Box2D.Dynamics.b2DebugDraw,
    b2Listener = Box2D.Dynamics.b2ContactListener;

// General counter for rules population
var elapsedTime = 0;

// Amount of rules for the initial population
var rulesInit = 12;

// Counter of the total amount of rules on the screen
var rulesCount = 0;

// The current page in the pagination system
var currentPage = 0;

// The total amount of items in the list
var listLength = 0;

// Flag to indicate if it's the start of the app
var firstLoad = true;

// How often (in cycles) do we populate at the beginning
var creationFreqInit = 15;

// Create a new rule every x cycles
var creationFreq = 0;
var creationNormalFreq = 200;
var creationIntenseFreq = 6;

var creationSpot = null;
var creationCenter = null;
var creationLeft = null;
var creationRight = null;

// The amount of resizing pixels to apply per cycle
var resizeFactor = 20;

// Holds the new rule while is being resized
var selectedRules = [];

// Set the counter for the new rule static showcase
var justAdded = false;
var justAddedDelay = -1;

var scrollDirection = 0;
var scrollMax = 40;
var scrollingForce = 100;
var previousTouch = 0;

var isTablet = false;

// We need this to calculate the attraction force
var windowWidth = $(window).width();
var windowHeight = $(window).height();

var $ruleWrapper, $ruleList, $doc;

var domFragment = document.createDocumentFragment();


// This is the main function
function init()
{
    // Create the Box2D World without gravity and allowing bodies to sleep
    world = new b2World( new b2Vec2(0,0), true );

	//Add listeners for contact
	/*var listener = new b2Listener;

	listener.BeginContact = function(contact) {
	  //console.log(contact.GetFixtureA().GetBody());

	}

	listener.EndContact = function(contact) {
	  // console.log(contact.GetFixtureA().GetBody().GetUserData());
	  /*console.log(contact.GetFixtureB().GetBody());

	  if( contact.GetFixtureA().GetBody().GetUserData() == 'ball' || contact.GetFixtureB().GetBody().GetUserData() == 'ball')
	  {
	      var impulse = impulse.normalImpulses[0];
	      if (impulse < 0.2) return; //threshold ignore small impacts
	      world.ball.impulse = impulse > 0.6 ? 0.5 : impulse;
	      console.log(world.ball.impulse);
	  }
	}

	listener.PostSolve = function(contact, impulse)
	{
		/*console.log(contact.GetFixtureA().GetBody());

	  if( contact.GetFixtureA().GetBody().GetUserData() == 'ball' || contact.GetFixtureB().GetBody().GetUserData() == 'ball')
	  {
	      var impulse = impulse.normalImpulses[0];
	      if (impulse < 0.2) return; //threshold ignore small impacts
	      world.ball.impulse = impulse > 0.6 ? 0.5 : impulse;
	      console.log(world.ball.impulse);
	  }
	}

	listener.PreSolve = function(contact, oldManifold) {
	  // PreSolve
	}

	//world.SetContactListener(listener);*/

    $ruleWrapper = $('.rule-wrapper');
    $ruleWrapper.css('width', '100%');
    $ruleWrapper.css('height', '100%');
    $ruleList = $ruleWrapper.find('ul');
    $doc = $(document);

    // Limit the amount of rules on tablets on start
    if( windowWidth < 1100 || windowHeight < 750 )
    {
    	rulesInit = 7;
    	creationIntenseFreq = 14;
    	scrollingForce = 60;
    	isTablet = true;
    }

    //Create the viewport walls
    var w = $ruleWrapper.width();
    var h = $ruleWrapper.height();

    createBox(0,h,w + 500,1, true); // bottom
    //createBox(0,0,1,h, true); // left
    //createBox(w,0,1,h, true); // right
    createBox(0,0,w + 500,1, true); // top

    if( !isTablet )
    {
	    createLogo( 60, 10 ); // logo body
		createWar( windowWidth/2, windowHeight + 15 ); // war body

		// Add the static body for the filter circle
		if( $('.filter-message').length > 0 )
			createFilter( 170, 10 );
	}

	// Add the static body for the new rule
	if( $('.force_first_time_fade_in').length > 0 )
		justAdded = true;

    $('body').css('overflow','hidden');

	// Set default creation frequency
	creationFreq = creationNormalFreq;

	// FadeIn UI
	$('nav ul.right').animate({left:0}, 1000, function(){
		$('.filter-message').animate({opacity:1}, 2000);
		$('.write-a-rule .war').animate({height:80}, 1000);
	});
	

    // Start updating and painting DOM objects and box2d bodies
    loop();
}

// Load new rules
function loadRules( file )
{
	var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];

	// Load rules
	$.getJSON(file, function(data)
	{ 
		$.each(data, function(key, val)
		{
			if( !$("ul .mini-rule[data-rule_id='"+val.id+"']").length ) // Add the new rule only if it's not there already
			{
				var ruleDate = new Date(val.created_at);
				ruleDate = ruleDate.getDate() + " " + monthNames[ruleDate.getMonth()] + " " + ruleDate.getFullYear();

				var liEl = document.createElement('li');
				var newRule = "";

  				if( val.type == 'rule')
  				{
					newRule = "<div class='mini-rule "+val.class_for_mini_rule+"' style='display: none' data-rule_id='"+val.id+"'> \
								    <h3> \
								      <span>Rule &deg;</span> \
								      "+val.id+" \
								    </h3> \
								    <div class='content'> \
								      <p><a href='/rules/"+val.id+"'>"+val.content+"</a></p> \
								    </div> \
								    <div class='meta'> \
								      <span class='author'>"+val.user.full_name+"</span> \
								      <time datetime='"+ruleDate+"'>"+ruleDate+"</time> \
								    </div> \
								    <div class='overlay-bg' id='mini_rule_overlay_bg_"+val.id+"'></div> \
								    <div class='overlay' data-rule_id='"+val.id+"' id='mini_rule_overlay_"+val.id+"'> \
								      <span class='hover-container'> \
								        <section> \
								          <div class='agree' id='agree_link_"+val.id+"'> \
								            <a href='/rules/"+val.id+"/like?from=rules' data-method='post' rel='nofollow'><i class='icons tick'></i> \
								            <strong class='rule-agreed'>Agree</strong> \
								            </a> \
								            <span id='votes_liked'>"+val.cached_votes_up+"</span> \
								          </div> \
								          <div class='disagree' id='disagree_link_"+val.id+"'> \
								            <a href='/rules/"+val.id+"/dislike?from=rules' data-method='post' rel='nofollow'><i class='icons cross'></i> \
								            <strong class='rule-agreed'>Disagree</strong> \
								            </a> \
								            <span id='votes_disliked'>"+val.cached_votes_down+"</span> \
								          </div> \
								        </section> \
								        <span class='view-rule'> \
								          <a href='/rules/"+val.id+"'>View Rule &amp;</a> \
								          <span class='comments'> \
								            "+val.comments_count+" \
								          </span> \
								          <span class='comments-icon'> \
								            Comments \
								          </span> \
								        </span> \
								      </span> \
								    </div> \
								  </div>";
				}
				else
				{
					newRule = "<div class='mini-rule spotlight' data-spotlight_id='2'> \
							    <div class='content'> \
							      <p>"+val.leading_text.toUpperCase()+"</p> \
							      <h4> \
							        <a href='/rules/spotlight/"+val.id+"'>"+val.main_text_row_1+"</a> \
							        <span></span> \
							        <a href='/rules/spotlight/"+val.id+"'>"+val.main_text_row_2+"</a> \
							      </h4> \
							    </div> \
							  </div>";
				}

				liEl.innerHTML = newRule;
				domFragment.appendChild(liEl);
			}
		});

		console.log( "Loaded page " + currentPage );
		$('#pageless').append( domFragment );	
	});
}


function loop()
{
	if( justAddedDelay < 0 )
	{
		elapsedTime++;

		// Check if a body can be created at this point
		if( (elapsedTime > creationFreqInit && rulesCount < rulesInit && firstLoad ) || (elapsedTime > creationFreq) )
		{
			displayRules();
			elapsedTime = 0;

			if( rulesCount >= rulesInit )
				firstLoad = false;

			if( rulesCount == listLength - 10 )
			{
				currentPage++;

				// Load the next page
	    		loadRules("/rules.json?page="+ currentPage );
			}
		}
		else
		{
			update();
	    	paint();
		}
	}
	else
	{
		justAddedDelay--;
		update();
    	paint();
	}

	requestAnimFrame(loop);
}

// Update the DOM and the Box2D world
function update()
{
	world.Step(
    1 / 40 //frame-rate
    , 4 //velocity iterations
    , 50 //position iterations
    );

	world.ClearForces();

	updateDOMObjects();
}

// Update the CSS of the rules
function paint()
{
    for( var b = world.m_bodyList; b; b = b.m_next )
    {
        for( var f = b.m_fixtureList; f; f = f.m_next )
        {
              if( f.m_userData && f.m_userData.domObj )
              {
                   f.m_userData.domObj.css( f.m_userData.css );
              }
         }
    }
}

// Create the DOM objects and the box2d bodies for the rules
function displayRules()
{
	// Find a rule that is hidden
	var $fullList = $ruleList.find('li .mini-rule');
	var $newList = $ruleList.find('li .mini-rule').filter( (rulesCount ? ':gt('+rulesCount+')' : ':eq(0)' )+':hidden');

	listLength = $fullList.length;

	if( $newList.length ) // Only proceed if there are dead bodies
	{
		$newRule = $newList.first();

		var width = 0;
		var mass = new b2MassData();

		if( $newRule.hasClass('small') || $newRule.hasClass('spotlight') )
		{
			width = 244;
			mass.mass = 10;
		}
		else if( $newRule.hasClass('medium') )
		{
			width = 347;
			mass.mass = 75;
		}
		else if( $newRule.hasClass('high') )
		{
			width = 481;
			mass.mass = 150;
		}

		// The update function will grab this value to resize the rule
		$newRule.data( 'resizeTo', width );
		$newRule.data( 'direction', 'up' );

		// Initialize the rule style
		$newRule.css('width', 1);
		$newRule.css('height', 1);
		$newRule.css('left', 0);
		$newRule.css('top', 0);
		$newRule.css('display', 'inline');

		// Number of life cycles for a given rule
		var ruleLife = Math.floor(Math.random() * 5000) + 2000;

		// Get the cached body from the DOM
		var body = $newRule.data("box2dBody");

		if( scrollDirection == '' )
		{
			var plusOrMinus = Math.random() < 0.5 ? -1 : 1;
		    creationCenter = new b2Vec2( ((windowWidth / 2) + (Math.random()*30*plusOrMinus)) / SCALE, ((windowHeight / 2) + (Math.random()*30*plusOrMinus) ) / SCALE );
			creationSpot = creationCenter;
		}

		if( !body ) // Create a new one if there's none cached
		{
			if( rulesCount == 0 && justAdded == true ) // If the user has just added a new rule, create a static circle in the center of the screen
				body = createRule( (windowWidth / 2), (windowHeight / 2), 244, true);
			else
				body = createRule( null, null, 1);
		}

		body.m_userData = null;
		body.m_userData = { domObj:$newRule, life:ruleLife, css:'' };
		body.m_body.SetActive(true);

		for( var f = body.m_body.m_fixtureList; f; f = f.m_next )
			f.GetShape().m_radius = 1 / SCALE;

		if( !justAdded )
			body.m_body.SetPosition( creationSpot );
		else
		{
			body.m_userData = { domObj:$newRule, life:ruleLife, css:'', id:'new' };
			justAdded = false;
			justAddedDelay = 200;
		}

		// Set the mass of the body
		//body.m_body.SetMassData( mass ); 

		// Cache the box2d body in the DOM object
		$newRule.data( "box2dBody", body );

		$newRule.find('.content').css('opacity', 0);
		$newRule.find('.meta').css('opacity', 0);
		$newRule.find('h3').css('opacity', 0);

		var l = $newRule.css('left');
		var t = $newRule.css('top');
		var font = 1;

		l = -(width / 2);
		t = -(width / 2);

		if( width > 240 )
			font = Math.max(Math.min(width / 15, parseFloat(Number.POSITIVE_INFINITY)), parseFloat(Number.NEGATIVE_INFINITY));
		else
			font = 0;

		// Start the resize animation
		$newRule.animate(
	    {
	    	width: width,
	    	height: width,
	    	left: l,
	    	top: t
	    },
	    	isTablet ? 500 : 2000, // how fast we are animating
	    	isTablet ? 'swing' : 'easeOutBounce', // the type of easing
		    function() {
		    	var content = $(this).find('.content');
		    	var meta = $(this).find('.meta');
		    	var num = $(this).find('h3');
		    	content.css('font-size', font);
				content.animate({opacity:1});
				meta.animate({opacity:1});
				num.animate({opacity:1});
		    }
	    );

		
		// Push the object to be resized
		selectedRules.push( $newRule );

		rulesCount++;
	}
	else
	{
		// Reset the list
		rulesCount = 1;
	}

	//console.log( "Rule: " + rulesCount + " of " + listLength );

	$newRule = null;
}

// This creates the walls in box2d
function createBox( x, y, width, height, static )
{
    var bodyDef = new b2BodyDef;
    bodyDef.type = static ? b2Body.b2_staticBody : b2Body.b2_dynamicBody;
    bodyDef.position.x = x / SCALE;
    bodyDef.position.y = y / SCALE;
    bodyDef.fixedRotation = true;

    var fixDef = new b2FixtureDef;
    fixDef.density = 0;
    fixDef.friction = 0;
    fixDef.restitution = 0;

    fixDef.shape = new b2PolygonShape;
    fixDef.shape.SetAsBox(width / SCALE, height / SCALE);
    return world.CreateBody(bodyDef).CreateFixture(fixDef);
}

function createLogo(x, y)
{
    var bodyDef = new b2BodyDef;
    bodyDef.type = b2Body.b2_staticBody;
	bodyDef.position.x = x / SCALE;
    bodyDef.position.y = y / SCALE;
    bodyDef.fixedRotation = true;

    var fixDef = new b2FixtureDef;
    fixDef.density = 0;
    fixDef.friction = 0;
    fixDef.restitution = 0;

    fixDef.shape = new b2CircleShape;
    fixDef.shape.SetRadius(109 / SCALE);
    var logoBody = world.CreateBody(bodyDef).CreateFixture(fixDef);
    logoBody.m_userData = { id:'logo', life:-1 };
}

function createFilter(x, y)
{
    var bodyDef = new b2BodyDef;
    bodyDef.type = b2Body.b2_staticBody;
    bodyDef.position.x = x / SCALE;
    bodyDef.position.y = y / SCALE;
    bodyDef.fixedRotation = true;

    var fixDef = new b2FixtureDef;
    fixDef.density = 0;
    fixDef.friction = 0;
    fixDef.restitution = 0;

    fixDef.shape = new b2CircleShape;
    fixDef.shape.SetRadius(196 / SCALE);
    var filterBody = world.CreateBody(bodyDef).CreateFixture(fixDef);
    filterBody.m_userData = { id:'filter', life:-1 };
}

function createWar(x, y)
{
    var bodyDef = new b2BodyDef;
    bodyDef.type = b2Body.b2_staticBody;
    bodyDef.position.x = x / SCALE;
    bodyDef.position.y = y / SCALE;
    bodyDef.fixedRotation = true;

    var fixDef = new b2FixtureDef;
    fixDef.density = 0;
    fixDef.friction = 0;
    fixDef.restitution = 0;

    fixDef.shape = new b2PolygonShape;
    fixDef.shape.SetAsBox(60 / SCALE, 80 / SCALE);
    var warBody = world.CreateBody(bodyDef).CreateFixture(fixDef);
    warBody.m_userData = { id:'war', life:-1 };
}

// 
function createRule( x, y, radius, static )
{
    var bodyDef = new b2BodyDef;
    bodyDef.type = static ? b2Body.b2_staticBody : b2Body.b2_dynamicBody;
    bodyDef.fixedRotation = true;
    bodyDef.linearDamping = 2;

    if( x && y )
    {
    	bodyDef.position.x = x / SCALE;
    	bodyDef.position.y = y / SCALE;
    }

    var fixDef = new b2FixtureDef;
    fixDef.density = 0;
    fixDef.friction = 0;
    fixDef.restitution = 0;

    fixDef.shape = new b2CircleShape;
    fixDef.shape.SetRadius(radius / SCALE);
    return world.CreateBody(bodyDef).CreateFixture(fixDef);
}

//Animate DOM objects
function updateDOMObjects()
{
    var offset = 0;
    var css = '';
    var bodyCount = 0;

    for( var b = world.m_bodyList; b; b = b.m_next )
    {
        for( var f = b.m_fixtureList; f; f = f.m_next )
        {
			if( f.m_userData ) // Only of the body is linked with a DOM object (Rule)
			{
				if( scrollDirection != 0 )
		    	{
		    		f.m_body.SetAwake(true);
		    	}

				// Hide the body
				if( f.m_userData.life <= 0)
				{
					if( f.m_userData.id != 'logo' && f.m_userData.id != 'filter' && f.m_userData.id != 'war' )
					{
						css = { 'display':'none' };
						b.SetActive(false);
					}
				}
				else if( f.m_userData.life > 0 )
				{
					//if( b.IsAwake() )
					//{
					    //Retrieve positions from the Box2d world
					    var x = Math.floor( f.m_body.m_xf.position.x * SCALE );
					    var y = Math.floor( f.m_body.m_xf.position.y * SCALE );

						var ruleWidth = parseInt( f.m_userData.domObj[0].style.width, 10 );
						
						if( (x + ruleWidth ) > 0 && x < ( windowWidth + ruleWidth ) )
						{
							if( scrollDirection == 0 )
							{
								var dX = offset + ( (windowWidth/2) / 2 ) - x; // Get the screen center X
								var dY = (windowHeight/3) - y; // Get the screen center Y
								var distance = Math.floor( Math.sqrt( Math.pow( dX, 2) + Math.pow( dX, 2) ) ); // Get the distance between the body and the screen center position
								var rads = Math.atan2( dY, dX ); // Get the angle from the triangle between the body position and the screen center position
								var accel = Math.max( 0, ( distance - ((windowWidth/2) / 3) ) / 1000 );
								var xVel = accel * Math.cos( rads ); // Get the new acceleration in the X asis
								var yVel = accel * Math.sin( rads ); // Get the new acceleration in the Y asis

								if( xVel > 0.02 || yVel > 0.02 )
								{
									f.m_body.ApplyForce( new b2Vec2( xVel * 20, yVel * 20 ), new b2Vec2( f.m_body.m_xf.position.x, f.m_body.m_xf.position.y ) );

									// Prepare coordinates to apply to the DOM
									x = Math.floor( x + xVel );
									y = Math.floor( y + yVel );
								}

								creationFreq = creationNormalFreq;
								creationSpot = creationCenter;
							}
							else if( scrollDirection < 0 )
							{
								f.m_body.ApplyForce( new b2Vec2( -scrollingForce, 0 ), new b2Vec2( f.m_body.m_xf.position.x, f.m_body.m_xf.position.y ) );
								scrollDirection++;
							}
							else if( scrollDirection > 0 )
							{
								f.m_body.ApplyForce( new b2Vec2( scrollingForce, 0 ), new b2Vec2( f.m_body.m_xf.position.x, f.m_body.m_xf.position.y ) );
								scrollDirection--;
							}

							if( !firstLoad && f.m_userData.id == 'new' )
								f.m_body.SetType( b2Body.b2_dynamicBody );
						}
						else
						{
							// Kill the rule if its out of the viewport
							f.m_userData.life = 0;
						}

					    css = {	'-webkit-perspective':'1000',
					    		'-webkit-backface-visibility':'hidden',
					    		'-webkit-transform-style':'preserve-3d',
					    		'display':'inline',
					    		'-webkit-transform':'translate3d(' + x + 'px,' + y + 'px, 0)',
					    		'-moz-transform':'translate3d(' + x + 'px,' + y + 'px, 0)',
					    		'-ms-transform':'translate(' + x + 'px,' + y + 'px)',
					    		'-o-transform':'translate3d(' + x + 'px,' + y + 'px, 0)',
					    		'transform':'translate3d(' + x + 'px,' + y + 'px, 0)'
					    	};
					/*}
					else
					{
					    css = '';
					}*/

					//console.log(selectedRules.length);

					// Resize bodies and DOM rules
					for( var i = 0; i < selectedRules.length; i++ )
					{
						var rule_id = selectedRules[i].attr('data-rule_id');
						var spotLight_id = -1;

						if( !rule_id )
						{
							rule_id = -1;
							spotLight_id = selectedRules[i].attr('data-spotlight_id');
						}

						if( (rule_id > 0 && rule_id == f.m_userData.domObj.attr('data-rule_id')) || (spotLight_id > 0 && spotLight_id == f.m_userData.domObj.attr('data-spotlight_id')) )
						{
							var direction = selectedRules[i].data('direction');
							//var newRadius = parseInt( f.m_userData.domObj[0].style.width, 10 ) / 2;

							if( direction != 'none' )
							{
								//if( !world.IsLocked() )
								//{
									//f.m_body.SetAwake( true );
									//f.GetShape().Set(new b2CircleShape( newRadius / SCALE));
									
									//b.ResetMassData();

									// Get the current values of the rule
									var w = selectedRules[i].width();

									f.GetShape().m_radius = (w/2) / SCALE;
									/*var l = selectedRules[i].css('left');
									var t = selectedRules[i].css('top');
									var font = 1;*/
									var resizeTo = selectedRules[i].data('resizeTo');
									//var resizeDirection = 1;

									if( direction == 'up' && w == resizeTo )
										selectedRules[i].data('direction', 'none');

									/*{
										if( w < resizeTo )
											w += resizeFactor;
										else if( w > resizeTo )
											w = resizeTo;
									}
									else if( direction == 'down' )
									{
										if( w > resizeTo )
											w -= resizeFactor;
										else if( w < resizeTo )
											w = resizeTo;
									}
									else
										

									/*l = -(w / 2);
									t = -(w / 2);

									if( w > 240 )
										font = Math.max(Math.min(w / 15, parseFloat(Number.POSITIVE_INFINITY)), parseFloat(Number.NEGATIVE_INFINITY));
									else
										font = 0;

									css['font-size'] = font + 'px';
									css['left'] = l + 'px';
									css['top'] = t + 'px';
									css['width'] = w + 'px';
									css['height'] = w + 'px';*/

									//console.log("w: " + w + ", resizeTo: " + resizeTo + ", factor: " + resizeFactor + ", dir: " + resizeDirection );
									//console.log(css['width']);
								//}
							}
							else
							{
								selectedRules.splice(i,1);
							}

							break; // Get out of the loop
						}
					}
				}

				f.m_userData.css = css;
			}
        }
        bodyCount++; // bodies counter
    }
}

// Page events
$(document).ready(function()
{
	//$.publish('loadHomePage');

	if( $(".error-page").length === 0 && $('#pageless').length > 0 )
	{
		init();

		var $rule = $('.mini-rule').not('.spotlight');

		$ruleList.on("mouseenter", ".mini-rule", function()
		{
			var $this = $(this);

			if( !$this.hasClass('spotlight') && $this.data('direction') == 'none' )
			{
				$this.find('.overlay-bg').fadeIn();
				$this.find('.overlay').css('display', 'table');
				$this.find('.overlay').animate({opacity:1}, 300);

				/*if( windowHeight > 700 )
				{
					$this.data( 'oldWidth', $this.width() );
					$this.data( 'resizeTo', 481 );
					$this.data( 'direction', 'up' );
					selectedRules.push( $this );
				}*/
			}
		});

		$ruleList.on("mouseleave", ".mini-rule", function()
		{
			/*if( windowHeight > 700 )
			{
				var $this = $(this);

				$this.data( 'resizeTo', $this.data( 'oldWidth' ) );
				$this.data( 'direction', 'down' );
				selectedRules.push( $this );
			}*/

			$('.overlay-bg').fadeOut();
			$('.overlay').animate({opacity:0});
		});

		if( $rule.length )
		{
		    // Scroll the body with the mouse wheel. Use document for Firefox
		    $('body').bind('mousewheel', function(event, delta, deltaX, deltaY)
		    {
			scrollRules( delta );

				event.preventDefault();
		    });

		    document.addEventListener('touchstart', function(e)
		    {
		    	var touch = e.touches[0];
		    	previousTouch = touch.pageX;
		    	//e.preventDefault();

		    }, false);

		    document.addEventListener('touchmove', function(e)
		    {
			    var touch = e.touches[0];

			    if( previousTouch > touch.pageX )
			    	scrollRules( -1, 60 );
			    else if( previousTouch < touch.pageX )
			    	scrollRules( 1, 60 );

			    e.preventDefault();

			}, false);

			/*window.ondevicemotion = function(event)
			{  
				var delta = Math.sin( event.accelerationIncludingGravity.x * Math.PI / 180 );
			    scrollRules( delta ); 
			}*/

			function scrollRules( delta, amount )
			{
				if( !amount )
					amount = 30;

				// Create a new body in the center of the viewport
				var plusOrMinus = Math.random() < 0.5 ? -1 : 1;
				var newY = 0;

				if( isTablet )
					newY = ((windowHeight / 2) + (Math.random()*200*plusOrMinus)) / SCALE;
				else
					newY = ((windowHeight / 2) + (Math.random()*(windowHeight / 2)*plusOrMinus) ) / SCALE;

				if( delta > 0 && scrollDirection >= 0 && scrollDirection < scrollMax )
				{
					creationLeft = new b2Vec2( 100 / SCALE, newY );
					creationFreq = creationIntenseFreq;
					creationSpot = creationLeft;
					scrollDirection += amount;
				}
				else if( delta < 0 && scrollDirection <= 0 && scrollDirection > -scrollMax )
				{
					creationRight = new b2Vec2( (windowWidth - 50) / SCALE, newY );
					creationFreq = creationIntenseFreq;
					creationSpot = creationRight;
					scrollDirection -= amount;
				}

				if( scrollDirection == 0 )
				{
					creationCenter = new b2Vec2( ((windowWidth / 2) + (Math.random()*30*plusOrMinus)) / SCALE, ((windowHeight / 2) + (Math.random()*30*plusOrMinus) ) / SCALE );
				}	
			}
		}
	}
});

})();
