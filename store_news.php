<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php

// 前一個網頁
$_SESSION['PrevPage'] = $_SERVER['PHP_SELF'];
?>


<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Store News</title>
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
    #game_news a{
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
<div id="collection_toppest_title"> Game News </div>
<div id="title_desc">Games News , Updates , Reviews , Resources</div>
</div>

<div id="css">
<!-- start feedwind code --> <script type="text/javascript" src="https://feed.mikle.com/js/fw-loader.js" data-fw-param="10056/"></script> <!-- end feedwind code -->   
</div>    
    
<div id="gap"></div>  
    
    
    
    
    
    

    
</div>  


<!-- 載入下邊區塊 -->
<div id="footer"></div>
</body>
</html>