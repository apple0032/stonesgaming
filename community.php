<?php
  session_start();
?>

<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php 

$_SESSION['PrevPage'] = $_SERVER['PHP_SELF']; 
?>

<?php
//-------------------------
// DISPLAY CURRENT COMMENT
//-------------------------

// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
// 查詢 $_SESSION['database'] 資料表
$query = sprintf("SELECT * FROM community ORDER BY datetime DESC");

// 傳回 $_SESSION['database'] 資料表的結果集
$result = mysql_query($query, $connection) or die(mysql_error());

if ($result)
{
	// 結果集的記錄筆數
	$totalRows = mysql_num_rows($result);
}
?>

<!--------------------------------------->

<?php

$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];}
$rowsPerPage = 10;
$totalPages = ceil($totalRows / $rowsPerPage);
$startRow = $page * $rowsPerPage;
$current_query = sprintf("%s LIMIT %d, %d", $query, $startRow, $rowsPerPage);
$result = mysql_query($current_query, $connection) or die(mysql_error());
if ($result) {	
	$rowsOfCurrentPage = mysql_num_rows($result);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <title>Community</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="CSS/community.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="JavaScript/community.js"></script>
<script src="JavaScript/jBox.min.js"></script>
<link rel="stylesheet" href="CSS/magnific-popup.css" type="text/css">
<script src="JavaScript/jquery.magnific-popup.js"></script>
<link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
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

</style>
</head>

<body>
<!-- 載入上邊區塊 -->
 <div id="header"></div>

    
<section id="detail">
<div id="detail_main">
    
<div id="community_toppest">
<div id="community_toppest_title">Community Activity</div>
<div id="community_toppest_desc">Community, discussion, official content and sharing for all games on Stone.  </div>
</div>
    
<div id="topbox_container">
    
<div id="community_topbox1">

<div id="feature_box">
    Welcome to the Stone Community	<br><br>

Login to the Stone Community to find more details to browse.<br><br>
    <div id="feature_login"><a href="member_center.php">Login</a>&nbsp;&nbsp; OR &nbsp;&nbsp;<a href="member_new.php">Join Stone</a></div>
    <div id="feature_about">New to STONE? <a href="about.php" class="tooltip" title="Read more about Stone feature">Click to learn more.</a></div>
</div>
    
<div id="search_box">

<div id="search_box_games">
find games
<form class="form-wrapper cf" action="search_result.php" method="post">
  	<input name="keyword" id="keyword" type="text" placeholder="Search games.." required>
    <img src="images/search.png">
    <button type="submit" id="button2">Search</button>
</form>    
</div>
    
<div id="search_box_bytopic">
find post or user
<form class="form-wrapper cf" action="community_search.php" method="post">
  	<input name="keyword" id="keyword" type="text" placeholder="Search post/user.." required autofocus>
    <img src="images/search.png">
    <button type="submit">Search</button>
</form>
</div>
    
</div>
    
</div>
    
<div id="community_topbox2">
<a href="community_photo.php"><img src="images/share.jpg" class="tooltip" title="Share a picture"></a>
<a href="community_add.php"><img src="images/discussion.jpg" class="tooltip" title="Create new post"></a>
</div>
    
</div>    

<?php 
//-----------------------------
// RECORD OF COMMENT IF ITS EXIST
//-----------------------------
if ($rowsOfCurrentPage)
{
?>     
        <div id="comment_main_pages">
      
        Total <?php echo $totalPages; ?> Pages &nbsp;&nbsp; 
    
			  <?php 
				  if ($page > 0) {
			  ?>
            <a href="<?php printf("%s?page=%d", $_SERVER['PHP_SELF'], 0); ?>" ><img src="images/first_page_white.png" class="tooltip" title="First"></a>
				<?php 
					}
				?>
        <?php 
				  if ($page > 0) {
			  ?>
            <a href="<?php printf("%s?page=%d", $_SERVER['PHP_SELF'], max(0, $page - 1)); ?>" 
              ><img src="images/previous_page_white.png" class="tooltip" title="Previous"></a>        
        <?php 
					}
				?>
				Page-<?php echo $page + 1; ?> &nbsp;&nbsp;
    		<?php 
				  if ($page < $totalPages - 1) {				
				?>
            <a href="<?php printf("%s?page=%d", $_SERVER['PHP_SELF'], min($totalPages - 1, $page + 1)); ?>" 
              > <img src="images/next_page_white.png" class="tooltip" title="Next"></a>
        <?php 
					}
				?>
				<?php 
				  if ($page < $totalPages - 1) {				
				?>
            <a href="<?php printf("%s?page=%d", $_SERVER['PHP_SELF'], $totalPages - 1); ?>" > <img src="images/last_page_white.png" class="tooltip" title="Last"></a>
        <?php 
					}
				?>
        </div>
        

<?php while ($row = mysql_fetch_array($result)) 
    {   $comment1 = strip_tags(html_entity_decode($row['comment'])) ;
        $comment_detail = html_entity_decode($row['comment']) ;
     
            //-----------------------------//
            // DISPLAY CURRENT TOTAL REPLY //
            //-----------------------------//
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
$query3 = sprintf("SELECT * FROM community_reply WHERE topic_id = %s ORDER BY datetime ASC", GetSQLValue($row['id'], "int"));
$result3 = mysql_query($query3, $connection) or die(mysql_error());
if ($result3)
{$totalRows3 = mysql_num_rows($result3);}
?>
   
    
    <div id="community_list">
    
        <a href="community_detail.php?id=<?php echo $row['id']; ?>" class="titlehref"><div id="community_list_title"> <?php echo $row['title'] ?> &nbsp;&nbsp;&nbsp;<img src="images/open_new.png"></div></a><br>
        
        <a href="#<?php echo $row['id'] ?>" class="open-popup-link">
            
            <?php if(empty($row['photo'])) { ?>
            
            <div id="community_list_content" ><?php echo substr(($comment1),0, 250); ?> <?php if (strlen($comment1)>200){ echo "........" ;} ?>
            </div>
            
            <?php } else { ?>
            
            <div id="community_image">
            <img src="<?php echo $row['photo'] ?>">
            </div>
            
            <?php } ?>
            
        </a>
        
        <!---------- POPUP WINDOW ---------->
        <div id="<?php echo $row['id'] ?>" class="white-popup1 mfp-hide">
            
          <?php if(empty($row['photo'])) { ?>  
                 <?php echo $comment_detail ?>
            <?php } else { ?>
                <div id="community_popup_image">
            <img src="<?php echo $row['photo'] ?>">
            </div>
            
            <?php } ?>
            
            <div id="popup_like">
       <img src="images/like.png" class="tooltip" title="Like" ><?php echo $row['love'] ?>
            
        <img src="images/dislike.png" class="tooltip" title="Dislike"><?php echo $row['dislove'] ?>
                
            <div id="popup_reply">
                <a href="community_detail.php?id=<?php echo $row['id']; ?>"><img src="images/speaker.png" class="tooltip" title="Say Something!"></a>
            </div>
                
        </div>

        </div>
        <!---------- POPUP WINDOW ---------->
        
        
        <div id="community_list_like">
        <img src="images/reply.png" class="tooltip" title="Reply"><?php echo $totalRows3 ?>
        
        <img src="images/like.png" class="tooltip" title="Like"><?php echo $row['love'] ?>
            
        <img src="images/dislike.png" class="tooltip" title="Dislike"><?php echo $row['dislove'] ?>
        </div>
        
        
        <div id="community_list_user"><?php echo $row['username'] ?>  
        <div id="community_list_time"><?php echo $row['datetime'] ?></div>
        </div>
    
        
        
    </div>
    
  <?php  } 
    
    }
else
{
?>
        <div id="no_comment">
        Not any post.
        </div>
    
<?php 
}
?>
    
</div>
</section>    
    
    
    
<!-- 載入下邊區塊 -->
<div id="footer"></div>
</body>
</html>