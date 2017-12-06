<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php
// 選擇 MySQL 資料庫ch26
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch26不存在'); 

// 新會員輸入的帳號
$check_name = "-1";
if (isset($_GET['username'])) {
  $check_name = $_GET['username'];
}

// 查詢新會員輸入的帳號是否已經存在？
$query = sprintf("SELECT * FROM member WHERE username = %s", GetSQLValue($check_name, "text"));
$result = mysql_query($query) or die(mysql_error());

// 結果集的記錄筆數
$totalRows = mysql_num_rows($result);
// 傳回指定帳號的資料筆數
if ($totalRows > 0)
{
	// 結果集
	$row = mysql_fetch_assoc($result);
	
	// 收信人
	$to  = $row['email'];	
	// 主旨
	$subject = "德瑞購物廣場 - 會員密碼回函";
	// 信件的內容
	$body = "歡迎您加入德瑞購物廣場會員。<br />";
	$body .= "在德瑞購物廣場, 您隨時可以選購全國最齊全的電腦圖書/軟體/電腦週邊等相關商品。<br /><br />";
	$body .= "您個人的會員密碼為　" . $row['password'] . " 。";		
	// 信件的標頭
	$headers = "Content-type: text/html; charset=utf-8\r\n" . "From: daniel@derek.com";
	
	// 寄信
	mb_internal_encoding("utf-8");
	mb_send_mail($to, $subject, $body, $headers);
}

// 傳回指定帳號的資料筆數
echo $totalRows;
// 釋放結果集
mysql_free_result($result);
?>