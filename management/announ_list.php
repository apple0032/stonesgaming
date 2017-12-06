<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../Connections/function.php'); ?>

<?php 
if (!isset($_SESSION)) {
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

<!----------- Display announcement List ----------->
<?php

 mysql_select_db('stonesga_ch30', $connection) or die('database error');
$query = sprintf("SELECT * FROM announ ORDER BY datetime DESC");
$result = mysql_query($query, $connection) or die(mysql_error());
    if ($result)
{
	$totalRows = mysql_num_rows($result);  
}
    
?>
<!----------------------------------------->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Support</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="CSS/support.css" rel="stylesheet" type="text/css" />
<link href="announ_add.css" rel="stylesheet" type="text/css" />

</head>

<body>
<!-- 載入上邊區塊 -->

    
<section id="detail">
<div id="community_main">
    <h3>Announcement List
    <a href="announ_add.php"><img src="../images/previous.png"></a>
    </h3>
       
    
<div id="support_more">
  List of all announcement ( Total : <?php echo $totalRows ?> Cases)
  <table class="responstable2">
  
  <tr>
    <th>Announce-ID</th>
    <th>User</th>
    <th>Title</th>
    <th>Content</th>
    <th>Time (↑)</th>
    <th>Delete ?</th>
  </tr>
  
    <?php while ($row = mysql_fetch_assoc($result)) { ?>
  <tr>
   
    <td><?php echo $row['id'] ?></td>
    <td><?php echo $row['username'] ?></td> 
    <td><?php echo substr(($row['title']),0, 40); ?> <?php if (strlen($row['title'])>50){ echo "............" ;} ?></td>
    <td>
        <?php echo substr(($row['content']),0, 50); ?> <?php if (strlen($row['content'])>60){ echo "............" ;} ?>
    </td>
    <td><div id="manatime"><?php echo $row['datetime'] ?></div></td>
    <td> 
        <form method="post" id="deleteform">
          <input type="submit" name="delete" value="Delete">
        </form>
        <?php $deleteid = $row['id'] ?>
        
        <?php 
if (isset($_POST['delete'])) {
    mysql_select_db('stonesga_ch30', $connection) or die('database error');
    $query = sprintf("DELETE FROM announ WHERE id=%s", 
        GetSQLValue($deleteid, "int"));
    $result = mysql_query($query, $connection);
    
    if ($result) {
		// 回到前一個網頁 
		header('Location: announ_list.php');   
	};
} ?> 
        
            
    </td>
      
  </tr>
  <?php } ?>
    
</table>

</div>
    
    
</div> 
</section>

 
</body>
</html>













    