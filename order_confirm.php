<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php
if (!isset($_SESSION)) {
	session_start();	
}
// 尚未登入
if ((!isset($_SESSION['Username'])) && (!isset($_SESSION['UserGroup']))) {
  header('Location: order_step01.php');
}
?>
<?php
//------------------------------------
// 檢查購物車內是否有商品
//------------------------------------

// 購物車內有商品
$_SESSION['has_item'] = TRUE;
// 商品的編號				
if (!isset($_SESSION['item']['item_index']) || (count($_SESSION['item']['item_index']) == 0)) {
  // 購物車內沒有商品
  $_SESSION['has_item'] = FALSE;
}

// 沒有加入商品
if (!$_SESSION['has_item']) {
  header('Location: order_step02.php');
}
?>
<?php
//------------------------------------
// 顯示購物者的資料
//------------------------------------

$field = "-1";
if (isset($_SESSION['Username'])) {
  $field = $_SESSION['Username'];
}

// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
// 查詢 member 資料表
$query = sprintf("SELECT * FROM member WHERE username = %s", GetSQLValue($field, "text"));
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

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Finish Purchasing</title>
</head>
<body>
<script type="text/javascript">
  alert("Thank you for your order, your order will be processed within 24 hours.");
  // 清除購物車
  location.href = "clear_cart.php";
</script>
</body>
</html>
<?php
// 釋放結果集
mysql_free_result($result);
?>