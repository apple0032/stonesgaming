<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php 
if (!isset($SESSION)) {
    session_start();
}

$_SESSION['PrevPage'] = $_SERVER['PHP_SELF']; 
?>

<?php $_SESSION['login_form_title'] = "NO permission !"; ?>

<!-------- READ MEMBER TABLE (CHECK PERMISSION)-------->
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

<?php if (!isset($_SESSION['Username']))  header('Location: login_form.php')  ?>
<?php if (($row5['unititle']) !== "admin")  header('Location: login_form.php')  ?>

<!----------- Display SUPPORT List ----------->
<?php

if (isset($_SESSION['Username'])){
 mysql_select_db('stonesga_ch30', $connection) or die('database error');
$query = sprintf("SELECT * FROM support WHERE id=%s",
        GetSQLValue($_GET['id'],"int"));
$result = mysql_query($query, $connection) or die(mysql_error());
    if ($result)
{   
    $row = mysql_fetch_assoc($result);
	$totalRows = mysql_num_rows($result);  
}

 mysql_select_db('stonesga_ch30', $connection) or die('database error');
$query2 = sprintf("SELECT * FROM support_reply WHERE support_id=%s ORDER BY datetime asc",
        GetSQLValue($row['id'],"text"));
$result2 = mysql_query($query2, $connection) or die(mysql_error());
    if ($result2)
{
	$totalRows2 = mysql_num_rows($result2);  
}
    
}
?>
<!----------------------------------------->
<!--------------- Again Form -------------->

<?php
if (isset($_POST["editor1"]) ) 
{
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch26不存在');	
	  
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
    
	$query = sprintf("INSERT INTO support_reply  (support_id,username,support,content,datetime) VALUES ( %s, %s, %s, %s, %s)",  
		GetSQLValue($row['id'], "int"),
        GetSQLValue($_SESSION['Username'], "int"),             
        GetSQLValue("supporter", "text"),
		GetSQLValue($_POST['editor1'], "text"),
        GetSQLValue($datetime, "date"));
    
    $result = mysql_query($query, $connection);
    
    $query3 = sprintf("UPDATE support SET reply='yes' WHERE id=%s",
              GetSQLValue($row['id'], "int"));
    $result3 = mysql_query($query3, $connection);

    if (($result) and ($result3)) {
		// 回到前一個網頁 
		header('Location: support_gm.php');
        
	};
} 
?>
    <!---------------------------------------->

    <!--------------- End case -------------->

<?php
if (isset($_POST["end"]) ) 
{
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch26不存在');	
    
	$query = sprintf("UPDATE support SET reply='deal' WHERE id=%s",  
        GetSQLValue($row['id'], "text"));
    
    $result = mysql_query($query, $connection);
    
    if ($result) {
		// 回到前一個網頁 
		header('Location: support_gm.php');
        
	};
} 
?>
    <!---------------------------------------->
    <!--------------- delete case -------------->

<?php
if (isset($_POST["delete"]) ) 
{
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch26不存在');	
    
	$query = sprintf("DELETE FROM support WHERE id=%s", 
        GetSQLValue($row['id'], "text"));
    
    $result = mysql_query($query, $connection);
    
    if ($result) {
		// 回到前一個網頁 
		header('Location: support_gm.php');
        
	};
} 
?>
    <!---------------------------------------->


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Support</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="CSS/support.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="JavaScript/support.js"></script>
<script src="JavaScript/jBox.min.js"></script>
<link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="CSS/magnific-popup.css" type="text/css">
<script src="JavaScript/jquery.magnific-popup.js"></script>

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
<div id="detail_main">
    
    
<div id="support_toppest">
<div id="support_toppest_title">Support Management Center - Case NO. <?php echo $row['id']?>
<a href="support_gm.php"><img src="images/previous.png"></a>  
</div>
<div id="support_toppest_desc">This panel is confidential and only allow administrator to browser </div>
</div>    
    

<div id="support_more">
 <div id="case_table_top">
    <b>[<?php echo $row['category']?>]&nbsp;&nbsp;
          <?php echo $row['title'] ?></b>
        <i> <?php echo $row['datetime'] ?> </i>
</div>
<table id="case_table_content">
    <tr>
        <td id="case_table_content1" style="vertical-align:top"><img src="images/user2.png"></td>
        <td id="case_table_content2" style="vertical-align:top"><?php echo $row['content'] ?></td>
    </tr>                  
</table>
    
<?php while($row2 = mysql_fetch_assoc($result2)) { ?>
        
        <table id="case_table_content">
            <tr>
                <td id="case_table_content1" style="vertical-align:top">
                    
                <?php if($row2['support'] !== "supporter"){ ?>  
                    <img src="images/user2.png">
                <?php } else { ?>
                    <img src="images/support2.png">Support
                <?php } ?>
                    
                </td>
                <td id="case_table_content2" style="vertical-align:top"><?php echo $row2['content'] ?>
                <div id="support_time"><?php echo $row2['datetime'] ?></div>
                </td>
            </tr>                  
        </table>

        <?php  }  ?>
    
     <?php if($row['reply'] !== "deal") { ?>
    <div id="again-form">
        <form method="post" id="post_form">
		
            <div id="post_topic">Respond to user.</div>
			<textarea id="editor1" name="editor1" placeholder="Respond to user here."></textarea>
		
            <input type="submit" value="Submit" onclick="return CheckFields();"/>
            <input type="Reset" value="Reset"/>
	   </form>
             
             <form method="post" id="end_form">
                <input type="submit" name="end" value="End case"/>
             </form>
            <form method="post" id="delete_form">
                <input type="submit" name="delete" value="Delete case"/>
             </form>
       </div>
    <?php } else { ?>
    
    Notice : This case is closed and wait to delete
        
            <form method="post" id="delete_form">
                <input type="submit" name="delete" value="Delete case"/>
             </form>
        
    <?php } ?>
</div>
</div>
</section>
<div id="gap"></div>

<!-- 載入下邊區塊 -->
<div id="footer"></div>   
</body>
</html>
    