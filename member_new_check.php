<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php
// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 

// 新會員輸入的帳號
$check_name = "-1";
if (isset($_GET['username'])) {
  $check_name = $_GET['username'];
}

// 查詢新會員輸入的帳號是否已經存在？
$query = sprintf("SELECT username FROM member WHERE username = %s", GetSQLValue($check_name, "text"));
$result = mysql_query($query) or die(mysql_error());

// 結果集的記錄筆數
$totalRows = mysql_num_rows($result);
// 傳回指定帳號的資料筆數
echo $totalRows;

// 釋放結果集
mysql_free_result($result);
?>