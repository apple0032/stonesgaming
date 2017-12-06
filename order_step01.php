<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php 
if (!isset($_SESSION)) {
  session_start();
} 
// 已經登入
if ((isset($_SESSION['Username'])) && (isset($_SESSION['UserGroup']))) {
  header('Location: order_step02.php');
}

// 前一個網頁
$_SESSION['PrevPage'] = $_SERVER['PHP_SELF'];
?>
<?php
//------------------------------------
// 修改購買商品的數量
//------------------------------------

if (isset($_POST['order_nextstep'])) 
{
  // [數量]文字欄位的索引值
  $index = 0;
  // 巡迴購物車內的所有商品
  foreach ($_SESSION['item']['item_index'] as $key => $value) 
  {
    // 有商品
    if (isset($_SESSION['item']['item_index'][$key])) 
    {			
			// 重新設定商品的數量
      $_SESSION['item']['quantity'][$key] = $_POST['order_quantity'][$index];
		}
		// [數量]文字欄位的索引值
		$index++;
  } 
	
	header('Location: order_step02.php');
}
?>
<?php
//------------------------------------
// 刪除購買的商品
//------------------------------------

// $_POST['order_delete'] 是[刪除]按鈕, $_POST['order_check'] 是核取方塊
if (isset($_POST['order_delete']) && isset($_POST['order_check'])) 
{ 
  // 巡迴所有的商品核取方塊
  foreach ($_POST['order_check'] as $key => $value) 
  {
    // 商品的核取方塊被勾選, $_POST['order_check'][$key]等於value屬性值
    if (isset($_POST['order_check'][$key])) 
		{	      
			// 第?個商品被刪除
			$index = $_POST['order_check'][$key];
			// 商品的編號				
			$_SESSION['item']['item_index'][$index] = NULL;
			unset($_SESSION['item']['item_index'][$index]);
			// 商品的名稱
			$_SESSION['item']['item_name'][$index] = NULL;
			unset($_SESSION['item']['item_name'][$index]);
			// 商品的單價
			$_SESSION['item']['price'][$index] = NULL;
			unset($_SESSION['item']['price'][$index]);
			// 商品的數量
			$_SESSION['item']['quantity'][$index] = NULL;
			unset($_SESSION['item']['quantity'][$index]);
			// 商品的總價
			$_SESSION['item']['total_price'][$index] = NULL;
			unset($_SESSION['item']['total_price'][$index]);	
		}
  }
}
?>
<?php
//------------------------------------
// 登入
//------------------------------------

// 有帳號與密碼欄位
if (isset($_POST['username']) && isset($_POST['password'])) 
{
	// 選擇 MySQL 資料庫ch30
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
	// 帳號與密碼欄位
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);	
	// 查詢 member 資料表
	$query = sprintf("SELECT username, password, userlevel FROM member WHERE username=%s AND password=%s",
			GetSQLValue($username, "text"), GetSQLValue($password, "text")); 
	// 傳回結果集
	$result = mysql_query($query, $connection) or die(mysql_error());
	
	if ($result)
	{
		// 目前的列
		$row = mysql_fetch_assoc($result);
		// 結果集的記錄筆數
		$totalRows = mysql_num_rows($result);
		
		// 使用者輸入的帳號與密碼存在於member資料表
		if ($totalRows) 
		{    
			// 建立session變數
			$_SESSION['Username'] = $username;
			$_SESSION['UserGroup'] = mysql_result($result, 0, 'userlevel');
			// 釋放結果集
			mysql_free_result($result);
		}
	}
		
	// 成功登入, 前 往order_step02.php
	header("Location: order_step01.php");
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
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Cart</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<link rel="stylesheet" href="CSS/order_step01.css">
<script src="JavaScript/order_step02.js" type="text/javascript"></script>
</head>
<body>
<!-- 載入上邊區塊 -->
 <div id="header"></div>
<script>
    $('#header').load('header.php');
</script>

