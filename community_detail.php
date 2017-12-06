<?php
    session_start();
    ob_start();
?>

<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php 

$_SESSION['PrevPage'] = $_SERVER['REQUEST_URI']; 
?>

<!-------- READ MEMBER TABLE FIRST -------->

<?php 
    if (isset($_SESSION['Username'])){
    mysql_select_db('stonesga_ch30', $connection) or die('database error'); 
    $query5 = sprintf("SELECT * FROM member WHERE username=%s",
        GetSQLValue($_SESSION['Username'],"text"));

    $result5 = mysql_query($query5, $connection) or die(mysql_error());
    if ($result5)
    {$row5 = mysql_fetch_assoc($result5);} ;
    }
?>

<?php
//-------------------------
// DISPLAY CURRENT TOPIC
//-------------------------

// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
// 查詢 $_SESSION['database'] 資料表
$query = sprintf("SELECT * FROM community WHERE id = %s", GetSQLValue($_GET['id'], "int"));

// 傳回 $_SESSION['database'] 資料表的結果集
$result = mysql_query($query, $connection) or die(mysql_error());

if ($result)
{
     // 目前的列
	$row = mysql_fetch_assoc($result);
	// 結果集的記錄筆數
	$totalRows = mysql_num_rows($result);
    
}
?>

<?php 
//------------------------------------
// DISPLAY USER HEAD IMAGE
//------------------------------------

// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
// 查詢 member 資料表
$query2 = sprintf("SELECT * FROM member WHERE username = %s", GetSQLValue($row['username'], "text"));
// 傳回結果集
$result2 = mysql_query($query2, $connection) or die(mysql_error());

if ($result2)
{
  // 目前的列
	$row2 = mysql_fetch_assoc($result2);
}

?>


<?php
//-----------------------------------------
// ADD NEW COMMENT IN THE DATABASE 'COMMUNITY_REPLY'
//-----------------------------------------

if ((isset($_POST["insert"])) && ($_POST["insert"] == "comment_new")) 
{
    
    if (!isset($_SESSION['Username'])) { $_SESSION['login_form_title'] = "Login to join community.";
    header('Location: login_form.php') ;};
    
    
	// 選擇 MySQL 資料庫ch26
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch26不存在');	
	  
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
    
	// 在member資料表內插入一筆新的紀錄
	$query = sprintf("INSERT INTO community_reply (	topic_id,topic_author, topic, username,comment,datetime) VALUES (%s, %s, %s, %s, %s, %s)",  
		GetSQLValue($row['id'], "int"),
        GetSQLValue($row['username'], "text"),
		GetSQLValue($row['title'], "text"),
        GetSQLValue($_SESSION['Username'], "text"),  
		GetSQLValue($_POST['comment'], "text"),
        GetSQLValue($datetime, "date"));

	$result = mysql_query($query, $connection);
    
    $newpoint = $row5['point'] + 1 ;
    $query6 = sprintf("UPDATE member SET point=%s WHERE username=%s",
        GetSQLValue($newpoint,"int"),
        GetSQLValue($_SESSION['Username'],"text"));
    
    $result6 = mysql_query($query6,$connection);
    
	if (($result) and ($result6)) {
		// 回到前一個網頁 
		header(sprintf("Location: %s", $_SERVER['REQUEST_URI']));
        
	}
} 
?>


<?php
//-------------------------
// DISPLAY CURRENT COMMENT
//-------------------------

// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
// 查詢 $_SESSION['database'] 資料表
$query3 = sprintf("SELECT * FROM community_reply WHERE topic_id = %s ORDER BY datetime ASC", GetSQLValue($row['id'], "int"));

// 傳回 $_SESSION['database'] 資料表的結果集
$result3 = mysql_query($query3, $connection) or die(mysql_error());

if ($result3)
{
	// 結果集的記錄筆數
	$totalRows3 = mysql_num_rows($result3);
}
?>


<!---------- LIKE AND DISLIKE ---------->
   <?php
if ((isset($_POST["update"])) && ($_POST["update"] == "update_like")) 
{   mysql_select_db('stonesga_ch30', $connection) or die('database error');	
    $row['love'] = ($row['love'] + 1) ;
 
    $query = sprintf("UPDATE community SET love=%s WHERE id=%s", 
	GetSQLValue($row['love'], "int"), 
    GetSQLValue($row['id'], "int"));
 
    $result = mysql_query($query, $connection);
	if ($result) {
	  	header(sprintf("Location: %s", $_SERVER['REQUEST_URI']));
	}
}
?>  
   <?php
