         var mouseX, mouseY, mousePVec, isMouseDown, selectedBody, mouseJoint, clickedX, clickedY, clicked;
         var canvasPosition = getElementPosition(document.getElementById("canvas"));
         var doubleClicked = null;

         var mouse = MouseAndTouch(document, downHandler, upHandler, moveHandler);
         
         function downHandler(x,y) {
            isMouseDown = true;
            moveHandler(x,y);
            clickedX = x;
            clickedY = y;
            clicked = true;
         }
         
         function upHandler(x,y) {
            isMouseDown = false;
            mouseX = undefined;
            mouseY = undefined;
         }
         
         function moveHandler(x,y) {
            mouseX = (x - canvasPosition.x) / 30;
            mouseY = (y - canvasPosition.y) / 30;
         }
         
         function getBodyAtMouse() {
            mousePVec = new b2Vec2(mouseX, mouseY);
            var aabb = new b2AABB();
            aabb.lowerBound.Set(mouseX - 0.001, mouseY - 0.001);
            aabb.upperBound.Set(mouseX + 0.001, mouseY + 0.001);
            
            // Query the world for overlapping shapes.

            selectedBody = null;
            world.QueryAABB(getBodyCB, aabb);

            if( selectedBody && doubleClicked )
            {
               console.log("body");
               doubleClicked = null;
            }

            return selectedBody;
         }

         function getBodyCB(fixture) {
            if(fixture.GetBody().GetType() != b2Body.b2_staticBody) {
               if(fixture.GetShape().TestPoint(fixture.GetBody().GetTransform(), mousePVec)) {
                  selectedBody = fixture.GetBody();
                  return false;
               }
            }
            return true;
         }

         function getElementPosition(element) {
            var elem=element, tagname="", x=0, y=0;
           
            while((typeof(elem) == "object") && (typeof(elem.tagName) != "undefined")) {
               y += elem.offsetTop;
               x += elem.offsetLeft;
               tagname = elem.tagName.toUpperCase();

               if(tagname == "BODY")
                  elem=0;

               if(typeof(elem) == "object") {
                  if(typeof(elem.offsetParent) == "object")
                     elem = elem.offsetParent;
               }
            }

            return {x: x, y: y};
         }


         function updateMouseDrag() {
            if(isMouseDown && (!mouseJoint)) {
               var body = getBodyAtMouse();

               if( clicked && !body )
               {
                  // Get a random rule class name
                  var rule = rules[Math.floor(Math.random() * rules.length)][0];

                  createDOMObject(clickedX, clickedY, rule);
                  clicked = false;
               }

               if(body) {
                  var md = new b2MouseJointDef();
                  md.bodyA = world.GetGroundBody();
                  md.bodyB = body;
                  md.target.Set(mouseX, mouseY);
                  md.collideConnected = true;
                  md.maxForce = 300.0 * body.GetMass();
                  mouseJoint = world.CreateJoint(md);
                  body.SetAwake(true);
               }
            }

            if(mouseJoint) {
               if(isMouseDown) {
                  mouseJoint.SetTarget(new b2Vec2(mouseX, mouseY));
               } else {
                  world.DestroyJoint(mouseJoint);
                  mouseJoint = null;
               }
            }
         }