<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php 

$_SESSION['PrevPage'] = $_SERVER['PHP_SELF']; 
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Event</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="CSS/event.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="JavaScript/event.js"></script>
<script src="JavaScript/jBox.min.js"></script>
<link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="CSS/magnific-popup.css" type="text/css">
<script src="JavaScript/jquery.magnific-popup.js"></script>
<script type="text/javascript" src="poll/jquery.js"></script>
<script type="text/javascript" src="poll/ajax-poll.php"></script>
</head>

<body>
<!-- 載入上邊區塊 -->
<div id="header"></div>

<section id="detail">
<div id="detail_main"> 
    
<div id="event-logo">
<img src="images/event.png"> 
</div>

<div class='ajax-poll' tclass='poll-background-image' style='width:1050px;'>    
</div>      


</div>
</section>

<div id="bot_part">
<div id="best">
<img src="images/best2.png">
</div>
    
<div id="topbox">
    <div class="topgame"><a href="item_detail.php?pro_id=14"><img src="photo/item/tomb-rise.jpg" id="rise"></a>
    <div class="topname">Rise of the Tomb Raider</div>
    </div>
    
    <div class="topgame"><a href="item_detail.php?pro_id=66"><img src="photo/item/csgo.jpg" id="rise"></a>
    <div class="topname">Counter-Strike: Global Offensive</div>
    </div>
    
    <div class="topgame"><a href="item_detail.php?pro_id=81"><img src="photo/item/gta5.jpg" id="rise"></a>
    <div class="topname">Grand Theft Auto V</div>
    </div>
    
</div>    
</div>    

<!-- 載入下邊區塊 -->
<div id="footer"></div>
</body>
</html>
    
    