if ((isset($_POST["update_dis"])) && ($_POST["update_dis"] == "update_dislike")) 
{   mysql_select_db('stonesga_ch30', $connection) or die('database error');	
    $row['dislove'] = ($row['dislove'] + 1) ;
 
    $query = sprintf("UPDATE community SET dislove=%s WHERE id=%s", 
	GetSQLValue($row['dislove'], "int"), 
    GetSQLValue($row['id'], "int"));
 
    $result = mysql_query($query, $connection);
	if ($result) {
	  	header(sprintf("Location: %s", $_SERVER['REQUEST_URI']));
	}
}
?>

<!--------------------------------------->

<?php

$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];}
$rowsPerPage = 10;
$totalPages = ceil($totalRows3 / $rowsPerPage);
$startRow = $page * $rowsPerPage;
$current_query = sprintf("%s LIMIT %d, %d", $query3, $startRow, $rowsPerPage);
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
<script src="JavaScript/community_detail.js"></script>
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
<div id="community_main">
    
    <div id="community_bar">
    <div id="goback"><a href="community.php"><img src="images/previous.png" class="tooltip" title="BACK"/></a></div>
    <div id="post">
    <a href="community_add.php">
    <img src="images/post.png" class="tooltip" title="WANT TO POST?"/></a>
    <a href="community_photo.php">
    <img src="images/photo-camera.png" class="tooltip" title="Share a photo?"/></a>    
    </div>
    </div>
    
    
    <div id="community_detail">
    <!---------- COMMUNITY DETAIL ---------->
    <div id="community_detail_title">
    <?php echo $row['title'] ?>
    <!---------- edit function ---------->
    <?php 
        if (isset($_SESSION['Username'])){
        if((($_SESSION['Username'])==($row['username'])) or (($_SESSION['Username'])=="apple0032")) {
        if (empty($row['photo'])) {
        ?>
        
            <a href="community_edit.php?id=<?php echo $row['id'] ?>"><img src="images/edit.png" class="tooltip" title="Edit your post"> </a>
            
    <?php    }
            }   
        }
    ?>    
    <!----------------------------------->
    <div id="community_detail_date">Post : <?php echo $row['datetime'] ?></div>
    </div>
    
    <div id="community_detail_user">
    <div id="community_detail_name">
        <?php echo $row['username'] ?></div>
    <div id="community_detail_photo">
        <a href="#<?php echo $row['username']?>" class="open-popup-link">
        <img src="images/user/<?php echo $row2['photo']?>"/></a> 
    </div>
        
     <!---------- POPUP WINDOW ---------->    
    
        
    <div id="<?php echo $row['username']?>" class="white-popup2 mfp-hide">
        
    <div id="detail_username"><?php echo $row2['username'] ?></div>
    <div id="detail_head"><img src="images/user/<?php echo $row2['photo']?>"/></div>
    <div id="detail_star">
      <?php if(($row2['point']) >= "600" ) {  
           for ($x = 0; $x <= 4; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
    } else { ?>
        <?php if(($row2['point']) >= "400" ) {  
        for ($x = 0; $x <= 3; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
    } else { ?> 
        <?php if(($row2['point']) >= "200" ) {  
        for ($x = 0; $x <= 2; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
         } else { ?>
    <?php if(($row2['point']) >= "100" ) {  
        for ($x = 0; $x <= 1; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
          } else { ?>
        <?php if(($row2['point']) >= "10" ) {  ?>
        <img src="images/star-gold.png">
        <?php  }  }}}}?>  
    </div>   
    <div id="detail_point">
        POINT : <?php echo $row2['point'] ?>
    </div>
    <div id="detail_title">
        <?php if($row2['unititle']=="admin") { echo 'administrator' ;} else { echo 'member' ;}; ?>
    </div>
    <div id="detail_profile">
        <a href="profile.php?username=<?php echo $row['username']?> ">Profile</a>
    </div>
    </div>  
        
        
    <!-------------------------------------------->       
    <div id="community_detail_star">
    
        <?php if(($row2['point']) >= "600" ) {  
           for ($x = 0; $x <= 4; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
    } else { ?>
        <?php if(($row2['point']) >= "400" ) {  
        for ($x = 0; $x <= 3; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
    } else { ?> 
        <?php if(($row2['point']) >= "200" ) {  
        for ($x = 0; $x <= 2; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
         } else { ?>
    <?php if(($row2['point']) >= "100" ) {  
        for ($x = 0; $x <= 1; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
          } else { ?>
        <?php if(($row2['point']) >= "10" ) {  ?>
        <img src="images/star-gold.png">
        <?php  }  }}}}?>
          
    </div>
    <div id="community_detail_point">
        POINT : <?php echo $row2['point'] ?>
        </div>
    <div id="community_detail_uni">
        <?php if($row2['unititle']=="admin") { echo 'administrator' ;} else { echo 'member' ;}; ?>
    </div>
        
    </div>
     
    <?php if(empty($row['photo'])) { ?>  
    <div id="community_detail_comment">
    <?php echo html_entity_decode($row['comment']) ?>
    </div>
     <?php } else { ?> 
        <div id="community_detail_image">
            <img src="<?php echo $row['photo'] ?>">
            </div>
            
            <?php } ?>
   
        
    <div id="like_part"> 
    <img src="images/like.png" class="tooltip" title="Like"><?php echo $row['love']?>
        <img src="images/dislike.png" class="tooltip" title="Dislike"><?php echo $row['dislove']?>
    </div>  
    
    <div id="likeornot">
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="like_form" > 
        <input type="submit" value="Like" id="comment_submit"/ class="tooltip" title="Click to Like"> 
        <input name="update" id="update" type="hidden" value="update_like" />
    </form> 
        
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="dislike_form" > 
        <input type="submit" value="Dislike" id="comment_submit"/ class="tooltip" title="Click to dislike" > 
        <input name="update_dis" id="update_dis" type="hidden" value="update_dislike" />
    </form> 
    </div>        
        
    <!---------------------------------------->
    <!---------------------------------------->
    <!-------------- THE REPLY --------------->
    <div id="reply_detail_container">
        <div id="replay_count">Comment : (<?php echo $totalRows3 ?>)</div>
    
        
<?php 
//-----------------------------
// RECORD OF COMMENT IF ITS EXIST
//-----------------------------
if ($rowsOfCurrentPage)
{
?>     
        <div id="comment_pages">
      
        Total <?php echo $totalPages; ?> Pages &nbsp;&nbsp; 
      
         <?php echo $rowsPerPage; ?> Replies/page &nbsp;&nbsp;
    
			  <?php 
				  if ($page > 0) {
			  ?>
            <a href="<?php printf("%s&page=%d", $_SERVER["REQUEST_URI"], 0); ?>" ><img src="images/first_page.png" class="tooltip" title="First"></a>
				<?php 
					}
				?>
        <?php 
				  if ($page > 0) {
			  ?>
            <a href="<?php printf("%s&page=%d", $_SERVER["REQUEST_URI"], max(0, $page - 1)); ?>" 
              ><img src="images/previous_page.png" class="tooltip" title="Previous"></a>        
        <?php 
					}
				?>
				Page-<?php echo $page + 1; ?>
    		<?php 
				  if ($page < $totalPages - 1) {				
				?>
            <a href="<?php printf("%s&page=%d", $_SERVER["REQUEST_URI"], min($totalPages - 1, $page + 1)); ?>" 
              > <img src="images/next_page.png" class="tooltip" title="Next"></a>
        <?php 
					}
				?>
				<?php 
				  if ($page < $totalPages - 1) {				
				?>
            <a href="<?php printf("%s&page=%d", $_SERVER["REQUEST_URI"], $totalPages - 1); ?>" > <img src="images/last_page.png" class="tooltip" title="Last"></a>
        <?php 
					}
				?>
        </div>
        
        
        <?php $_SESSION['replyno'] = 0; ?>
        <?php $page = ($page + 1); ?>
        

        <?php  while ($row3 = mysql_fetch_array($result)) 
    {  
        mysql_select_db('stonesga_ch30', $connection) or die('database error'); 
        $query4 = sprintf("SELECT * FROM member WHERE username = %s", GetSQLValue($row3['username'], "text"));
        $result4 = mysql_query($query4, $connection) or die(mysql_error());
        if ($result4)
        {$row4 = mysql_fetch_assoc($result4);} ;
        
        
        ?>
        
    <div id="reply_inner_container">
        
        <table><tr>
        <td style="vertical-align:top">
        <div id="reply_detail_user">  
            <div id="reply_detail_name">
            <?php echo $row3['username'] ?></div>
            <div id="reply_detail_photo">
            <a href="#<?php echo $row3['username']?>" class="open-popup-link">
            <img src="images/user/<?php echo $row4['photo']?>"/></a></div>
            
            <!---------- POPUP WINDOW ---------->    
    
        
    <div id="<?php echo $row3['username']?>" class="white-popup2 mfp-hide">
        
    <div id="detail_username"><?php echo $row3['username'] ?></div>
    <div id="detail_head"><img src="images/user/<?php echo $row4['photo']?>"/></div>
    <div id="detail_star">
      <?php if(($row4['point']) >= "600" ) {  
           for ($x = 0; $x <= 4; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
    } else { ?>
        <?php if(($row4['point']) >= "400" ) {  
        for ($x = 0; $x <= 3; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
    } else { ?> 
        <?php if(($row4['point']) >= "200" ) {  
        for ($x = 0; $x <= 2; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
         } else { ?>
    <?php if(($row4['point']) >= "100" ) {  
        for ($x = 0; $x <= 1; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
          } else { ?>
        <?php if(($row4['point']) >= "10" ) {  ?>
        <img src="images/star-gold.png">
        <?php  }  }}}}?>  
    </div>   
    <div id="detail_point">
        POINT : <?php echo $row4['point'] ?>
    </div>
    <div id="detail_title">
        <?php if($row4['unititle']=="admin") { echo 'administrator' ;} else { echo 'member' ;}; ?>
    </div>
    <div id="detail_profile">
        <a href="profile.php?username=<?php echo $row4['username']?> ">Profile</a>
    </div>
    </div>  
        
        
    <!-------------------------------------------->  
            
            <div id="reply_detail_star">
            <?php if(($row4['point']) >= "600" ) {  
           for ($x = 0; $x <= 4; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
    } else { ?>
        <?php if(($row4['point']) >= "400" ) {  
        for ($x = 0; $x <= 3; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
    } else { ?> 
        <?php if(($row4['point']) >= "200" ) {  
        for ($x = 0; $x <= 2; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
         } else { ?>
    <?php if(($row4['point']) >= "100" ) {  
        for ($x = 0; $x <= 1; $x++) { ?> 
            <img src="images/star-gold.png">
    <?php ;  }  
          } else { ?>
        <?php if(($row4['point']) >= "10" ) {  ?>
        <img src="images/star-gold.png">
        <?php  }  }}}}?>
            </div>
            <div id="reply_detail_title">
            <?php echo $row4['unititle'] ?>    
            </div>
        </div> 
        </td>
        
        <td>
        <div id="reply_box">
        
        <?php if(!empty($row3['quote'])){ ?>
            <div id="quote_box">
            <?php echo $row3['quote']; ?>
            <div id="quote_person">
            <?php echo $row3['quote_ppl']; ?>
            </div>
            </div>                
            <?php } ?>

        <?php echo $row3['comment'] ?>
        </div>
        <div id="date"><?php echo $row3['datetime'] ?> 
        | P<?php echo $page ; ?>
        <?php $_SESSION['replyno'] += 1 ?>#
        <?php echo $_SESSION['replyno']; ?> |
        <a href="community_quote.php?id= <?php echo $row3['id']?>">Quote</a>
        </div>
        </td>
        </tr>
        </table>
        
    </div> 
            <?php }  ?>
        
         <div id="comment_pages2">
        
        <?php $page = ($page -1) ?>
             
        Total <?php echo $totalPages; ?> Pages &nbsp;&nbsp; 
      
         <?php echo $rowsPerPage; ?> Replies/page &nbsp;&nbsp;
    
			  <?php 
				  if ($page > 0) {
			  ?>
            <a href="<?php printf("%s&page=%d", $_SERVER["REQUEST_URI"], 0); ?>" ><img src="images/first_page.png" class="tooltip" title="First"></a>
				<?php 
					}
				?>
        <?php 
				  if ($page > 0) {
			  ?>
            <a href="<?php printf("%s&page=%d", $_SERVER["REQUEST_URI"], max(0, $page - 1)); ?>" 
              ><img src="images/previous_page.png" class="tooltip" title="Pervious"></a>        
        <?php 
					}
				?>
				Page-<?php echo $page + 1; ?>
    		<?php 
				  if ($page < $totalPages - 1) {				
				?>
            <a href="<?php printf("%s&page=%d", $_SERVER["REQUEST_URI"], min($totalPages - 1, $page + 1)); ?>" 
              > <img src="images/next_page.png" class="tooltip" title="Next"></a>
        <?php 
					}
				?>
				<?php 
				  if ($page < $totalPages - 1) {				
				?>
            <a href="<?php printf("%s&page=%d", $_SERVER["REQUEST_URI"], $totalPages - 1); ?>" > <img src="images/last_page.png" class="tooltip" title="Last"></a>
        <?php 
					}
				?>
        </div>
        
        <?php 
}
else
{
?>
        <div id="no_comment">
        Not any comment.
        </div>
    
<?php 
}
?>
        
        
        
        
     <!---------------Reply form----------------->   
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="comment_form" > 
        <div id="comment_wanna" class="tooltip" title="Type your comment here."><img src="images/talk.png">Let's say something together.</div>
        <textarea rows="10" cols="130" name="comment"  id="comment" maxlength="2500"></textarea>
       
        </br>    
        <input type="Reset" value="Reset"/>
        <input type="submit" value="Submit" id="comment_submit"/>
            
        <input name="insert" id="insert" type="hidden" value="comment_new" />
        </form>
        
    </div>  
    
     <!---------------------------------------->
    </div>
    
    <div id="backtop"><a href="#" id="backtotop"><img src="images/backtop.png" class="tooltip" title="Top" /></a></div>
    
</div>
    

    
</section>    
    
    
    
<!-- 載入下邊區塊 -->
<div id="footer"></div>
</body>
</html>