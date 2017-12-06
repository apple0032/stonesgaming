<?php
  session_start();
?>

<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php 

$_SESSION['PrevPage'] = $_SERVER['PHP_SELF']; 

if(!isset($_SESSION['bgheader']) ){
    $_SESSION['bgheader'] = "bannerjpg" ;
};

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>STONE</title>
<link rel="stylesheet" href="assets/css/main2.css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="assets/js/main2.js"></script>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script> 
<script src="https://cdn.jsdelivr.net/jquery.typeit/4.3.0/typeit.min.js"></script>
<script src="JavaScript/jBox.min.js"></script>
<link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
<style>
    body{
    background-image: url(images/about_wall2.png);
    background-color: #363636;
    background-size: cover;
    background-attachment: fixed;
    }
</style>
<style>
    #game_home a{
    background: -webkit-gradient(linear, center top, center bottom, from(#ededed), to(#fff));
	background-image: linear-gradient(#ededed, #fff);
	border-radius: 12px;
	box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,0.1);
	color: #222;
    pointer-events: none;
    cursor: default;
    }   
</style>
<style>
header {
    background-image: url(images/<?php echo $_SESSION['bgheader']?>.jpg);
    background-size: cover; 
    background-repeat: no-repeat;
	background-position:left top;
    background-color: #ccc;
    transition:all .35s;        /* 屬性過渡效果 */
	-webkit-transition:all .35s;
}    
</style>
</head>

<body>
    <header>
    <nav id="nav1">
    <ul id="page-nav1">
        <li class = "logo" ><a href="main"><img src="images/bannernew.png" width=175 height=54 ></img></a></li>
    <li><a href="store">STORE</a></li>
    <li><a href="about">ABOUT</a></li>
    <li><a href="community">COMMUNITY</a></li>
    <li><a href="event">EVENT</a></li>
    <li><a href="support">SUPPORT</a></li>
    <li><a href="member_center.php">
    <?php
        if (isset($_SESSION['Username'])) { ?> 
    <div id="logged"><?php echo $_SESSION['Username']; ?></div>
    <?php } else { ?> 
    <div id="login">login</div> 
    <?php } ?>    
    </a></li>
    <li><a href="" id = "gap"> | </a></li>
    <li>
    <?php
        if (isset($_SESSION['Username'])) { ?> 
    <a href="log_out.php" id = "signup">logout</a>    
    <?php } else { ?> 
    <a href="member_new.php" id = "signup">signup</a> 
    <?php } ?>       
    </li>
        
  </ul>
    </nav>
    
    <div id="headwall">
    <ul id="page-headwall">
    <li><a href="bg-header.php?wall=dishonored" id="wall1" class="headwall-link">no.1</a></li>
    <li><a href="bg-header.php?wall=galaxy" id="wall2" class="headwall-link">no.2</a></li>    
    </ul>

    <ul id="page-headwall2">
    <li><a href="bg-header.php?wall=bannerjpg" id="wall3" class="headwall-link">no.3</a></li>
    <li><a href="bg-header.php?wall=lara" id="wall4" class="headwall-link">no.4</a></li>
    </ul>
    </div>
    
    </header>
    
    <div class="wrap">
	
	<nav>
		<ul class="menu">
			<li id="game_home"><a href="index2.html">Home</a></li>
			<li><a href="store_about.php">About</a></li>
			<li><a href="store_news.php">NEWS</a></li>
			<li><a href="store.php">Games</a>
				<ul>
					<li><a href="store">adventure</a></li>
					<li><a href="action">action</a></li>
					<li><a href="strategy">strategy</a></li>
					<li><a href="sports">sports</a></li>
					<li><a href="multiplay">multiplay</a></li>
				</ul>
			</li>
			<li><a href="store_collection.php">Collection</a></li>
            <li>
                <form class="form-wrapper cf" action="search_result.php" method="post">
  	<input name="keyword" id="keyword" type="text" placeholder="Search here..." required class="tooltip" title="search game" autofocus><img src="images/search.png">
    <button type="submit">Search</button>
                </form>
</li>
		</ul>
		<div class="clearfix"></div>
	</nav>
	</div>
    
    
<article id="main">
<section id="slideshow">
    <table id="slidetitle">
    <tr>
    <td>featuring & Pre-purchasing Games</td>
    </tr>
    </table>
    <table class="slidetable" id="slide_art1">  
        <tr>
            <td><a href="item_detail.php?pro_id=44"><img id="slide_img" src="images/aoc1.png"></a>
            </td>
        <td>
            
        <div id="s-slide">
            <ul id="smallslide1">
                <li><a href="#"  id="slide1" class="slide-link" >no.1</a></li>
                <li><a href="#"  id="slide2" class="slide-link">no.2</a></li>    
            </ul>

            <ul id="smallslide2">
                <li><a href="#"  id="slide3" class="slide-link">no.3</a></li>
                <li><a href="#"  id="slide4" class="slide-link">no.4</a></li>
            </ul>
        </div> 
        <div id="slidedetail">   
        <h3>Age of Empires II HD: Rise of the Rajas</h3>
        <p>USD$ 150</p>
            <div id="topsell">top seller</div>
            <div class="sup_os">
                <img src="images/windows.png" id="wins">
                <img src="images/macos.png" >
                <img src="images/linux.png" >
            </div>
        </div>   
        </td>
        </tr>
    </table>

    <table class="slidetable" id="slide_art2">  
        <tr>
            <td><a href="item_detail.php?pro_id=65"><img id="slide_img2" src="images/football.png"></a>
            </td>
        <td>
            
        <div id="s-slide">
            <ul id="smallslide1">
                <li><a href="#"  id="slide5" class="slide-link" >no.1</a></li>
                <li><a href="#"  id="slide6" class="slide-link">no.2</a></li>    
            </ul>

            <ul id="smallslide2">
                <li><a href="#"  id="slide7" class="slide-link">no.3</a></li>
                <li><a href="#"  id="slide8" class="slide-link">no.4</a></li>
            </ul>
        </div>
        <div id="slidedetail"> 
        <h3>Football Manager 2017</h3>
        <p>USD$ 98</p>
        <div id="topsell">top seller</div>
            <div class="sup_os">
                <img src="images/windows.png" id="wins">
                <img src="images/macos.png" >
                <img src="images/linux.png" >
            </div>
        </div>
        </td>
        </tr>
    </table>
    
    <table class="slidetable" id="slide_art3">  
        <tr>
            <td><a href="item_detail.php?pro_id=23"><img id="slide_img3" src="images/darksoul.jpg"></a>
            </td>
        <td>
            
        <div id="s-slide">
            <ul id="smallslide1">
                <li><a href="#"  id="slide9" class="slide-link" >no.1</a></li>
                <li><a href="#"  id="slide10" class="slide-link">no.2</a></li>    
            </ul>

            <ul id="smallslide2">
                <li><a href="#"  id="slide11" class="slide-link">no.3</a></li>
                <li><a href="#"  id="slide12" class="slide-link">no.4</a></li>
            </ul>
        </div>
        <div id="slidedetail">
        <h3>DARK SOULS III</h3>
        <p>USD$ 249</p>
        <div id="topsell">top seller</div>
            <div class="sup_os">
                <img src="images/windows.png" id="wins2">
            </div>
        </div>
        </td>
        </tr>
    </table>
    
    <table class="slidetable" id="slide_art4">  
        <tr>
            <td><a href="item_detail.php?pro_id=16"><img id="slide_img4" src="images/wdog.png"></a>
            </td>
        <td>
            
        <div id="s-slide">
            <ul id="smallslide1">
                <li><a href="#"  id="slide13" class="slide-link" >no.1</a></li>
                <li><a href="#"  id="slide14" class="slide-link">no.2</a></li>    
            </ul>

            <ul id="smallslide2">
                <li><a href="#"  id="slide15" class="slide-link">no.3</a></li>
                <li><a href="#"  id="slide16" class="slide-link">no.4</a></li>
            </ul>
        </div> 
        <div id="slidedetail">
        <h3>Watch_Dogs® 2</h3>
        <p>Released Day:24/3/2017 </p>
            <div id="ppurchase">Pre-Purchasing</div>
            <div class="sup_os">
                <img src="images/windows.png" id="wins">
                <img src="images/macos.png" >
                <img src="images/linux.png" >
            </div>
        </div>
        </td>
        </tr>
    </table>
    
    
    <table class="slidetable" id="slide_art5">  
        <tr>
            <td><a href="item_detail.php?pro_id=34"><img id="slide_img5" src="images/witcher.png"></a>
            </td>
        <td>
        <div id="s-slide">
            <ul id="smallslide1">
                <li><a href="#"  id="slide17" class="slide-link" >no.1</a></li>
            </ul>
        </div>
        <div id="slidedetail">
        <h3>The Witcher 3 - Game of the Year Edition</h3>
        <p>USD$ 249</p>
         <div id="reedit">re-edition</div>
            <div class="sup_os" id="sup_os2">
                <img src="images/windows.png" id="wins">
                <img src="images/macos.png" >
                <img src="images/linux.png" >
            </div>
        </div>
        </td>
        </tr>
    </table>
    
    
    
    <table id="slidebar">
    <tr>
    <td>
    <a href="#" class="bar-link" id="slidebarpoint1">1</a>
    <a href="#" class="bar-link" id="slidebarpoint2">2</a>
    <a href="#" class="bar-link" id="slidebarpoint3">3</a>
    <a href="#" class="bar-link" id="slidebarpoint4">4</a>
    <a href="#" class="bar-link" id="slidebarpoint5">5</a>
    </td>
    </tr>
    </table>

</section>

<section id="specialbox">
    <table id="special">
        <tr> <!-- table tr 1 -->
            <td class="title">discount & special offer period</td>
        </tr>
        <tr> <!-- table tr 2 -->
            <td>
                <div id="container">
                <div class="col">
                <a href="item_detail.php?pro_id=15"><img src="images/l4d.jpg" class="icon"></a>
                <h1>left 4 Dead 2</h1>
                <img src="images/coop.png" alt="coop" class="tooltip" title="cooperative play">
                <B>-50%</B><h5>&nbsp USD$80 &nbsp</h5><h3>USD$40</h3>
                </div>
                    
                <div class="col">
                <a href="item_detail.php?pro_id=45"><img src="images/sim4.jpg" class="icon"></a>
                <h1>SimCity 4</h1>
                <img src="images/burn.png" alt="hot game" class="tooltip" title="Hot game">
                <B>-60%</B><h5>&nbsp USD$70 &nbsp</h5><h3>USD$28</h3>
                </div>
                
                <div class="col">
                <a href="item_detail.php?pro_id=81"><img src="images/gta.jpg" class="icon"></a>
                <h1>grand theft auto v</h1>
                <img src="images/burn.png" alt="hot game" class="tooltip" title="Hot game">
                <img src="images/coop.png" alt="coop" class="tooltip" title="cooperative play">
                <B>-75%</B><h5>&nbsp USD$120 &nbsp</h5><h3>USD$30</h3>
                </div>
                </div>
            </td>
        </tr>
        <tr>    <!-- table tr 3 -->
            <td>
                   <div id="container2">
                <div class="col" id="csgo">
                <a href="item_detail.php?pro_id=66"><img src="images/csgo.jpg" class="icon"></a>
                <h1>Counter-Strike: GO</h1>
                <img src="images/burn.png" alt="hot game" class="tooltip" title="Hot game">
                <img src="images/coop.png" alt="coop" class="tooltip" title="cooperative play">
                <B>-90%</B><h5>&nbsp USD$99 &nbsp</h5><h3>USD$9.9</h3>
                </div>
                    
                <div class="col" id="hs">
                <a href="item_detail.php?pro_id=46"><img src="images/hs.jpg" class="icon"></a>
                <h1>hearthstone</h1>
                <img src="images/chess.png" alt="chess game" id="cheese" class="tooltip" title="Strategy game">
                    <a href="item_detail.php?pro_id=46"><p>FREE TO PLAY!</p></a>
                </div>
                
                <div class="col">
                <a href="item_detail.php?pro_id=14"><img src="images/rise.jpg" class="icon"></a>
                <h1>Rise of the Tomb Raider™</h1>
                <img src="images/burn.png" alt="hot game" class="tooltip" title="Hot game">
                <img src="images/coop.png" alt="coop" class="tooltip" title="cooperative play">
                <B>-30%</B><h5>&nbsp USD$249 &nbsp</h5><h3>USD$174</h3>
                </div>
                </div> 
            
            </td>
        </tr>
    </table>   
</section>


<section id="topbox">
<table id="toptitle">
    <tr> <!-- table tr 1 -->
        <td class="title">Tops Leaderboard (2016 WINTER) </td>
        <td>
        </td>
</tr>
<tr>
    <td>
        <div id="topshape">
            <a href="#1" id="playtop">SHOW </a>
            <div id="topeople"><img src="images/user.png"></div>
<img src="images/topsell.png" id="toplogo">   
        <!----------- START ANIMATION ------------->        
        <div id="topline"></div>
            
        <a href="item_detail.php?pro_id=81"><div class="gameshape" id="no1game">
            <div class="classname" id="nameno1"></div>
            </div> </a>
        <a href="item_detail.php?pro_id=66"><div class="gameshape" id="no2game">
            <div class="classname" id="nameno2"></div>
            </div></a>
        <a href="item_detail.php?pro_id=13"><div class="gameshape" id="no3game">
            <div class="classname" id="nameno3"></div>
            </div></a>
        <a href="item_detail.php?pro_id=12"><div class="gameshape" id="no4game">
            <div class="classname" id="nameno4"></div>
            </div></a>
        <a href="item_detail.php?pro_id=67"><div class="gameshape" id="no5game">
            <div class="classname" id="nameno5"></div>
            </div></a>
                <div id="detailbox">
                    <div id="topdetail"></div>
                </div>
                
                        <div id="buythis">
                        <a href="#1" id="buylink"><img src="images/shop2.png"></a>
                        </div>
                
                </div>    
            
    </td> 
</tr>
<tr>
    <td>
        <div id="topshape2">
            <a href="#1" id="playtop2">SHOW </a>
            <div id="topeople"><img src="images/user.png"></div>
<img src="images/toppurch.png" id="toplogo">   
        <!----------- START ANIMATION ------------->        
        <div id="topline"></div>
            
        <a href="item_detail.php?pro_id=48"><div class="gameshape" id="no6game">
            <div class="classname" id="nameno6"></div>
            </div> </a>
        <a href="item_detail.php?pro_id=16"><div class="gameshape" id="no7game">
            <div class="classname" id="nameno7"></div>
            </div></a>
        <a href="item_detail.php?pro_id=73"><div class="gameshape" id="no8game">
            <div class="classname" id="nameno8"></div>
            </div></a>
        <a href="item_detail.php?pro_id=25"><div class="gameshape" id="no9game">
            <div class="classname" id="nameno9"></div>
            </div></a>
        <a href="item_detail.php?pro_id=47"><div class="gameshape" id="no10game">
            <div class="classname" id="nameno10"></div>
            </div></a>
                <div id="detailbox2">
                    <div id="topdetail2"></div>
                </div>
                
                        <div id="buythis">
                        <a href="#1" id="buylink2"><img src="images/shop2.png"></a>
                        </div>
                
                </div>
    </td>
</tr>
    </table>  
</section>



<section id="signpart">
<table id="jointable">
<tr>
    <td>
        <div id="lastsay"></div>
    </td>
<tr>
    <td>
    <div id="joinus">
            <a href="member_center.php" id = "login2">login</a>
            <a href="member_new.php" id = "signup2">signup</a>
    </div>
    </td>
</tr>
</tr>
</table>
</section>

</article>

<div id="backtop"><a href="#" id="backtotop"><img src="images/backtop.png" class="tooltip" title="Top" /></a></div>

<footer id="footer">
<div id="footertable">

   
        <a href=""><img src="images/bannernew.png" width=175 height=54 ></img></a> 
    
<div id="footerline">
<div id="footerline1">
    STONE® 2016-2017. All rights reserved.
    </div>
    <div id="footerline2">
    STONE Pages designed by IP Since 2016 December.
    </div>
    <div id="footerline3">
    All trademarks and registered trademarks are
    </div>
    <div id="footerline4">
    the property of their respective owners.
    </div>
</div>
</div>
</footer>



</body>
</html>
