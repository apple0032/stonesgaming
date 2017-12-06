<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php require_once('search_require.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}

// 前一個網頁
$_SESSION['PrevPage'] = $_SERVER['PHP_SELF'];
// 購物的網頁
$_SESSION['shopping_page'] = $_SERVER['REQUEST_URI'] ;

?>
<?php
//-------------------------
// 顯示目前書籍的詳細資料
//-------------------------

// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
// 查詢 $_SESSION['database'] 資料表
$query = sprintf("SELECT * FROM " . $_SESSION['database'] . " WHERE id = %s", GetSQLValue($_GET['pro_id'], "int"));
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
//-------------------------
// 顯示目前書籍的作者相關書籍
//-------------------------

// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
// 查詢 $_SESSION['database'] 資料表
$query_author_related = "SELECT * FROM " . $_SESSION['database'] . " WHERE ( author='" . 
	$row['author'] . "' OR translator='" . $row['author'] . 
	"' ) AND title <> '" . $row['title'] . "' ORDER By publishdate";
// 傳回 $_SESSION['database'] 資料表的結果集
$result_author_related = mysql_query($query_author_related, $connection) or die(mysql_error());

if ($result_author_related)
{
  // 目前的列
	$row_author_related = mysql_fetch_assoc($result_author_related);
	// 結果集的記錄筆數
	$totalRows_author_related = mysql_num_rows($result_author_related);
}
?>

<?php
//-----------------------------------------
// ADD NEW COMMENT IN THE DATABASE 'COMMENT'
//-----------------------------------------

if ((isset($_POST["insert"])) && ($_POST["insert"] == "comment_new")) 
{
    
    if (!isset($_SESSION['Username'])) { $_SESSION['Username'] = "anonymous" ;};
    
    
	// 選擇 MySQL 資料庫ch26
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch26不存在');	
	  
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
    
	// 在member資料表內插入一筆新的紀錄
	$query = sprintf("INSERT INTO comment (game_id,game_title, username, comment,datetime) VALUES (%s, %s, %s, %s, %s)",  
		GetSQLValue($row['id'], "int"),
        GetSQLValue($row['title'], "text"),
		GetSQLValue($_SESSION['Username'], "text"),
		GetSQLValue($_POST['comment'], "text"),
        GetSQLValue($datetime, "date"));
        
    
    
	
	// 傳回結果集
	$result = mysql_query($query, $connection);

	if ($result) {
		// 回到前一個網頁 
		header(sprintf("Location: %s", $_SERVER['REQUEST_URI']));
        
        if ($_SESSION['Username']=="anonymous") { unset($_SESSION['Username']) ;};
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
$query2 = sprintf("SELECT * FROM comment WHERE game_id = %s ORDER BY datetime DESC LIMIT 20", GetSQLValue($row['id'], "int"));

// 傳回 $_SESSION['database'] 資料表的結果集
$result2 = mysql_query($query2, $connection) or die(mysql_error());

if ($result2)
{
  // 目前的列
	$row2 = mysql_fetch_assoc($result);
	// 結果集的記錄筆數
	$totalRows2 = mysql_num_rows($result2);
}
?>



<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row['title']; ?></title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="CSS/item_detail.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="JavaScript/item_detail.js"></script>
<link rel="stylesheet" href="CSS/normalize.css">
<link rel="stylesheet" href="CSS/ideal-image-slider.css">
<link rel="stylesheet" href="CSS/default.css">
<link rel="stylesheet" href="CSS/lightbox.css">
<script src="JavaScript/lightbox.js"></script>
<script src="JavaScript/jquery-imgpreview.min.js"></script>
<script src="JavaScript/imgpreview.full.jquery.js"></script>
    
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

    <div id="detail_path">
        <a href="store.php">All Games</a> > <a href="
<?php if ($row['category']=="Adventure") { echo 'store'; }; 
 if ($row['category']=="Action") { echo 'action'; };            
 if ($row['category']=="Strategy") { echo 'strategy'; };            
 if ($row['category']=="Sports") { echo 'sports'; };            
 if ($row['category']=="Multiplay") { echo 'multiplay'; };?>.php"><?php echo $row['category']; ?> Games</a> >  <a href="item_detail.php?pro_id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
    </div>
  
<div id="detail_title">
        <?php echo $row['title']; ?>
</div>  
    
<div id="detail_info">
    <table>
    <tr>
    <td>
    <div id="detail_info_left">
        <div id="detail_left">
    <img src="photo/item/<?php echo $row['photo']; ?>"/>
        <div id="detail_info_content"><?php echo $row['contents']; ?></div>
        <div id="detail_info_publish">Release Date: <?php echo $row['publishdate']; ?></div>
        <div id="detail_info_author">Publisher: <b><?php echo $row['author']; ?></b></div>
        <div id="detail_info_category">Category: <?php echo $row['category']; ?></div>
        <div id="detail_info_special">Special: 
        <?php if($row['topseller']==""){echo 'null.';} else{echo $row['topseller'];} ?> </div>
        </div>
    </div>
    </td>
    <td>
        <div id="detail_info_right">
            <div id="detail_img1">
                <img src="photo/item/<?php echo $row['img1']; ?>"/>
                <img src="photo/item/<?php echo $row['img2']; ?>"/>
                <img src="photo/item/<?php echo $row['img3']; ?>"/>
                <img src="photo/item/<?php echo $row['img4']; ?>"/>
                <img src="photo/item/<?php echo $row['img5']; ?>"/>
            </div>
            <div id="detail_small">
                <a href="photo/item/<?php echo $row['img1']; ?>" data-lightbox="box1" data-title="<?php echo $row['title']; ?> - IMG1">
                    <img class="thumbnail" src="photo/item/<?php echo $row['img1']; ?>"/></a>
                
                <a href="photo/item/<?php echo $row['img2']; ?>" data-lightbox="box1" data-title="<?php echo $row['title']; ?> - IMG2">
                    <img class="thumbnail" src="photo/item/<?php echo $row['img2']; ?>"/></a>
                    
                <a href="photo/item/<?php echo $row['img3']; ?>" data-lightbox="box1" data-title="<?php echo $row['title']; ?> - IMG3">
                    <img class="thumbnail" src="photo/item/<?php echo $row['img3']; ?>"/></a>    
                    
                <a href="photo/item/<?php echo $row['img4']; ?>" data-lightbox="box1" data-title="<?php echo $row['title']; ?> - IMG4">
                    <img class="thumbnail" src="photo/item/<?php echo $row['img4']; ?>"/></a>
            
                <a href="photo/item/<?php echo $row['img5']; ?>" data-lightbox="box1" data-title="<?php echo $row['title']; ?> - IMG5">
                    <img class="thumbnail" src="photo/item/<?php echo $row['img5']; ?>"/></a>
            </div>
        </div>
    </td>
        </tr>
    </table>
</div>
    
    <div id="detail_main2">
        
        <div id="detail_info_about_title">ABOUT THIS GAME </div>
        <div id="detail_info_about">
        <?php echo html_entity_decode($row['feature']); ?></div>
    </div>
    
    
    <div id="detail_main4">
        <div id="detail_info_related">Related Games</div>
        
        <div id="detail_info_relateinfo">
        <?php echo $row_author_related['author']; ?>
          
        <?php 
				 // 有紀錄
				 if ($row_author_related != false)
				 {
					 do 
					 { 
        ?>
            related:
            <a href="item_detail.php?pro_id=<?php echo $row_author_related['id']; ?>" rel="photo/item/<?php echo $row_author_related['photo']; ?>">
              <?php echo $row_author_related['title']; ?>
            </a>
            
            </br></br>
               
				<?php 
            } 
            while ($row_author_related = mysql_fetch_assoc($result_author_related));
          }
					else
					{
				?>	
    
        No any related games.</br></br></br>
          
        <?php 
					}
        ?>
    </div>
    </div>
    
    
    <div id="detail_main3">
        <div id="detail_info_buy">Purchase <?php echo $row['title']; ?> </div>
        <div id="detail_info_price">Selling Price: <?php if ($row['topseller']=="FREE TO PLAY!") { echo 'Free to play!'; } else {echo "USD$ ".$row['saleprice'];} ?>  </div>
        
        <a href="add_to_cart.php?id=<?php echo $row['id']; ?>"><div id="detail_info_purchase"><img src="images/addcart.png"/>ADD TO CART</div></a>
    </div>

    <div id="detail_main5">
        <div id="detail_comment_title">Comment (<?php echo $totalRows2 ?>)</div>
        
        <!--------- Here is comment box ---------->    
        
  <?php while ($row2 = mysql_fetch_array($result2)) 
    { 
      ?>
        <div id="comment_box">
        
    <div id="comment_box_name">
    <?php if ($row2['username']=="apple0032") { ?>
         <?php echo $row2['username']; ?>
        <img src="images/admin_icon.png" id="admin" title="admin">
        <?php } else
          if ($row2['username']!=="anonymous") { ?>
        <?php echo $row2['username']; ?>
        <img src="images/vip.png" id="member" title="member">
        
        <?php } else { ?> <div id="comment_anonymous"><?php echo $row2['username']; ?></div> <?php } ?>

    </div>
            
    <div id="comment_box_comment"><?php echo $row2['comment']; ?>
            </div>
            
        <div id="comment_box_time">POST: <?php echo $row2['datetime']; ?></div>    
        </div>
        
        <?php  }  ?>
        
        <!----------------------------------------->   
        
    
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="comment_form"> 
        <div id="comment_wanna">Wanna say something about this game?</div>
        <textarea rows="5" cols="80" name="comment"  id="comment"></textarea>
            
        <input type="submit" value="Submit" id="comment_submit"/>
            
            
        <input name="insert" id="insert" type="hidden" value="comment_new" />
        </form>
        
        <div id="detail_main5_gap"></div>
        
    </div>



</div>
        
</section>
      
    

<!-- 載入下邊區塊 -->
<div id="footer"></div>


<script src="JavaScript/ideal-image-slider.js"></script>
<script src="JavaScript/iis-bullet-nav.js"></script>
</body>
</html>
<?php
// 釋放結果集
mysql_free_result($result);
mysql_free_result($result_author_related);
?>