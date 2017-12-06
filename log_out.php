<?php require_once('clear_cart.php'); ?>

<?php
if (!isset($_SESSION['item'])) {
  session_start();
}

//-------------------------------
// 清除帳號與層級
//-------------------------------

$_SESSION['Username'] = NULL;
$_SESSION['UserGroup'] = NULL;
$_SESSION['PrevUrl'] = NULL;
unset($_SESSION['Username']);
unset($_SESSION['UserGroup']);
unset($_SESSION['PrevUrl']);

//-------------------------------
// 清空購物車
//-------------------------------

// 商品的編號				
$_SESSION['item']['item_index'] = NULL;
unset($_SESSION['item']['item_index']);
// 商品的名稱
$_SESSION['item']['item_name'] = NULL;
unset($_SESSION['item']['item_name']);
// 商品的單價
$_SESSION['item']['price'] = NULL;
unset($_SESSION['item']['price']);
// 商品的數量
$_SESSION['item']['quantity'] = NULL;
unset($_SESSION['item']['quantity']);
// 商品的總價
$_SESSION['item']['total_price'] = NULL;
unset($_SESSION['item']['total_price']);
// 訂單編號
$_SESSION['item']['order_index'] = NULL;
unset($_SESSION['item']['order_index']);
// 沒有商品
$_SESSION['item']['has_item']  = FALSE;

//-------------------------------
// 回到首頁
//-------------------------------

header("Location: member_center.php");
?>