<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php
if (!isset($_SESSION)) {
	session_start();	
}
?>
<?php
//------------------------------------
// 查詢要購買的商品的資料
//------------------------------------

// $_SESSION['database'] 資料表的欄位數值
$field = "-1";
if (isset($_GET['id'])) {
  $field = $_GET['id'];
}

// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
// 查詢 $_SESSION['database'] 資料表
$query = sprintf("SELECT * FROM " . $_SESSION['database'] . " WHERE id = %s", GetSQLValue($field, "int"));
// 傳回結果集
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
// 檢查要購買的商品是否已經存在
//------------------------------------

// 檢查商品是否已經存在
$item_exist = FALSE;

// 購物車內已經有商品
if (isset($_SESSION['item']['item_index']))	
{
	// 巡迴購物車內的商品
	foreach($_SESSION['item']['item_index'] as $key => $value) 
	{	
		// 購物車內的商品編號,與加入的商品編號相同
		if ($_SESSION['item']['item_index'][$key] == $row['item_index']) 
		{
			// 商品已經存在, 不要再加入
			$item_exist = TRUE;
			break;
		}
	}
}

// 商品還沒存在, 加入目前要購買的商品
if (!$item_exist)
{
  $_SESSION['item']['id'][] = $row['id'];
  // 商品的編號				
  $_SESSION['item']['item_index'][] = $row['item_index'];
  // 商品的名稱
  $_SESSION['item']['item_name'][] = $row['title'];
  // 商品的封面
  $_SESSION['item']['item_photo'][] = $row['photo'];
  // 商品的單價
  $_SESSION['item']['price'][] = $row['saleprice'];
  // 商品的數量
  $_SESSION['item']['quantity'][] = 1;
  // 商品的總價
  $_SESSION['item']['total_price'][] = $row['saleprice'];
}
		
//------------------------------------
// 已經登入?
//------------------------------------

if ((isset($_SESSION['Username'])) && (isset($_SESSION['UserGroup']))) {
  header('Location: order_step02.php');
}
else {
  header('Location: order_step01.php');
}
?>
<?php
// 釋放結果集
mysql_free_result($result);
?>