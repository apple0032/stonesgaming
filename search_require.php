<?php require_once('Connections/connection.php'); ?>
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
// 目前是第 ? 頁
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
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
//-----------------------------------------------
// 讀取ch30資料庫的computer_books資料表的全部紀錄
//-----------------------------------------------

// 每頁？筆
$rowsPerPage = 10;

// 作用資料表的名稱
$_SESSION['database'] = 'computer_books';
$_SESSION['database2'] = 'commerical_software';


// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
// 查詢computer_books資料表的author或translator欄位
$query = "SELECT * FROM " . $_SESSION['database']." WHERE category = 'Adventure' ORDER BY id DESC";

// 傳回結果集
$result = mysql_query($query, $connection) or die(mysql_error());
$result2 = mysql_query($query, $connection) or die(mysql_error());

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
// 讀取ch30資料庫的computer_books資料表的目前頁的紀錄
//-----------------------------------------------------

// 目前頁的開始列號
$startRow = $page * $rowsPerPage;
// 從目前頁的開始列號開始查詢
$current_query = sprintf("%s LIMIT %d, %d", $query, $startRow, $rowsPerPage);
// 傳回目前頁的結果集
$result = mysql_query($current_query, $connection) or die(mysql_error());
// 目前頁的記錄筆數
if ($result) {	
	$rowsOfCurrentPage = mysql_num_rows($result);
}
?>