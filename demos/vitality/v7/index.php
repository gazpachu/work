<?php

// These vars can be changed to other values
$prizes = ['5', '10', '15', '20', 'song']; // possible prizes (array)
$username = 'John Smith'; // User name (string)
$period = 'Your reward this month'; // Copy to display on the prize screen (string)
$sessionLife = 2592000; // Session life: 1800 = 30min, 86400 = 1day, 2592000 = 1month
$expiry = '15 December 2015'; // Copy with the expire date to display
$p1color = "#3f7f7c"; // Particles color for first animation (default: #5BB5B3)
$p2color = "#5ab6b2"; // Particles color for second animation (default: #5BB5B3)
$revealedEnabled = false;

// These are local vars for the randomization script
$message = ""; // Copy for congratulations screen (string)
$prize = ""; // Selected prize from the prizes array (string)
$revealed = false; // Flag for prize already revealed (bool)

if ($revealedEnabled) {

     /****************************************************************
     /* Example with PHP sessions to store the prize already revealed
     /***************************************************************/

     // Start the session
     if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

     if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $sessionLife)) {
         // last request was more than 30 minutes ago
         session_unset();     // unset $_SESSION variable for the run-time 
         session_destroy();   // destroy session data in storage
     }

     // Retrieve prize if the user already revealed it
     if (isset($_SESSION['revealed'])) {
          $revealed = true;
          $prize = $_SESSION['revealed'];
     }
     else {
          $selected = array_rand($prizes);
          $prize = $prizes[$selected];
     }

     // Update copy based on selected prize
     if ($prize != 'song') $message = 'AN ITUNES VOUCHER';
     else $message = 'A SONG';

     // Set the session var for the next time
     $_SESSION['revealed'] = $prize;

     // Update last activity time stamp
     $_SESSION['LAST_ACTIVITY'] = time();
}
else {

     /****************************************************************
     /* Example without PHP session (always reveals a new prize)
     /***************************************************************/
     if (session_status() !== PHP_SESSION_ACTIVE) {session_start(); session_destroy();}

     $selected = array_rand($prizes);
     $prize = $prizes[$selected];

     // Update copy based on selected prize
     if ($prize != 'song') $message = 'AN ITUNES VOUCHER';
     else $message = 'A SONG';
}

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
          <link rel="stylesheet" href="css/itunes-reward-main.css">
          <link rel="stylesheet" href="css/fonts/font-min.css">
     </head>
     <body>
          <div id="ir-anim-container" class="<?php if($revealed) echo 'revealed'; ?>" data-p1color="<?php echo $p1color; ?>" data-p2color="<?php echo $p2color; ?>">
               <canvas id="ir-anim-canvas"></canvas>
               <div id="white-circle">
                    <h1>REVEAL ITUNES REWARD</h1>
                    <h2>Before the end of this month</h2>
               </div>
               <div id="gifts">
                    <h3>GIFTS INCLUDE</h3>
                    <span>SONG</span>
                    <span>VOUCHER</span>
               </div>
               <div id="congrats">
                    <h1>CONGRATULATIONS!</h1>
                    <p id="user-copy"><?php echo $username; ?>,<br /><?php echo $period; ?></p>
                    <h2 id="gift-copy"><?php echo $message; ?></h2>
                    <img id="gift-image" src="img/prize-<?php echo $prize; ?>.png" data-prize="<?php echo $prize; ?>" alt="iTunes reward" width="300" height="210" />
                    <img id="download-on-itunes" src="img/itunes.png" alt="Download on iTunes" width="195" height="70" />
                    <p>Expires <strong><?php echo $expiry; ?></strong></p>
                    <p>This is a promotional code and is not for resale, has no cash value, and will not be replaced if lost or stolen. Valid only on the UK iTunes Store. Requires iTunes account. Terms and Apple Privacy Policy apply,</p>
                    <p><a href="www.apple.com/legal/itunes/uk/terms.html" target="_blank">www.apple.com/legal/itunes/uk/terms.html</a></p>
                    <p>Must be 13+ and in United Kingdom. iTunes 10.0 or later, compatible products and services required. This promotion is not sponsored by iTunes or Apple.<br />© 2014 iTunes S.à.r.l.</p>
               </div>
          </div>

          <script type="text/javascript" src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
          <script type="text/javascript" src="js/vendor/jquery-1.11.2.min.js"></script>

          <!--[if gt IE 8]><!-->
               <script type="text/javascript" src="js/vendor/Box2dWeb-2.1.a.3.min.js"></script>
               <script type="text/javascript" src="js/itunes-reward-node.js"></script>
               <script type="text/javascript" src="js/itunes-reward-physics.js"></script> 
          <!--<![endif]-->

          <!--[if IE 8]>
               <script>var Box2D = null;</script>
               <script type="text/javascript" src="js/vendor/jquery.color-2.1.2.min.js"></script>
          <![endif]-->

          <script type="text/javascript" src="js/itunes-reward-main.js"></script>
     </body>
</html>