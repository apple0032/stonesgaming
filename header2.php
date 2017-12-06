<?php
  session_start();
?>

<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<!doctype html>
<html>
<head>

<title>STONE</title>
<link rel="stylesheet" href="CSS/header2.css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="assets/js/jquery-3.1.1.min.js"></script>
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
    </header>
    
    
  
</body>
</html>
