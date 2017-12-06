<?php require_once('Connections/connection.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}

// 前一個網頁
$_SESSION['PrevPage'] = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
// 購物的網頁
$_SESSION['shopping_page'] = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
?>
<?php
// 沒有URL參數
if (!(isset($_GET['pro_id'])) || !(isset($_GET['sub_id']))) {
	exit;
}
?>
<?php
// 尋找關鍵字
if (!isset($_SESSION['keyword']))
	$_SESSION['keyword'] = "";
// 尋找範圍
if (!isset($_SESSION['keyword_category']))
	$_SESSION['keyword_category'] = "";
?>
<?php	
$database = array("computer_books", "education_software", "commerical_software");
$category = array("電腦圖書", "教育軟體", "商用軟體");
$category_type = array(0 => array("網頁設計","程式語言","多媒體系列"), 
	1 => array("影像多媒體","電腦繪圖","工具軟體"), 2 => array("作業系統","防毒防駭","文書處理"));

$index1 = $_GET['pro_id'];
$index2 = $_GET['sub_id'];
// 作用資料表的名稱
$_SESSION['database'] = $database[$index1 - 1];
// 電腦圖書, 教育軟體, 商用軟體
$_SESSION['category'] = $category[$index1 - 1];
// 網頁設計, 程式語言, 多媒體系列
$_SESSION['category_type'] = $category_type[$index1 - 1][$index2 - 1];
?>
<?php
//---------------------------------------------------------
// 讀取庫ch30資料庫的 $_SESSION['database'] 資料表的全部紀錄
//---------------------------------------------------------

// 最大的列數
$rowsPerPage = 10;

// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
// 查詢computer_books資料表的author或translator位
$query = "SELECT * FROM " . $_SESSION['database'] .  
	" WHERE category = '" . $_SESSION['category'] . "' AND " . 
	" category_type = '" . $_SESSION['category_type'] . "' ORDER BY publishdate DESC";
// 傳回目前頁的結果集
$result = mysql_query($query, $connection) or die(mysql_error());

if ($result)
{
	// 結果集的記錄筆數
	$totalRows = mysql_num_rows($result);
	// 總頁數
	$totalPages = ceil($totalRows / $rowsPerPage);
}
?>
<?php
//-----------------------------------------------------
// 讀取庫ch30資料庫的computer_books資料表的目前頁的紀錄
//-----------------------------------------------------

// 目前頁的開始列號
$startRow = isset($page) * $rowsPerPage;
// 從目前頁的開始列號開始查詢
$current_query = sprintf("%s LIMIT %d, %d", $query, $startRow, $rowsPerPage);
// 傳回目前頁的結果集
$result = mysql_query($current_query, $connection) or die(mysql_error());
// 目前頁的記錄筆數
if ($result) {	
	$rowsOfCurrentPage = mysql_num_rows($result);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::德瑞購物廣場::</title>
<link href="CSS/L2_category_result.css" rel="stylesheet" type="text/css" />
</head>
<body>
<!-- 載入上邊區塊 -->
<?php require_once("menu_top.php"); ?>
<table class="L2_category_result_style1">
  <tr>
    <td class="L2_category_result_style2">
      <span class="L2_category_result_style3">
        分類 : <?php echo $_SESSION['category'] . " - " . $_SESSION['category_type']; ?>
      </span>
    </td>
  </tr>
</table>
<br />
<?php 
//-----------------------------
// 有書籍的紀錄
//-----------------------------
if ($rowsOfCurrentPage)
{
?> 
  <!--********************************************-->
  <!-- 顯示 資料筆數 ? 則 共分 ? 頁 第 1 頁/下頁/末頁 -->
  <!--********************************************-->
  <table class="L2_category_result_style4">
    <tr>
      <td class="L2_category_result_style5">
        資料筆數 ： <?php echo $totalRows ?> 
      </td>
      <td class="L2_category_result_style5">
        共分 <?php echo $totalPages; ?> 頁
      </td>
      <td class="L2_category_result_style5">
        每頁 <?php echo $rowsPerPage; ?> 筆
      </td>
      <td class="L2_category_result_style6">
			  <?php 
				  if (isset($page) > 0) {
			  ?>
            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], 0); ?>" class="L2_category_result_style7">首頁 /</a>
				<?php 
					}
				?>
        <?php 
				  if (isset($page) > 0) {
			  ?>
            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], max(0, $page - 1)); ?>" 
              class="L2_category_result_style7">上頁 /</a>        
        <?php 
					}
				?>
				第 <?php echo isset($page) + 1; ?> 頁
    		<?php 
				  if (isset($page) < $totalPages - 1) {				
				?>
            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], min($totalPages - 1, $page + 1)); ?>" 
              class="L2_category_result_style7"> / 下頁</a>
        <?php 
					}
				?>
				<?php 
				  if (isset($page) < $totalPages - 1) {				
				?>
            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], $totalPages - 1); ?>" class="L2_category_result_style7"> / 末頁</a>
        <?php 
					}
				?>
      </td>
    </tr>
  </table>
  <!--****************-->
  <!-- 顯示目前頁的資料 -->
  <!--****************-->
  <table class="L2_category_result_style8">
	<?php 
	  // 左邊的欄位
    $odd = true;
		// 第 ? 個紀錄
		$index = 0;
		
		// 讀取目前的紀錄
    while ($row = mysql_fetch_assoc($result)) 
    { 
	?>
		<?php 
      // 左邊的欄位
      if ($odd) 
      { 
    ?>
      <tr>
    <?php 
      }
    ?>
		<?php 
      // 單數列
      if ($index % 4 < 2) 
      { 
    ?>
		    <td class="L2_category_result_style9">
    <?php 
      } else {
		?>
			  <td class="L2_category_result_style16">
    <?php 
      }
		?>
          <table>
            <tr>
              <td class="L2_category_result_style10">
                <img src="<?php echo 'photo/item/' . $row['photo']; ?>" width="100" />
              </td>
              <td class="L2_category_result_style10">
                <table>
                  <tr>
                    <td class="L2_category_result_style11">
                      <a href="item_detail.php?pro_id=<?php echo $row['id']; ?>" class="L2_category_result_style12">
                        <?php echo $row['title']; ?>  
                      </a>     
                    </td>
                  </tr>
                  <tr>
                    <td class="L2_category_result_style13">
                      <?php echo substr($row['feature'], 0, 140); ?> 
                      &nbsp;
                      <a href="item_detail.php?pro_id=<?php echo $row['id']; ?>" class="L2_category_result_style12">
                        ...更多
                      </a>
                      <br />
                      作者 : 
                      <span class="L2_category_result_style14">
                        <?php echo $row['author']; ?>
                      </span>
                      <br />
                      發行日 : 
                      <span class="L2_category_result_style14">
                        <?php echo date("Y年n月", strtotime($row['publishdate'])); ?>
                      </span>
                      <br />
                      原價 : 
											<span class="L2_category_result_style14">
											  <?php echo $row['price']; ?> 元
                      </span>
                      <br />
                      <span class="L2_category_result_style15">
                        特價：<?php echo $row['discount']; ?> 折 
                         <?php echo $row['saleprice']; ?> 元
                      </span>
                      <br />
                      <img src="photo/item_list_shop.jpg" />
                      <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="L2_category_result_style12">				  
                        放入購物車
                      </a>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
    <?php 
		  // 更換左/右邊欄位
		  $odd = !$odd;
			// 下一個紀錄
			$index++;
			
			// 左邊欄位或目前頁的最後紀錄
      if ($odd || ($index > $rowsPerPage - 1)) 
      {
    ?>
      </tr>
    <?php
			}
    }
    ?>
  </table>
  <!--********************************************-->
  <!-- 顯示 資料筆數 ? 則 共分 ? 頁 第 1 頁/下頁/末頁 -->
  <!--********************************************-->
  <table class="L2_category_result_style4">
    <tr>
      <td class="L2_category_result_style5">
        資料筆數 ： <?php echo $totalRows ?> 
      </td>
      <td class="L2_category_result_style5">
        共分 <?php echo $totalPages; ?> 頁
      </td>
      <td class="L2_category_result_style5">
        每頁 <?php echo $rowsPerPage; ?> 筆
      </td>
      <td class="L2_category_result_style6">
			  <?php 
				  if (isset($page) > 0) {
			  ?>
            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], 0); ?>" class="L2_category_result_style7">首頁 /</a>
				<?php 
					}
				?>
        <?php 
				  if (isset($page) > 0) {
			  ?>
            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], max(0, $page - 1)); ?>" 
              class="L2_category_result_style7">上頁 /</a>        
        <?php 
					}
				?>
				第 <?php echo isset($page) + 1; ?> 頁
    		<?php 
				  if (isset($page) < $totalPages - 1) {				
				?>
            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], min($totalPages - 1, $page + 1)); ?>" 
              class="L2_category_result_style7"> / 下頁</a>
        <?php 
					}
				?>
				<?php 
				  if (isset($page) < $totalPages - 1) {				
				?>
            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], $totalPages - 1); ?>" class="L2_category_result_style7"> / 末頁</a>
        <?php 
					}
				?>
      </td>
    </tr>
  </table>
  <br />
<?php 
}
else
{
?>
  <table>
    <tr>
      <td>
        沒有資料 
      </td>
    </tr>
  </table>
<?php 
}
?>
<!-- 載入下邊區塊 -->
<?php require_once("menu_bottom.php"); ?>
</body>
</html>
<?php
// 釋放結果集
mysql_free_result($result);
?>