<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php 

// 前一個網頁
$_SESSION['PrevPage'] = $_SERVER['PHP_SELF'];
?>

<?php 
$database_array = array("community");
$category_array = array("community");

// 尋找的關鍵字
if (isset($_POST['keyword'])) 
{
	$keyword = trim($_POST['keyword']);
	$_SESSION['keyword'] = $keyword;
}
else 
{
	if (!empty($_SESSION['keyword'])) {
	  $keyword = $_SESSION['keyword'];
	}
	else {
		header("Location: " . $_SESSION['PrevPage']);
	}
}

// 尋找的資料表種類
if (isset($_POST['keyword_category'])) // NO any category defined
{
	$keyword_category = $_POST['keyword_category'];
	$_SESSION['keyword_category'] = $keyword_category;
}
else 
{
	$keyword_category = "所有商品"; // MUST BE THIS
}
?>
<?php 
//------------------------------------
// 顯示搜尋的商品資料
//------------------------------------

// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 

if ($keyword_category == "所有商品") // MUST BE -> "所有商品" 
{
	$result_all = array();
	$row_all = array();
	// 尋找所有商品的資料表
	for ($i = 0; $i < count($database_array); $i++)
	{
		// 查詢書籍標題, 作者, 翻譯者, 以及書籍編號
		$query = "SELECT * FROM " . $database_array[$i] . " WHERE title LIKE '%" . 
			$keyword . "%' OR username LIKE '%" . 
			$keyword . "%' ORDER BY datetime DESC";
		// 傳回結果集
		$result_all[$i] = mysql_query($query, $connection) or die(mysql_error());
        $totalRows=mysql_num_rows($result_all[$i]);
	}
}
else // This should not be appeared
{
	// 尋找 "電腦圖書", "教育軟體", "商用軟體" 資料表
	foreach ($category_array as $key => $value) 
	{
		// 找到尋找範圍
		if ($keyword_category == $value)
		{	
		  // 查詢書籍標題, 作者, 翻譯者, 以及書籍編號
			$query = "SELECT * FROM " . $database_array[$key] . " WHERE title LIKE '%" . 
				$keyword . "%' OR author LIKE '%" . $keyword . "%' OR translator LIKE '%" . 
				$keyword . "%' OR item_index LIKE '%" . $keyword . "%' ORDER BY publishdate DESC";
		  // 傳回結果集
			$result = mysql_query($query, $connection) or die(mysql_error());
	
			if ($result)
			{
			  // 目前的列
				$row = mysql_fetch_assoc($result);
				break;	
			}
		}
	}
}
?>
<!doctype html>
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
<div id="community_toppest_title">Community Search Result
<div id="result_back"><a href="community.php"><img src="images/previous.png" class="tooltip" title="Back to Main Page"></a></div>
</div>
</div>
    
<div id="topbox_container">
    
<div id="community_topbox1">

<div id="result_box">
    
    You are searching : <i><?php echo $keyword ?></i> 
    <br><br>
    And the total result is : <?php echo $totalRows ?>
    <br><br>
    <div id="result_noted">You can search again but noted that don't repeatedly search in a short time.</div>
    
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
<a href="community_photo.php" class="tooltip" title="Share a picture"><img src="images/share.jpg"></a>
<a href="community_add.php" class="tooltip" title="Create new post"><img src="images/discussion.jpg"></a>
</div>
    
