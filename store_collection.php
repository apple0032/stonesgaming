<?php
  session_start();
?>

<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php
// 前一個網頁
$_SESSION['PrevPage'] = $_SERVER['PHP_SELF'];

$_SESSION['login_form_title'] = "Please Login";
?>

<!-------- READ MEMBER TABLE FIRST -------->
<?php 
    if (isset($_SESSION['Username'])){
    mysql_select_db('stonesga_ch30', $connection) or die('database error'); 
    $query5 = sprintf("SELECT * FROM member WHERE username=%s",
        GetSQLValue($_SESSION['Username'],"text"));

    $result5 = mysql_query($query5, $connection) or die(mysql_error());
    if ($result5)
    {$row5 = mysql_fetch_assoc($result5);} ;
    }
?>
<!----------------------------------------->
<!-------------- READ Library -------------->

<?php
mysql_select_db('stonesga_ch30', $connection) or die('no database'); 

 if (isset($_SESSION['Username'])){
$query = sprintf("SELECT DISTINCT(item_name) FROM order_detail WHERE username = %s GROUP BY item_name DESC", GetSQLValue($_SESSION['Username'], "text"));

$result = mysql_query($query, $connection) or die(mysql_error());
if ($result)
{   
    $totalRows = mysql_num_rows($result);
}
 }
?>
<!-------------------------------------------->

<?php 
mysql_select_db('stonesga_ch30', $connection) or die('no database');
 if (isset($_SESSION['Username'])){
$query3 = sprintf("SELECT * FROM order_list WHERE username = %s", GetSQLValue($_SESSION['Username'], "text"));
$result3 = mysql_query($query3, $connection) or die(mysql_error());
if ($result3)
{   
    $totalRows3 = mysql_num_rows($result3);} }
?>


<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Store Collection</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="CSS/store_collection.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="JavaScript/store_collection.js"></script>
<script src="JavaScript/store.js"></script>
<script src="JavaScript/jBox.min.js"></script>
<link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="CSS/magnific-popup.css">
<script src="JavaScript/jquery.magnific-popup.js"></script>
<style>
    #collection_style a{
    background: -webkit-gradient(linear, center top, center bottom, from(#ededed), to(#fff));
	background-image: linear-gradient(#ededed, #fff);
	border-radius: 12px;
	box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,0.1);
	color: #222;
    pointer-events: none;
    cursor: default;
    }   
</style>
<?php
  $bg = array('bg-01.png', 'bg-02.png','bg-03.png','bg-04.png','bg-05.png','bg-06.png','bg-07.png','bg-08.png','bg-09.png','bg-10.png' ); // array of filenames

  $i = rand(0, count($bg)-1); // generate random number size of the array
  $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
?>
<style type="text/css">

body{
background: url(images/<?php echo $selectedBg; ?>) no-repeat;
background-size: cover;
background-attachment: fixed;　
background-size: cover;
}
</style>
</head>
<body>
<!-- 載入上邊區塊 -->
 <div id="header"></div>

<div id="detail_main">
<div id="collection_toppest">
<div id="collection_toppest_title"> Your Store Collection </div>
<div id="title_desc"> Collect everytings , Enjoy everygames.</div>
</div>
 
<div id="topbox_container">
<div id="community_topbox1">

<div id="topbox1">
<?php 
    if (isset($_SESSION['Username'])){
    if(mysql_num_rows($result) !== 0 ) { while($row = mysql_fetch_array($result)){ 
      
mysql_select_db('stonesga_ch30', $connection) or die('no database'); 
$query2 = sprintf("SELECT * FROM computer_books WHERE title = %s", GetSQLValue($row['item_name'], "text"));
$result2 = mysql_query($query2, $connection) or die(mysql_error());
if ($result2)
{   $row2 = mysql_fetch_array($result2);
    $totalRows2 = mysql_num_rows($result2);}
?>
    
    <div id="collect_img">
    <a href="item_detail.php?pro_id=<?php echo $row2['id']?>"><img src="photo/item/<?php echo $row2['photo']?>"></a><br>
    <?php echo $row['item_name']?>
    </div>
  
<?php } } else { ?>
    
    <div id="nogame">
    No any games in your collection :( <br>
    Start to buy games in <a href="store.php">store</a> right now!
    </div>
    
<?php } } else { ?>
    <div id="nogame2">Please <a href="login_form.php">Login.</a></div>
<?php } ?>
</div>
   
<div id="topbox2">    
<?php 
mysql_select_db('stonesga_ch30', $connection) or die('no database'); 
$query4 = sprintf("SELECT * FROM order_detail WHERE username = %s  ORDER BY order_index DESC", GetSQLValue($_SESSION['Username'], "text"));
$result4 = mysql_query($query4, $connection) or die(mysql_error());
if ($result4)
{   
    $totalRows4 = mysql_num_rows($result4);
    }
?>   
<?php if(mysql_num_rows($result4) !== 0 ) { ?>
<div id="history_container">
<div id="history">Your purchasing history</div><br>
    
    <table>
  <thead>
    <tr>
        <th>(↑) Order - ID*</th>
        <th>Games</th>
        <th>Price</th>
    </tr>
  </thead>
  <tbody>
    
        
<?php while($row4 = mysql_fetch_array($result4)){ ?>
        <tr>
        <td><?php echo $row4['order_index'];?> </td>
        <td><?php echo $row4['item_name'];?></td>
        <td>$ <?php echo $row4['total_price'];?></td>
        </tr>
<?php } ?>
     
  </tbody>
</table>
   
<div id="ps">*PS: Order-ID is composed by DR, your username, purchase date, time and a random number.</div> 
</div>  
<?php } else  { ?>
    <div id="no_purchase"> You have not try to purchase yet :)</div>
<?php } ?>
    
</div>  
    
</div>
    
<div id="community_topbox2">
    
<?php if (isset($_SESSION['Username'])){ ?>
<div id="user_top"><?php echo $row5['username'] ?></div>
<div id="user_image">
<img src="images/user/<?php echo $row5['photo']?>"></div>

<div id="user_detail">
<div id="user_detail_title"><?php echo $row5['unititle'] ?></div>

<div id="user_info">
Join Day : <i><?php echo substr(($row5['datejoin']), 0,10); ?></i> 

Total Games : <i><?php echo $totalRows ?></i>   
    
    <?php   $sum=0; 
    while($row3 = mysql_fetch_assoc($result3)) {
        $value = $row3['order_price'];
        $sum += $value;
    } ?> <br>
Total Spend : <i>$<?php echo $sum ?></i>  
</div>
    
<div id="mycollect">My Collections</div> 
<div id="clickhistory">Purchase History</div>
    
</div>    
    <?php } ?>
</div>
    
</div>    
    
    
    
    
    
</div>  


<!-- 載入下邊區塊 -->
<div id="footer"></div>
</body>
</html>
<?php
// 釋放結果集
mysql_free_result($result);
?>