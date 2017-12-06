<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php

// 前一個網頁
$_SESSION['PrevPage'] = $_SERVER['PHP_SELF'];
?>

<?php 
mysql_select_db('stonesga_ch30', $connection) or die('no database'); 
$query = "SELECT * FROM computer_books ORDER BY publishdate DESC LIMIT 8";
$result = mysql_query($query, $connection) or die(mysql_error());
if ($result)
?>

<?php 
$query2 = "SELECT * FROM computer_books WHERE topseller = 'Pre-Purchasing' ORDER BY publishdate DESC LIMIT 4";
$result2 = mysql_query($query2, $connection) or die(mysql_error());
?>

<?php 
$query3 = "SELECT * FROM computer_books WHERE topseller = 'FREE TO PLAY!' ORDER BY publishdate DESC LIMIT 4";
$result3 = mysql_query($query3, $connection) or die(mysql_error());
?>

<?php 
$query4 = "SELECT * FROM announ ORDER BY datetime DESC LIMIT 6";
$result4 = mysql_query($query4, $connection) or die(mysql_error());
?>

<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Store About</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="CSS/store_news.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="JavaScript/store_news.js"></script>
<script src="JavaScript/jBox.min.js"></script>
<link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="CSS/magnific-popup.css">
<script src="JavaScript/jquery.magnific-popup.js"></script>
<style>
    #game_about a{
    background: -webkit-gradient(linear, center top, center bottom, from(#ededed), to(#fff));
	background-image: linear-gradient(#ededed, #fff);
	border-radius: 12px;
	box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,0.1);
	color: #222;
    pointer-events: none;
    cursor: default;
    }   
</style>
<?php
  $bg = array('bg-01.png', 'bg-02.png','bg-03.png','bg-04.png','bg-05.png','bg-06.png','bg-07.png','bg-08.png','bg-09.png','bg-10.png' ); // array of filenames

  $i = rand(0, count($bg)-1); // generate random number size of the array
  $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
?>
<style type="text/css">

body{
background: url(images/<?php echo $selectedBg; ?>) no-repeat;
background-size: cover;
background-attachment: fixed;　
background-size: cover;
}

    #footer{
      
        position: relative;
    }
    
</style>
</head>
<body>
<!-- 載入上邊區塊 -->
 <div id="header"></div>

<div id="detail_main">
<div id="collection_toppest">
<div id="collection_toppest_title"> About STORE </div>
<div id="title_desc"> Announcement, Updates, New Releases, Purchasing Details</div>
</div>

<div id="announ">
<div id="announ_top">Announcement and Updates
<a href="management/"><img src="images/settings.png" id="setting"></a>   
</div>  
    
    <div id="topbox_container">
    <div id="community_question">
        
 <?php while ($row4 = mysql_fetch_array($result4)) { ?>     
        <div id="ques1" class="ques">
            <a href="#<?php echo $row4['id']; ?>" class="open-popup-link">
            <?php echo $row4['title']; ?>
            <i><?php echo $row4['datetime']; ?></i>
            </a>&nbsp;&nbsp;&nbsp;<img src="images/open.png"></div>
        
        <div id="<?php echo $row4['id'] ?>" class="white-popup mfp-hide"> 
            <div id="announ_detail">
                <div id="announ_content">
                <br>
                <?php echo $row4['content']; ?>
                </div>
            </div>
            
            <div id="announ_info">
            <i>Announcer: <?php echo $row4['username']; ?></i>
            </div>
            
            <div id="announ_time">
            <i>Post: <?php echo $row4['datetime']; ?></i>
            </div>
            
        </div> 
        
        
      <?php } ?> 
        
    </div>  
    </div> 
</div>    
    
<div id="new">
    <i>new releases</i>
    
<?php 
    while ($row = mysql_fetch_array($result)) {?> 
        <div id="new_box">
        <a href="item_detail.php?pro_id=<?php echo $row['id'] ?>">
        <img src="photo/item/<?php echo $row['photo'] ?>"> </a>
        <div id="new_box_name"><?php echo $row['title'] ?></div>
        </div>
    <?php } ?>
</div> 
    
<div id="presell">
    <i>Pre-Purchasing</i>
<?php
    while ($row2 = mysql_fetch_array($result2)) {?> 
        <div id="new_box">
        <a href="item_detail.php?pro_id=<?php echo $row2['id'] ?>">
        <img src="photo/item/<?php echo $row2['photo'] ?>"> </a>
        <div id="new_box_name"><?php echo $row2['title'] ?></div>
        </div>
    <?php } ?>
</div>
    
<div id="free">
    <i>free to play</i>
<?php 
    while ($row3 = mysql_fetch_array($result3)) {?> 
        <div id="new_box">
        <a href="item_detail.php?pro_id=<?php echo $row3['id'] ?>">
        <img src="photo/item/<?php echo $row3['photo'] ?>"> </a>
        <div id="new_box_name"><?php echo $row3['title'] ?></div>
        </div>
    <?php } ?>
</div>
    
</div>  

<div id="howtobuy">
    
    <div id="howtobuy_container">
<h3>How to purchase games in STONE?</h3>
 
Step.1 &nbsp;Login to your member account. <br>

Step.2 &nbsp;Select your favorite games, click on the product and read the game details or buy the game directly. <br>

Step.3 &nbsp;Confirm your name, address and total amount. <br>

Step.4 &nbsp;Click [purchase] button to complete.   <br> 
    </div>

</div>


<!-- 載入下邊區塊 -->
<div id="footer"></div>
</body>
</html>