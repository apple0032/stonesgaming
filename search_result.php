<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php 
if (!isset($_SESSION)) {
  session_start();
}
// 前一個網頁
$_SESSION['PrevPage'] = $_SERVER['PHP_SELF'];
// 購物的網頁
$_SESSION['shopping_page'] = $_SERVER['PHP_SELF'];
?>
<?php 
$database_array = array("computer_books");
$category_array = array("電腦圖書", "教育軟體", "商用軟體");

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
if (isset($_POST['keyword_category'])) 
{
	$keyword_category = $_POST['keyword_category'];
	$_SESSION['keyword_category'] = $keyword_category;
}
else 
{
	$keyword_category = "所有商品";
}
?>
<?php 
//------------------------------------
// 顯示搜尋的商品資料
//------------------------------------

// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 

if ($keyword_category == "所有商品")
{
	$result_all = array();
	$row_all = array();
	// 尋找所有商品的資料表
	for ($i = 0; $i < count($database_array); $i++)
	{
		// 查詢書籍標題, 作者, 翻譯者, 以及書籍編號
		$query = "SELECT * FROM " . $database_array[$i] . " WHERE title LIKE '%" . 
			$keyword . "%' OR author LIKE '%" . $keyword . "%' OR translator LIKE '%" . 
			$keyword . "%' OR item_index LIKE '%" . $keyword . "%' ORDER BY publishdate DESC";
		// 傳回結果集
		$result_all[$i] = mysql_query($query, $connection) or die(mysql_error());
	}
}
else
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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search Result</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="CSS/search_result.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">

</head>
<body>
<!-- 載入上邊區塊 -->
 <div id="header"></div>
<script>
    $('#header').load('header.php');
</script>

<div id="store_main_gap2">Store Search Result : </div>	
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
		  ?>
          
         <div id="store_main_container"> 
        <div id="store_main_game">
    <table>
        <tr>
            <td>
                <a href="item_detail.php?pro_id=<?php echo $row_all[$i]['id']; ?>" >
                    <img src="<?php echo 'photo/item/' .$row_all[$i]['photo']; ?>"/></a>
            </td>
            <td>
                <div id="store_main_game_title">
                <a href="item_detail.php?pro_id=<?php echo $row_all[$i]['id']; ?>" >
            <h1><?php echo $row_all[$i]['title']; ?></h1></a>
                </div>
                
                <div id="store_main_game_author">
                <?php echo $row_all[$i]['author']; ?>
                </div>
                
                <div id="store_main_game_saleprice">
                <b>&nbsp;USD$&nbsp;<?php echo $row_all[$i]['saleprice']; ?>&nbsp;</b>
                </div>
                <div id="store_main_game_topseller">
                <h5><?php echo $row_all[$i]['topseller']; ?></h5>
                </div>
                <div id="store_main_game_buy">
                    <a href="add_to_cart.php?id=<?php echo $row_all[$i]['id']; ?>" >&nbsp;	add to cart &nbsp;</a>
                </div>
            </td>
        </tr>
    </table>
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
    
				<div id="store_main_gap"></div>	
            
    <?php
					// 沒有商品
			    if (!$has_item)
					{
				?>
       
                    <div id="search_no">
                        <div>
						No games found.
                            <style>#footer{bottom:0; position:fixed;}</style>
                         </div>   
                    </div>
        
        <?php	
				  }
				}
				
				?>
      </table>
	</td>
  </tr>
</table>
<!-- 載入下邊區塊 -->
<div id="footer"></div>
<script> $('#footer').load('footer.html');</script>
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