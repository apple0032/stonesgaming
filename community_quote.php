<?php
  session_start();
  ob_start();
?>


<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php 

$_SESSION['PrevPage'] = $_SERVER['REQUEST_URI']; 
$_SESSION['login_form_title'] = "Login to join community."
?>

<?php if (!isset($_SESSION['Username']))  header('Location: login_form.php')  ?>

<!-------- READ MEMBER TABLE FIRST -------->
<?php 
    mysql_select_db('stonesga_ch30', $connection) or die('database error'); 
    $query5 = sprintf("SELECT * FROM member WHERE username=%s",
        GetSQLValue($_SESSION['Username'],"text"));

    $result5 = mysql_query($query5, $connection) or die(mysql_error());
    if ($result5)
    {$row5 = mysql_fetch_assoc($result5);} ;
?>



<?php
//-------------------------
// DISPLAY QUOTE COMMENT
//-------------------------

// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在'); 
// 查詢 $_SESSION['database'] 資料表
$query = sprintf("SELECT * FROM community_reply WHERE id=%s ORDER BY datetime ASC", GetSQLValue($_GET['id'], "int"));

// 傳回 $_SESSION['database'] 資料表的結果集
$result = mysql_query($query, $connection) or die(mysql_error());

if ($result)
{
	$row = mysql_fetch_assoc($result);
	$totalRows = mysql_num_rows($result);
}
?>
<!---------------------------------------->



   <!------- Insert new comment with quote -------->

<?php
if (isset($_POST["editor1"]) ) 
{
    
	// 選擇 MySQL 資料庫ch26
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch26不存在');	
	  
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
    
	// 在member資料表內插入一筆新的紀錄
	$query = sprintf("INSERT INTO community_reply (	topic_id,topic_author, topic, username,comment,datetime,quote,quote_ppl) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",  
		GetSQLValue($row['topic_id'], "int"),
        GetSQLValue($row['topic_author'], "text"),
		GetSQLValue($row['topic'], "text"),
        GetSQLValue($_SESSION['Username'], "text"),         
		GetSQLValue($_POST['editor1'], "text"),
        GetSQLValue($datetime, "date"), GetSQLValue($row['comment'], "text"),
        GetSQLValue($row['username'], "text"));
        
    
	// 傳回結果集
	$result = mysql_query($query, $connection);

    $newpoint = $row5['point'] + 1 ;
    $query6 = sprintf("UPDATE member SET point=%s WHERE username=%s",
        GetSQLValue($newpoint,"int"),
        GetSQLValue($_SESSION['Username'],"text"));
    
    $result6 = mysql_query($query6,$connection);
    
    
    
    
	if (($result) and ($result6))  {
        
		$link = $row['topic_id'];
		header("Location: community_detail.php?id=$link");
        
	};
} 
?>
   <!------------------------------------------------>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Community - Quote </title>
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <link href="CSS/community.css" rel="stylesheet" type="text/css" />
    <link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
    <script src="JavaScript/community_detail.js"></script>
    <script src="JavaScript/jBox.min.js"></script>
    <link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
    function CheckFields()
{
	var fieldvalue = document.getElementById("com_title").value;
	if (fieldvalue == "") 
	{
		alert("Please type a title !");
		document.getElementById("com_title").focus();
		return false;
	} ;
    
}
    </script>
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

    
<section id="detail">
<div id="community_main">
    
    <div id="community_bar">
    <div id="goback"><a href="community_detail.php?id=<?php echo $row["topic_id"] ?>"><img src="images/previous.png" class="tooltip" title="BACK"/></a></div>
    <div id="post"><a href="community_photo.php"><img src="images/photo-camera.png" class="tooltip" title="Share a photo?"/></a></div>
    </div>
    
    <div id="post_detail">
    <div id="quote_rule" class="tooltip" title="You are quoting.....">
        <div id="quote_content">
        You are quoting - <?php echo $row['username'] ?>'s comment as below.
        <br><br>
        <div id="quote_main"><?php echo $row['comment'] ?></div>
        </div>
        <div id="quote_noti"><img src="images/quote.png"></div>
    </div>
      
    
    <form method="post" id="quote_form">
		<p>
			<textarea id="editor1" name="editor1"></textarea>
		</p>
		<p>  
            <input type="Reset" value="Reset"/>
			<input type="submit" value="Submit" onclick="return CheckFields();"/>
		</p>
	</form>
    </div>
    
</div>
</section>

    
<!-- 載入下邊區塊 -->
<div id="footer"></div>
</body>
</html>