<table class="order_step02_style1">
  <tr>
    <td class="order_step02_style2">
      <table class="order_step02_style3">
        <tr>
          <td class="order_step02_style4">
            Step1. Login
          </td>
          <td class="order_step02_style5">
            Step2. View / Modify
          </td>
          <td class="order_step02_style5">
            Step3. Preview / Payment
          </td>
          <td class="order_step02_style5">
            Step4. Purchase
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="order_step02_style6">
        
        
        <a href="member_center.php"><div id="loginnoti">
        <div id="tri"></div>  
        Please login to continue the purchase process.
        
        </div></a>
        
        <div id="tempo">
        Temporary Shopping Cart
        </div>
        
    </td>
  </tr>
  <tr>
    <td>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="order_step02_style18">
        <table class="order_step02_style7">
          <tr>
            <td><div class="style_cart">View your games</div></td>
          </tr>
        </table>
        <!-- ------------------------ -->
        <!--      顯示購物車內的商品    -->
        <!-- ------------------------ -->
        <table class="order_step02_style7">
          <tr>
            <td class="order_step02_style19">X</td>
            <td class="order_step02_style20">Code</td>
            <td class="order_step02_style21">Name</td>
            <td class="order_step02_style21">Picture</td>
            <td class="order_step02_style22">Cost</td>
            <td class="order_step02_style23">Quantity</td>
          </tr>
				<?php 
          if (isset($_SESSION['item']['item_index'])) 
          {					
            // 巡迴購物車內的每個商品
            foreach ($_SESSION['item']['item_index'] as $key => $value) 
						{ 
        ?>
          <tr>
            <!-- 顯示購物車內商品的索引值 -->
            
            <td class="order_step02_style24">
                
                <input name="order_check[]" type="checkbox" class="myClass" value="<?php echo $key; ?>" />
                
            </td>

            <!-- 顯示購物車內商品的編號 -->
            <td class="order_step02_style25">
							<?php echo $_SESSION['item']['item_index'][$key]; ?>
            </td>
            <!-- 顯示購物車內商品的名稱 -->
            <td class="order_step02_style25">
							<?php echo $_SESSION['item']['item_name'][$key]; ?>
            </td>
            <!-- Display game picture -->
            <td class="order_step02_style25">
                         <img src="<?php echo 'photo/item/' . $_SESSION['item']['item_photo'][$key]; ?>"/>
            </td>
            <!-- 顯示購物車內商品的單價 -->
            <td class="order_step02_style25">
							<?php echo $_SESSION['item']['price'][$key]; ?>
            </td>
            <!-- 顯示購物車內商品的數量 -->
            <td class="order_step02_style24">
              <input name="order_quantity[]" type="text" size="2" maxlength="2" c
                value="<?php echo $_SESSION['item']['quantity'][$key]; ?>" />
            </td>
          </tr>
				<?php 
            } 
          } 
        ?>
        </table>
        <!-- ------------------------------------------------------ -->
        <!-- 顯示 "刪除","修改數量","清空購物車","繼續購物","下一步" 按鈕 -->
        <!-- ------------------------------------------------------ -->
        <table class="order_step02_style7">
				<?php 
          // 購物車沒有商品
          if (!$_SESSION['has_item']) 
          { 
        ?>
					<tr>
            <td>
              <table class="order_step02_style7">
                <tr>
                  <td colspan="5" class="order_step02_style26">
                    No Game in your cart.
                  </td>
                </tr>
              </table>
            </td>
          </tr>
				<?php 
          } 
					// 購物車內有商品
          else
          { 
        ?>
					<tr>
            <td> 
              <table class="order_step02_style7">
                <tr>
                  <td class="order_step02_style27"> 
                    <input name="order_delete" id="order_delete" type="submit" value="Remove" />
                  </td>
                </tr>
              </table>	
            </td>
          </tr>
				<?php 
          } 
        ?>
          <tr>
            <td>
              <table class="order_step02_style7">
                <tr>
                  <?php 
									  // 購物車內有商品
									  if ($_SESSION['has_item']) 
										{ 
									?>
                  <td class="order_step02_style29">
                    <input type="button" value="Clear My Cart" onclick="return clearCart();" />
                  </td>
                  <?php 
									  } 
								  ?>
                  <td class="order_step02_style30">
                    <input type="button" value="Continue Shopping" class="order_step02_style31" 
                       onclick="document.location='<?php echo $_SESSION['shopping_page']; ?>'; return false;" />		
                  <?php 
									  // 購物車內有商品
									  if ($_SESSION['has_item']) 
										{ 
									?>	
                      	
								  <?php 
									  } 
									?>  
                  </td>
                </tr>
              </table>	
            </td>
          </tr>
        </table>
          
      </form>
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
mysql_free_result($result);
?>