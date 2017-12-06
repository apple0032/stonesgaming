<?php
  session_start();
?>

<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

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
			<li><a href="main">Home</a></li>
			<li id="game_about"><a href="store_about.php">About</a></li>
			<li id="game_news"><a href="store_news.php">NEWS</a></li>
			<li id="game_style"><a href="store.php">GAMES</a></li>
			<li id="collection_style"><a href="store_collection.php">COLLECTION</a></li>
            <li>
                
                <form class="form-wrapper cf" action="search_result.php" method="post">
  	<input name="keyword" id="keyword" type="text" placeholder="Search here..." required>
    <img src="images/search.png" width=16px height=16px;>
    <button type="submit">Search</button>
                </form>
                
            </li>
		</ul>
		<div class="clearfix"></div>
	</nav>
	</div>
    
    

</body>
</html>
