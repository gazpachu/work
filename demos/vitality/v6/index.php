<?php
$prizes = ['5', '10', '15', '20', 'song'];
$selected = array_rand($prizes);
$prize = $prizes[$selected];
$message = "";

if ($selected != 'song') $message = 'AN ITUNES VOUCHER';
else $message = 'A SONG';
?>

<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
     <head>
          <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
          <title>PruHealth animation prototype</title>
          <link rel="stylesheet" href="css/main.css">
     </head>
     <body>
          <div id="container">
               <canvas id="canvas"></canvas>
               <div id="white-circle">
                    <h1>REVEAL ITUNES REWARD</h1>
                    <h2>Before the end of this month</h2>
               </div>
               <div id="gifts">
                    <h3>GIFTS INCLUDE</h3>
                    <span>SONG</span>
                    <span>VOUCHER</span>
               </div>
               <div id="congrats" style="display: none">
                    <h1>CONGRATULATIONS!</h1>
                    <p>John Smith,<br />Your reward this month</p>
                    <h2 id="gift-copy"><?php echo $message; ?></h2>
                    <img id="gift-image" src="img/prize-<?php echo $prize; ?>.png" data-prize="<?php echo $prize; ?>" alt="iTunes reward" width="300" height="210" />
               </div>
          </div>

          <script type="text/javascript" src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
          <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>

          <!--[if gt IE 8]><!-->
               <script type="text/javascript" src="js/Box2dWeb-2.1.a.3.js"></script>
               <script type="text/javascript" src="js/node.js"></script>
               <script type="text/javascript" src="js/physics.js"></script> 
          <!--<![endif]-->

          <!--[if IE 8]>
               <script>var Box2D = null;</script>
               <script type="text/javascript" src="js/jquery.color-2.1.2.min.js"></script>
          <![endif]-->

          <script type="text/javascript" src="js/main.js"></script>
     </body>
</html>