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
// 設定付款方式
//------------------------------------
 
if (isset($_POST['order_nextstep'])) 
{
  $_SESSION['payment'] = $_POST['payment'];
  header('Location: order_step04.php');
}
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
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Cart</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="CSS/order_step03.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="JavaScript/jquery-imgpreview.min.js"></script>
<script src="JavaScript/imgpreview.full.jquery.js"></script>

</head>
<body>
<!-- 載入上邊區塊 -->
 <div id="header"></div>
<script>
    $('#header').load('header.php');
</script>

<table class="order_step03_style1">
  <tr>
    <td class="order_step03_style2">
      <table class="order_step03_style3">
        <tr>
          <td class="order_step03_style5">
            Step1. Login
          </td>
          <td class="order_step03_style5">
            Step2. View / Modify
          </td>
          <td class="order_step03_style4">
            Step3. Preview / Payment
          </td>
          <td class="order_step03_style5">
            Step4. Purchase
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="order_step03_style6">
      
        <table class="style7">
          <tr>
            <td class="order_step03_style8">
                <div id="style8">
                Please <b>DOUBLE</b> confirm your personal details
                </div>
                <a href="store.php"><div id="style9">
                <img src="images/store_back.png" title="Back to store"></div></a>  
            </td>
          </tr>
        </table>
        <table class="style7">
          <tr>
            <td class="order_step03_style9">Username</td>
            <td class="order_step03_style9">Name</td>
            <td class="order_step03_style10">Email</td>
            <td class="order_step03_style11">Phone</td>
            <td class="order_step03_style12">Recipient Address</td>
          </tr>
          <tr>
            <td class="order_step03_style13">
              <?php echo $row['username']; ?>
            </td>
            <td class="order_step03_style13">
              <?php echo $row['name']; ?>
            </td>
            <td class="order_step03_style13">
              <?php echo $row['email']; ?>
            </td>
            <td class="order_step03_style13">
              <?php echo $row['phone']; ?>
            </td>
            <td class="order_step03_style13">
              <?php echo $row['address']; ?>
            </td>
          </tr>
        </table>
     
    </td>
  </tr>
  <tr>
    <td>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="order_step03_style15">
         <table class="order_step03_style8">
          <tr>
            <td><div class="style_cart">View your games</div></td>
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
					// 付款總計
	  			$_SESSION['total'] = 0; 
						
          if (isset($_SESSION['item']['item_index'])) 
          {							
            // 巡迴購物車內的每個商品
            foreach ($_SESSION['item']['item_index'] as $key => $value) 
						{ 
						  // 購物車的總金額
   				    $_SESSION['item']['total_price'][$key] = $_SESSION['item']['price'][$key] * $_SESSION['item']['quantity'][$key];
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
							// 付款總計
							$_SESSION['total'] += $_SESSION['item']['total_price'][$key];
            }
          } 

					// 加上運費
                    if($_SESSION['total']<200){
					$_SESSION['total'] += 5; }
        ?>
        </table>
        <!-- ------------------- -->
        <!--     顯示運費與總計    -->
        <!-- ------------------- -->
        <table class="order_step03_style7">
          <tr>
            <td class="order_step03_style23">Service Charge</td>
            <td class="order_step03_style24">&nbsp;</td>
            <td class="order_step03_style24">+</td>
            <td class="order_step03_style25">
                <?php  if($_SESSION['total']<200){echo "USD$&nbsp;5" ;} 
                else {echo "USD$&nbsp;0";} ?>
            </td>
          </tr>
          <tr>
            <td class="order_step03_style23">Total Price</td>
            <td class="order_step03_style24">&nbsp;</td>
            <td class="order_step03_style24">&nbsp;</td>
            <td class="order_step03_style25">USD$&nbsp;<?php echo  $_SESSION['total']; ?></td>
          </tr>
        </table>
        <!-- ----------------- -->
        <!--     選擇付款方式    -->
        <!-- ----------------- -->
         
              <div id="cart_notice">
                
                    <div id="cart_notice_img"><img src="images/notice.png"></div>
                    <div id="cart_notice_word">
                    <ul>
                    <li>Please double check that the game cost and total price are both accurate.</li>   
                    <li>Note that each game will be deliver in either two ways - Entity DVD or Digital version. The digital one is default if you do not request for another.</li>
                    <li>The Service Charge will be free if your total price is over <B>USD$200</B>.</li>
                    </ul>
                    </div>
                
              </div>
          
              <div id="payment_method">
                Choose your payment methods:
              </br>
              <input name="payment" id="payment" type="radio" value="Paypal" checked="checked" />
              <span class="order_step03_style27">
                Paypal
              </span>
               
              <br />
              <input name="payment" id="payment" type="radio" value="Visa" />
              <span class="order_step03_style27">
                Visa credit card
              </span>
              <br />
              <input name="payment" id="payment" type="radio" value="MasterCard" />
              <span class="order_step03_style27">
                MasterCard
              </span>
               <br />
              <input name="payment" id="payment" type="radio" value="ATM remi" />
              <span class="order_step03_style27">
                ATM remittance
              </span>
              </div>
        
        <!-- ------------------------ -->
        <!-- 顯示 "上一步","下一步" 按鈕 -->
        <!-- ------------------------ -->
        <table class="order_step03_style7">
          <tr>
            <td class="order_step03_style29">
              <input type="button" value="Previous step" 
                onclick="document.location='order_step02.php'; return false;" />	
            </td>
            <td class="order_step03_style30">
              <input name="order_nextstep" id="order_nextstep" type="submit" value="Next step" />	
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