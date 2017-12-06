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


// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
// 查詢computer_books資料表的author或translator欄位
$query = "SELECT * FROM " . $_SESSION['database']." WHERE category = 'strategy' ORDER BY publishdate DESC";

// 傳回結果集
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
<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>STONE Store</title>
<link href="CSS/store.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script> 
<script src="JavaScript/jquery.sticky-kit.js"></script>
<script src="JavaScript/jBox.min.js"></script>
<link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
<script src="JavaScript/store.js"></script>
<link rel="stylesheet" href="CSS/magnific-popup.css">
<script src="JavaScript/jquery.magnific-popup.js"></script>
    <style type="text/css">
    #store_main{
    background-image: url(images/strategywall.png);
    background-attachment: fixed;　
    background-repeat: no-repeat;
}
</style>
<style>
    #game_style a{
    background: -webkit-gradient(linear, center top, center bottom, from(#ededed), to(#fff));
	background-image: linear-gradient(#ededed, #fff);
	border-radius: 12px;
	box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,0.1);
	color: #222;
    pointer-events: none;
    cursor: default;
    }   
</style>
</head>

<body>
<!-- 載入上邊區塊 -->
 <div id="header"></div>
    
    
<section id="store_top">
    <div id="store_top_div">

        <table><tr>
        <td><div class="store_top_banner"><p>Store</p></div></td>
        
        
        <td>    
        <ul id="store_top_box">
            <a href="store.php"><li class="store_top_container">
            Adventure</li></a>
            <a href="action.php"><li class="store_top_container">Action</li></a>
            <a href="strategy.php"><li class="store_top_container">Strategy</li></a>
            <a href="sports.php"><li class="store_top_container">Sports</li></a>
            <a href="multiplay.php"><li class="store_top_container">Multiplay</li></a>
        </ul>
        </td>
    
        <td>
            <?php
            if (!isset($_SESSION['Username'])) { ?>
            
            <div id="user_detail">
            <div id="user_detail_line1">Please login or join us to shop</div> 
           <div id="user_detail_fun">
                <!--- This is pop up window --->
                <div id="how-popup" class="white-popup mfp-hide">
                    Welcome to Stone's store ! </br></br>
                <img src="images/store_pop.png"></br>
                The shopping process is simple and easy. </br></br></br>
            
            <pre>Step.1&nbsp;&nbsp; Login to your member account. </br>
Step.2&nbsp;&nbsp; Select your favorite games, click on the product and
         read the game details or buy the game directly.</br>
Step.3&nbsp;&nbsp; Confirm your name, address and total amount. </br>
Step.4&nbsp;&nbsp; Click [purchase] button to complete.
            </pre>
                </br></br>
                Click everywhere to close this window.
                </div>
                <a href="#how-popup" class="open-popup-link">How?</a>
                <a href="member_center.php" title="Cart">Login</a>
                <a href="order_step01.php" title="Create an account">Shopping Cart</a>
            </div>
            </div>
            <?php  }     else  { ?>
             <div id="user_detail">
            <div id="user_detail_line1">Hi! <?php echo $_SESSION['Username']; ?>,  Welcome Back!</div> 
            <div id="user_detail_fun">
                <a href="member_center.php" title="center">Center</a>
                <a href="order_step01.php" title="Cart">Shopping Cart</a>
                <a href="log_out.php" title="Create an account">Logout</a>
            </div>
            </div>
            <?php  }   ?>
            
            
        </td>
        </tr>
        </table>
    
    </div>

</section>


<section id="store_main">
  <div id="store_main_gap"></div>
  
<?php 
//-----------------------------
// 有書籍的紀錄
//-----------------------------
if ($rowsOfCurrentPage)
{
?> 
  <!--********************************************-->
  <!-- 顯示 資料筆數 ? 共分 ? 頁 第 1 頁/下頁/末頁 -->
  <!--********************************************-->
  
      <div id="store_cate">
        <div id="store_title">
           Strategy Games
        </div>
    </div>
    
    
    <!--*******************-->
    <!---- The Right menu --->
    <!--*******************-->
    
   
    <div id="store_main_menu">
    
    <div id="Tooltip" class="jBox-Tooltip">
    <a href="store.php" alt="Adventure" title="Adventure">
        <img src="images/adventure.png"> </a>
    </div>
    
    <div id="Tooltip2" class="jBox-Tooltip">
    <a href="action.php" alt="Action" title="Action">
        <img src="images/action.png"></a>
    </div>
        
    <div id="Tooltip3" class="jBox-Tooltip">
    <a href="strategy.php" alt="Strategy" title="Strategy">
        <img src="images/strategy.png"></a>
    </div>
        
    <div id="Tooltip4" class="jBox-Tooltip">
    <a href="sports.php"alt="Sport" title="Sport">
        <img src="images/sports.png"></a>
    </div>
    
    <div id="Tooltip5" class="jBox-Tooltip">
    <a href="multiplay.php"alt="Multiplay" title="Multiplay">
        <img src="images/mulitplay.png"></a>
    </div>
    
     <div id="Tooltip6" class="jBox-Tooltip">
        <a href="#" id="backtotop" alt="backtotop" title="backtotop">
        <img src="images/backtop.png"></a></div>
    
    </div>
  
  <!--*******************-->
  <!-- Display the games -->
  <!--*******************-->
    <div id="store_main_container">
	<?php 
		// 讀取目前的紀錄
    while ($row = mysql_fetch_array($result)) 
    { 
      
    ?>
        <div id="store_main_game">
    <table>
        <tr>
            <td>
                <a href="item_detail.php?pro_id=<?php echo $row['id']; ?>">
                    <img src="<?php echo 'photo/item/' . $row['photo']; ?>" width="100" /></a>
            </td>
            <td>
                <div id="store_main_game_title">
                <a href="item_detail.php?pro_id=<?php echo $row['id']; ?>">
                    <h1><?php echo $row['title']; ?></h1></a>
                </div>
                <div id="store_main_game_author">
                <?php echo $row['author']; ?>
                </div>
                <div id="store_main_game_saleprice">
                <b>&nbsp;USD$&nbsp;<?php echo $row['saleprice']; ?>&nbsp;</b>
                </div>
                <div id="store_main_game_topseller">
                <h5><?php echo $row['topseller']; ?></h5>
                </div>
                <div id="store_main_game_buy">
                    <a href="add_to_cart.php?id=<?php echo $row['id']; ?>">&nbsp;	add to cart &nbsp;</a>
                </div>
                
            </td>
        </tr>
    </table>
        </div>
        
    <?php 	 
    }
    ?>
        
        <div id="store_main_page2">
        <div id="store_main_page_line1">
        Category:  Adventure Games
        </div>
        <div id="store_main_page_line2">
  
        Number of Games ：<?php echo $totalRows ?>&nbsp;&nbsp;&nbsp;
      
        Total <?php echo $totalPages; ?> Pages &nbsp;&nbsp; 
      
         <?php echo $rowsPerPage; ?> Games/page &nbsp;&nbsp;
    
			  <?php 
				  if ($page > 0) {
			  ?>
            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], 0); ?>" ><img src="images/first_page.png"></a>
				<?php 
					}
				?>
        <?php 
				  if ($page > 0) {
			  ?>
            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], max(0, $page - 1)); ?>" 
              ><img src="images/previous_page.png"></a>        
        <?php 
					}
				?>
				Page-<?php echo $page + 1; ?>
    		<?php 
				  if ($page < $totalPages - 1) {				
				?>
            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], min($totalPages - 1, $page + 1)); ?>" 
              > <img src="images/next_page.png"></a>
        <?php 
					}
				?>
				<?php 
				  if ($page < $totalPages - 1) {				
				?>
            <a href="<?php printf("%s?page=%d", $_SERVER["PHP_SELF"], $totalPages - 1); ?>" > <img src="images/last_page.png"></a>
        <?php 
					}
				?>
      </div>
    </div>
    </div>

  <!--********************************************-->
  <!-- 顯示 資料筆數 ? 共分 ? 頁 第 1 頁/下頁/末頁 -->
  <!--********************************************-->
  
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
</section>

<!-- 載入下邊區塊 -->
<div id="footer"></div>
    
</body>
</html>
<?php
// 釋放結果集
mysql_free_result($result);
?>