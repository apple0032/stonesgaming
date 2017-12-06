<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

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

<!----------- Display SUPPORT List ----------->
<?php

 mysql_select_db('stonesga_ch30', $connection) or die('database error');
$query = sprintf("SELECT * FROM support ORDER BY datetime DESC");
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
<div id="support_toppest_title">Support Management Center 
    <a href="support.php"><img src="images/previous.png"></a>
</div>
<div id="support_toppest_desc">This panel is confidential and only allow administrator to browser </div>
</div>    
    

<div id="support_more">
  List of all cases ( Total : <?php echo $totalRows ?> Cases)
  <table class="responstable2">
  
  <tr>
    <th>Status</th>
    <th>Case-ID</th>
    <th>Category</th>
    <th>User</th>
    <th>Title</th>
    <th>Content</th>
    <th>Time (↑)</th>
    <th>Action</th>
  </tr>
  
    <?php while ($row = mysql_fetch_assoc($result)) { ?>
  <tr>
    <td> 
        <?php if(($row['reply'])=="no") { ?>
        Processing 
        <?php } ?>
        <?php if(($row['reply'])=="yes") { ?>
        Wait to close 
        <?php } ?>
        <?php if(($row['reply'])=="deal") { ?>
        Closed 
        <?php } ?>
    </td>
    <td><?php echo $row['id'] ?></td>
    <td><?php echo $row['category'] ?></td>
    <td><?php echo $row['username'] ?></td> 
    <td><?php echo substr(($row['title']),0, 40); ?> <?php if (strlen($row['title'])>50){ echo "........" ;} ?></td>
    <td>
        <?php echo substr(($row['content']),0, 50); ?> <?php if (strlen($row['content'])>60){ echo "........" ;} ?>
    </td>
    <td><div id="manatime"><?php echo $row['datetime'] ?></div></td>
    <td>
        <div id="action">
        <?php if(($row['reply'])=="no") { ?>
        <a href="support_gm_case.php?id=<?php echo $row['id'] ?>">
            <img src="images/control.png"> </a>
        <?php } ?>
        <?php if(($row['reply'])=="yes") { ?>
        <a href="support_gm_case.php?id=<?php echo $row['id'] ?>"><img src="images/control.png"></a>
        <?php } ?>
        <?php if(($row['reply'])=="deal") { ?>
        <a href="support_gm_case.php?id=<?php echo $row['id'] ?>"><img src="images/closed.png"> </a>
        <?php } ?>
        </div>
    </td>
  </tr>
  <?php } ?>
    
</table>
<div id="status">
Status Description: <br>
Processing - User reported latest status and wait us to follow<br>
Wait to close - Waiting user to respond or end the case<br>
Closed - The case is closed with user or administrator and no need to follow
</div>   

</div>
</div>
</section>

<!-- 載入下邊區塊 -->
<div id="footer"></div>   
</body>
</html>
    