</div>    

			<?php
			  //------------------------------- 
				// 顯示 "所有商品"
				//------------------------------- 
				
				if ($keyword_category == "所有商品")
				{
				  // 沒有商品
				  $has_item = false;
					
				  // 尋找所有商品的資料表
					for ($i = 0; $i < count($database_array); $i++)
					{		
						// 有紀錄
						if ($result_all[$i])
						{
							$row_all[$i] = mysql_fetch_assoc($result_all[$i]);
							// 有紀錄
							if ($row_all[$i])
							{
								// 讀取每一筆記錄
								do
								{	
    $comment1 = strip_tags(html_entity_decode($row_all[$i]['comment'])) ;
    $comment_detail = html_entity_decode($row_all[$i]['comment']) ;                      
    
            //-----------------------------//
            // DISPLAY CURRENT TOTAL REPLY //
            //-----------------------------//
                                    
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
$query3 = sprintf("SELECT * FROM community_reply WHERE topic_id = %s ORDER BY datetime ASC", GetSQLValue($row_all[$i]['id'], "int"));
$result3 = mysql_query($query3, $connection) or die(mysql_error());
if ($result3)
{$totalRows3 = mysql_num_rows($result3);}
                                    
		  ?>
          
        <div id="community_list">
    
        <a href="community_detail.php?id=<?php echo $row_all[$i]['id']; ?>" class="titlehref"><div id="community_list_title"> <?php echo $row_all[$i]['title'] ?></div></a><br>
        
        <a href="#<?php echo $row_all[$i]['id'] ?>" class="open-popup-link">
            
            <?php if(empty($row_all[$i]['photo'])) { ?>
            
            <div id="community_list_content" ><?php echo substr(($comment1),0, 250); ?> <?php if (strlen($comment1)>200){ echo "........" ;} ?>
            </div>
            
            <?php } else { ?>
            
            <div id="community_image">
            <img src="<?php echo $row_all[$i]['photo'] ?>">
            </div>
            
            <?php } ?>
            
        </a>
        
        <!---------- POPUP WINDOW ---------->
        <div id="<?php echo $row_all[$i]['id'] ?>" class="white-popup1 mfp-hide">
            
          <?php if(empty($row_all[$i]['photo'])) { ?>  
                 <?php echo $comment_detail ?>
            <?php } else { ?>
                <div id="community_popup_image">
            <img src="<?php echo $row_all[$i]['photo'] ?>">
            </div>
            
            <?php } ?>
            
            <div id="popup_like">
       <img src="images/like.png" class="tooltip" title="Like" ><?php echo $row_all[$i]['love'] ?>
            
        <img src="images/dislike.png" class="tooltip" title="Dislike"><?php echo $row_all[$i]['dislove'] ?>
                
            <div id="popup_reply">
                <a href="community_detail.php?id=<?php echo $row_all[$i]['id']; ?>"><img src="images/speaker.png" class="tooltip" title="Say Something!"></a>
            </div>
                
        </div>

        </div>
        <!---------- POPUP WINDOW ---------->
        
        
        <div id="community_list_like">
        <img src="images/reply.png" class="tooltip" title="Reply"><?php echo $totalRows3 ?>
        
        <img src="images/like.png" class="tooltip" title="Like"><?php echo $row_all[$i]['love'] ?>
            
        <img src="images/dislike.png" class="tooltip" title="Dislike"><?php echo $row_all[$i]['dislove'] ?>
        </div>
        
        
        <div id="community_list_user"><?php echo $row_all[$i]['username'] ?>  
        <div id="community_list_time"><?php echo $row_all[$i]['datetime'] ?></div>
        </div>
    
        
        
    </div>
          
          
        <?php 
								} 
								while ($row_all[$i] = mysql_fetch_assoc($result_all[$i])); 
								
								// 有商品
						    $has_item = true;
							}
						}
					} ?>
    	
            
    <?php
					// 沒有商品
			    if (!$has_item)
					{
				?>
       
                    <div id="search_no">
                       
                    </div>
        
        <?php	
				  }
				}
				
				?>

    </div>
    </section>
<!-- 載入下邊區塊 -->
<div id="footer"></div>
</body>
</html>
<?php
// 釋放結果集
if (isset($result) != false) {
	mysql_free_result($result);
}
	
for($i = 0; $i < count($database_array); $i++)
{
    if ($result_all[$i] != false) {
	    mysql_free_result($result_all[$i]);
		}
}
?>