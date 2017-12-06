<?php
  session_start();
?>

<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php
if (isset($_POST["email"]) ) 
{
    mysql_select_db('stonesga_ch30', $connection) or die('no database');	
	  
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
    
	// 在member資料表內插入一筆新的紀錄
	$query = sprintf("INSERT INTO subscribe (email, datetime) VALUES ( %s, %s )",  
		GetSQLValue($_POST['address'], "text"),
        GetSQLValue($datetime, "date"));
    
    $result = mysql_query($query, $connection);
    
    if ($result)  {
    echo "<script>
alert('Thank you for the subscription, Please check your email constantly.');
window.location.href='main';
</script>";
    };
} 
?>    
    
<!DOCTYPE HTML>
<!--
	Landed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>STONE</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="landing">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<h1 id="logo"><a href="main"><img src="images/pic-banner.png" alt="STONE" width="130" height="60"></a></h1>
					<nav id="nav">
						<ul>
							<li><a href="main">Home</a></li>
							<li>
								<a href="#">Games</a>
								<ul>
									<li><a href="store.php">Adventure</a></li>
									<li><a href="action.php">Action</a></li>
									<li><a href="strategy.php">Strategy</a></li>
									<li><a href="sports.php">Sports</a></li>
                                    <li><a href="multiplay.php">Multiplay</a></li>
								</ul>
							</li>
							<li><a href="about.php">Support</a></li>
							<li><a href="member_new.php" class="button special">Sign Up</a></li>
						</ul>
					</nav>
				</header>

			<!-- Banner -->
				<section id="banner">
					<div class="content">
						<header>
							<h2>STONE</h2>
							<b><p>The most popular digital distribution platform.<br />
                                Just Games. Lots of funs.</p></b>
						</header>
						<span class="image"><img src="images/pic01.png" alt="" /></span>
					</div>
					<a href="#one" class="goto-next scrolly">Next</a>
                    
				</section>

			<!-- One -->
				<section id="one" class="spotlight style1 bottom">
					<span class="image fit main"><img src="images/fps.jpg" alt="" /></span>
					<div class="content">
						<div class="container">
							<div class="row">
								<div class="4u 12u$(medium)">
									<header>
										<h2>STONE - The BIGGEST digital games online shop</h2>
										<p>We provide thousand of games for our customers including DLC or patches</p>
									</header>
								</div>
								<div class="4u 12u$(medium)">
									<p>STONE is a digital distribution platform developed by KENIP Corporation offering digital rights management (DRM), multiplayer gaming and social networking services. Our services spread all over the world including North America, Europe and Asia</p>
								</div>
								<div class="4u$ 12u$(medium)">
									<p>STONE provides the user with installation and automatic updating of games on multiple computers, and community features such as friends lists and groups, cloud saving, and in-game voice and chat functionality.</p>
								</div>
							</div>
						</div>
					</div>
					<a href="#two" class="goto-next scrolly">Next</a>
				</section>

			<!-- Two -->
				<section id="two" class="spotlight style2 right">
					<span class="image fit main"><img src="images/lara.jpg" alt="" /></span>
					<div class="content">
						<header>
							<h2>STONE - The most easiest shopping platform</h2>
							<p>Only fews of steps then enjoy your games everywhere and everytime</p>
						</header>
						<p>STONE's primary service is to allow our users to download games and other software that they have in their virtual software libraries to their local computers as game cache files (GCFs). Once the software is downloaded and installed, the user can then authenticate through STONE's server to de-encrypt the executable files to play the game.</p>
						<ul class="actions">
							<li><a href="" class="button" id="pop1">Learn More</a></li>
						</ul>
					</div>
					<a href="#three" class="goto-next scrolly">Next</a>
                    
                    <!------------------- POPUP -------------------->
                    
                    <div id="popup">
                        <div id="popup-content">
                        <h1>Convenient Gameing Style</h1>
    <p>Normally it is done while connected to the Internet following the user's credential validation, but once they have logged into STONE once, a user can instruct STONE's server to launch in a special offline mode to be able to play their games without a network connection. </p>
                            
    <button id="close">Close me</button>
  </div>
  <div id="popup-bg"></div>
  </div>
                    
				</section>

			<!-- Three -->
				<section id="three" class="spotlight style3 left">
					<span class="image fit main bottom"><img src="images/game2.jpg" alt="" /></span>
					<div class="content">
						<header>
							<h2>Brilliant Games Management</h2>
							<p>Easy and simple way to manage your games,dlcs,mods and saves files.</p>
						</header>
						<p>We added support for Stone Cloud, a service that can automatically store saved game and related custom files on STONE's servers; users can access this data from any machine running the Steam client.</p>
						<ul class="actions">
							<li><a href="" class="button" id="pop2">Learn More</a></li>
						</ul>
					</div>
					<a href="#four" class="goto-next scrolly">Next</a>
                    <!------------------- POPUP2 -------------------->
                    
                    <div id="popup2">
                        <div id="popup-content2">
                        <h1>Manage with Cloud Server</h1>
    <p>Our service added the ability for users to manage their game libraries from remote clients, including computers and mobile devices; users can instruct STONE to download and install games they own through this service if their STONE client is currently active and running.</p>
    <button id="close2">Close me</button>
  </div>
  <div id="popup-bg"></div>
  </div>
                    
				</section>

			<!-- Four -->
				<section id="four" class="wrapper style1 special fade-up">
					<div class="container">
						<header class="major">
							<h2>JOIN STONE RIGHT NOW</h2>
							<p>There are so many services and features that we can provide as below </p>
						</header>
    <section class="logo1">             
            <article>
              <img src="images/gamepad.png" class="mainlogo" alt="game">
              <h1>Game</h1>
              <P>Thousand of games in our server</P>
            </article>
            
         <article>
          <img src="images/shop.png" class="mainlogo" alt="shop">
        <h1>Shop</h1>
              <P>Many ways to paid for your favourite game</P>
        </article>
        
        <article>
          <img src="images/folder.png" class="mainlogo" alt="shop">
        <h1>Documentation</h1>
              <P>Auto configuration and files management </P>
        </article>
        
         <article>
          <img src="images/cloud.png" class="mainlogo" alt="shop">
        <h1>Cloud</h1>
              <P>Support Cloud server management - Auto save configuration and document</P>
        </article>
        </section>
        
        <section class="logo2">
            <article>
          <img src="images/safebox.png" class="mainlogo" alt="shop">
        <h1>Security</h1>
              <P>Provide STRONG firewall protection</P>
            </article>
            <article>
          <img src="images/internet.png" class="mainlogo" alt="shop">
        <h1>Community</h1>
              <P>Join STONE community to discuss with friends</P>
            </article>
            <article>
          <img src="images/apps.png" class="mainlogo" alt="shop">
        <h1>Apps</h1>
              <P>Manage your account with mobile apps</P>
            </article>
            <article>
          <img src="images/support.png" class="mainlogo" alt="shop">
        <h1>Support</h1>
              <P>Provide technical support for our customer</P>
            </article>
        </section>
                   
       <section id="tohome">
						<footer class="major">
							<ul class="actions">
								<li><a href="main" class="button">SHOP NOW!</a></li>
							</ul>
						</footer>
					</div>
                    </section>
				</section>

			<!-- Five -->
				<section id="five" class="wrapper style2 special fade">
					<div class="container">
						<header>
							<h2>Wish for more information and news about us?</h2>
							<p>Put down your email here! We would like to share with you more!</p>
						</header>
						<form method="post" action="#" class="container 50%">
							<div class="row uniform 50%">
								<div class="8u 12u$(xsmall)"><input type="email" name="address" id="email" placeholder="Your Email Address" required/></div>
								<div class="4u$ 12u$(xsmall)"><input type="submit" value="Get Started" class="fit special" name="email"/></div>
							</div>
						</form>
					</div>
				</section>

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon alt fa-linkedin"><span class="label">LinkedIn</span></a></li>
						<li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon alt fa-github"><span class="label">GitHub</span></a></li>
						<li><a href="#" class="icon alt fa-envelope"><span class="label">Email</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; STONE 2016-2017. All rights reserved.</li><li>Design: <a href="http://www.youtube.com/user/apple00032">KEN IP</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>