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
// 付款方式
if (!isset($_SESSION['payment'])) {
  $_SESSION['payment'] = 'Paypal';
}

$datetime = date ("Y-m-d-H:i:s" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 

// 訂單編號

  $_SESSION['order_index'] = 'DR-' . strtoupper($_SESSION['Username']) . '-' . $datetime . '-' . rand(10,1000) ;

?>
<?php
//------------------------------------
// 顯示購物者的資料
//------------------------------------

// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
// 查詢 member 資料表
$query = sprintf("SELECT * FROM member WHERE username = %s", GetSQLValue($_SESSION['Username'], "text"));
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
//-----------------------------------------
// 插入訂單的商品詳細資料
//-----------------------------------------

if ((isset($_POST["insert"])) && ($_POST["insert"] == "order_form")) 
{
	// 選擇 MySQL 資料庫ch30
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在');	
	
	// 購物車內有商品
  if (isset($_SESSION['item']['item_index'])) 
  {
    // 巡迴購物車內的所有商品
		foreach ($_SESSION['item']['item_index'] as $key => $value) 
		{
			if (isset($_SESSION['item']['item_index'][$key])) 
			{
			  // 在order_detail資料表內插入一筆新的紀
				$query = sprintf("INSERT INTO order_detail (username, order_index, item_index, item_name, photo, quantity, single_price, total_price) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
					GetSQLValue($_POST['username'], "text"),
					GetSQLValue($_POST['order_index'], "text"),
					GetSQLValue($_SESSION['item']['item_index'][$key], "text"),
					GetSQLValue($_SESSION['item']['item_name'][$key], "text"),
                    GetSQLValue($_SESSION['item']['item_photo'][$key], "text"),
					GetSQLValue($_SESSION['item']['quantity'][$key], "int"),
					GetSQLValue($_SESSION['item']['price'][$key], "int"),
					GetSQLValue($_SESSION['item']['total_price'][$key], "int"));
			
					// 傳回結果集
					$result = mysql_query($query, $connection);
			}
		}
	}
}
?>
<?php
//-----------------------------------------
// 插入訂單的總金額,日期,與付款方式
//-----------------------------------------

if ((isset($_POST["insert"])) && ($_POST["insert"] == "order_form")) 
{
	// 選擇 MySQL 資料庫ch30
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在');	
	
	// 在order_list資料表內插入一筆新的紀
	$query = sprintf("INSERT INTO order_list (username, order_index, order_price, payment, order_date) VALUES (%s, %s, %s, %s, %s)",
						 GetSQLValue($_POST['username'], "text"),
						 GetSQLValue($_POST['order_index'], "text"),
						 GetSQLValue($_POST['order_price'], "int"),
						 GetSQLValue($_POST['payment'], "text"),
						 GetSQLValue($_POST['order_date'], "date"));
			
	// 傳回結果集
	$result = mysql_query($query, $connection);
	
	if ($result) {
		header("Location: order_confirm.php");
	}
}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Cart</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="CSS/order_step04.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="JavaScript/jquery-imgpreview.min.js"></script>
<script src="JavaScript/imgpreview.full.jquery.js"></script>
<script src="JavaScript/jBox.min.js"></script>
<link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
</head>
<body>
<!-- 載入上邊區塊 -->
<div id="header"></div>
<script>
    $('#header').load('header.php');
</script>
    
<table class="order_step03_style1">

<tr>
    <td>
        <div id="button1"><a href="store.php"><img src="images/minimize.png" class="tooltip" title="Purchase later"></a></div>
        
        <div id="button2"><a href="clear_cart.php"><img src="images/closed2.png" class="tooltip" title="Clear Cart"></a></div>
    </td>
</tr>
    
<tr>
<td>   
<div id="order_title"> Your order details </div> 
</td> 
</tr>    
    
  <tr>
    <td>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="order_step03_style15">
        <table class="order_step03_style8">
          <tr>
            <td>
            <div class="style_cart">Your order
            <div id="tri"></div>
            </div>
            </td>
          </tr>
        </table>
        <!-- ------------------------ -->
        <!--      顯示購物車內的商品    -->
        <!-- ------------------------ -->
        <table class="style7">
          <tr>
            <td class="order_step03_style16">Code</td>
            <td class="order_step03_style17">Name</td>
            <td class="order_step03_style18">Cost</td>
            <td class="order_step03_style19">Quantity</td>
            <td class="order_step03_style20">Total</td>
          </tr>
				<?php 
          if (isset($_SESSION['item']['item_index'])) 
          {					
            // 巡迴購物車內的每個商品
            foreach ($_SESSION['item']['item_index'] as $key => $value) 
						{ 
        ?>
          <tr>
            <!-- 顯示購物車內商品的編號 -->
            <td class="order_step03_style22">
							<?php echo $_SESSION['item']['item_index'][$key]; ?>
            </td>
            <!-- 顯示購物車內商品的名稱 -->
            <td class="order_step03_style22" id="hoverme">
                <a href="photo/item/<?php echo $_SESSION['item']['item_photo'][$key];?>"><?php echo $_SESSION['item']['item_name'][$key]; ?></a>
            </td>
            <!-- 顯示購物車內商品的單價 -->
            <td class="order_step03_style22">
							<?php echo $_SESSION['item']['price'][$key]; ?>
            </td>
            <!-- 顯示購物車內商品的數量 -->
            <td class="order_step03_style22">
              <?php echo $_SESSION['item']['quantity'][$key]; ?>
            </td>
            <!-- 顯示購物車內商品的總價 -->
            <td class="order_step03_style22">
              <?php echo $_SESSION['item']['total_price'][$key]; ?>
            </td>
          </tr>
				<?php 
            }
          } 
        ?>
        </table>
        
          
        <div id="gap"></div>
        <table class="order_step03_style8">
          <tr>
            <td>
            <div class="style_cart">order details
            <div id="tri"></div>
            </div>
            </td>
          </tr>
        </table>  
          
          
        <!-- ------------------- -->
        <!--     顯示運費與總計    -->
        <!-- ------------------- -->
          <div id="cart_notice">
                
                    <div id="cart_notice_img"><img src="images/purchase.png"></div>
                    <div id="cart_notice_word">
                    
                        <table class="order_step03_style28">
          <tr>
            <td class="order_step03_style26">
				       Payment methods
            </td>
            <td class="order_step03_style27">
				      <?php echo $_SESSION['payment'] ?>
            </td>
          </tr>
          <tr>
            <td class="order_step03_style26">
				      Order Number
            </td>
            <td class="order_step03_style27">
				      <?php echo $_SESSION['order_index'] ?>
            </td>
          </tr>
          <tr>
            <td class="order_step03_style26">
				      Order Total Price 
            </td>
            <td class="order_step03_style27">
				      $USD 
							<span class="order_step03_style31">
							  <?php echo $_SESSION['total'] ?>
              </span>
              
            </td>
          </tr>
        </table>
                        
                    </div>
                
              </div>
          
    
        <table class="order_step03_style8">
          <tr>
            <td>
            <div class="style_cart">purchase confirmation
            <div id="tri"></div>
            </div>
            </td>
          </tr>
        </table> 
          
        
        <!-- ------------------------ -->
        <!-- 顯示 "上一步","下一步" 按鈕 -->
        <!-- ------------------------ -->
        <div id="comfirm">

              <input type="button" value="Previous step" 
              onclick="document.location='order_step03.php'; return false;" />	
            
              <input type="submit" value="Purchase now!" />	
        </div>
          
			  <input name="username" id="username" type="hidden" value="<?php echo $row['username']; ?>" />
          
			  <input name="order_index" id="order_index" type="hidden" value="<?php echo $_SESSION['order_index']; ?>" />
          
        <input name="order_price" id="order_price" type="hidden" value="<?php echo $_SESSION['total']; ?>" />
          
			  <input name="payment" id="payment" type="hidden" value="<?php echo $_SESSION['payment']; ?>" />
          
			  <input name="order_date" id="order_date" type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" />
          
			  <input name="insert" id="insert" type="hidden" value="order_form" />
      </form>
    </td>
  </tr>
</table>
<!-- 載入下邊區塊 -->
<div id="footer"></div>
<script> $('#footer').load('footer.html');</script>
<script>
$('#hoverme a').imgPreview({
    containerID: 'imgPreviewWithStyles',
    imgCSS: {
        // Limit preview size:
        height: 200
    },
    // When container is shown:
    onShow: function(link){
        // Animate link:
        $(link).stop().animate({opacity:0.4});
        // Reset image:
        $('img', this).stop().css({opacity:0});
    },
    // When image has loaded:
    onLoad: function(){
        // Animate image
        $(this).animate({opacity:1}, 300);
    },
    // When container hides: 
    onHide: function(link){
        // Animate link:
        $(link).stop().animate({opacity:1});
    }
});

</script>
</body>
</html>